<?php
ob_start();
$pageTitle = 'Orders';
$images = "layout/images/";
include "init.php";

$sellerData = getSeller($db, $_SESSION['username'])[0];

$itemIDs = getItemIDsBySellerID($_SESSION['id'], $db);
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


    <div class="container">
        <h1 class="text-center m-5">History of <?= $sellerData["userName"] ?> </h1>
        <table class="table table-hover text-center">
            <thead class="bg-success text-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Order date</th>
                <th scope="col">Buyer</th>
                <th scope="col">Details</th>
            </tr>
            </thead>
            <tbody>
                <?php
                $stt = 1;
                $cnt = count($itemIDs);
                for($i = 0; $i < $cnt; $i++){
                    $orderbyitemId = getOrdersByItemID($itemIDs[$i], $db);
                    $cntOrders = count($orderbyitemId);
                    for($j = 0; $j < $cntOrders; $j++) {
                        $buyer = getBuyerById($orderbyitemId[$j]['buyerId'], $db)[0];
                    ?>
                    <tr>
                        <th scope="row"><?= $stt ?></th>
                        <td> <?= $orderbyitemId[$j]['orderPrice'] ?> </td>
                        <td> <?= $orderbyitemId[$j]['quantity'] ?> </td>
                        <td> <?= $orderbyitemId[$j]['orderDate'] ?></td>
                        <td> <?= $buyer->userName ?> </td>
                        <?php if ($orderbyitemId[$j]['isShip']): ?>
                        <td>
                            <a href="details.php?itemid=<?=$orderbyitemId[$j]['itemId']?>&buyerId=<?=$orderbyitemId[$j]['buyerId']?>&billId=<?=$orderbyitemId[$j]['billId']?>" class="btn btn-primary">View</a>
                        </td>
                        <?php else: ?>
                        <td>
                        </td>
                    <?php endif; ?>
                    </tr>
                    <?php
                    $stt = $stt + 1;
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
<?php include $tpl . "footer.php";
ob_end_flush(); ?>