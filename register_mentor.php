<?php

session_start();
require_once('./include/navbar.php');




// Processing form data when form is submitted

$email = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {


        if (empty($_POST["password"])) {
            $err = "Please enter password!";
        } else {
            $password = test_input($_POST["password"]);
        }

        if (empty($_POST["email"])) {
            $err = "Please enter email!";
        } else {
            $email = test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $err = "Invalid email format";
            }
            $email = test_input($_POST["email"]);
        }
        if (empty($_POST["lname"])) {
            $err = "Please enter last name!";
        } else {
            $lname = test_input($_POST["lname"]);
        }

        if (empty($_POST["fname"])) {
            $err = "Please enter first name!";
        } else {
            $fname = test_input($_POST["fname"]);
        }

        $user_check_query = "SELECT * FROM user_data WHERE email='$email' LIMIT 1";
        $result = mysqli_query($link, $user_check_query);
        $user = mysqli_fetch_assoc($result);
        if ($user) { // if user exists

            if ($user['email'] === $email) {
            $reg_err="Email already exists";
            }
           
        }
        else{
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $query = "INSERT INTO user_data (regno, user_type, first_name,last_name,email,password,committee) 
                    VALUES('NULL','CONFIRM_DUE', '$fname', '$lname', '$email', '$hash', 'MENTOR')";
            mysqli_query($link, $query);
            $_SESSION['login'] = "pending";
            $_SESSION['name'] != $fname;
            header('location: mentor_homepage.php');
        }
}
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    
      
      
?>

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

</head>

<body>





    <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">

        <img src="assets/images/mainback.jpg" alt="block1" class="back-main">
        <div class="container">
            <div class="card login-card">
                <div class="row no-gutters">
                    <div class="col-md-5">
                        <img src="assets/images/registercard.jpeg" alt="login" class="login-card-img">
                    </div>
                    <div class="col-md-7">
                        <div class="card-body">

                            <p class="login-card-description"><b>CAPS</b> Mentor Portal</p>
                            <p class="login-card-label">Register</p>
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                <div class="form-group">
                                    <?php
                                    if (!empty($reg_err)) {
                                        echo '<div class="alert alert-danger" style="font-size:0.8rem;">' . $reg_err . '</div>';
                                    }
                                    ?>
                                    <label for="fname" class="sr-only">First Name</label>
                                    <input type="text" name="fname" id="fname" class="form-control" placeholder="First Name">
                                    
                                </div>

                                <div class="form-group">
                                    <label for="lname" class="sr-only">Last Name</label>
                                    <input type="text" name="lname" id="lname" class="form-control" placeholder="Last Name">
                                </div>

                                <div class="form-group">
                                <label for="email" class="sr-only">Email Address</label>
                                    <input type="text" name="email" id="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" placeholder="Email Address">
                                </div>



                                <div class="form-group mb-4">
                                    <label for="password" class="sr-only">Password</label>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                                </div>

                                <input name="login" id="login" class="btn btn-block login-btn mb-4" type="submit" value="Login">
                            </form>
                            <a href="./register.php" class="forgot-password-link">Not a mentor? Register here as a volunteer.</a>
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
</body>

</html>