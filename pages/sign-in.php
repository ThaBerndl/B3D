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
  <meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/branding/circle logo_new.png">
  <title>
    B3D - Skillboard | Sign In
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
    require_once "../PHP/class/User.php";
    session_start();
  ?>
</head>
<?php
if(isset($_POST['submit'])) //verarbeitung Forms
{
    if (!empty($_POST['nickname']) && !empty($_POST['password']))
    {
        $user = new User();
        $user->nickname = $_POST['nickname'];
        $user->passwort = $_POST['password'];
        if ($user->checkLogin()){
            $user->getUserwithNick();
            $_SESSION['nickname'] = $user->nickname;
            $_SESSION['user_id'] = $user->id;
            $_SESSION['auth'] = true;
            header('location: new-game.php');
        }
    }
}?>
<body class="">
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg blur border-radius-lg top-0 z-index-3 shadow position-absolute mt-4 py-2 start-0 end-0 mx-4">
          <div class="container-fluid">
            <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 " href="../pages/dashboard.php">
              B3D - Skillboard
            </a>          
          </div>
        </nav>
        <!-- End Navbar -->
      </div>
    </div>
  </div>
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
              <div class="card card-plain">
                <div class="card-header pb-0 text-start ">
                  <h4 class="font-weight-bolder">Sign In</h4>
                  <p class="mb-0">Enter your nickname and password to sign in</p>
                </div>
                <div class="card-body border-radius-xl">
                  <form role="form" action="sign-in.php" method="post">
                    <div class="mb-3">
                      <input type="text" class="form-control form-control-lg" placeholder="Nickname" aria-label="nickname" name="nickname">
                    </div>
                    <div class="mb-3">
                      <input type="password" class="form-control form-control-lg" placeholder="Passwort" aria-label="Password" name="password">
                    </div>
                    <!--<div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="rememberMe">
                      <label class="form-check-label" for="rememberMe">Remember me</label>
                    </div>-->
                    <div class="text-center">
                      <input type="submit" name="submit" value="Sign in" class="btn btn-lg btn-success btn-lg w-100 mt-4 mb-0"></input>
                    </div>
                  </form>
                </div>

                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-4 text-sm mx-auto">
                    Don't have an account?
                    <a href="sign-up.php" class="text-success text-gradient font-weight-bold">Sign up</a>
                  </p>
                </div>
              </div>
            </div>

              <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
              <div class="position-relative bg-gradient-success h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden" style="background-image: url('https://github.com/ThaBerndl/B3D/blob/main/assets/img/main_theme_forest.jpg?raw=true');
          background-size: cover;">
                <span class="mask bg-gradient-success opacity-4"></span>
                <h4 class="mt-5 text-white font-weight-bolder position-relative">"B3D - Skillboard"</h4>
                <p class="text-white position-relative">Ob du richtig triffst und nicht, zeigt dir gleich das Licht.</p>
              </div>
            </div>
              <?php
                  if(isset($_POST['submit'])) //verarbeitung Forms
                  {
                      if (empty($_POST['nickname']))
                      {
                          echo "<a style='color: red; margin-left: 3%'> Nickname Required</a>";
                          return false;
                      }
                      if (empty($_POST['password']))
                      {
                          echo "<a style='color: red; margin-left: 3%'> Password Required</a>";
                          return false;
                      }
                      $user = new User();
                      $user->nickname = $_POST['nickname'];
                      $user->passwort = $_POST['password'];
                      if (!$user->checkLogin()){
                          echo "<a style='color: red; margin-left: 3%'> Nickname/Password Wrong, Check Spelling</a>";
                          return false;
                      }
                  }
              ?>
          </div>
        </div>
      </div>
    </section>
  </main>

  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- B3D -->
  <script type="text/javascript" src="../Javascript/myscripts.js"></script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/argon-dashboard.min.js?v=2.0.1"></script>
</body>
</html>