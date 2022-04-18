<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
        B3D - Skillboard | Parcour Favourites
    </title>
    <!--Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!--CSS B3D-->
    <link id="pagestyle" href="../assets/css/b3d-style.css" rel="stylesheet"/>
    <?php
    session_start();
    include "../PHP/header.php";
    include "../PHP/getClasses.php";
    ?>
</head>

<body class="g-sidenav-show   bg-gray-100">
<div class="min-height-300 bg-success position-absolute w-100"></div>
<!--Left Side Nav Bar -->
<?php
require_once '../PHP/leftHor_Navbar.php';
if (isset($_POST['saveParcour'])){
    $fav = new Parcour_fav();
    $fav->user_id = $_SESSION['user_id'];
    $fav->parcour_id = $_POST['parcour_id'];
    $fav->insert();
}
if(isset($_POST['deleteParcour'])){
    $fav = new Parcour_fav($_SESSION['user_id'],$_POST['parcour_id']);
    $fav->delete();
}
if (isset($_POST['showFavs'])){
    if (isset($_SESSION['showFavs'])){
        unset($_SESSION['showFavs']);
    }else{
        $_SESSION['showFavs'] = true;
    }
}
if (isset($_POST['showParcs'])){
    if (isset($_SESSION['showParcs'])){
        unset($_SESSION['showParcs']);
    }else{
        $_SESSION['showParcs'] = true;
    }
}?>
<main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur"
         data-scroll="false">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript;">Pages</a>
                    </li>
                    <li class="breadcrumb-item text-sm text-white active" aria-current="page">Parcour Favourites</li>
                </ol>
                <h6 class="font-weight-bolder text-white mb-0">Parcour Favourites</h6>
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
                        <h6>Favourites</h6>
                        <br>
                        <!--form-->
                        <form action="parcour-location.php" method="post">
                            <button type="submit" class="btn btn-success align-right" name="add_parcour">Create Parcour&nbsp;&nbsp;<i
                                        class="ni ni-fat-add"></i></button>
                        </form>

                            <hr id="tables-hr">
                        <form action="parcour-favourites.php" method="post">
                            <button type="submit"
                                    class="btn btn-outline-success align-right"
                                    name="showFavs">Favorites&nbsp;&nbsp;<i class="<?= !isset($_SESSION['showFavs'])?"ni ni-bold-down":"ni ni-bold-up"; ?>"></i></button>
                        </form>
                            <table class="table align-items-center mb-0 responsive" <?= isset($_SESSION['showFavs'])?"style=\"display: none;\"":""; ?>>
                                <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Parcour
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Animals
                                    </th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $favs = Parcour_fav::getFavs($_SESSION['user_id']);
                                while ($data = $favs->fetch()){
                                    $parcour = Parcour::getParcour($data['parcour_id']);
                                    $tierzuord = new Tierzuord(null, $parcour->parcour_id);
                                    $tierzuord->getAktPos();
                                ?>
                                <form id="favorites" action="parcour-favourites.php" method="post">
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-xs"><?=$parcour->bez?></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">

                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-xs"><?=$tierzuord->pos?></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <input type="hidden" name="parcour_id" value="<?=$parcour->parcour_id?>">
                                        <button id="deteleParcourFav" type="submit" name="deleteParcour"
                                                class="btn btn-outline-success">Remove
                                        </button>
                                    </td>
                                </tr>
                                </form>
                                <?php
                                }
                                ?>
                                </tbody>
                            </table>
                            <hr id="tables-hr">

                        <form action="parcour-favourites.php" method="post">
                            <button type="submit"
                                    class="btn btn-outline-success align-right"
                                    name="showParcs">Available parcours&nbsp;&nbsp;<i class="<?= !isset($_SESSION['showParcs'])?"ni ni-bold-down":"ni ni-bold-up"; ?>"></i></button>
                        </form>
                            <table class="table align-items-center mb-0 responsive" <?= isset($_SESSION['showParcs'])?"style=\"display: none;\"":""; ?>>
                                <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Parcour</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Animals</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $parcours = Parcour::getAllNotFavs($_SESSION['user_id']);
                                while($parcour = $parcours->fetch())
                                {
                                    $tierzuord = new Tierzuord(null, $parcour['parcour_id']);
                                    $tierzuord->getAktPos();
                                ?>
                                <form id="available" action="parcour-favourites.php" method="post">
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-xs"><?=$parcour['bez']?></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-xs"><?=$tierzuord->pos?></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <input type="hidden" name="parcour_id" value="<?=$parcour['parcour_id']?>">
                                        <button id="saveParcourFav" type="submit" name="saveParcour"
                                                class="btn btn-outline-success">Add
                                        </button>
                                    </td>
                                </tr>
                                </form>
                                <?php
                                }
                                ?>
                                </tbody>
                        </table>
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
