<?php
include 'connect.php';

//Routes 
$tpl = "includes/temps/";
$func = "includes/functions/";
$css = "public/layout/css/";
$js = "public/layout/js/";


include $func . 'functions.php';
include $func . 'controller.php';
include $tpl . "header.php";

if (!isset($noNavbar)) {
    include $tpl . "navbar.php";
}

?>