
<?php
include('./database/config.php');
    if (isset($_SESSION['regno'])) {
        $regno = $_SESSION['regno'];
        $result = $link->query("select count(distinct event_name) from attendance")->fetch_assoc();
        $total_events = $result['count(distinct event_name)'];
        $attended_events_row = $result = $link->query("select count(regno) from attendance where regno=" . $regno . " and attendance_status='P'")->fetch_assoc();
        $attended_events = $attended_events_row['count(regno)'];
        $att_percent = ($attended_events / $total_events) * 100;
        $att_percent = round($att_percent, 2);
    }
  ?>

<header class="site-navbar js-sticky-header site-navbar-target" role="banner">

  <div class="container">
    <div class="row align-items-center position-relative">


      <div class="site-logo">
        <a href="homepage.php"><img src="assets/images/newcaps.png" alt="logo" class="logo" style="width:30vh;">
      </div>

      <div class="col-12">
        <nav class="site-navigation text-right ml-auto " role="navigation">

          <ul class="site-menu main-menu js-clone-nav ml-auto d-none d-lg-block">
            <li><a href="./homepage.php" class="nav-link">Home</a></li>
            <li><a href="./attendance.php" class="nav-link">Attendance <div class="badge badge-primary text-wrap" style="width: 3rem;display:<?php if (!isset($_SESSION['regno'])){echo 'none;';}else{}?>">  <?php echo $att_percent;?>
</div></a></li>
            <li><a href="./payments.php" class="nav-link">Payments</a></li>
            <li><a href="./grading.php" class="nav-link">My Grade</a></li>
            <li><a href="./assignment.php" class="nav-link">Work Diary</a></li>
            <li class="has-children" style="<?php if (basename($_SERVER['PHP_SELF']) != "homepage_nomentor.php" && basename($_SERVER['PHP_SELF']) != "login.php" && basename($_SERVER['PHP_SELF']) != "register.php" && basename($_SERVER['PHP_SELF']) != "login_mentor.php" && basename($_SERVER['PHP_SELF']) != "register_mentor.php" )  {
                                              echo 'display:none;';
                                            } ?>">

              <a href="#about-section" class="nav-link"><?php if (basename($_SERVER['PHP_SELF']) == "login.php" || basename($_SERVER['PHP_SELF']) == "login_mentor.php") {
                                                          echo 'Register';
                                                        } elseif (basename($_SERVER['PHP_SELF']) == "homepage_nomentor.php" || basename($_SERVER['PHP_SELF']) == "register.php" || basename($_SERVER['PHP_SELF']) == "register_mentor.php") {
                                                          echo 'Login';
                                                        }
                                                        ?></a>
              <ul class="dropdown arrow-top" style="<?php if (basename($_SERVER['PHP_SELF']) != "homepage_nomentor.php" && basename($_SERVER['PHP_SELF']) != "login.php" && basename($_SERVER['PHP_SELF']) != "register.php" && basename($_SERVER['PHP_SELF']) != "login_mentor.php" && basename($_SERVER['PHP_SELF']) != "register_mentor.php") {
                                                      echo 'display:none;';
                                                    } ?>">
                <li><a href="<?php if (basename($_SERVER['PHP_SELF']) == "login.php" || basename($_SERVER['PHP_SELF']) == "login_mentor.php") {
                                echo './register.php';
                              } elseif (basename($_SERVER['PHP_SELF']) == "register.php" || basename($_SERVER['PHP_SELF']) == "register_mentor.php"|| basename($_SERVER['PHP_SELF']) == "homepage_nomentor.php") {
                                echo './login.php';
                              } ?>" class="nav-link">Volunteers</a></li>
                <li><a href="<?php if (basename($_SERVER['PHP_SELF']) == "login.php") {
                                echo './register_mentor.php';
                              }
                              ?>" style="<?php if (basename($_SERVER['PHP_SELF']) == "register.php" || basename($_SERVER['PHP_SELF']) == "register_mentor.php" || basename($_SERVER['PHP_SELF']) == "homepage_nomentor.php") {
              echo 'display:none;';
            }
            ?>" class="nav-link">Mentors</a></li>


              </ul>
            </li>

            <li class="has-children" style="<?php if (!isset($_SESSION['name'])) {
                                              echo 'display:none;';
                                            } else {
                                            } ?>">

              <a href="#about-section" class="nav-link" style="<?php if (!isset($_SESSION['name'])) {
                                                                  echo 'display:none;';
                                                                } else {
                                                                  echo 'display:block;';
                                                                } ?>"><?php echo $_SESSION['name']; ?></a>
              <ul class="dropdown arrow-top">
                
                <li><a href="./logout.php" class="nav-link">Logout</a></li>


              </ul>
            </li>
          </ul>

        </nav>

      </div>

      <div class="toggle-button d-inline-block d-lg-none"><a href="#" class="site-menu-toggle py-5 js-menu-toggle text-black"><span class="icon-menu h3"></span></a></div>

    </div>
  </div>

</header>