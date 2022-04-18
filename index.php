<?php
session_start();
if ($_SESSION['auth'])
{
    header("location: pages/new-game.php");
}
else
{
    header("location: pages/sign-in.php");
}

