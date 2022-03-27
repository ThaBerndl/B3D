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

<?php
    require_once("../PHP/class/User.php");

    $vorname = isset($_POST['vorname']) ? $_POST['vorname'] : '';
    $nachname = isset($_POST['nachname']) ? $_POST['nachname'] : '';
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $pw = isset($_POST['password']) ? $_POST['password'] : '';
    $errormsg = '';
?>
<?php
if(isset($_POST["submit"]))
{
    if(isset($_POST["checkTerms"]))
    {
        if($username != '')
        {
            if($pw != '')
            {
                if($vorname != '')
                {
                    if($nachname != '')
                    {
                        $user = new User($username, $vorname, $nachname, $pw);
                        //User has been created
                        if($user->insertUser())
                        {
                            //Weiterleiten zur dashboard seite
                        }
                        else
                        {
                            $errormsg = "The username is already in use!";
                        }
                    }
                    else
                    {
                        $errormsg = "please enter your last name!";
                    }
                }
                else
                {
                    $errormsg = "please enter your first name!";
                }
            }
            else
            {
                $errormsg = "please enter a password!";
            }
        }
        else
        {
            $errormsg = "please enter a username!";
        }
    }
    else
    {
        $errormsg = "Dont forget to agree to our Terms and Conditions!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/branding/circle logo_new.png">
  <title>
    B3D -Skillboard | Sign Up
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
  
</head>

<body class="">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3 navbar-transparent mt-4">
    <div class="container">
      <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 text-white" href="../pages/dashboard.html">
        B3D - Skillboard
      </a>      
    </div>
  </nav>
  <!-- End Navbar -->
  <main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('https://github.com/ThaBerndl/B3D/blob/main/assets/img/main_theme_forest.jpg?raw=true'); background-position: center;">
      <span class="mask bg-gradient-success opacity-4"></span>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5 text-center mx-auto">
            <h1 class="text-white mb-2 mt-5">Welcome!</h1>
            <p class="text-lead text-white">Create your B3D - Skillboard account for free.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
          <div class="card z-index-0">
            <div class="card-header text-center pt-5">
              <h4>Sign up</h4>
            </div>
            <form action="sign-up.php" method="post">
                <p style="text-align: center; color: orangered"><?php echo $errormsg ?></p>
              <div class="card-body">
                <form role="form">
                  <div class="mb-3">
                    <input type="text" class="form-control" placeholder="Vorname" aria-label="Vorname" name="vorname" value="<?php echo isset($_POST['vorname']) ? $_POST['vorname'] : '' ?>">
                  </div>
                  <div class="mb-3">
                    <input type="text" class="form-control" placeholder="Nachname" aria-label="nachname" name="nachname" value="<?php echo isset($_POST['nachname']) ? $_POST['nachname'] : '' ?>">
                  </div>
                  <div class="mb-3">
                    <input type="text" class="form-control" placeholder="Username" aria-label="Username" name="username" value="<?php echo isset($_POST['username']) ? $_POST['username'] : '' ?>">
                  </div>
                  <div class="mb-3">
                    <input type="password" class="form-control" placeholder="Password" aria-label="Password" name="password" value="<?php echo isset($_POST['password']) ? $_POST['password'] : '' ?>">
                  </div>
                  <div class="form-check form-check-info text-start">
                    <input class="form-check-input" name="checkTerms" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                      I agree the <a href="javascript:;" class="text-dark font-weight-bolder">Terms and Conditions</a>
                    </label>
                  </div>
                  <div class="text-center">
                    <a href="dashboard.html"><button type="submit" name="submit" class="btn bg-gradient-success w-100 my-4 mb-2">Sign up</button></a>
                  </div>
                  <p class="text-center-sm mt-3 mb-0">Already have an account? <a href="../pages/sign-in.php" class="text-success font-weight-bolder">Sign in</a></p>
                </form>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>
  <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  <footer class="footer py-5">
    <div class="container">
      <div class="row">
        <div class="col-8 mx-auto text-center mt-1">
          <p class="mb-0 text-secondary">
            Copyright © <script>
              document.write(new Date().getFullYear())
            </script> Soft by B3D.
          </p>
        </div>
      </div>
    </div>
  </footer>
  <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
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
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/argon-dashboard.min.js?v=2.0.1"></script>
</body>
</html>