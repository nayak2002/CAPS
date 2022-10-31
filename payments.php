<?php session_start();

require_once('include/navbar.php');

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
</head>


<body>

    <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close mt-3">

            </div>
        </div>
        <div class="site-mobile-menu-body"></div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <?php if (isset($_SESSION['login']) != "true") {
        
        echo "  <div class='alert alert-danger' style='text-align:center' role='alert'>
        Seems like you haven't logged in yet! <a href='./login.php'>Click here</a> to log in your CAPS account
      </div>";
    }
    
    else{
        echo"<div class='col d-flex justify-content-center'>
        <div class='card w-50 '>
            <div class='card-header'>
                Featured
            </div>
            <div class='card-body'>
                <h5 class='card-title'>Membership Fee Payment</h5>
                <p class='card-text'>Kindly pay Rs.500 towards club membership fee. Don't pay again if already paid.</p>
                <form>
                    <script src='https://checkout.razorpay.com/v1/payment-button.js' data-payment_button_id='pl_KLRUEU5Ego08ev' async> </script>
                </form>
            </div>
        </div>
    </div>";
    }
    ?>
    



    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/main.js"></script>
    <?php require_once('./include/footer.php'); ?>
</body>

</html>