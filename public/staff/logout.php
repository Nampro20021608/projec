<?php
require_once('lib/initialize.php');

unset($_SESSION['username']);

redirect_to('login.php');
exit;
?>