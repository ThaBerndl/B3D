<?php
    require_once "class/User.php";
    require_once "class/Ort.php";

    echo asdf;

    $myOrtBez = Ort::getOrtwithBez("Linz");

    echo $myOrtBez->bez;
?>