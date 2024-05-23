<?php
  ob_start();
  require 'admin/connect.php' ;
  $func = "includes/functions/";
  require $func . 'controller.php';
  $unSeenFlag = false;
  $images = "layout/images/";
  session_start();

  $_SESSION['noOfNewNotification'] = 0;
  $_SESSION['noOfOldNotification'] = 0;

  if(isset($_SESSION["typeOfUser"]) && $_SESSION["typeOfUser"]==="buyer"){
  $User = getBuyer($db,$_SESSION["username"]);
  $Notifications = getNotificationsForBuyer($db,$User[0]['ID']);
  $_SESSION['userID'] = $User[0]['ID'];
  $_SESSION['not'] = $Notifications;
  foreach($Notifications as $noti){
    if($noti['seen']==0){
      $unSeenFlag = true;
      break;
      }
    }
  }
  else if(isset($_SESSION["typeOfUser"]) && $_SESSION["typeOfUser"]==="seller"){
  $User = getSeller($db,$_SESSION["username"]);
  $Notifications = getNotificationsForSeller($db,$User[0]['ID']);
  $_SESSION['userID'] = $User[0]['ID'];
  $_SESSION['not'] = $Notifications;
  foreach($Notifications as $noti){
    if($noti['seen']==0){
      $unSeenFlag = true;
      break;
    }
  }
}
else if(isset($_SESSION["typeOfUser"]) && $_SESSION["typeOfUser"]==="admin"){
header("Location: signin.php");
}
?>
<?php if(isset($_SESSION["username"])): ?>
	
  <header style = "background-color:#FFBE98;">  
		<div class="container" >
			<div class="brand">
				<div class="logo">
					<a href="index.php">
						<img src="img/icons/online_shopping.png">
						<div class="logo-text">
							<p class="big-logo" style = "font-family: candara;line-height: 1.15; padding: 20px;font-size:30px;">Electronic Commerce</p>
							<!-- <p class="small-logo"></p> -->
						</div>
					</a>
				</div> <!-- logo -->
        <div class="menu-bar">
				<div class="search-bar">
					<form>
						<div class="form-group" style = "margin: -20px;">
							 <input type="text" class="form-control" name="keyword" placeholder="Type here to search..." style = "font-family: Arial, sans-serif;line-height: 1.15">
							<img src="img/icons/search.png">
						</div>
					</form>
				</div>
			</div> <!-- menu -->
				<div class="shop-icon">
					<div class="dropdown" style = "margin-right:5px">
						<img src="img/icons/account.png">
						<div class="dropdown-menu">
							<ul>
                <?php if($_SESSION["typeOfUser"]==="buyer"): ?>
                  <li><a href="profileBuyer.php" style = "font-family:candara;letter-spacing: 0.05em;">PROFILE</a></li>
                <?php elseif($_SESSION["typeOfUser"]==="seller"): ?>
                  <li><a href="profileSeller.php" style = "font-family:candara;letter-spacing: 0.05em;">PROFILE</a></li>
                <?php endif; ?>
								<?php if($_SESSION["typeOfUser"]==="buyer"): ?>
                  <li><a href="<?php echo "cart.php?username=".$User[0]['userName']?>" style = "font-family:candara;letter-spacing: 0.05em;">CART</a></li>
                <?php elseif($_SESSION["typeOfUser"]==="seller"): ?>
                  <li><a href="history.php" style = "font-family:candara;letter-spacing: 0.05em;">HISTORY</a></li>
                <?php endif; ?>
							</ul>
						</div>
					</div>
          
					<div class="dropdown">
						<a href="logout.php">
							<img src="img/icons/logout.png">
						</a>
						
					</div>
          <div class="dropdown">
          <?php if($unSeenFlag): ?>
            <img src="img/icons/heart_fill.png" style = "margin-left:5px;">
            <?php else: ?>
              <img src="img/icons/heart.png"style = "margin-left:5px;">
            <?php endif; ?>
						<ul class="dropdown-menu dropdown-menu-notification" aria-labelledby="navbarDropdown11" style="right: 0;">
           
      <?php foreach($Notifications as $noti): ?>
      <?php if($noti['seen']===0): ?>
      <?php $_SESSION['noOfNewNotification'] = $_SESSION['noOfNewNotification'] +1; ?>
      <li><a class="dropdown-item add-red noti-items-red" href="notification.php"><?php echo
       "Notification From ". $noti['fName']." ".$noti['lName']; ?></a>
      </li>
      <?php endif; ?>
      <?php endforeach; ?>
      <?php if($_SESSION['noOfNewNotification']!=0): ?>
      <li>
        <hr class="dropdown-divider">
      </li>
      <?php endif; ?>
      <?php foreach($Notifications as $noti): ?>
      <?php if($noti['seen']===1): ?>
      <?php $_SESSION['noOfOldNotification'] = $_SESSION['noOfOldNotification'] +1; ?>
      <li><a class="dropdown-item" href="notification.php"><?php echo
       "Notification From ". $noti['fName']." ".$noti['lName']; ?></a></li>
      <?php endif; ?>
      <?php endforeach; ?>
    </ul>

					</div>
				</div> <!-- shop icons -->
			</div> <!-- brand -->
		</div> <!-- container -->
	</header> <!-- header -->
<?php else: ?>
  <header style = "background-color:#FFBE98;">
		<div class="container">
			<div class="brand">
				<div class="logo">
					<a href="index.php">
						<img src="img/icons/online_shopping.png">
						<div class="logo-text">
							<p class="big-logo" style = "font-family: candara;line-height: 1.15; padding: 20px;font-size:30px;">Electronic Commerce</p>
							<!-- <p class="small-logo">Team 1</p> -->
						</div>
					</a>
				</div> <!-- logo -->
        <div class="menu-bar">
				<div class="search-bar">
					<form action="searchItem.php" method="GET">
  <div class="form-group">
    <input type="text" class="form-control" name="keyword" placeholder="Type here to search..." style = "font-family: Arial, sans-serif;line-height: 1.15">
    <img src="img/icons/search.png">
  </div>
</form>
				</div>
			</div> <!-- menu -->
				<div class="shop-icon" style= "width: 15%;">
          <div class="dropdown" style = "margin-right: 5px;">
          <a href="signin.php">
						<img src="img/icons/signin.png">
          </a>
					</div>
					<div class="dropdown" style = "margin-right: 5px;">
          <a href="signup.php">
						<img src="img/icons/signup.png" >
          </a>
					</div>
          <div class="dropdown" style = "margin-right: 5px;">
          <a href="about.php" >
						<img src="img/icons/aboutus.png">
            </a>
					</div>
          
				</div> <!-- shop icons -->
        
			</div> <!-- brand -->
		</div> <!-- container -->
	</header> <!-- header -->
  
<?php endif;
ob_end_flush();
?>