<?php session_start();
ob_start();
require_once('admin_navbar.php');

if ($_SESSION['login'] == "true") {
  if ($_SESSION['utype'] == "volunteer") {
    header('Location:./homepage.php');
    exit();
  } elseif ($_SESSION['utype'] == "volunteer") {
    header('Location:./homepage.php');
    exit();
  } elseif ($_SESSION['utype'] == "admin") {
  } else {
    header('Location:./homepage.php');
    exit();
  }
} elseif ($_SESSION['login'] == "pending") {
  header('Location:./homepage_nomentor.php');
  exit();
} else {
  header('Location:./homepage_nologin.php');
  exit();
}

?>

<!doctype html>
<html lang="en">
<script>
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
</script>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Admin Portal</title>
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/css/login.css">
  <link rel="stylesheet" href="../fonts/icomoon/style.css">

</head>

<body>

  <div class="site-mobile-menu site-navbar-target">
    <div class="site-mobile-menu-header">
    </div>
    <div class="site-mobile-menu-body"></div>
  </div>


  <div class="alert alert-success" style="text-align:center;" role="alert">
    Welcome <?php echo $_SESSION['name']; ?>! You are logged into admin portal!
  </div>

  <div class="d-flex justify-content-center">
    <img src="../assets/images/admin.jpg" alt="" width="500px" srcset="">
  </div>

  <div class="d-flex justify-content-center">

    <button type="button" class="btn btn-primary ml-3" onclick="location.href='./admin_volunteer.php'">
      Volunteers
    </button>
    <button type="button" class="btn btn-primary ml-3" onclick="location.href='./admin_mentor.php'">
      Mentors
    </button>
  </div>



  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.sticky.js"></script>
  <script src="js/main.js"></script>
  <?php require_once('../include/footer.php'); ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

</body>

</html>

<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="../assets/css/css/ionicons.min.css">
<link rel="stylesheet" href="../assets/css/footstyle.css">