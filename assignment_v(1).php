<?php
if (isset($_POST["submit"])) {
  if (isset($_FILES['fileInput'])) {
    $event_id = $_POST['event-id'];
    $diaryentry = $_POST['diaryentry'];
    $query = 'SELECT * FROM events where ID=' . $event_id . '';
    if ($result = $link->query($query)) {
      while ($row = $result->fetch_assoc()) {
        $event_name = $row['event_title'];
      }
      if (!file_exists('uploads/' . $event_name . '')) {
        mkdir('uploads/' . $event_name . '', 0777, true);
      }
      $file_name = $_FILES['fileInput']['name'];
      $file_size = $_FILES['fileInput']['size'];
      $file_tmp = $_FILES['fileInput']['tmp_name'];
      $ext = explode(".", $file_name);
      $ext = end($ext);


      $file_name = '' . $event_id . '_' . $regno . '.' . $ext . '';
      $file_path = 'uploads/' . $event_name . '/' . $file_name . '';

      if ($file_size > 104857600) {
        $errors[] = 'File is too large';
      }
      if (empty($errors) == true) {
        $path = 'uploads/' . $event_name . '/' . $file_name . '';
        move_uploaded_file($file_tmp, $path);


        $query = 'INSERT INTO `workdiaryentry`(`ID`,`regno`, `event_name`, `path-to-file`, `diary-entry`) VALUES (' . $event_id . ',' . $regno . ',"' . $event_name . '","' . $file_path . '","' . $diaryentry . '")';

        $result = mysqli_query($link, $query);
        if ($result) {
          echo "Success";
        } else {
          echo "Error";
        }
      } else {
        print_r($errors);
      }
    }
  }
}


?>
<div class="form-body">
  <div class="row">
    <div class="form-holder">
      <div class="form-content">
        <div class="form-items">
          <h3>Work Diary Entry</h3>
          <p>Fill in all the fields below</p>
          <form class="requires-validation" action="assignment.php" method="post" enctype="multipart/form-data">
            <div class="col-md-12">
              <select class="form-select mt-3" name="event-id" required>
                <option selected disabled value="">Event</option>
                <?php
                $count = 1;
                $query = 'select events.event_title, events.ID from events left join workdiaryentry on events.ID = workdiaryentry.ID AND workdiaryentry.regno =' . $regno . ' where workdiaryentry.ID is null;';
                if ($result = $link->query($query)) {
                  while ($row = $result->fetch_assoc()) {
                    echo "<option value=" . $row['ID'] . ">" . $row['event_title'] . "</option>";
                  }
                }
                ?>
              </select>
              <div class="valid-feedback">You selected a position!</div>
              <div class="invalid-feedback">Please select a position!</div>
            </div>


            <div class="col-md-12  mt-3">

              <div class="custom-file">
                <label for="fileInput" id="file-input-label" class="custom-file-label">Add photo/video/PDF</label>
                <input id="fileInput" name="fileInput" type="file" />
                <span class="fileuploadspan">No file selected</span>
              </div>
            </div>


            <div class="col-md-12 mt-1">
              <p class="mt-3">How did you contribute to this event? What was the task assigned to you?</p>
            </div>

            <div class="col-md-12" style="margin-top: -5px;">
              <textarea style="height:100px;" name="diaryentry" placeholder="Type here" required></textarea>
            </div>

            <div class="form-button mt-3">
              <button name="submit" type="submit" class="btn btn-primary" style="background-color:#007bff;">Submit</button>
            </div>
          </form>
        </div>
      </div>
        <img src="./assets/work-diary.png" width="700px" height="400" class="side-image">
    </div>

  </div>
</div>