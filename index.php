<?php
  ob_start();
  $pageTitle = 'Home Page';
  require "init.php";
  $categories = getCategories($db);
  $itemImages = getItemsImages($db);
  $categories = array_reverse($categories);

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
?>



<div class="container">
		<main>
			<div class="text-center">
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
				<?php else : ?>
			<div class="breadcrumb">
			</div> <!-- End of Breadcrumb-->

			<div class="new-product-section shop">
				<div class="sidebar">
					<div class="sidebar-widget">
						<h3>Category</h3>
						<ul>
							<?php foreach($categories as $cat): ?>
								<li><a href="<?php echo "childcat.php?cat=".urlencode($cat['categoryId']); ?>"><?php echo $cat['categoryName'] ?></a></li>
							<?php endforeach; ?>
						</ul>
					</div>
					<!-- <div class="sidebar-widget">
						<h3>Range Filter</h3>
						<p>
						  <label for="amount"></label>
						  <input type="text" id="amount" readonly style="border:0; color:#F0E68C;  margin-bottom: 5px;">
						</p>						 
						<div id="slider-range"></div>
					</div> -->
				</div>
				<div class="product-content">
					<?php foreach($categories as $cat): ?>
							<div class="product">
								<a href="<?php echo "childcat.php?cat=".urlencode($cat['categoryId']); ?>">
									<img src="<?php
										$image_path = "layout/images/" . $cat['categoryName'] . ".png";
										echo $image_path;
									?>">
								</a>
								<div class="product-detail">
									<h3><?php echo $cat['categoryName'] ?></h3>
									<a href="<?php echo "childcat.php?cat=".urlencode($cat['categoryId']); ?>">VIEW MORE</a>
								</div>
							</div>
					<?php endforeach; ?>
				</div>	
			</div> <!-- New Product Section -->	
			<div class="load-more">
				<a href="#">Load More</a>
			</div>	
			<?php endif ?>	
		</main> <!-- Main Area -->
	</div>
<?php
include $tpl . "footer.php";
ob_end_flush(); ?>	