<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        B3D - Skillboard | Modal
    </title>
    <!--Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"/>
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
require_once '../PHP/leftHor_Navbar.php'
?>
<main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur"
         data-scroll="false">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a>
                    </li>
                    <li class="breadcrumb-item text-sm text-white active" aria-current="page">Modal</li>
                </ol>
                <h6 class="font-weight-bolder text-white mb-0">Modal</h6>
            </nav>
            <?php
            require_once "../PHP/header-navbar.php";
            ?>
        </div>
    </nav>
    <!-- End Navbar -->
    <div class="col-md-4">
        <!--call modal-->
        <button type="button" class="btn btn-block btn-default mb-3" data-bs-toggle="modal"
                data-bs-target="#modal-form">Form
        </button>
        <!-- -->
        <div class="modal fade" id="modal-form" tabindex="-1" role="dialog"
             aria-labelledby="modal-form" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="card card-plain">
                            <div class="card-header pb-0 text-left">
                                <h3 class="font-weight-bolder text-success text-gradient">#1 Hase</h3>
                                <p class="mb-0">Enter your arrow number and scoring zone</p>
                            </div>

                            <form role="form text-left" action="?" method="post"
                                  onsubmit="document.getElementById('user').setAttribute('value', user_id);">
                                <div class="card-body">
                                    <h6>Arrow</h6>
                                    <div class="form-group">
                                        <select class="form-control" id="arrowSelect" name="">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="M">Miss</option>
                                        </select>
                                    </div>
                                    <h6>Scoring Zone</h6>
                                    <div class="form-check">
                                        <label class="custom-control-label" for="customRadio1">Center</label>
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                               id="btnradio5" value="center">
                                    </div>
                                    <div class="form-check">
                                        <label class="custom-control-label" for="customRadio2">Kill</label>
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                               id="btnradio6" value="kill">
                                    </div>
                                    <div class="form-check">
                                        <label class="custom-control-label" for="customRadio3">Body</label>
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                               id="btnradio7" value="body">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">
                                        Close
                                    </button>
                                    <button type="submit" class="btn bg-gradient-success">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
