<?php
function redirect_to($location) {
    header("Location: " . $location);
    exit;
}
session_start();

if(!isset($_SESSION['username']) && !(basename($_SERVER['PHP_SELF']) == 'login.php')){
    redirect_to('login.php'); 
}
?>
