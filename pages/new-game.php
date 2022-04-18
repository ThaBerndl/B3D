<?php
session_start();
if (!$_SESSION['auth']) {
    header("location: sign-in.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        B3D - Skillboard | New Game
    </title>
    <!--CSS B3D-->
    <link id="pagestyle" href="../assets/css/b3d-style.css" rel="stylesheet"/>
    <?php
    include "../PHP/header.php";
    include "../PHP/getClasses.php";


    if(isset($_GET['submit']))
    {
        $myArray = $_GET['userArr'];
        $myDropdownValue = $_GET['myDropdown'];

        for($i = 0; $i < sizeof($myArray); $i++)
        {
            $myArrayVal = $myArray[$i];

            if(isset($myArray[$i]))
            {
                //echo "<h1>" ."UserId= ". "$myArrayVal" ." Drowdownvalue= ".$myDropdownValue. "</h1>";
            }
        }



        Game::insertGame($myDropdownValue);

        header("Location: enter-point-score.php");
        //exit;
    }
    ?>
</head>

<body class="g-sidenav-show   bg-gray-100">
<div class="min-height-300 bg-success position-absolute w-100"></div>
<!--Left Side Nav Bar -->
<?php
require_once '../PHP/leftHor_Navbar.php';

if (isset($_POST['showFriends'])){
    if (isset($_SESSION['showFriends'])){
        unset($_SESSION['showFriends']);
    }else{
        $_SESSION['showFriends'] = true;
    }
}
?>
<main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur"
         data-scroll="false">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:">Pages</a>
                    </li>
                    <li class="breadcrumb-item text-sm text-white active" aria-current="page">New Game</li>
                </ol>
                <h6 class="font-weight-bolder text-white mb-0">New Game</h6>
            </nav>
            <?php
            require_once "../PHP/header-navbar.php";
            ?>
        </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body p-3">
                        <h6>Start a new game</h6>
                        <!--form-->

                        <form action="new-game.php" method="post">
                            <button type="submit"
                                    class="btn btn-outline-success align-right"
                                    name="showFriends">Friends&nbsp;&nbsp;<i class="<?= !isset($_SESSION['showFriends'])?"ni ni-bold-down":"ni ni-bold-up"; ?>"></i></button>
                        </form>

                        <form id="new_game_form" action="new-game.php" method="get">
                            <!--Friendlist - select participating archers-->
                            <table class="table-responsive">
                                <table class="table align-items-center justify-content-center mb-0" <?= isset($_SESSION['showFriends'])?"style=\"display: none;\"":""; ?>>
                                    <thead>
                                    <tr>
                                        <th scope="row">Friend</th>
                                        <th scope="row"></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $freunde = Freund::getAllFreunde($_SESSION['user_id']);
                                        foreach ($freunde as $freund)
                                        {
                                            $user = USER::getUserwithID($freund->freund_id);
                                            $uservName = $user->vName;
                                            $usernName = $user->nName;
                                            $userNickName = $user->nickname;
                                            $userId = $user->id;

                                            echo '
                                            <tr> 
                                                <td>
                                                    <h6 class="mb-0 text-xs" name="archerName">'.$uservName." ".$usernName.'</h6>
                                                    <p class="text-xs text-secondary mb-0"
                                                       name="archerNickname">@'.$userNickName.'</p>
                                                </td>
                                                <td>
                                                    <div class="form-check centerCheckBox">
                                                        <input class="form-check-input" type="checkbox" value="'.$userId.'"
                                                               name="userArr[]" checked="">
                                                    </div>
                                                </td>
                                            </tr>';
                                        }
                                        ?>
                                    <!--End placeholder-->
                                    </tbody>
                                </table>
                            </table>
                            <hr id="tables-hr">
                            </tr>
                            <!--End Friendslist-->
                            <tr scope="row">
                                <td colspan="4">
                                    <label for="example-text-input" class="form-control-label">Parcour</label>
                                    <select name="myDropdown" class="form-select" aria-label=".form-select-sm example">
                                        <option selected>-choose parcour-</option>
                                        <?php
                                        $parcours = Parcour::getAllParcours();
                                        while($parcour = $parcours->fetch())
                                        {
                                            echo "<option value='".$parcour['parcour_id']."'>" . $parcour['bez'] . "</option>";
                                        }
                                        ?>
                                    </select
                                </td>
                            </tr>
                            <br><br>
                            <tr>
                                <td>
                                    <a href="enter-point-score.php.php">
                                        <button type="submit" class="btn bg-gradient-success align-right" name="submit">
                                            Start
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        </form>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0"></div>
                </div>
            </div>
        </div>
    </div>
    <?php
        require_once "../PHP/footer.php";
        ?>
    </div>
</main>
<?php
require_once "../PHP/rightHor_Navbar.php";
require "../PHP/body_end.php";
?>
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
</body>

</html>
