<?php
    session_start();
    if (!$_SESSION['auth'])
    {
        //header("location: sign-in.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        B3D - Skillboard | Point Score
    </title>
    <!--Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link id="pagestyle" href="../assets/css/b3d-style.css" rel="stylesheet" />
    <?php
        include "../PHP/header.php";
    ?>
</head>
<body class="g-sidenav-show   bg-gray-100">
    <div class="min-height-300 bg-success position-absolute w-100"></div>
    <?php
    require_once '../PHP/leftHor_Navbar.php';
    require_once '../PHP/getClasses.php';
    if (isset($_GET['addAnimal'])){
        $parcour_ID = Parcour::getIDWithNames($_GET['parcour'],$_GET['ort']);
        $tierzuord = new Tierzuord();
        $tierzuord->parcour_id = $parcour_ID;
        $tierzuord->getnextPos();
        $tierzuord->insertTierZuord();
        echo "BESTTEST";
    }
  ?>
    <main class="main-content position-relative border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur"
            data-scroll="false">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white"
                                href="javascript:;">Pages</a></li>
                        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Point Score</li>
                    </ol>
                    <h6 class="font-weight-bolder text-white mb-0">Point Score</h6>
                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                        <div class="input-group">
                            <span class="input-group-text text-body"><i class="fas fa-search"
                                    aria-hidden="true"></i></span>
                            <input type="text" class="form-control" placeholder="Type here...">
                        </div>
                    </div>
                    <ul class="navbar-nav  justify-content-end">
                        <li class="nav-item d-flex align-items-center">
                            <a href="sign-up.php" class="nav-link text-white font-weight-bold px-0">
                                <i class="fa fa-user me-sm-1"></i>
                                <?php echo "<span class=\"d-sm-inline d-none\">"; if($_SESSION['auth'] == true){echo $_SESSION['nickname'];} else { echo "Sign in"; } echo "</span>"; ?>
                            </a>
                        </li>
                        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line bg-white"></i>
                                    <i class="sidenav-toggler-line bg-white"></i>
                                    <i class="sidenav-toggler-line bg-white"></i>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item px-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-white p-0">
                                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h5 class="text-center">Treffer</h5>
                            <div class="table-responsive">
                                <table class="table align-items-center justify-content-center mb-0">
                                    <tbody>
                                        <form id="choose_parcour" action="parcour-location.php" method="get">
                                            <tr scope="row">
                                                <td colspan="4">
                                                    <h6 class="text-center">
                                                        <button type="button" class="btn btn-outline-success align-right" name="addAnimal">< - - </button>
                                                            Tier X
                                                        <button type="button" class="btn btn-outline-success align-right" name="addAnimal"> - - ></button>
                                                    </h6>
                                                    <div>
                                                        <label class="col-sm-4">
                                                            <label class="btn btn-dark disabled">Schnatotea</label>
                                                        </label>
                                                        <label class="btn btn-youtube disabled">Over 9000</label>
                                                    </div>
                                                    <div>
                                                        <label class="col-sm-4">
                                                            <label class="btn btn-dark disabled">Wurmsdabber</label>
                                                        </label>
                                                        <label class="btn btn-github disabled">144</label>
                                                    </div>
                                                    <div>
                                                        <label class="col-sm-4">
                                                            <label class="btn btn-dark disabled">Fresh Berndl</label>
                                                        </label>
                                                        <label class="btn btn-github disabled">132</label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <table class="table-responsive">
                                                    <table class="table align-items-center justify-content-center mb-0">
                                                        <tbody>
                                                            <?php
                                                            if (isset($_GET['parcour'])){
                                                                $parcour_ID = Parcour::getIDWithNames($_GET['parcour'],$_GET['ort']);
                                                                $stmt = Tierzuord::getAllTiereFromParcour($parcour_ID);
                                                                while ($data = $stmt->fetch()) {?>
                                                            <tr>
                                                                <td>
                                                                    <th scope="row" class="animalNr">#<?=$data['pos']?></th>
                                                                </td>
                                                                <td>
                                                                <input type='text' list='tiere' class="form-control" id="animalList" value='<?=$data['tier']?>' required>
                                                                <datalist id="tiere">
                                                                <?php
                                                                $tiere = Tier::getAllTiere();
                                                                while ($tier = $tiere->fetch()) {
                                                                    echo "<option>" . $tier['bez'] . "</option>";
                                                                }
                                                                echo "</datalist>";
                                                                    }
                                                                ?>
                                                                </td>
                                                                <?php
                                                                }
                                                                ?>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </table>
                                            </tr>
                                            <hr id="tables-hr">
                                            <tr>
                                                <td id=hitCount>
                                                    <input type="button" class="btn btn-outline-success align-right" name="addAnimal" value="1">
                                                </td>
                                                <td id=hitCount>
                                                    <input type="button" class="btn btn-outline-success align-right" name="addAnimal" value="2">
                                                </td>
                                                <td id=hitCount>
                                                    <input type="button" class="btn btn-outline-success align-right" name="addAnimal" value="3">
                                                </td>
                                                <td id=hitCount>
                                                    <input type="button" class="btn btn-outline-success btn-outline-danger on- align-right" name="addAnimal" value="Miss">
                                                </td>
                                            </tr>
                                            <hr id="tables-save-hr">
                                            <tr>
                                                <td>
                                                    <input type="button" class="btn btn-outline-success align-right" name="centerHit" value="Center">
                                                </td><br>
                                                <td id=hitButton>
                                                    <input type="button" class="btn btn-outline-success align-right" name="killHit" value="Kill">
                                                </td><br>
                                                <td id=hitButton>
                                                    <input type="button" class="btn btn-outline-success align-right" name="bodyHit" value="Body">
                                                </td>
                                            </tr>
                                            <hr id="tables-save-hr">
                                            <tr>
                                                <td>
                                                    <button id="saveParcour" type="button" class="btn bg-gradient-success">Save</button>
                                                </td>
                                            </tr>
                                        </form>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                            </div>
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
  ?>
    <div class="fixed-plugin">
        <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
            <i class="fa fa-cog py-2"> </i>
        </a>
        <div class="card shadow-lg">
            <div class="card-header pb-0 pt-3 ">
                <div class="float-start">
                    <h5 class="mt-3 mb-0">Argon Configurator</h5>
                    <p>See our dashboard options.</p>
                </div>
                <div class="float-end mt-4">
                    <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                        <i class="fa fa-close"></i>
                    </button>
                </div>
                <!-- End Toggle Button -->
            </div>
            <hr class="horizontal dark my-1">
            <div class="card-body pt-sm-3 pt-0 overflow-auto">
                <!-- Sidebar Backgrounds -->
                <div>
                    <h6 class="mb-0">Sidebar Colors</h6>
                </div>
                <a href="javascript:void(0)" class="switch-trigger background-color">
                    <div class="badge-colors my-2 text-start">
                        <span class="badge filter bg-gradient-primary active" data-color="primary"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-dark" data-color="dark"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-info" data-color="info"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-success" data-color="success"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-warning" data-color="warning"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-danger" data-color="danger"
                            onclick="sidebarColor(this)"></span>
                    </div>
                </a>
                <!-- Sidenav Type -->
                <div class="mt-3">
                    <h6 class="mb-0">Sidenav Type</h6>
                    <p class="text-sm">Choose between 2 different sidenav types.</p>
                </div>
                <div class="d-flex">
                    <button class="btn bg-gradient-primary w-100 px-3 mb-2 active me-2" data-class="bg-white"
                        onclick="sidebarType(this)">White</button>
                    <button class="btn bg-gradient-primary w-100 px-3 mb-2" data-class="bg-default"
                        onclick="sidebarType(this)">Dark</button>
                </div>
                <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
                <!-- Navbar Fixed -->
                <div class="d-flex my-3">
                    <h6 class="mb-0">Navbar Fixed</h6>
                    <div class="form-check form-switch ps-0 ms-auto my-auto">
                        <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed"
                            onclick="navbarFixed(this)">
                    </div>
                </div>
                <hr class="horizontal dark my-sm-4">
                <div class="mt-2 mb-5 d-flex">
                    <h6 class="mb-0">Light / Dark</h6>
                    <div class="form-check form-switch ps-0 ms-auto my-auto">
                        <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version"
                            onclick="darkMode(this)">
                    </div>
                </div>
                <a class="btn bg-gradient-dark w-100" href="https://www.creative-tim.com/product/argon-dashboard">Free
                    Download</a>
                <a class="btn btn-outline-dark w-100"
                    href="https://www.creative-tim.com/learning-lab/bootstrap/license/argon-dashboard">View
                    documentation</a>
                <div class="w-100 text-center">
                    <a class="github-button" href="https://github.com/creativetimofficial/argon-dashboard"
                        data-icon="octicon-star" data-size="large" data-show-count="true"
                        aria-label="Star creativetimofficial/argon-dashboard on GitHub">Star</a>
                    <h6 class="mt-3">Thank you for sharing!</h6>
                    <a href="https://twitter.com/intent/tweet?text=Check%20Argon%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fargon-dashboard"
                        class="btn btn-dark mb-0 me-2" target="_blank">
                        <i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/argon-dashboard"
                        class="btn btn-dark mb-0 me-2" target="_blank">
                        <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php
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
        function reload()
        {
            var ort = document.getElementById('Orte');
            self.location='parcour-location.php?ort=' + ort.value;
        }
    </script>
</body>
</html>