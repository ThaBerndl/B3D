<?php
echo test1234;
require_once "class/User.php";
$user = new User("Tim", "Hofmann", "thistim", "1234");
echo $user->checkUser();
?>