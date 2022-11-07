<?php

require_once('include/navbar.php');
require_once('database/config.php');
// Initialize the session
session_start();

if (isset($_SESSION['login'])=="true") {
  header("location:login.php");
  exit;
}else {

  if(isset($_POST['login'])){
    $email = mysqli_real_escape_string($link, $_POST["email"]);
    $email = strtolower($email);  
    $password = mysqli_real_escape_string($link, $_POST["password"]);
    $query = "SELECT email,password,first_name,user_type,regno,committee FROM user_data WHERE email = '$email'";  
    
    $result = mysqli_query($link, $query);  

    if(mysqli_num_rows($result) > 0)  
    {  
        $row = $result->fetch_assoc();
        if(password_verify($password, $row['password'])){
          $_SESSION['name'] = $row['first_name'];  
          $_SESSION['login'] = "true";
          
          if($row['user_type']=="VOLUNTEER"){
            $_SESSION['utype']="volunteer";
            $_SESSION['regno']=$row['regno'];
            $_SESSION['committee']=$row['committee'];
            header("location:homepage.php");  
          }
          
          elseif($row['user_type']=="MENTOR"){
            $_SESSION['utype']="mentor";
            header("location:mentor_homepage.php");  
          }
          
          elseif($row['user_type']=="CONFIRM_DUE"){
            $_SESSION['utype']="pending";
            header("location:homepage_nomentor.php");  
          }
        }
        else{
          $login_err = "Incorrect password! Please try again.";
          
        }
    }  
    else  
    {
      $login_err = "Email doesn't exist! Want to <a style='color:#721c24;' href='./register.php'><b>register</b></a>?";
    }
  }
  
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



  <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">

    <img src="assets/images/mainback.jpg" alt="block1" class="back-main">
    <div class="container" style="padding-top:15vh;">
      <div class="card login-card">
        <div class="row no-gutters">
          <div class="col-md-5">
            <img src="assets/images/central.jpg" alt="login" class="login-card-img">
          </div>
          <div class="col-md-7">
            <div class="card-body">
              <p class="login-card-description"><b>CAPS</b> Login Portal</p>
              <p class="login-card-label">Login</p>
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                  <?php
                  if (!empty($login_err)) {
                    echo '<div class="alert alert-danger" style="font-size:0.8rem;">' . $login_err . '</div>';
                  }
                  ?>
                  <label for="email" class="sr-only">Email Address</label>
                  <input type="text" name="email" id="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>"  placeholder="Email Address">
                </div>
                <div class="form-group mb-4">
                  <label for="password" class="sr-only">Password</label>
                  <input type="password" name="password" id="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" placeholder="***********">
                </div>
                <input name="login" id="login" class="btn btn-block login-btn mb-4" type="submit" value="Login">
              </form>
              <a href="#!" class="forgot-password-link">Forgot password?</a><br><br>
              <nav class="login-card-footer-nav">
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <?php require_once('./include/footer.php'); ?>

</body>

</html>