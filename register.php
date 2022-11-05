<?php

session_start();
// Include config file
require_once('./include/navbar.php');



if (isset($_SESSION['login'])=="true") {
    header("location:homepage.php");
    exit;
}
// Processing form data when form is submitted

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $wing = test_input($_POST["wing"]);


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

        if (empty($_POST["regno"])) {
            $err = "Please enter register number!";
        } else {
            $regno = test_input($_POST["regno"]);
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



        $user_check_query = "SELECT * FROM user_data WHERE regno='$regno' OR email='$email' LIMIT 1";
        $result = mysqli_query($link, $user_check_query);
        $user = mysqli_fetch_assoc($result);
        if ($user) { // if user exists
            if ($user['regno'] === $regno) {
            $err = "Register number already exists";
            }

            if ($user['email'] === $email) {
            $err="Email already exists";
            }
        }

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO user_data (regno, user_type, first_name,last_name,email,password,committee) 
                VALUES('$regno','VOLUNTEER', '$fname', '$lname', '$email', '$hash', '$wing')";
        mysqli_query($link, $query);
        
        $_SESSION['regno']=$regno;
        $_SESSION['name'] = $fname;
        $_SESSION['login']="true";
        $_SESSION['utype']="volunteer";
        $_SESSION['fname'] = $fname;
        $_SESSION['committee']=$_POST["wing"];
        
        header('location: homepage.php');

        

        
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
    <title>CAPS Register</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/register.css">
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

                            <p class="login-card-description"><b>CAPS</b> Volunteer Portal</p>
                            <p class="login-card-label">Register</p>
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <?php
                                
                            if (!empty($err)) {
                                  echo '<div class="alert alert-danger" style="font-size:0.8rem;">' . $err . '</div>';
                                    }
                            ?>
                                <div class="form-group">
                                    <label for="fname" class="sr-only">First Name</label>
                                    <input type="text" name="fname" id="fname" class="form-control" placeholder="First Name" required>
                                </div>
                                <div class="form-group">
                                    <label for="lname" class="sr-only">Last Name</label>
                                    <input type="text" name="lname" id="lname" class="form-control" placeholder="Last Name" required>
                                </div>
                                <div class="form-group">
                                    <label for="regno" class="sr-only">Registration Number</label>
                                    <input type="text" name="regno" id="regno" class="form-control" placeholder="Registration Number" required>
                                </div>
                                <div class="form-group">
                                    <label for="classname" class="sr-only">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="password" class="sr-only">Password</label>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
                                </div>
                                <div class="form-group">
                                    <select style="color:#495057;" name="wing" id="wing" class="form-control" required>
                                        <option style="color:#495057;" value="N/A">Committee</option>
                                        <option value="Tech Tank">Tech Tank</option>
                                        <option value="Content Generation">Content Generation</option>
                                        <option value="Quality Control">Quality Control</option>
                                        <option value="Media">Media and PR</option>
                                        <option value="Operations">Operations</option>
                                    </select>
                                </div>
                                <input type="checkbox" name="terms-check" id="terms-check" style="float: left; margin-top: 3px; margin-right: 6px;" required></input>
                                <p class="terms"><b>Terms of Service</b> and <b>Privacy Policy</b></p>
                                <br>
                                <input name="signup" id="signup" class="btn btn-block login-btn mb-4" type="submit" value="Sign Up">
                            </form>
                            <a href="./register_mentor.php" class="forgot-password-link">Not a volunteer? Register as a mentor.</a>
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