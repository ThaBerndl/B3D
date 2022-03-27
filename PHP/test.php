<?php
    require_once "class/User.php";
    require_once "class/Ort.php";

    /*$user = new User("Tim", "Hofmann", "thistim", "1234");
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
    }*/

    $myOrt = new Ort("Linz");
    $myOrt->insertOrt();

    $myOrtBez = Ort::getOrtwithBez("Linz");

    echo $myOrtBez;
?>