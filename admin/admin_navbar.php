<?php
include('../database/config.php');
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
      <a href="../homepage.php"><img src="../assets/images/newcaps.png" alt="logo" class="logo" style="width:30vh;">
    </div>

    <div class="col-12">
      <nav class="site-navigation text-right ml-auto " role="navigation">

        <ul class="site-menu main-menu js-clone-nav ml-auto d-none d-lg-block">
          <?php 
          if(isset($_SESSION['utype'])==true){
            if($_SESSION['utype'] !='admin'){
              echo '<li><a href="./homepage.php" class="nav-link">Home</a></li>';
            }
            else{
              echo '<li><a href="./admin_homepage.php" class="nav-link">Home</a></li>';
              echo '<li><a href="./admin_volunteers.php" class="nav-link">Volunteers</a></li>';
              echo '<li><a href="./admin_mentors.php" class="nav-link">Mentors</a></li>';
            }
          }
          else{
            echo '<li><a href="./homepage.php" class="nav-link">Home</a></li>';
          }
          ?>
          
        </ul>

      </nav>

    </div>

    <div class="toggle-button d-inline-block d-lg-none"><a href="#" class="site-menu-toggle py-5 js-menu-toggle text-black"><span class="icon-menu h3"></span></a></div>

  </div>
</div>

</header>