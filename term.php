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
				<h2 class="heading">Terms and Conditions</h2>
				<br>
				<h3 class="heading" style="font-size:1.3em; padding-left:6px">Lincense and access</h3>
				<p style = "text-align: justify;font-family:candara;letter-spacing: 0.05em;">Subject to your compliance with these Conditions of Use and any Service Terms, and your payment of any applicable fees, Electronic Commerce or its content providers grant you a limited, non-exclusive, non-transferable, non-sublicensable license to access and make personal and non-commercial use of the MagicShop Services. This license does not include any resale or commercial use of any MagicShop Service, or its contents; any collection and use of any product listings, descriptions, or prices; any derivative use of any MagicShop Service or its contents; any downloading, copying, or other use of account information for the benefit of any third party; or any use of data mining, robots, or similar data gathering and extraction tools. All rights not expressly granted to you in these Conditions of Use or any Service Terms are reserved and retained by MagicShop or its licensors, suppliers, publishers, rightsholders, or other content providers. No MagicShop Service, nor any part of any MagicShop Service, may be reproduced, duplicated, copied, sold, resold, visited, or otherwise exploited for any commercial purpose without express written consent of MagicShop. You may not frame or utilize framing techniques to enclose any trademark, logo, or other proprietary information (including images, text, page layout, or form) of MagicShop without express written consent. You may not use any meta tags or any other "hidden text" utilizing MagicShop's name or trademarks without the express written consent of MagicShop. You may not misuse the MagicShop Services. You may use the MagicShop Services only as permitted by law. The licenses granted by MagicShop terminate if you do not comply with these Conditions of Use or any Service Terms.</p>
				<br>
				<h3 class="heading" style="font-size:1.3em; padding-left:6px;">Reviews, comments, communications, and other content</h3>
<p style = "text-align: justify;font-family:candara;letter-spacing: 0.05em;">You may post reviews, comments, photos, videos, and other content; send e-cards and other communications; and submit suggestions, ideas, comments, questions, or other information, so long as the content is not illegal, obscene, threatening, defamatory, invasive of privacy, infringing of intellectual property rights (including publicity rights), or otherwise injurious to third parties or objectionable, and does not consist of or contain software viruses, political campaigning, commercial solicitation, chain letters, mass mailings, or any form of "spam" or unsolicited commercial electronic messages. You may not use a false e-mail address, impersonate any person or entity, or otherwise mislead as to the origin of a card or other content. MagicShop reserves the right (but not the obligation) to remove or edit such content, but does not regularly review posted content.
If you do post content or submit material, and unless we indicate otherwise, you grant MagicShop a nonexclusive, royalty-free, perpetual, irrevocable, and fully sublicensable right to use, reproduce, modify, adapt, publish, perform, translate, create derivative works from, distribute, and display such content throughout the world in any media. You grant MagicShop and sublicensees the right to use the name that you submit in connection with such content, if they choose. You represent and warrant that you own or otherwise control all of the rights to the content that you post; that the content is accurate; that use of the content you supply does not violate this policy and will not cause injury to any person or entity; and that you will indemnify MagicShop for all claims resulting from content you supply. MagicShop has the right but not the obligation to monitor and edit or remove any activity or content. MagicShop takes no responsibility and assumes no liability for any content posted by you or any third party.
</p>
			</div>
		</main> <!-- Main Area -->
	</div>

<?php
include $tpl . "footer.php";
ob_end_flush(); ?>	
</html>