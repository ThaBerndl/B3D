<!--
=========================================================
* Argon Dashboard 2 - v2.0.1
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/branding/circle logo_new.png">
    <title>
        B3D - Skillboard | Archer
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="../assets/css/argon-dashboard.css?v=2.0.1" rel="stylesheet" />
    <?php
       session_start();
     ?>
</head>

<body class="g-sidenav-show   bg-gray-100">
    <?php
        require_once "../PHP/class/Freund.php";
        require_once "../PHP/class/User.php";
    ?>
    <div class="min-height-300 bg-success position-absolute w-100"></div>
  <?php
    require_once '../PHP/leftHor_Navbar.php'
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
                        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Archer</li>
                    </ol>
                    <h6 class="font-weight-bolder text-white mb-0">Archer</h6>
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
                                <?php echo "<span class=\"d-sm-inline d-none\">".!empty($_SESSION['nickname'])?$_SESSION['nickname']:"Sign in"."</span>" ?>
                            </a>
                        </li>
                        <li class="nav-item d-flex align-items-center">
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
            <!--TODO-->
            <form id="add_friend" action="archer.php" method="POST">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <h6>Add a Friend</h6>
                                    <input type="submit" class="btn btn-success btn-md ms-auto" name="submit" value="Add Friend"input>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Nickname<input class="form-control" name="nickname" type="text"></label>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">First name<input class="form-control" name="fname" type="text"></label>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Last name<input class="form-control" name="lname" type="text"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                        echo "<p style='color: red'> Nickname not existing: to create please enter first and last name</p>";
                    }
                    else {
                        $user->insertUser();
                        $freund = new Freund(1, $user->id); //TODO: user_id von Login hier übernehmen
                        $freund->insertFreund();
                    }
                }
                else
                {
                    $freund = new Freund(1,$user->id); //TODO: user_id von Login hier übernehmen
                    if($freund->user_id == $freund->freund_id)
                    {
                        echo "<p style='color: red'>Can't add yourself as friend</p>";
                    }
                    else if(!$freund->checkFreund())
                    {
                        $freund->insertFreund();
                    }
                    else
                    {
                        echo "<p style='color: red'>Friend already added!</p>";
                    }
                }
            }
            ?>

            <br>
            <!-- Table content shows friends created in the past-->
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h6>My Friends</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Friend</th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                            if (isset($_POST['delete']))
                                            {
                                                $freund = new Freund($_POST['user'],$_POST['freund']);
                                                $freund->delFreund();
                                            }

                                            $freunde = Freund::getAllFreunde(1); //TODO: user_id von Login hier übernehmen
                                            foreach ($freunde as $freund)
                                            {
                                                $user = USER::getUserwithID($freund->freund_id);
                                                echo   "<form action='archer.php' method='post'>
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
                                                                    <input type='submit' class=\"btn btn-success btn-md ms-auto\"
                                                                        data-toggle=\"tooltip\" data-original-title=\"Add a friend\" name=\"delete\" value='Delete'>
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
                <?php
                 require_once "../PHP/footer.php";
                ?>
            </div>
        </div>
    </main>
    <?php
        require_once "../PHP/rightHor_Navbar.php";
     ?>
    <!--   Core JS Files   -->
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/chartjs.min.js"></script>
    <script>
        var ctx1 = document.getElementById("chart-line").getContext("2d");

        var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

        gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
        gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
        gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
        new Chart(ctx1, {
            type: "line",
            data: {
                labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Mobile apps",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#5e72e4",
                    backgroundColor: gradientStroke1,
                    borderWidth: 3,
                    fill: true,
                    data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                    maxBarThickness: 6

                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#fbfbfb',
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#ccc',
                            padding: 20,
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });
    </script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/argon-dashboard.min.js?v=2.0.1"></script>
</body>

</html>