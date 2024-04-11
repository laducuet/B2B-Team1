<?php
require 'admin/connect.php';

//Routes 
$tpl = "includes/temps/";
$func = "includes/functions/";
$css = "public/layout/css/";
$js = "public/layout/js/";
$imgs = "public/layout/images/";
$dataimages = "data/uploads/items/";


require $func . 'functions.php';
require $tpl . "header.php";

if (!isset($noNavbar)) {
    require $tpl . "navbar.php";
} elseif (isset($noNavbar)) {
    require $func . 'controller.php';
}

?>