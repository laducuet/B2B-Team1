<?php
  ob_start();
  $pageTitle = 'Home Page';
  require "init.php";

  
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
		<main>
			<div class="about">
				<h2 class="heading">Instructions</h2>
				<p>Instructions for registration, login, product posting, purchase ...</p>
			</div>
		</main> <!-- Main Area -->
	</div>

	

</body>
<?php
include $tpl . "footer.php";
ob_end_flush(); ?>	
</html>

