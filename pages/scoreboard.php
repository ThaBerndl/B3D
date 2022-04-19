<!--info:
  this page won't be linked in leftHor_Navbar.php and will only be accessible through result.php
  -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        B3D - Skillboard | Scoreboard
    </title>
    <!--CSS B3D-->
    <link id="pagestyle" href="../assets/css/b3d-style.css" rel="stylesheet"/>
    <?php
    session_start();
    include "../PHP/header.php";
    include "../PHP/getClasses.php";
    $userArr = Punkte_data::getDataAkt($_GET['game_id'],1);
    $game = Game::getGame($userArr[1]->game_id);
    $parcour = Parcour::getParcour($game->parcour_id);
    $ort = Ort::getOrt($parcour->ort_id);
    ?>
</head>

<body class="g-sidenav-show   bg-gray-100">
<div class="min-height-300 bg-success position-absolute w-100"></div>
<!--Left Side Nav Bar -->
<?php
require_once '../PHP/leftHor_Navbar.php'
?>
<main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
                    <li class="breadcrumb-item text-sm text-white active" aria-current="page">Scoreboard</li>
                </ol>
                <h6 class="font-weight-bolder text-white mb-0">Scoreboard</h6>
            </nav>
            <?php
            require_once "../PHP/header-navbar.php";
            ?>
        </div>
    </nav>
    <!-- End Navbar -->
    <!--Game Details-->
    <div class="container-fluid py-4">
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold" name="gameDate"><i
                                                class="ni ni-calendar-grid-58"></i>&nbsp;<?=$game->created?></p>
                                    <h5 class="font-weight-bolder" name="parcourLoc">
                                        <?=$parcour->bez?>
                                    </h5>
                                    <h7 class="font-weight-bolder"><?=$ort->bez?></h7>
                                    <p class="mb-0 text-sm">
                                        <span class="text-success text-sm font-weight-bolder" name="gameId">#</span>
                                        <?=$game->game_id?>
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                    <i class="ni ni-pin-3 text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End game details-->
        <!--Total Score-->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card ">
                    <div class="card-header pb-0 p-3">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-2">Total Score</h6>
                        </div>
                    </div>
                    <div>
                        <table class="table align-items-center">
                            <tr>
                                <th class="text-uppercase text-xxs font-weight-bolder mb-0" scope="row">Archer</th>
                                <?php
                                foreach ($userArr as $user) {
                                ?>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                    scope="row"><?=$user->user_nickname?>
                                </th>
                                <?php
                                }
                                ?>
                            </tr>
                            <tr>
                                <th class="text-uppercase text-xxs font-weight-bolder mb-0" scope="row">Total</th>
                                <?php

                                foreach ($userArr as $user){
                                    $sum = Punkte_data::getSum($user->game_id, $user->user_id);
                                    $perc = Punkte_data::getPerc($user->game_id, $user->user_id);
                                    echo "<td class=\"text-xs font-weight-bold mb-0\">" . $sum . " (" . $perc . "%)</td>";
                                }
                                ?>
                            </tr>
                            <tr>
                                <th class="text-uppercase text-xxs font-weight-bolder mb-0" scope="row">Hits</th>
                                <?php
                                foreach ($userArr as $user){
                                    $misses = Punkte_data::getMisses($user->game_id, $user->user_id);
                                    $maxPos = Punkte_data::getMaxPos($user->game_id);
                                    echo "<td class=\"text-xs font-weight-bold mb-0\">".($maxPos-$misses)."/".$maxPos."</td>";
                                }
                                ?>
                            </tr>
                            <tr>
                                <th class="text-uppercase text-xxs font-weight-bolder mb-0" scope="row">DPS</th>
                                <?php
                                foreach ($userArr as $user){
                                    $avg = Punkte_data::getAvg($user->game_id, $user->user_id);
                                    echo "<td class=\"text-xs font-weight-bold mb-0\">".$avg."</td>";
                                }
                                ?>
                            </tr>
                            <tr>
                                <th class="text-uppercase text-xxs font-weight-bolder mb-0" scope="row">Arrow 1</th>
                                <?php
                                foreach ($userArr as $user){
                                    $arrow1 = Punkte_data::getArrow1($user->game_id, $user->user_id);
                                    echo "<td class=\"text-xs font-weight-bold mb-0\">".$arrow1."</td>";
                                }
                                ?>
                            </tr>
                            <tr>
                                <th class="text-uppercase text-xxs font-weight-bolder mb-0" scope="row">Arrow 2</th>
                                <?php
                                foreach ($userArr as $user){
                                    $arrow2 = Punkte_data::getArrow2($user->game_id, $user->user_id);
                                    echo "<td class=\"text-xs font-weight-bold mb-0\">".$arrow2."</td>";
                                }
                                ?>
                            </tr>
                            <tr>
                                <th class="text-uppercase text-xxs font-weight-bolder mb-0" scope="row">Arrow 3</th>
                                <?php
                                foreach ($userArr as $user){
                                    $arrow3 = Punkte_data::getArrow3($user->game_id, $user->user_id);
                                    echo "<td class=\"text-xs font-weight-bold mb-0\">".$arrow3."</td>";
                                }
                                ?>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--End Total Score-->
        <!--Target Overview-->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <h6 class="mb-2">Targets</h6>
                    <div class="table-responsive">
                        <table>
                            <thead>
                            <tr>
                                <th class="text-uppercase text-xxs font-weight-bolder mb-0" scope="row">Target</th>
                                <?php
                                foreach ($userArr as $user) {
                                    ?>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder" scope="row">
                                        <?=$user->user_nickname?>
                                    </th>
                                    <?php
                                }
                                ?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            for ($i = 1; $i <= $maxPos; $i++){
                                echo "<tr>";
                                echo "<td class=\"text-uppercase text-xxs font-weight-bolder mb-0\" scope=\"row\">#$i</td>";
                                foreach ($userArr as $user) {
                                    $punkte = Punkte_data::getPunkte($user->game_id, $user->user_id,$i);
                                    echo "<td class=\"text-xs font-weight-bold mb-0\">".$punkte."</td>";
                                }
                                echo "</tr>";
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Target Overview-->
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
