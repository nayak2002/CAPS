<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit_attendance'])) {
        $event_id = $_POST['event-id'];
        $ename_row = $link->query("SELECT * FROM events where ID=" . $event_id . "")->fetch_assoc();

        $userlist_sql = $link->query("SELECT * FROM user_data where user_type='VOLUNTEER'");
        while ($volunteers_row = $userlist_sql->fetch_assoc()) {
            $choice = $_POST['btnradio-' . $volunteers_row['regno'] . ''];
            $attendance_sql = "INSERT INTO `sql12542208`.`attendance` (`regno`, `student_name`, `event_name`, `date`, `eventid`, `attendance_status`, `time`) VALUES ('" . $volunteers_row['regno'] . "', '" . $volunteers_row['first_name'] . "', '" . $ename_row['event_title'] . "', '" . date("Y/m/d") . "', '" . $ename_row['ID'] . "', '" . $choice . "','" . date("h:i:sa") . "')";
            echo "<script>console.log('".$attendance_sql."');</script>";
            $attendance_result = $link->query($attendance_sql);
            if ($attendance_result) {
                $attendance_result = $link->query("UPDATE `sql12542208`.`events` SET `attendance_taken` = '1' WHERE (`ID` = '" . $ename_row['ID'] . "');");
            }
        }
    }
}

?>
<div class="row justify-content-center">
    <div class="col-auto">
        <form action="attendance.php" method="post">
            <select class="custom-select mb-5" name="event-id">
                <option selected>Select Event</option>
                <?php
                $count = 1;
                $query = "SELECT * FROM events group by(event_title) having attendance_taken=0";
                if ($result = $link->query($query)) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value=" . $row['ID'] . ">" . $row['event_title'] . "</option>";
                    }
                }
                ?>
            </select>
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
                        <td class="align-middle" >' . $field0name . '</td> 
                        <td class="align-middle">' . $field1name . '</td> 
                        <td class="align-middle">' . $field2name . '</td> 
                        <td class="align-middle">' . $field3name . '</td> 
                        <td class="align-middle">' . $field4name . '</td>
                        <td>
                    
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="btnradio-' . $field0name . '" id="flexRadioDefault1" value="Present">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Present
                        </label>
                        </div>
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="btnradio-' . $field0name . '" value="Absent" id="flexRadioDefault2">
                        <label class="form-check-label" for="flexRadioDefault2">
                            Absent
                        </label>
                        </div>';
                            $count += 1;
                        }
                    }

                    $result->free();
                }
                ?>

                </tbody>
            </table>
            <hr>
            <div class="text-center">
                <button type="submit" name="submit_attendance" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>