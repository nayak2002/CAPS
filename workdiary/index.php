<?php
date_default_timezone_set('Asia/Kolkata');

include('./database/config.php');
require_once('include/navbar.php');
if (isset($_POST['submitdata'])) {
    
    $Regno = $_SESSION['regno'];
    $event_time =strval(date('h:i:sa'));
    $event_date = date('Y-m-d');
    $task = $_POST['task'];
    $event_id = $_POST['event-id'];
    $committee = $_SESSION['committee'];
    $ename_row = $link->query("SELECT * FROM events where ID=" . $event_id . "")->fetch_assoc();
    $event_title= $ename_row['event_title'];
    $query = "INSERT INTO workdiaryentry (Regno, event_name,event_time,event_date,committee,task) 
          VALUES('$Regno', '$event_title', '$event_time', '$event_date', '$committee', '$task')";
    $result = $link->query($query);
    if ($result) {
        
    } else {
        echo "<script>alert('Unsuccessful. Try Again.');</script>";
    }

    
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CAPS Work Diary</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet" href="fonts/icomoon/style.css">

</head>


<body>


    <div class="container">
        <div class=" text-center ">

            <h1>Work Diary</h1>


        </div>


        <div class="row ">
            <div class="col-lg-7 mx-auto">
                <div class="card mt-2 mx-auto p-4 bg-light">
                    <div class="card-body bg-light">

                        <div class="container">
                            <form id="contact-form" role="form" action="workdiary.php" method="POST">
                                <div class="controls">

                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="form_time">Select Event</label>
                                                <select class="custom-select" name="event-id" required>
                                                    <?php
                                                    $count = 1;
                                                    $query = "SELECT * FROM events group by(event_title)";
                                                    if ($result = $link->query($query)) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            echo "<option value=" . $row['ID'] . " required>" . $row['event_title'] . "</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="form_time">Diary Entry Time</label><br>
                                                <label for="form_time"><?php echo date("h:i:sa"); ?></label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="form_date">Diary Entry Date</label><br>
                                                <label for="form_time"><?php echo date("dS F Y"); ?></label>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="form_message">Enter your task assigned</label>
                                                <textarea id="form_message" name="task" class="form-control" placeholder="Write your message here." rows="4" required="required" data-error="Please, leave us a message."></textarea>
                                            </div>

                                        </div>


                                        <div class="col-md-12">

                                            <button type="submit" name="submitdata" class="btn btn-success btn-send  pt-2 btn-block" value="Submit">Submit</button>

                                        </div>

                                    </div>


                                </div>
                            </form>
                        </div>
                    </div>


                </div>
                <!-- /.8 -->

            </div>
            <!-- /.row-->

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>