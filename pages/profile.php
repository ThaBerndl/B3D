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
        B3D - Skillboard | Profile
    </title>
    <?php
    include "../PHP/header.php";
    ?>
</head>

<body class="g-sidenav-show bg-gray-100">
<div class="min-height-300 bg-success position-absolute w-100"></div>
<?php
require_once '../PHP/leftHor_Navbar.php'
?>
<main class="main-content position-relative max-height-vh-100 h-100">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur"
         data-scroll="false">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a>
                    </li>
                    <li class="breadcrumb-item text-sm text-white active" aria-current="page">Profile</li>
                </ol>
                <h6 class="font-weight-bolder text-white mb-0">Profile</h6>
            </nav>
            <?php
            require_once "../PHP/header-navbar.php";
            ?>
        </div>
    </nav>
    <!-- End Navbar -->
    <!--Profile header-->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body p-3">
                        <div class="row gx-4">
                            <div class="col-auto">
                                <div class="avatar avatar-xl position-relative">
                                    <img src="../assets/img/icons8-cat-profile-64%20(1).png" alt="profile_image"
                                         class="w-100 border-radius-lg shadow-sm">
                                </div>
                            </div>
                            <div class="col-auto my-auto">
                                <div class="h-100">
                                    <h5 class="mb-1">
                                        Lena Antonia
                                    </h5>
                                    <p class="mb-0 font-weight-bold text-sm">
                                        @lenapopena
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End profile header-->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body pb-3">
                        <h6>Edit Profile</h6>
                        <!--form-->
                        <form id="choose_parcour" action="results.php" method="get">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Surname</label>
                                <input class="form-control" type="text" value="Lena">
                            </div>
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Lastname</label>
                                <input class="form-control" type="text" value="Antonia">
                            </div>
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Nickname</label>
                                <input class="form-control" type="text" value="@lenapopena">
                            </div>
                            <hr id="tables-hr">
                            <button type="submit" class="btn bg-gradient-success align-right" name="saveProfile">
                                Save
                            </button>
                        </form>
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