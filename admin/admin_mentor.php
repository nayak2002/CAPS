<?php session_start();
ob_start();
require_once('admin_navbar.php');

if ($_SESSION['login'] == "true") {
  if($_SESSION['utype']=="volunteer"){
    header('Location:./homepage.php');
    exit();
  }
  elseif($_SESSION['utype']=="volunteer"){
    header('Location:./homepage.php');
    exit();
  }
  elseif($_SESSION['utype']=="admin"){

  }
  else{
    header('Location:./homepage.php');
    exit();
  }
}
elseif($_SESSION['login'] == "pending"){
  header('Location:./homepage_nomentor.php');
  exit();
}
else { 
  header('Location:./homepage_nologin.php');
  exit();
}

?>

<!doctype html>
<html lang="en">
<script>if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}</script>
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

    <?php
    function test_input($data)
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
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
        if ($user['regno'] == $regno) {
          $err = "Register number already exists";
        }

        if ($user['email'] == $email) {
          $err = "Email already exists";
        }
      } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO user_data (regno, user_type, first_name,last_name,email,password,committee) 
          VALUES('$regno','MENTOR', '$fname', '$lname', '$email', '$hash', '$wing')";
        $result = $link->query($query);
        header('Location:./mentor_homepage.php');
        exit();
      }
    }
    ?>
  </div>

  <?php
  if (!empty($err)) {
    echo '<div class="alert alert-danger" style="text-align:center;">' . $err . '</div>';
  } ?>
  <div class="d-flex justify-content-center">
    <form action="#" method="post">
      <table class="table table-striped text-center">
        <?php
        $count = 1;
        $query = "SELECT * FROM user_data";
        echo '
              <thead>
                <tr >
                  <th scope="col">#</th>
                  <th scope="col">Register No</th>
                  <th scope="col">First Name</th>
                  <th scope="col">Last Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Committee</th>
                  <th scope="col">Verification</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>';
        if ($result = $link->query($query)) {
          while ($row = $result->fetch_assoc()) {
            $field0name = $row["regno"];
            $field1name = $row["first_name"];
            $field2name = $row["last_name"];
            $field3name = $row["email"];
            $field4name = $row["committee"];

            if ($field4name != 'MENTOR') {
              continue;
            } else {
                if($row['user_type']=="CONFIRM_DUE"){
                  $status = "Not Verified";
                }
                else{
                  $status = "Verified";
                }

              
              
              echo '<tr> 
                        <th class="align-middle" scope="row">' . $count . '</th>
                        <td class="align-middle">' . $field0name . '</td> 
                        <td class="align-middle">' . $field1name . '</td> 
                        <td class="align-middle">' . $field2name . '</td> 
                        <td class="align-middle">' . $field3name . '</td> 
                        <td class="align-middle">' . $field4name . '</td>
                        <td class="align-middle">' . $status . '</td>';

              if($status=="Verified"){
                echo '<td><button type="button" value=' . $field0name . '  name=' . $field0name . ' id="editbutton" class="btn btn-outline-primary mx-2">Edit</button>
                        
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#delete' . $field0name . '">
                  Remove
                </button>';
              }
              else{
                echo '<td><button type="button" value=' . $field0name . '  name=' . $field0name . ' id="editbutton" class="btn btn-outline-primary mx-2">Approve</button>
                        
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#delete' . $field0name . '">
                        Remove
                        </button>';
              }
                        
                        echo'

                        <!-- Modal -->
                        <div class="modal fade" id="delete' . $field0name . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Confirm</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                Do you want to delete student with register number : ' . $field0name . '?
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <a href="./deleteuser.php/?uid=' . $field0name . '"><button type="button" class="btn btn-primary">Delete</button></a>
                              </div>
                            </div>
                          </div>
                        </div>
                        </tr>';
              $count += 1;
            }
          }

          $result->free();
        }
        ?>

        </tbody>
      </table>
      <hr>
      <!-- Button trigger modal -->
      <center>
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Add Student
      </button>
      </center>
      <?php require_once('../include/footer.php'); ?>
      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add Mentor</h5>
              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

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
                  <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
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

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>
    </form>

  </div>

  <div class="hero" style="background-image: url('../images/hero_1.jpg');"></div>


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