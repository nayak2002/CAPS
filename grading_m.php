<?php
if ($_SESSION['login'] != "true") {
  header("location:login.php");
  exit;
} else {
  if (isset($_GET['reg'])) {
    if (isset($_GET['eid'])) {
      $reg = $_GET['reg'];
      $eid = $_GET['eid'];
      if ($path_result = $link->query("select * from workdiaryentry where regno=" . $reg . " and ID=" . $eid . "")) {
        while ($path_row = $path_result->fetch_assoc()) {
          $path = $path_row['path-to-file'];
          $diary = $path_row['diary-entry'];
        }
      }
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($path_result = $link->query("UPDATE `sql12542208`.`workdiaryentry` SET grade=" . $_POST['grade'] . " WHERE regno=" . $reg . " and ID=" . $eid . "")) {
          header("location:assignment.php");
        }
      }
    }
  } else {
    header("location:assignment.php");
    exit;
  }
}


?>


<div class="card m-5 p-5">


  <div class="card-body">
    </center>
    <div class="container">
      <div class="row">
        <div class="col-sm">
          <h3 class="card-title" style="font-weight: 700;">Grade this assignment</h5>
            <embed src="<?php echo $path ?>" height="80%" width="80%" />
        </div>



        <div class="col-sm">
          <h5 class="mt-2">Diary Entry</h5>
          <p><?php echo $diary; ?></p>
          <form method="post" action="<?php echo "grading.php?reg=" . $reg . "&eid=" . $eid . "" ?>">
        </div>
      </div>
      <div class="row mt-2">
        <div class="col-sm">
          <input class="mt-3" type="text" name="grade" style="width:5rem;text-align:center;" /><br>
          <button name="submit" type="submit" class="btn btn-primary mt-2" style="background-color:#007bff;">Submit</button>
        </div>
      </div>
      </form>
      </center>


    </div>
  </div>
</div>