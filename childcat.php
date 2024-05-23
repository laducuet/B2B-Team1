<?php
  ob_start();
  require "init.php";
  $items = getItems($db);
  $childcategories = getChildCategories($db);
  $childcategories = array_reverse($childcategories);

  if(isset($_GET['cat'])){
    $childcategories = getChildByCategory($db,$_GET['cat']);
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

    <div id="main_slider" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <div class="container">
            <h1 class="mua_acc_taital"></h1>
            <div class="mua_acc_section_2">
              <div class="row">
                <?php foreach($childcategories as $childcat): ?>
                  <div class="col-lg-4 col-sm-4">
                    <div class="box_main" style = "box-shadow: rgba(0, 0, 0, 0.4) 0px 0px 10px; border-radius: 10px">
                      <h4 class="shirt_text" style = "font-family:candara;letter-spacing: 0.05em;"><?php echo $childcat['childcategoryName'] ?></h4>
                      <p class="price_text" style = "font-family:candara;letter-spacing: 0.05em;">
                        Số lượng: <span style="color: #262626">
                        <?php 
                          echo $childcat['totalItems'];
                        ?>
                      </span>
                      </p>
                      <p class="price_text" style = "font-family:candara;letter-spacing: 0.05em;">
                        Đã bán: <span style="color: #262626">
                        <?php 
                          $count = 0;
                          $n = count($items);
                          for($i=0;$i < $n;++$i){
                            if($items[$i]['childcategoryId']==$childcat['childcategoryId']){
                                $quantity = getQuantityFromOrdersAndItems($items[$i]['itemId'], $db);
                                $count = $count + $quantity;
                              } 
                            }
                          echo $count;
                        ?>
                        </span>
                      </p>
                      <div class="tshirt_img" style="line-height: 270px;">
                          <img src="<?php
                            $image_path = "layout/images/" . $childcat['childcategoryName'] . ".jpg";
                            echo $image_path;
                          ?>">
                      </div>
                      <div class="see_all">
                        <ul>
                          <li><a href="<?php echo "acc.php?childcat=".urlencode($childcat['childcategoryId']); ?>" style = "font-family:candara;letter-spacing: 0.05em; font-weight: bold">Xem tất cả</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <?php endforeach; ?>
              </div>

            </div>
          </div>

        </div>

      </div>

    </div>
    
  </div>
  
  <?php 
include $tpl . 'footer.php';
ob_end_flush();
?>