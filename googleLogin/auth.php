<?php
session_start();

if(!isset($_SESSION['ucode']) || (isset($_SESSION['ucode']) && empty($_SESSION['ucode']))){
    if(strstr($_SERVER['PHP_SELF'], 'index.php') === false)
    header('location:index.php');
}else{
    if(strstr($_SERVER['PHP_SELF'], 'home.php') === false)
    header('location:home.html');
}