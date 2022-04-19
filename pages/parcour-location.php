<?php
session_start();
if (!$_SESSION['auth']) {
    header("location: sign-in.php");
} //Notice: Trying to get property 'tier_id' of non-object in C:\Users\Stifi\OneDrive - Berufsschule Linz 2\Year 3\B3D\pages\parcour-location.php on line 211
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        B3D - Skillboard | Parcour & Location
    </title>
    <!--Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!--CSS B3D-->
    <link id="pagestyle" href="../assets/css/b3d-style.css" rel="stylesheet"/>
    <?php
    include "../PHP/header.php";
    ?>
</head>
<body class="g-sidenav-show   bg-gray-100">
<div class="min-height-300 bg-success position-absolute w-100"></div>
<?php
require_once '../PHP/leftHor_Navbar.php';
require_once '../PHP/getClasses.php';
if (isset($_GET['addParcour'])) {
    $ort = Ort::getOrtwithBez($_GET['ort']);
    if (empty($ort)) {
        $ort = new Ort($_GET['ort']);
        $ort->insertOrt();
    }
    $parcour = Parcour::getIDWithNames($_GET['parcour'], $ort->bez);
    if (empty($parcour)) {
        $parcour = new Parcour(null, $_GET['parcour'], $ort->id);
        $parcour->create();
        $tierzuord = new Tierzuord();
        $tierzuord->parcour_id = $parcour->parcour_id;
        $tierzuord->getnextPos();
        $tierzuord->insertTierZuord();
    }
}

if (isset($_GET['addAnimal'])) {
    $parcour_ID = Parcour::getIDWithNames($_GET['parcour'], $_GET['ort']);
    if (!empty($_GET['Tiere'])) {
        saveParcour($parcour_ID);
    }
    $tierzuord = new Tierzuord();
    $tierzuord->parcour_id = $parcour_ID;
    $tierzuord->getnextPos();
    $tierzuord->insertTierZuord();
}
if (isset($_GET['saveParcour'])) {
    $parcour_ID = Parcour::getIDWithNames($_GET['parcour'], $_GET['ort']);
    saveParcour($parcour_ID);
}
?>
<main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur"
         data-scroll="false">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:">Pages</a>
                    </li>
                    <li class="breadcrumb-item text-sm text-white active" aria-current="page">Parcour & Location</li>
                </ol>
                <h6 class="font-weight-bolder text-white mb-0">Parcour & Location</h6>
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
                        <h6>Parcour & Location</h6>
                        <form id="choose_parcour" action="parcour-location.php" method="get">
                            <label for="example-text-input" class="form-control-label">Create or Choose
                                Parcour</label>
                            <input class="form-control"
                                   type="text"
                                   placeholder="enter location.."
                                   name="ort"
                                   list='orte' class="form-control"
                                   id="loc-parc-input"
                                   onchange="reload()"
                                   value="<?php echo isset($_GET['ort']) ? $_GET['ort'] : "" ?>">
                            <datalist id="orte">
                                <?php
                                $orte = Ort::getAllOrte();
                                while ($ort = $orte->fetch()) {
                                    echo "<option>" . $ort['bez'] . "</option>";
                                }
                                echo "</datalist>";
                                ?>
                                <input class="form-control"
                                       type="text"
                                       placeholder="enter parcour.."
                                       id="example-text-input"
                                       list="parcours"
                                       name="parcour"
                                       value="<?php echo isset($_GET['parcour']) ? $_GET['parcour'] : "" ?>">
                                <datalist id="parcours">
                                    <?php
                                    if (isset($_GET['ort'])) {
                                        $parcours = Parcour::getAllParcoursWithOrt($_GET['ort']);
                                    } else {
                                        $parcours = Parcour::getAllParcours();
                                    }
                                    while ($parcour = $parcours->fetch()) {
                                        echo "<option>" . $parcour['bez'] . "</option>";
                                    }
                                    echo "</datalist>";
                                    ?>
                                    <hr id="tables-hr">
                                    <button type="submit" name="addParcour"
                                            class="btn btn-outline-success align-right" id=addParcourBtn>Add/Edit
                                        Parcour
                                    </button>
                        </form>
                        <form action="parcour-location.php" method="get">
                            <input type="hidden" name="ort" value="<?= $_GET['ort'] ?>">
                            <input type="hidden" name="parcour" value="<?= $_GET['parcour'] ?>">
                            <div class="table-responsive">
                                <table class="table align-items-center">
                                    <tbody>
                                    <?php
                                    if (isset($_GET['parcour'])){
                                    $parcour_ID = Parcour::getIDWithNames($_GET['parcour'], $_GET['ort']);
                                    $stmt = Tierzuord::getAllTiereFromParcour($parcour_ID);
                                    while ($data = $stmt->fetch()) { ?>
                                        <tr>
                                        <th id="parLocTh" scope="row">#<?= $data['pos'] ?></th>
                                        <td class="align-middle">
                                        <input type='text' list='tiere' class="form-control"
                                               name="Tiere[]" style="width: 200px;
                                               placeholder=" enter animal"
                                        id="example-text-input"
                                        value='<?= $data['tier'] ?>'
                                               required>
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
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <hr id="invisible-hr">
                            <button type="submit"
                                    class="btn btn-success align-right"
                                    name="addAnimal" id=addAnimalBtn>Add Animal
                            </button>
                            <hr id="tables-save-hr">
                            <button id="saveParcour" type="submit" name="saveParcour"
                                    class="btn bg-gradient-success">Save
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    require_once "../PHP/footer.php";
    ?>
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

    function reload() {
        var ort = document.getElementById('loc-parc-input');
        self.location = 'parcour-location.php?ort=' + ort.value;
    }
    <?php
    function saveParcour($parcour_ID)
    {
        $tierArr = $_GET['Tiere'];
        for ($i = 0; $i < count($tierArr); $i++) {
            $tier = Tier::getTierfromBez($tierArr[$i]);
            if ($tier == null) {
                $tier = Tier::createTier($tierArr[$i]);
            }
            $tierzuord = new Tierzuord();
            $tierzuord->tier_id = $tier->tier_id;
            $tierzuord->parcour_id = $parcour_ID;
            $tierzuord->pos = ($i + 1);
            $tierzuord->updateTier();
        }
    }
    ?>
</script>
</body>
</html>