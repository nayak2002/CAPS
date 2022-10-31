
<?php session_start();
require_once('include/navbar.php');
require_once('database/config.php');
?>

<?php 
    if(isset($_POST['login'])){
        $username = mysqli_real_escape_string($link, $_POST["username"]);  
        $password = mysqli_real_escape_string($link, $_POST["password"]);
        $query = "SELECT * from admin_data where username='".$username."'";  
        $result = mysqli_query($link, $query);  
    
        if(mysqli_num_rows($result) > 0)  
        {  
            $row = $result->fetch_assoc();
            if($password ==  $row['password']){
                $_SESSION['utype'] = 'admin';
                $_SESSION['login'] = "true";
                $_SESSION['name'] = $username;
                header('Location:./admin_homepage.php');
              }
              else{
                $login_err = "Incorrect password! Please try again.";
              }
            }
            else{  
          $login_err = "Incorrect Username!";
        }
            
            
        }  
        
?>
<!doctype html>
<html lang="en">

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

  <head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

  <link rel="stylesheet" href="assets/css/home.css">
  <link rel="stylesheet" href="fonts/icomoon/style.css">

  <title>CAPS</title>
</head>


<body>

  <div class="site-mobile-menu site-navbar-target">
    <div class="site-mobile-menu-header">
      <div class="site-mobile-menu-close mt-3">
        
      </div>
    </div>
    <div class="site-mobile-menu-body"></div>
  </div>

  <div class="col-md-7">
            <div class="card-body">
              <p class="login-card-description"><b>STEMS</b> Admin Login Portal</p>
              <p class="login-card-label">Login</p>
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                  <?php
                  if (!empty($login_err)) {
                    echo '<div class="alert alert-danger" style="font-size:0.8rem;">' . $login_err . '</div>';
                  }
                  ?>
                  <label for="username" class="sr-only">Username</label>
                  <input type="text" name="username" id="username" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>"  placeholder="Username">
                </div>
                <div class="form-group mb-4">
                  <label for="password" class="sr-only">Password</label>
                  <input type="password" name="password" id="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" placeholder="***********">
                </div>
                <input name="login" id="login" class="btn btn-primary mb-4" type="submit" value="Login">
              </form>
              <a href="#!" class="forgot-password-link">Forgot password?</a><br><br>
              <nav class="login-card-footer-nav">
              </nav>
            </div>
          </div>


  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.sticky.js"></script>
  <script src="js/main.js"></script>
  <?php require_once('./include/footer.php'); ?>
</body>

</html>