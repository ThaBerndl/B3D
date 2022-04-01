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
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        B3D - Skillboard | Archer
    </title>
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
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
                        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Archer</li>
                    </ol>
                    <h6 class="font-weight-bolder text-white mb-0">Archer</h6>
                </nav>
                <?php
                require_once "../PHP/header-navbar.php";
                ?>
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

                                            $freunde = Freund::getAllFreunde($_SESSION['user_id']);
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
        require "../PHP/body_end.php";
     ?>


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
</body>

</html>