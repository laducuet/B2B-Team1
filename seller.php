<?php
ob_start();
require "init.php";
if (!isset($_GET["id"])) {
  echo '404';
  return;
}
$imagesUploades = "data/uploads/items/";
$sellerData = getSellerId($db, $_GET['id'])[0];

if (!isset($sellerData)) {
  echo 'Seller not found';
}
$sellerMobiles = getSellerMobiles($_GET['id'], $db);
$forSaleItems = getSellerForSaleItems($_GET['id'], $db);
$soldItems = getSellerSoldOutItems($_GET['id'], $db);
$deletedItems = getSellerDeletedItems($_GET['id'], $db);

?>


<div class="container p-3 position-static">
  <div
    class="row shadow rounded p-3 m-5 text-lg-start text-md-center text-sm-center border-start border-5 border-success">
    <div class="col-lg-3 m-auto">
      <h1 class="card-title">
        <?= $sellerData["userName"] ?>
      </h1>
    </div>
    <div class="col-lg-7 m-auto">
      <div class="m-2">
        <h4 class="d-inline-block">Email: </h4>
        <a href="mailto:<?= $sellerData["email"] ?>" class="mb-2 link-dark fa-1x ">
          <h5 class="text-muted d-inline-block">
            <?= $sellerData["email"] ?>
          </h5>
        </a>
      </div>
      <div class="m-2">
        <h4 class="d-inline-block">Mobile: </h4>
        <h5 class="mb-2 text-muted d-inline-block ">
          <ul class="list-group list-group-flush profile_scroll" style="max-height: 120px;overflow: auto">
            <?php
            foreach ($sellerMobiles as $mobile) {
              echo "<li class='list-group-item'> $mobile->phoneNo</li>";
            }
            ?>

          </ul>
        </h5>
      </div>
      <div class="m-2">
        <h4 class="d-inline-block">Join date: </h4>
        <h5 class=" mb-2 text-muted d-inline-block">
          <?= $sellerData["joinDate"] ?>
        </h5>
      </div>
    </div>

  </div>


  <!------------------------------------------------>
  <!--   Dashboard   -->
  <!------------------------------------------------>
  <div class="row justify-content-around m-3">
    <div class="col-xl-3 col-md-6">
      <div class="card">
        <div class="card-body">
          <h4 class="header-title mt-0 mb-4">Total Reviews</h4>
          <div class="row flex-row flex-nowrap justify-content-evenly">
            <div style="width: fit-content">
              <i class="bi bi-people-fill fa-4x"></i>
            </div>
            <div class="text-end" style="width: fit-content">
              <h2 class="fw-normal pt-2 mb-1 text-center">
                <?= $sellerData["likes"] + $sellerData["disLikes"] ?>
              </h2>
              <p class="text-muted mb-1 text-center">Review</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6">
      <div class="card">
        <div class="card-body">
          <h4 class="header-title mt-0 mb-4">Total likes</h4>
          <div class="row flex-row flex-nowrap justify-content-evenly">
            <div style="width: fit-content">
              <i class="bi bi-hand-thumbs-up fa-4x"></i>
            </div>
            <div class="text-end" style="width: fit-content">
              <h2 class="fw-normal pt-2 mb-1 text-center">
                <?= $sellerData["likes"] ?>
              </h2>
              <p class="text-muted mb-1 text-center">Like</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6">
      <div class="card">
        <div class="card-body">
          <h4 class="header-title mt-0 mb-4">Total dislikes</h4>
          <div class="row flex-row flex-nowrap justify-content-evenly">
            <div style="width: fit-content">
              <i class="bi bi-hand-thumbs-down fa-4x"></i>
            </div>
            <div class="text-end" style="width: fit-content">
              <h2 class="fw-normal pt-2 mb-1 text-center">
                <?= $sellerData["disLikes"] ?>
              </h2>
              <p class="text-muted mb-1 text-center">Dislike</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-md-6">
      <div class="card">
        <div class="card-body">
          <h4 class="header-title mt-0 mb-4">Total transactions</h4>
          <div class="row flex-row flex-nowrap justify-content-evenly">
            <div style="width: fit-content">
              <i class="bi bi-cash-coin fa-4x"></i>
            </div>
            <div class="text-end" style="width: fit-content">
              <h2 class="fw-normal pt-2 mb-1 text-center">
                <?= $sellerData["transactions"] ?>
              </h2>
              <p class="text-muted mb-1 text-center">Transaction</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!------------------------------------------------>
  <!--   For sale   -->
  <!------------------------------------------------>
  <div class="row justify-content-around" id="forSale">

    <div class="row justify-content-between m-3">
      <div class="col-lg-8 jumbotron m-3">
        <div class="container">
          <h1 class="display-4">For sale</h1>
          <hr class="my-4">

          <p class="lead">List of all items that are offered for sale.</p>
        </div>
      </div>
    </div>
    <div class="col-sm-12">

      <section class="row flex-row flex-nowrap p-3 overflow-auto profile_scroll rounded position-static "
        style="gap: 60px;">
        <?php
        foreach ($forSaleItems as $forSaleItem) {
          $imageName = getImageOfAnItem($forSaleItem->itemId, $db);
          $childcategory = getchildcategory($forSaleItem->childcategoryId, $db)[0];
          $countOrders = getPendingOrdersCount($forSaleItem->itemId, $db);
          echo '
                    <div class="col-lg-3 m-0 text-center">
                        <div class="card m-md-auto shadow" style="width: 18rem;">
                                '; ?>

          <a href="reviewItem.php?do=Manage&itemId=<?= $forSaleItem->itemId ?>&itemName=<?= $forSaleItem->title ?>"
            style="text-decoration: none;color: black">
            <?php
            if ($imageName) {
              echo '<img src="' . $imagesUploades . $imageName[0]->image . ' " class="card-img-top" alt="Item">';
            } else {
              echo '<img src="' . $imagesUploades . 'default.png" class="card-img-top" alt="Item">';
            }
            ?>
            <?php echo '       
                    <div class="card-body">
                                <h5 class="card-title" style = "font-family:candara;letter-spacing: 0.05em;font-weight:bold;">' . $forSaleItem->title . '</h5>
                                
                                <h6 class="card-title" style = "font-family:candara;letter-spacing: 0.05em;">' . $childcategory->childcategoryName . '</h6>
                                <p class="card-text" style = "font-family:candara;letter-spacing: 0.05em;">' . $forSaleItem->description . '</p>
                                <h4 class="card-title" style = "font-family:candara;letter-spacing: 0.05em;">' . $forSaleItem->price . '$</h4>
                                <h6 class="card-title" style = "font-family:candara;letter-spacing: 0.05em;">' . $forSaleItem->addDate . '</h6>
                                <a href="reviewItem.php?do=Manage&itemId=' . $forSaleItem->itemId . '&itemName=' . $forSaleItem->title . '" 
                                class="btn btn-outline-success btn-lg" style = "font-family:candara;letter-spacing: 0.05em;">View</a>
                            </div>
                            </a>
                        </div>
                    </div>
                    ';
        } ?>
      </section>
    </div>
  </div>

</div>

<?php
include $tpl . 'footer.php';
ob_end_flush();
?>