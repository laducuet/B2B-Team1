<?php
$noNavbar = '';
$pageTitle = 'SignIn';
$images = "layout/images/";
include "init.php";
session_start();
if (isset($_POST['username']))
    $_SESSION["printUserName"] = htmlentities($_POST['username']);
if (isset($_POST['username']) && isset($_POST['password'])) {
    if (isset($_SESSION["username"])) {
        unset($_SESSION["username"]);
        unset($_SESSION["id"]);
        unset($_SESSION['typeOfUser']);
    }
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        if (isset($_SESSION["printUserName"]))
            unset($_SESSION["printUserName"]);
        $username = htmlentities($_POST['username']);
        $password = $_POST['password'];
        $truePassword_id = getBuyerPassword_ID($username,$db);
        if($truePassword_id!=false)
            $typeOfUser = "buyer";
        else{
            $truePassword_id = getSellerPassword_ID($username,$db);
            if($truePassword_id!=false)
                $typeOfUser = "seller";
            else{
                $truePassword_id = getAdminPassword_ID($username,$db);
                if($truePassword_id!=false)
                    $typeOfUser = "admin";
            }
        }
        if ($password == $truePassword_id[0]->password) {
            $_SESSION['username'] = htmlentities($_POST['username']);
            $_SESSION['id'] = $truePassword_id[0]->ID;
            $_SESSION['typeOfUser'] = $typeOfUser;
            if($typeOfUser=="admin"){
                header("Location: admin/index.php");
                return;
            }
            header("Location: index.php");
            return;
        } else {
            $_SESSION['error'] = "Incorrect password or username";
            header("Location: signin.php");
            return;
        }
    } elseif (!empty($_POST['username']) && empty($_POST['password'])) {
        $_SESSION['error'] = "Please enter your password";
        header("Location: signin.php");
        return;
    } elseif (empty($_POST['username']) && !empty($_POST['password'])) {
        $_SESSION['error'] = "Please enter your username";
        header("Location: signin.php");
        return;
    } else {
        $_SESSION['error'] = "Please enter your username and password";
        header("Location: signin.php");
        return;
    }
}

?>
    <div class="container-fluid text-center shadow p-2" style="position: sticky; top:0; opacity: 1; background-color: white; z-index:100000;">
        <a href="index.php" class="navbar-brand"  
        style="text-decoration: none;color: black; font-family: 
        MyCustomFont, Arial, sans-serif; font-weight: bold; font-size: 30px; margin-top: 30px">
        <img src="img/icons/online_shopping.png" width="50" height="50" alt="logo" >
            Electronic Commerce
        </a>
    </div>
    <div class="row justify-content-evenly container-fluid" style="">
        <div class="col-md-10 row justify-content-center m-5 text-center shadow">
            <div class="col-lg-5 col-md-12">
                <form method="POST" action="signin.php" class="form-signin p-5">
                    <h3 class="m-3">Sign in to your account</h3>
                    
                    <div class="input-group mb-4" >
                        <input type="text" required id="username" class="form-control" placeholder="Username"
                               name="username"
                               value="<?php
                               if(isset($_SESSION["printUserName"])){
                                   echo $_SESSION["printUserName"];
                                   unset($_SESSION["printUserName"]);
                               }
                               else{
                                   echo "";
                               }?>" style = "font-family:candara;">
                        <span class="input-group-text">@</span>
                    </div>
                    <div class="input-group mb-4">
                        <input type="password" required id="password" class="form-control" placeholder="Password"
                               name="password" style = "font-family:candara;">
                        <span class="input-group-text" onclick="togglePasswordVisibility()">
            <i class="bi bi-eye" id="eyeIcon"></i>
          </span>
                    </div>
                    <?php
                    if(isset($_SESSION['error']) && !empty($_SESSION['error'])){
                        echo' <div class="alert alert-danger" role="alert">'.$_SESSION["error"].'</div> ';
                        unset($_SESSION['error']);
                    }
                    ?>
                    <p class="mb-4 text-secondary" style = "font-family:candara;">By clicking Sign In, you agree to our <a href="#"
                                                                                            class="link-primary" style = "font-family:candara;">Terms
                            of
                            Use</a> and our <a href="#" class="link-primary" style = "font-family:candara;">Privacy Policy</a>.</p>
                    <div class="d-grid gap-2">
                        <input type="submit" class="btn btn-block btn-success text-white rounded-pill btn-lg"
                               value="Sign-in" style = "font-family:candara;">
                    </div>
                    <span class="d-block text-left my-4 text-muted" style = "font-family:candara;">— or sign up —</span>
                    <a href="signup.php" type="button"
                       class="btn btn-block btn-success text-white rounded-pill btn-lg ps-5 pe-5" style = "font-family:candara;">Sign-up
                    </a>
                </form>
            </div>
            <div class="col-lg-7 col-md-12">
                <img src=" <?php echo $imgs . "login.png" ?>" alt="Login image" class="img-fluid" width="500" height="500">
            </div>
        </div>
    </div>

    <style> 
    .input-group-text {
        cursor: pointer;
    }
    </style>

<?php include $tpl . "footer.php" ?>