<?php
    session_start();
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
    <link href="style.css" rel="stylesheet">

    <title>Work Diary</title>
</head>
<body>
  
    <div class="container mt-4">

        <?php include('message.php'); ?>
        <h4>Work Diary</h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                
                    <div class="card-header">
                        
                            <a href="../workdiary/index.php" class="btn btn-primary float-start">Add in Work Diary</a>
                        
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Register Number</th>
                                    <th>Student Name</th>
                                    <th>Event Name</th>
                                    <th>Event Time</th>
                                    <th>Event Date</th>
                                    <th>Task</th>
                                    <th>Operations</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $query = "SELECT workdiaryentry.ID, workdiaryentry.Regno,user_data.first_name,user_data.last_name, workdiaryentry.event_name,workdiaryentry.event_time,workdiaryentry.task,user_data.committee
                                    FROM workdiaryentry
                                    INNER JOIN user_data ON workdiaryentry.Regno=user_data.regno;";
                                    $result = $conn->query($query);

                                    if(mysqli_num_rows($result) > 0)
                                    {
                                        foreach($result as $student)
                                        {
                                            ?>
                                            <tr>
                                                <td><?= $student['ID']; ?></td>
                                                <td><?= $student['Regno']; ?></td>
                                                <td><?php echo"".$student['first_name']." ".$student['last_name']."";?></td>
                                                <td><?= $student['event_time']; ?></td>
                                                <td><?= $student['date']; ?></td>
                                                <td><?= $student['task']; ?></td>
                                                <td>
                                                    <a href="student-view.php?id=<?= $student['ID']; ?>" class="btn btn-info btn-sm">View</a>
                                                    <a href="student-edit.php?id=<?= $student['ID']; ?>" class="btn btn-success btn-sm">Edit</a>
                                                    <form action="code.php" method="POST" class="d-inline">
                                                        <button type="submit" name="delete_student" value="<?=$student['ID'];?>" class="btn btn-danger btn-sm">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        echo "<h5> No Record Found </h5>";
                                    }
                                ?>
                                
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>