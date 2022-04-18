<!--info:
  this page won't be linked in leftHor_Navbar.php and will only be accessible through result.php
  -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
        B3D - Skillboard | Scoreboard
    </title>
    <!--CSS B3D-->
    <link id="pagestyle" href="../assets/css/b3d-style.css" rel="stylesheet"/>
    <?php
    session_start();
    include "../PHP/header.php";
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
                                                class="ni ni-calendar-grid-58"></i>&nbsp;17.04.2022</p>
                                    <h5 class="font-weight-bolder" name="parcourLoc">
                                        BSV Maria Taferl
                                    </h5>
                                    <p class="mb-0 text-sm">
                                        <span class="text-success text-sm font-weight-bolder" name="gameId">#</span>
                                        123456789
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
                    <div class="table-responsive">
                        <table class="table align-items-center">
                            <tr>
                                <th class="text-uppercase text-xxs font-weight-bolder mb-0" scope="row">Archer</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                    scope="row">Stephan
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                    scope="row">Lukas
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                    scope="row">Leon
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                    scope="row">Lena
                                </th>
                            </tr>
                            <tr>
                                <th class="text-uppercase text-xxs font-weight-bolder mb-0" scope="row">Total</th>
                                <td class="text-xs font-weight-bold mb-0">408</td>
                                <td class="text-xs font-weight-bold mb-0">246</td>
                                <td class="text-xs font-weight-bold mb-0">210</td>
                                <td class="text-xs font-weight-bold mb-0">132</td>
                            </tr>
                            <tr>
                                <th class="text-uppercase text-xxs font-weight-bolder mb-0" scope="row">Hits</th>
                                <td class="text-xs font-weight-bold mb-0">29/33</td>
                                <td class="text-xs font-weight-bold mb-0">22/33</td>
                                <td class="text-xs font-weight-bold mb-0">18/33</td>
                                <td class="text-xs font-weight-bold mb-0">13/33</td>
                            </tr>
                            <tr>
                                <th class="text-uppercase text-xxs font-weight-bolder mb-0" scope="row">Arrow 1</th>
                                <td class="text-xs font-weight-bold mb-0">18</td>
                                <td class="text-xs font-weight-bold mb-0">11</td>
                                <td class="text-xs font-weight-bold mb-0">6</td>
                                <td class="text-xs font-weight-bold mb-0">5</td>
                            </tr>
                            <tr>
                                <th class="text-uppercase text-xxs font-weight-bolder mb-0" scope="row">Arrow 2</th>
                                <td class="text-xs font-weight-bold mb-0">9</td>
                                <td class="text-xs font-weight-bold mb-0">3</td>
                                <td class="text-xs font-weight-bold mb-0">8</td>
                                <td class="text-xs font-weight-bold mb-0">2</td>
                            </tr>
                            <tr>
                                <th class="text-uppercase text-xxs font-weight-bolder mb-0" scope="row">Arrow 3</th>
                                <td class="text-xs font-weight-bold mb-0">2</td>
                                <td class="text-xs font-weight-bold mb-0">8</td>
                                <td class="text-xs font-weight-bold mb-0">4</td>
                                <td class="text-xs font-weight-bold mb-0">6</td>
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
                <div class="card ">
                    <div class="card-header pb-0 p-3">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-2">Targets</h6>
                        </div>
                    </div>
                    <div class="table-responsive tableFixHead">
                        <table>
                            <thead>
                            <tr>
                                <th class="text-uppercase text-xxs font-weight-bolder mb-0" scope="row">Target</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder" scope="row">
                                    Stephan
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder" scope="row">
                                    Lukas
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder" scope="row">Leon
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder" scope="row">Lena
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="text-uppercase text-xxs font-weight-bolder mb-0" scope="row">#1</td>
                                <td class="text-xs font-weight-bold mb-0">10</td>
                                <td class="text-xs font-weight-bold mb-0">4</td>
                                <td class="text-xs font-weight-bold mb-0">4</td>
                                <td class="text-xs font-weight-bold mb-0">0</td>
                            </tr>
                            <tr>
                                <td class="text-uppercase text-xxs font-weight-bolder mb-0" scope="row">#2</td>
                                <td class="text-xs font-weight-bold mb-0">16</td>
                                <td class="text-xs font-weight-bold mb-0">16</td>
                                <td class="text-xs font-weight-bold mb-0">0</td>
                                <td class="text-xs font-weight-bold mb-0">16</td>
                            </tr>
                            </tbody>
                        </table>
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
<script src="/assets/js/plugins/chartjs.min.js"></script>
</body>

</html>
