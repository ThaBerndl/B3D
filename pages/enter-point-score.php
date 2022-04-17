<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
        B3D - Skillboard | Results
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
<?php
if (isset($_POST['finish']))
{
    header('location: scoreboard.php');
}
if (isset($_POST['points']))
{
    Punkte::insertpoints(   $_SESSION['game_id'],
                            $_POST['userid'],
                            $_SESSION['tz_id'],
                            $_POST['btnradioArrow'],
                       $_POST['btnradioArrow'] != 'M' ? $_POST['btnradioZone'] : 0);
}
if (isset($_POST['next'])){
    $_SESSION['aktpos'] = $_POST['next'];
    Punkte::createnextPos($_SESSION['game_id'],$_POST['next']);
}
elseif (isset($_POST['previous']) && $_POST['previous'] != 0){
    $_SESSION['aktpos'] = $_POST['previous'];
}
elseif (!isset($_POST['previous'])&&!isset($_POST['next'])&&!isset($_POST['points']))
{
    $_SESSION['aktpos'] = 1;
    $_SESSION['Game_id'] = 1;
}
?>

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
                    <li class="breadcrumb-item text-sm text-white active" aria-current="page">Point Score</li>
                </ol>
                <h6 class="font-weight-bolder text-white mb-0">Point Score</h6>
            </nav>
            <?php
            require_once "../PHP/header-navbar.php";
            $dataArr = Punkte_data::getDataAkt($_SESSION['game_id'],isset($_SESSION['aktpos'])?$_SESSION['aktpos']:1);
            $_SESSION['game_id'] = $dataArr[1]->game_id;
            $_SESSION['tz_id'] = $dataArr[1]->tz_id;
            ?>
            <script>
                user_id = null;
                game_id = <?=$dataArr[1]->game_id?>;
            </script>
        </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body p-3">
                        <h6>Point Score</h6>
                        <!--form-->
                        <form id="choose_parcour" action="?" method="post">
                            <!--Page index for targets -->
                            <nav aria-label="Page navigation example">
                                <ul class="pagination pagination-success justify-content-center">
                                    <button type="submit" name="previous" value="<?=$dataArr[1]->pos-1?>" class="page-item invbutton">
                                        <a class="page-link" tabindex="-1" id="prevbutton">
                                            <i class="fa fa-angle-left"></i>
                                        </a>
                                    </button>

                                    <li class="page-item active"><a class="page-link" href="javascript:;"><?=$dataArr[1]->pos?></a></li>
                                    <button type="submit" name="next" value="<?=$dataArr[1]->pos+1?>" class="page-item invbutton">
                                        <a class="page-link" id="nextbutton">
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </button>
                                </ul>
                            </nav>
                            <!--End page index-->
                            <span class="badge badge-lg bg-gradient-success" name="currentAnimal"><?=$dataArr[1]->tier_bez?></span>
                            <hr id="tables-hr">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Archer
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Points
                                        </th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($dataArr as $data)
                                    {
                                    ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-xs" name="archerName"><?=$data->user_vname . ' ' . $data->user_nname?></h6>
                                                    <p class="text-xs text-secondary mb-0"
                                                       name="archerNickname"><?=$data->user_nickname?></p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="text-xs font-weight-bold mb-0"><?php echo is_null($data->punkte)?"???":$data->punkte?></span>
                                        </td>
                                        <td>
                                            <!--Opens modal element-->
                                            <span class="badge bg-gradient-success" data-bs-toggle="modal" onclick="user_id=<?=$data->user_id?>"
                                                  data-bs-target="#modal-form">Add</span>
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            <input type="submit" name="finish" class="btn bg-gradient-success" value="Finish">
                    </div>
                    </form>
                    <!--End form-->
                    <!--Modal element for entering scores, already outsourced to modal-score.point.php -->
                    <div class="modal fade" id="modal-form" tabindex="-1" role="dialog"
                         aria-labelledby="modal-form" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                            <div class="modal-content">
                                <div class="modal-body p-0">
                                    <div class="card card-plain">
                                        <div class="card-header pb-0 text-left">
                                            <h3 class="font-weight-bolder text-success text-gradient">Hase</h3>
                                            <p class="mb-0">Enter your arrow number and scoring zone</p>
                                        </div>
                                        <div class="card-body">
                                            <form role="form text-left" action="?" method="post" onsubmit="document.getElementById('user').setAttribute('value', user_id);">
                                                <div class="table-responsive">
                                                    <table class="table align-items-center mb-0">
                                                        <tbody>
                                                        <tr>
                                                            <td class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                                Arrow
                                                            </td>
                                                            <td>
                                                                <div class="btn-group" role="group"
                                                                     aria-label="Basic radio toggle button group">
                                                                    <input type="radio" class="btn-check"
                                                                           name="btnradioArrow" id="btnradio1" value="1"
                                                                           autocomplete="off"
                                                                           required="required">
                                                                    <label class="btn btn-outline-success"
                                                                           for="btnradio1">1</label>

                                                                    <input type="radio" class="btn-check"
                                                                           name="btnradioArrow" id="btnradio2" value="2"
                                                                           autocomplete="off"
                                                                           required="required">
                                                                    <label class="btn btn-outline-success"
                                                                           for="btnradio2">2</label>

                                                                    <input type="radio" class="btn-check"
                                                                           name="btnradioArrow" id="btnradio3" value="3"
                                                                           autocomplete="off"
                                                                           required="required">
                                                                    <label class="btn btn-outline-success"
                                                                           for="btnradio3">3</label>

                                                                    <input type="radio" class="btn-check"
                                                                           name="btnradioArrow" id="btnradio4" value="M"
                                                                           autocomplete="off"
                                                                           required="required">
                                                                    <label class="btn btn-outline-success"
                                                                           for="btnradio4">Miss</label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                                Scoring Zone
                                                            </td>
                                                            <td>
                                                                <div class="btn-group" role="group"
                                                                     aria-label="Basic radio toggle button group">
                                                                    <input type="radio" class="btn-check"
                                                                           name="btnradioZone"
                                                                           id="btnradio5"
                                                                           value="center"
                                                                           autocomplete="off">
                                                                    <label class="btn btn-outline-success"
                                                                           for="btnradio5">Center</label>

                                                                    <input type="radio" class="btn-check"
                                                                           name="btnradioZone" id="btnradio6" value="kill"
                                                                           autocomplete="off">
                                                                    <label class="btn btn-outline-success"
                                                                           for="btnradio6">Kill</label>

                                                                    <input type="radio" class="btn-check"
                                                                           name="btnradioZone" id="btnradio7" value="body"
                                                                           autocomplete="off">
                                                                    <label class="btn btn-outline-success"
                                                                           for="btnradio7">Body</label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <hr id="tables-hr">
                                                <div class="text-center">
                                                    <input type="hidden" name="userid" id="user">
                                                    <button type="submit"
                                                            class="btn btn-round bg-gradient-success btn-lg w-100 mt-4 mb-0"
                                                            name="points">
                                                        Save
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End modal-->
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
    //set display if either the next or previous animal does not exist
    if (<?=$_SESSION['aktpos']?> == 1)
    {
        document.getElementById("prevbutton").style.display = "none";
    }
    <?php
        $game = Game::getGame($_SESSION['game_id']);
        $tierzuord = new Tierzuord();
        $tierzuord->parcour_id = $game->parcour_id;
        $tierzuord->getAktPos();
    ?>
    if (<?=$_SESSION['aktpos']?> == <?=$tierzuord->pos?>)
    {
        document.getElementById("nextbutton").style.display = "none";
    }
</script>
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
