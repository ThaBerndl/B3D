<?php
    require_once "class/User.php";
    $user = new User("Tim", "Hofmann", "thistim", "1234");
    $user->insertUser();

    if($user->getUser())
    {
        $myInt = DB::nextId(user);


        echo "an Tim gibts";
        echo $myInt;
    }
    else
    {
        echo "an Tim gibts ned";
    }
?>