<?php
    session_start();
    if (!$_SESSION['auth'])
    {
        header("location: sign-in.php");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        B3D - Skillboard | Friends
    </title>
    <!--Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!--CSS B3D-->
    <link id="pagestyle" href="../assets/css/b3d-style.css" rel="stylesheet"/>
    <?php
        include "../PHP/header.php";
    ?>
</head>

<body class="g-sidenav-show   bg-gray-100">
    <?php
        require_once "../PHP/class/Freund.php";
        require_once "../PHP/class/User.php";
        if (isset($_POST['Logout']))
        {
            require_once "../PHP/logout.php";
            header("location: dashboard.php");
        }
    ?>
    <div class="min-height-300 bg-success position-absolute w-100"></div>
    <?php
        require_once '../PHP/leftHor_Navbar.php';
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
                        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Friends</li>
                    </ol>
                    <h6 class="font-weight-bolder text-white mb-0">Friends</h6>
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
                        <div class="card-body pb-3">
                            <h6>Add friend</h6>
                            <!--form-->
                            <form id="add_friend" action="archer.php" method="post">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Nickname*</label>
                                    <input class="form-control" placeholder="search or create new friend.." type="text"
                                           value="" name="nickname">
                                </div>
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Surname</label>
                                    <input class="form-control" placeholder="new surname.." type="text" value=""
                                           name="fname">
                                </div>
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Lastname</label>
                                    <input class="form-control" placeholder="new lastname.." type="text" value=""
                                           name="lname">
                                </div>
                                <hr id="tables-hr">
                                <button type="submit" class="btn bg-gradient-success align-right" name="submit">
                                    Save
                                </button>
                            </form>
                            <?php
            if(isset($_POST['submit'])) //verarbeitung Forms
            {
                $user = new User();
                $user->nickname = $_POST['nickname'];
                $user->vName = $_POST['fname'];
                $user->nName = $_POST['lname'];
                if(!$user->getUser())
                {
                    if(empty($_POST['nickname']) || empty($_POST['fname']) || empty($_POST['lname']))
                    {
                        echo "<p style='color: #ff0000'> Nickname not existing: to create please enter first and last name</p>";
                    }
                    else {
                        $user->insertUser();
                        $freund = new Freund($_SESSION['user_id'], $user->id);
                        $freund->insertFreund();
                    }
                }
                else
                {
                    $freund = new Freund($_SESSION['user_id'],$user->id);
                    if($freund->user_id == $freund->freund_id)
                    {
                        echo "<p style='color: red'>Can't add yourself as friend</p>";
                    }
                    else if(!$freund->checkFreund()) {
                        $freund->insertFreund();
                    } else {
                        echo "<p style='color: red'>Friend already added!</p>";
                    }
                }
            }
                            ?>
                            <br>
                            <!-- Table content shows friends created in the past-->
                            <h6>Friend list</h6>
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Friend
                                        </th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php

                                    if (isset($_POST['delete'])) {
                                        $freund = new Freund($_POST['user'], $_POST['freund']);
                                        $freund->delFreund();
                                    }

                                    $freunde = Freund::getAllFreunde($_SESSION['user_id']);
                                    foreach ($freunde as $freund) {
                                        $user = USER::getUserwithID($freund->freund_id);
                                        echo "<form action='archer.php' method='post'>
                                            <tr>
                                                <td>
                                                    <div class=\"d-flex px-2 py-1\">
                                                        <div class=\"d-flex flex-column justify-content-center\">
                                                            <h6 class=\"mb - 0 text - sm\">$user->vName $user->nName </h6>
                                                            <p class=\"text-xs text-secondary mb-0\">$user->nickname</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class=\"align-items-start\">
                                                    <button class=\"btn bg-gradient-success\" name=\"delete\">Delete&nbsp;<i
                                                            class=\"ni ni-fat-remove\"></i></button>
                                                    <input type='text' style='display: none' name='user' value='$freund->user_id'>
                                                    <input type='text' style='display: none' name='freund' value='$freund->freund_id'>
                                               </td>
                                            </tr>
                                        </form>";
                                    }
                                    unset($freund);
                                    ?>
                                    </tbody>
                                </table>
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