<?php
session_start();
require_once('dbconn.php');
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Edit Event</title>
</head>

<body>

    <div class="container mt-5">

        <?php include('message.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Event Edit
                            <a href="../workdiary.php" class="btn btn-danger float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <?php
                        if (isset($_GET['id'])) {
                            $event_id = mysqli_real_escape_string($conn, $_GET['id']);
                            $query = "SELECT * FROM workdiaryentry WHERE id='$event_id' ";
                            $result = $conn->query($query);

                            if (mysqli_num_rows($result) > 0) {
                                $student = mysqli_fetch_array($result);
                        ?>
                                <form action="code.php?id=<?= $_GET['id']; ?>" method="POST">

                                    <div class="mb-3">
                                        <label>Event Name</label>
                                        <select class="custom-select mb-5" name="event-id">
                                            <option selected>Select Event</option>
                                            <?php
                                            $count = 1;
                                            $query = "SELECT * FROM events group by(event_title)";
                                            if ($result = $conn->query($query)) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<option value=" . $row['ID'] . ">" . $row['event_title'] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label>Re-enter Task</label>
                                        <input type="text" name="task" value="<?= $student['task']; ?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" name="update_student" class="btn btn-primary">
                                            Update Event
                                        </button>
                                    </div>

                                </form>
                        <?php
                            } else {
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