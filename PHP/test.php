<?php
    require_once "class/User.php";
    $user = new User("Tim", "Hofmann", "thistim", "1234");
    $user->insertUser();

    if($user->checkUser())
    {
        echo "an Tim gibts";
    }
    else
    {
        echo "an Tim gibts ned";
    }
?>