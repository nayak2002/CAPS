<?php
require_once('include/navbar.php');
require_once('database/config.php');
// Initialize the session
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
         if ($_SESSION['utype'] == 'mentor') {
            $uid = $_GET['uid'];
            $query = "DELETE FROM `user_data` WHERE regno='$uid'";  
            $result = mysqli_query($link, $query);  
            if($result){
                header("location:../mentor_homepage.php");   
            }
            else{
                echo 'Failed';
            }
        
        } else {
          echo 'You are not authorized to view this page!';
          exit();
        }
        
        
    ?>
</body>
</html>