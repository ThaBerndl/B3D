<?php
echo "<div class=\"collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-\" id=\"navbar\">
          <div class=\"ms-md-auto pe-md-3 d-flex align-items-center\">
           
          </div>
          <ul class=\"navbar-nav  justify-content-end\">
            <li class=\"nav-item d-flex align-items-center\">
              <li class=\"nav-item px-3 d-flex align-items-center\">
                  <a href=\"../pages/profile.php\" class=\"nav-link text-white p-0\">
                      <i class=\"fa fa-user\" data-bs-toggle=\"tooltip\" data-bs-placement=\"bottom\" title=\"View profile\">
                      </i>
                      <span class=\"d-sm-inline d-none\">";
/*Show nickname*/
if ($_SESSION['auth'] == true) {
    echo $_SESSION['nickname'];
} else {
    echo "Sign in";
}
echo "            </span>
                  </a>
                </li>
                </li>
                <li class=\"nav-item px-3 d-flex align-items-center\">
                    <a href=\"../pages/sign-in.php\" class=\"nav-link text-white p-0\">
                        <i class=\"fa fa-sign-out fixed-plugin-button-nav cursor-pointer\" data-bs-toggle=\"tooltip\" data-bs-placement=\"bottom\" title=\"Sign out\"></i>
                    </a>
                </li>
                <li class=\"nav-item d-xl-none ps-3 d-flex align-items-center\">
                    <a href=\"javascript:;\" class=\"nav-link text-white p-0\" id=\"iconNavbarSidenav\">
                        <div class=\"sidenav-toggler-inner\">
                            <i class=\"sidenav-toggler-line bg-white\"></i>
                            <i class=\"sidenav-toggler-line bg-white\"></i>
                            <i class=\"sidenav-toggler-line bg-white\"></i>
                        </div>
                    </a>
                </li>
                </ul>
                </div>";