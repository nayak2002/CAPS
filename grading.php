<?php

require_once('include/navbar.php');
require_once('database/config.php');
// Initialize the session
session_start();

if ($_SESSION['login'] !="true") {
  header("location:login.php");
  exit;
}else {

}

?>

<html lang="en">
<script>if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}</script>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>CAPS Login</title>
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/login.css">
  <link rel="stylesheet" href="fonts/icomoon/style.css">

</head>

<body>
<?php
     if ($_SESSION['login'] != "true") {
        header('Location:./homepage_nologin.php');
        exit();
      }
      else {
        if ($_SESSION['utype'] == "volunteer") {
            include_once('./grading_v.php');
        } elseif ($_SESSION['utype'] == "mentor") {
            include_once('./grading_m.php');
        } else {
        }
    }
        ?>
</body>
</html>
