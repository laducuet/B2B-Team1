<?php
  ob_start();
  require 'admin/connect.php' ;
  $func = "includes/functions/";
  require $func . 'controller.php';
  $unSeenFlag = false;
  $images = "layout/images/";
  session_start();
  
  if(isset($_SESSION["typeOfUser"]) && $_SESSION["typeOfUser"]==="buyer"){
  $User = getBuyer($db,$_SESSION["username"]);
  $Notifications = getNotificationsForBuyer($db,$User[0]['ID']);
  $_SESSION['userID'] = $User[0]['ID'];
  $_SESSION['not'] = $Notifications;
  foreach($Notifications as $noti){
    if($noti['seen']==='0'){
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
    if($noti['seen']==='0'){
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
  <div class="banner_bg_main">
    <header>
      <div class="header-left">
        <div id="parent-container">
          <div id="video-container">
            <img src="hi.gif" alt="GIF image" />
          </div>
          <div id="overlay"></div>
        </div>
        <nav>
          <ul>
            <li><a class="active" href="index.php">Trang Chủ</a></li>
            <li><a href="#main_slider">Sản Phẩm</a></li>
            <li><a href="#" id="nap-tien-link">Nạp Tiền</a></li>
            <li><a href="#electronic_main_slider" id="myBtn2">Dịch Vụ</a></li>
            <li><a href="#jewellery_main_slider">Tin Tức</a></li>
            <li><a href="#">Hỗ Trợ</a></li>
          </ul>
        </nav>
      </div>
      <div class="header-right">
        <div class="login-signup">
          <?php if($_SESSION["typeOfUser"]==="buyer"): ?>
            <a href="profileBuyer.php" id="infoBtn">Hi, <?php echo $User[0]['fName']." ". $User[0]['lName'] ?></a>
          <?php elseif($_SESSION["typeOfUser"]==="seller"): ?>
            <a href="profileSeller.php" id="infoBtn">Hi, <?php echo $User[0]['fName']." ". $User[0]['lName'] ?></a>
          <?php endif; ?>

          <a href="logout.php" id="signoutBtn">Sign out</a>
        </div>
        <div class="hamburger">
          <div></div>
          <div></div>
          <div></div>
        </div>
      </div>
    </header>
    <script>
      hamburger = document.querySelector(".hamburger");
      nav = document.querySelector("nav");
      hamburger.onclick = function () {
        nav.classList.toggle("active");
      };
    </script>
  </div>
<?php else: ?>
  <div class="banner_bg_main1">
        <header>
            <div class="header-left">
                <div id="parent-container">
                    <div id="video-container">
                        <img src="hi.gif" alt="GIF image" />
                    </div>
                    <div id="overlay"></div>
                </div>
                <nav>
                    <ul>
                        <li><a href="index.php">Trang Chủ</a></li>
                        <li><a href="#main_slider">Sản Phẩm</a></li>
                        <li><a href="#" id="nap-tien-link">Nạp Tiền</a></li>
                        <li><a href="#dichvu_main_slider">Dịch Vụ</a></li>
                        <li><a href="#tintuc_main_slider">Tin Tức</a></li>
                        <li><a href="#" id="myBtn2">Hỗ Trợ</a></li>
                    </ul>
                    <div class="login-signup">
                        <a href="signin.php" id="loginBtn_">Đăng nhập</a> or
                        <a href="signup.php" id="signupBtn_">Đăng ký</a>
                    </div>
                </nav>
            </div>
            <div class="header-right">
                <div class="login-signup">
                    <a href="signin.php" id="loginBtn">Đăng nhập</a>
                    <a href="signup.php" id="signupBtn">Đăng ký</a>
                </div>
                <div class="hamburger">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
        </header>
        <script>
            hamburger = document.querySelector(".hamburger");
            nav = document.querySelector("nav");
            hamburger.onclick = function () {
                nav.classList.toggle("active");
            };
        </script>
    </div>
<?php endif;
ob_end_flush();
?>
