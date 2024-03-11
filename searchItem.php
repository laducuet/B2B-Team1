<?php
   ob_start();
   $pageTitle = 'Home Page';
   require "init.php";
   $itemImages = getItemsImages($db);
   $childcategories = getChildCategories($db);
   $childcategories = array_reverse($childcategories);
   $items = getItems($db);
   $noItems = false;
   if(isset($_GET['cat'])){
     $items = getItemsByCategory($db,$_GET['cat']);
     if(count($items)==0)
     $noItems = true;
   }
   $inputSearchError = false;
   $noItemsSearch = false;
   if(isset($_GET['keyword'])){
     $_GET['keyword'] = htmlspecialchars($_GET['keyword']);
     if($_GET['keyword'] == "")
       $inputSearchError =true;
     else {
     $items = searchForItems($db,$_GET['keyword']);
     if(count($items)==0)
       $noItemsSearch = true;
     }
   }
   // Linking item cateogry to each item
   $iterI1 = count($childcategories);
  $iterk1 = count($items);
    for($i=0; $i < $iterI1 ; ++$i) {
      for($k=0;$k < $iterk1;++$k){
        if($items[$k]['childcategoryId']==$childcategories[$i]['childcategoryId']){
          $items[$k]["childcategoryName"]=$childcategories[$i]['childcategoryName'];
          } 
        }
    }
    $iterI1 = count($itemImages);
    // linking items image to each item
    for($i=0; $i < $iterI1 ; ++$i) {
      for($k=0;$k < $iterk1;++$k){
        if($items[$k]['itemId']==$itemImages[$i]['itemId']){
          $items[$k]["image"]=$itemImages[$i]['image'];
          } 
        }
    }    
   ?>
<div class="container">
   <main>
      <div class="text-center">
         <?php if(isset($_GET['keyword'])&&($inputSearchError)): ?>
         <p class="alert-danger ms-auto me-auto pt-5 pb-5" style="width:50%; font-size: 24px">Enter a valid value!</p>
         <?php elseif(isset($_GET['keyword'])&&($noItemsSearch)): ?>
         <p class="alert-danger ms-auto me-auto pt-5 pb-5" style="width:50%; font-size: 24px">No items match this word
            <?php echo " " .$_GET['keyword']; ?> 
         </p>
         <?php elseif($noItems): ?>
         <p class="alert-danger ms-auto me-auto pt-5 pb-5" style="width:50%; font-size: 24px">No items in this Category</p>
         <?php else: ?>
            <div class="main-page pb-5 pt-5 bg-light">
    <div class="text-center">
      <div class="row row-of-card g-5 justify-content-center align-items-center">
        <?php foreach($items as $ite): ?>
        <?php if($ite['isDeleted']==0): ?>
        <div class="col-8 col-lg-4 col-xl-3 ">
          <a href="<?php echo "reviewitem.php?do=Manage&itemId=" . $ite['itemId'] . "&itemName=" . $ite['title'] ?>"
            style="text-decoration:none; color:black">
            <div class="card m-md-auto shadow" style="width: 18rem;">
              <img src="<?php 
              if (isset($ite['image'])) {
                echo $dataimages . $ite['image'];
              } else {
                echo $dataimages . "default.png";
              }
              ?>" class="card-img-top" alt="Item">
              <div class="card-body">
                <h5 class="card-title"><?php echo $ite['title'] ?></h5>
                <h6 class="card-title"><?php echo $ite['childcategoryName'] ?></h6>
                <p class="card-text"> <?php echo $ite['description'] ?></p>
                <div class="price">
                  <?php if ($ite['discount'] == 0): ?>
                  <div class="new-price">
                    <?php echo $ite['price'] . "$"; ?>
                  </div>
                  <?php else: ?>
                  <div class="new-price">
                    <?php echo $ite['price'] - ($ite['price'] * ($ite['discount']/100)) . "$"; ?>
                  </div>
                  <div class="discount">
                    <?php echo $ite['discount'] . "%"; ?>
                  </div>
                  <div class="old-price">
                    <?php echo $ite['price'] . "$"; ?>
                  </div>
                  <?php endif; ?>
                </div>
                <div class="card-body">
                  <?php if($ite['quantity']==0): ?>
                  <span class="badge p-3 rounded-pill bg-danger">Sold Out!</span>
                  <?php else: ?>
                  <a href="<?php echo "reviewitem.php?do=Manage&itemId=" . $ite['itemId'] . "&itemName=" . $ite['title'] ?>"
                    class="btn btn-success">Review</a>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </a>
        </div>
        <?php endif; ?>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>
         <?php endif ?>
      </div>
   </main>
   <!-- Main Area -->
</div>
<?php
   include $tpl . "footer.php";
   ob_end_flush(); ?>