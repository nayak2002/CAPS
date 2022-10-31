
<!doctype html>
<?php session_start();
include('./include/navbar.php');
error_reporting(0);
?>
<html lang="en">


<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/home.css">
  <link rel="stylesheet" href="fonts/icomoon/style.css">
  <link rel="stylesheet" href="assets/css/ionicons.min.css">
  <link rel="stylesheet" href="assets/css/footerstyle.css">


  <title>CAPS Work Diary</title>


<body>

  <div class="site-mobile-menu site-navbar-target">
    <div class="site-mobile-menu-header">
      <div class="site-mobile-menu-close mt-3">
        
      </div>
    </div>
    <div class="site-mobile-menu-body"></div>
  </div>

  <?php  

    if ($_SESSION['login'] != "true") {
        header('Location:./homepage_nologin.php');
        exit();
      }
      else {
        if ($_SESSION['utype'] == 'mentor') {
            
            include('./wddisplay/index_m.php');
          exit();
        } 
        elseif($_SESSION['utype'] == 'confirm_due') {
          header('Location:./homepage_nomentor.php');
          exit();
        }
        else{
            include('./workdiary/index.php');
            include('./wddisplay/index_v.php');
        }
      }
    
  ?>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.sticky.js"></script>
  <script src="js/main.js"></script>
</body>

</html>