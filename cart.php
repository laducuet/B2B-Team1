<?php
ob_start();
$pageTitle = "Cart";
include "init.php";
if(!isset($_SESSION['typeOfUser'])||(isset($_SESSION['typeOfUser'])&&$_SESSION['typeOfUser']!='buyer')){
    header("Location: index.php");
}
$cartID = GetCartIDFromBuyer($_SESSION["id"], $db)[0]['cartId'];
$itemCount=countItemCart($db,$cartID);
$items=cartItem($db,$_SESSION['id']);
if (isset($_GET['deleteItem'])) {
    deleteItemCart($cartID, $_GET['deleteItem'], $db);
    updateTheCartAfterDeletion($cartID, $_GET['finalPrice'], $db);
    header("Location: cart.php");
}

if(isset($_GET['orderPrice'])&&isset($_GET['qty'])&&isset($_GET['userID'])&&isset($_GET['itemID'])){
    $_SESSION['orderStatus'] = -1; 
    $_SESSION['orderStatus'] = makeAnOrder($db,$cartID, $_GET['userID'],$_GET['itemID'],$_GET['orderPrice'],$_GET['qty']);
    if($_SESSION['orderStatus'] === -1)
      header("Location: cart.php?Ordersuccess=true");
    else 
      header("Location: cart.php?Ordersuccess=false");
}

if(isset($_GET['Ordersuccess'])&&$_GET['Ordersuccess']==='true'){
  $_SESSION['Ordersuccess']='true';
  header("Location: cart.php");
  return;
}
if(isset($_GET['Ordersuccess'])&&$_GET['Ordersuccess']==='false'){
  $_SESSION['Ordersuccess']='false';
  header("Location: cart.php");
  return;
}
?>
<?php if(isset($_GET['keyword'])): ?>
					<?php if ($inputSearchError) :?>
					<p class="alert-danger ms-auto me-auto pt-5 pb-5" style="width:50%">Enter a valid value!</p>
					<?php elseif(($noItemsSearch)): ?>
					<p class="alert-danger ms-auto me-auto pt-5 pb-5" style="width:50%">No items match this word
						<?php echo " " .$_GET['keyword']; ?> </p>
					<?php elseif($noItems): ?>
					<p class="alert-danger ms-auto me-auto pt-5 pb-5" style="width:50%">No items in this Category</p>
					<?php else: ?>
						<?php header("Location: searchItem.php?keyword=".$_GET['keyword']); ?>
					<?php endif ?>
          <?php endif ?>

<div class="container-lg text-center shadow p-5 mt-4 mb-4 border-3">
  <div class="text-center">
    <?php if(isset($_SESSION['Ordersuccess'])&&$_SESSION['Ordersuccess']=='true'): ?>
    <div class="alert alert-success m-auto mb-5" style="width: 50%;" role="alert">Order Done Successfully</div>
    <?php unset($_SESSION['Ordersuccess']); ?>
    <?php elseif(isset($_SESSION['Ordersuccess'])&&$_SESSION['Ordersuccess']==='false'): ?>
    <?php if($_SESSION['orderStatus']==0): ?>
    <div class="alert alert-danger m-auto mb-5" style="width: 50%;" role="alert">Selected quantity no longer available!
      Item is sold out.. Order can't be done </div>
    <?php unset($_SESSION['Ordersuccess']); ?>
    <?php else: ?>
    <div class="alert alert-danger m-auto mb-5" style="width: 50%;" role="alert">Selected quantity no longer available!
      Only <?php echo $_SESSION['orderStatus'] ?> Left.. Order can't be done </div>
    <?php unset($_SESSION['Ordersuccess']); ?>
    <?php endif; ?>
    <?php endif; ?>
    <?php if($itemCount==0): ?>
    <div class="alert alert-info m-auto mb-5" style="width: 50%;" role="alert">Cart is Empty</div>
    <?php endif; ?>
    <div class="row row-of-card g-5 justify-content-start align-items-center">
      <?php
            foreach($items as $k):
              $finalPrice= (int)$k['quantity'] * floatval($k['price'] - $k['price'] * ($k['discount']/100));
            ?>
      <div class="col-8 col-lg-4 col-xl-3 ">
        <div class="card m-md-auto shadow" style="width: 19rem;">
          <a href="cart.php?deleteItem=<?php echo $k['itemId']?>&finalPrice=<?php echo $finalPrice; ?>"
            id="stopRedirect" class="btn btn-danger rounded-pill position-absolute"
            style="width: fit-content; top: 0;right: 0" onclick="return deleteItemCart()">
            <span class="badge"><i class="bi bi-trash"></i>
            </span></a>
          <?php $imageOfitem=GetImagesByID($k['itemId'],$db); ?>
          <img src="<?php 
              if (isset($imageOfitem[0]['image'])) {
                echo $dataimages .$imageOfitem[0]['image'];
              } else {
                echo $dataimages . "default.png";
              }
              ?>" class="card-img-top" alt="Item">
          <div class="card-body ">
            <h5 class="card-title">
              <?php echo $k['title']?> </h5>
            <p class="card-text"><?php echo $k['description'] ?> </p>
            <h4 class="card-title"> <?php echo  'Quantity: ' .$k['quantity'] ?> </h4>
            <h4 class="card-title"> <?php echo $finalPrice ?> $</h4>
            <div class="card-body">
              <a href="reviewItem.php?do=Manage&itemId=<?php echo $k['itemId']; ?>&itemName=<?php echo $k['title']; ?>"
                class="btn btn-warning ">Edit quantity</a>
                <?php if (getCategoryNameById($db, $k['itemId']) == "GAME"): ?>
                  <a href="cart.php?itemID=<?php echo $k['itemId']?>&userID=<?php echo $_SESSION['id']?>&orderPrice=<?php echo $finalPrice?>&qty=<?php echo $k['quantity']?>"
                  class="btn btn-primary">PayNow</a>
                <?php else: ?>
                  <a href="checkout.php"
                    class="btn btn-primary">Order Item</a>
                <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach ?>
    </div>
  </div>
  <div class="container">
    <h6 class="mt-3 display text-center text-dark"></h6>
    <h6 class="display text-center text-dark"></h6>
  </div>
</div>


<?php 
include $tpl . 'footer.php';
ob_end_flush();
?>