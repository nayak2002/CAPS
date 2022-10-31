<?php session_start();

require_once('database/config.php');
require_once('include/navbar.php');
if ($_SESSION['login'] != "true" && $_SESSION['utype'] != 'mentor') {
  header('Location:./homepage_nologin.php');
  exit();
}
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/css/home.css">
  <link rel="stylesheet" href="fonts/icomoon/style.css">
  <link rel="stylesheet" href="assets/css/ionicons.min.css">
  <link rel="stylesheet" href="assets/css/footerstyle.css">


  <title>CAPS</title>
</head>

<body>

<?php if(isset($_SESSION['edit-user'])){
      echo $_SESSION['edit-user'];
  }?>
  <div class="site-mobile-menu site-navbar-target">
    <div class="site-mobile-menu-header">
    </div>
    <div class="site-mobile-menu-body"></div>
  </div>


  

  <div class="alert alert-success" style="text-align:center;" role="alert">
    Welcome <?php echo $_SESSION['name']; ?>! You are logged into mentor portal!

  </div>
  <div class="d-flex justify-content-center">
  <div class="accordion" id="accordionExample">
    <div class="accordion-item " style="width: 70rem;">
      <h2 class="accordion-header" id="headingOne">
        <button class="accordion-button collapsed" style="font-family: 'Poppins';" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
          Show Student Data
        </button>
      </h2>
      <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
        <div class="accordion-body">
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

                if ($field4name == 'MENTOR') {
                  continue;
                } else {



                  echo '<tr> 
                        <th class="align-middle" scope="row">' . $count . '</th>
                        <td class="align-middle">' . $field0name . '</td> 
                        <td class="align-middle">' . $field1name . '</td> 
                        <td class="align-middle">' . $field2name . '</td> 
                        <td class="align-middle">' . $field3name . '</td> 
                        <td class="align-middle">' . $field4name . '</td>
                        <td><button type="button" class="btn btn-outline-primary mx-2">Edit</button><button type="button" class="btn btn-primary">Remove</button></td>
                    </tr>';
                  $count += 1;
                }
              }
              $result->free();
            }
            ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  </div>



  <div class="hero" style="background-image: url('images/hero_1.jpg');"></div>


  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.sticky.js"></script>
  <script src="js/main.js"></script>
  <?php require_once('./include/footer.php'); ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>

</html>

<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="./assets/css/css/ionicons.min.css">
<link rel="stylesheet" href="./assets/css/footstyle.css">