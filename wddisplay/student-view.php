<?php
require_once ('dbconn.php');
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>View Event</title>
</head>
<body>

    <div class="container mt-5">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Event Details 
                            <a href="../workdiary.php" class="btn btn-danger float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <?php
                        if(isset($_GET['id']))
                        {
                            $event_id = mysqli_real_escape_string($conn, $_GET['id']);
                            $query = "SELECT * FROM workdiaryentry WHERE ID='$event_id' ";
                            $result = $conn->query($query);

                            if(mysqli_num_rows($result) > 0)
                            {
                                $student = mysqli_fetch_array($result);
                                ?>
                                
                                    <div class="mb-3">
                                        <label>Event Name</label>
                                        <p class="form-control">
                                            <?=$student['event_name'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Event Time</label>
                                        <p class="form-control">
                                            <?=$student['event_time'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Event Date</label>
                                        <p class="form-control">
                                            <?=$student['event_date'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Task</label>
                                        <p class="form-control">
                                            <?=$student['task'];?>
                                        </p>
                                    </div>

                                <?php
                            }
                            else
                            {
                                echo "<h4>No Such Id Found</h4>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>