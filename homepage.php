<?php session_start();

require_once('include/navbar.php');
require_once('./database/config.php');
require_once('delete_event.php');
if ($_SESSION['login'] != "true") {
  header('Location:./homepage_nologin.php');
  exit();
}
else {
  if ($_SESSION['utype'] == 'mentor') {
    header('Location:./mentor_homepage.php');
    exit();
  } 
  elseif($_SESSION['utype'] == 'confirm_due') {
    header('Location:./homepage_nomentor.php');
    exit();
  }
  else{
    
  }
}
?>

<?php


$sql = "SELECT * FROM events";
$result = mysqli_query($link, $sql);  
$rowcount = mysqli_num_rows($result);

?>


<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/home.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="fonts/icomoon/style.css">
  <link rel="stylesheet" href="assets/css/ionicons.min.css">
  <link rel="stylesheet" href="assets/css/footerstyle.css">
  <link rel="stylesheet" type="text/css" href="./Slider/carouselstyle.css">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Roboto+Slab:wght@300&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/flickity/2.2.1/flickity.css">
  <script src="https://code.iconify.design/3/3.0.0/iconify.min.js"></script>


  <title>CAPS</title>
</head>

<body>

  <div class="site-mobile-menu site-navbar-target">
    <div class="site-mobile-menu-header">
    </div>
    <div class="site-mobile-menu-body"></div>
  </div>


  <div class="alert alert-success" style="text-align:center;" role="alert">
    Welcome <?php echo $_SESSION['name'];?>! You are now logged in to volunteer portal.
</div>

<div class="carousel-main">
<div class="hero-slider" data-carousel>
	<div class="carousel-cell" style="background-image: url(https://christuniversity.in/images/denery-banner1.jpg);">
		<div class="overlay"></div>
		<div class="inner">
			<h2 class="title">Artifex '22</h2>
			<a href="https://christuniversity.in/events/Main%20Campus/view-pdf/artifex-2022-flagship-event-of-caps" class="btn">Learn More</a>
		</div>
	</div>

	<div class="carousel-cell" style="background-image: url(https://christuniversity.in/uploads/campus/large/231781473_2020-11-11_03-22-25.jpg);">
		<div class="overlay"></div>
		<div class="inner">
			<h2 class="title">Our Website</h2>
			<a href="https://caps.christuniversity.in/" class="btn">Learn More</a>
		</div>
	</div>

	<div class="carousel-cell" style="background-image: url(https://ncr.christuniversity.in/uploads/course/medium/484245266_2021-01-06_12-19-57.jpg);">
		<div class="overlay"></div>
		<div class="inner">
			<h2 class="title">Our Mentors</h2>
			<a href="https://caps.christuniversity.in/our-family/mentors" class="btn">Learn More</a>
		</div>
	</div>
</div>
</div>
<div class="maintitle">
  <h1 class="my-5" style="font-weight: 500;">Upcoming Events</h1> 
  </div>

    <?php
    while($rowcount=$result->fetch_assoc()){
      $start_month = date('F', strtotime($rowcount['start_date']));
      $end_month = date('F', strtotime($rowcount['end_date']));
      $e_title= $rowcount['event_title'];
      $start_date= date('d', strtotime($rowcount['start_date']));
      $end_date= date('d', strtotime($rowcount['end_date']));
      $e_desc= $rowcount['event_desc'];
      $start_time=$rowcount['start_time'];
      $end_time=$rowcount['end_time'];
      echo "
    <div class='event-container'>
      <div class='event'>
        <div class='event-left'>
          <div class='event-date'>
            <div class='date'>$start_date</div>
            <div class='date'></div>
            <div class='month'>$start_month</div>  
          </div>
        </div>

        <div class='event-right'>
          <h3 class='event-title'>$e_title</h3>

          <div class='event-description'>
          $e_desc
          </div>

          <div class='event-timing'>
          <span class='iconify mr-1' data-icon='ant-design:clock-circle-filled'></span>
          <span>".$start_date." ".$start_month." ".$start_time." - ".$end_date." ".$end_month." ".$end_time." </span>
          </div>
        </div>
      </div>

    </div>
    ";
    }
    ?>

    
    <div class="container2">
    <footer class="py-3 my-4">
      <ul class="nav justify-content-center border-bottom pb-3 mb-3">
        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Home</a></li>
        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Features</a></li>
        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Pricing</a></li>
        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">FAQs</a></li>
        <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
      </ul>
      <p class="text-center text-muted">CAPS 2022</p>
    </footer>
  </div>
  <div class="hero" style="background-image: url('images/hero_1.jpg');"></div>


  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.sticky.js"></script>
  <script src="js/main.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/flickity/2.2.1/flickity.pkgd.min.js"></script>
  <script type="text/javascript" src="./Slider/script.js"></script>
</body>

</html>

<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700&display=swap" rel="stylesheet">


<link rel="stylesheet" href="./assets/css/css/ionicons.min.css">
<link rel="stylesheet" href="./assets/css/footstyle.css">