<?php

require_once('include/navbar.php');
require_once('database/config.php');
// Initialize the session
session_start();

if ($_SESSION['login'] != "true") {
  header("location:login.php");
  exit;
} else {
  if ($_SESSION['utype'] == "volunteer") {
    header("location:homepage.php");
  }
  else{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $ename = mysqli_real_escape_string($link, $_POST['ename']);
      $venue = mysqli_real_escape_string($link, $_POST['venue']);
      $desc = mysqli_real_escape_string($link, $_POST['desc']);
      $sdate = $_POST['start_date'];
      $stime = $_POST['start_time'];
      $edate = $_POST['end_date'];
      $etime = $_POST['end_time'];
      $campus = $_POST['campus'];
      $dept = $_POST['dept'];

      $query = "INSERT INTO events(event_title,event_desc,start_time,start_date, end_time,end_date,campus, dept, venue) VALUES ('".$ename ."','".$desc."','".$stime."','".$sdate."','".$etime."','".$edate."','".$campus."','".$dept."','".$venue."')";
      echo $query;
      $result = mysqli_query($link, $query);
        if ($result) {
          echo "Success";
        } else {
          echo "Error";
        }
    }
  }
}

?>

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
  <title>CAPS Login</title>
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/login.css">
  <link rel="stylesheet" href="assets/css/add_event.css">
  <link rel="stylesheet" href="fonts/icomoon/style.css">
  <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css" />
  

</head>

<body>
  <div class="main">
    <div class="container">
      <div class="signup-content">
        <div class="signup-img">
          <img src="IMG_9414.jpg" alt="" />
        </div>
        <div class="signup-form">
          <form method="POST" action="add_event.php" class="register-form" id="register-form">
            <h2>STEMS - Event creation form</h2>
            <div class="form-row">
              <div class="form-group">
                <label for="name">Event Name :</label>
                <input type="text" name="ename" id="ename" required />
              </div>
              <div class="form-group">
                <label for="venue">Venue :</label>
                <div class="form-select">
                  <select name="venue" required>
                    <option value=""></option>
                    <option value="main">Main Auditorium</option>
                    <option value="block4">Block 4 auditorium</option>
                    <option value="ke">KE auditorium</option>
                  </select>
                  <span class="select-icon"><i class="zmdi zmdi-chevron-down"></i></span>
                </div>
              </div>

            </div>


            <div class="form-row">
              <div class="form-group" style="width:100%;">
                <label for="desc">Event Description :</label>
                <textarea name="desc" placeholder="Type here...." style="width:100%;display: block;width: 100%;border: 1px solid #ebebeb;padding: 11px 20px;box-sizing: border-box;font-family: 'Montserrat';font-weight: 500;font-size: 13px;"></textarea>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group">
                <label for="start_date">Event Start Date :</label>
                <input type="date" name="start_date" required />
              </div>

              <div class="form-group">
                <label for="start_time">Event Start Time :</label>
                <input type="time" name="start_time" required />
              </div>
            </div>

            <div class="form-row">
              <div class="form-group">
                <label for="end_date">Event End Date :</label>
                <input type="date" name="end_date" id="date" required />
              </div>

              <div class="form-group">
                <label for="end_time">Event End Time :</label>
                <input type="time" name="end_time" id="date" required />
              </div>
            </div>

            <div class="form-row">

              <div class="form-group">
                <label for="campus">Campus :</label>
                <div class="form-select">
                  <select name="campus" required>
                    <option value=""></option>
                    <option value="hosur">Hosur Road</option>
                    <option value="kengeri">Kengeri</option>
                    <option value="central">Central Campus</option>
                  </select>
                  <span class="select-icon"><i class="zmdi zmdi-chevron-down"></i></span>
                </div>
              </div>

              <div class="form-group">
                <label for="dept">Department attending :</label>
                <div class="form-select">
                  <select name="dept" id="dept" required>
                    <option value=""></option>
                    <?php
                    $dept_query = 'select * from departments';
                    $dept_fetch = mysqli_query($link, $dept_query);
                    while ($dept_row = mysqli_fetch_array($dept_fetch)) {
                      echo "<option value=" . $dept_row['dept_id'] . ">" . $dept_row['dept_name'] . "</option>";
                    }

                    ?>
                  </select>
                  <span class="select-icon"><i class="zmdi zmdi-chevron-down"></i></span>
                </div>
              </div>
            </div>



            <div class="form-submit">
              <input type="reset" value="Reset All" class="submit" name="reset" id="reset" required />
              <input type="submit" value="Submit Form" class="submit" name="submit" id="submit" />
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- JS -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="js/main.js"></script>
</body>
</body>

</html>