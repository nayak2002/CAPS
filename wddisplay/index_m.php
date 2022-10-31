    <div class="container mt-4">

        <?php include('message.php');include('./database/config.php'); ?>
        <h4>Work Diary</h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
            
                    <div class="card-body">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Register Number</th>
                                    <th>Student Name</th>
                                    <th>Committee</th>
                                    <th>Event Name</th>
                                    <th>Event Time</th>
                                    <th>Event Date</th>
                                    <th>Diary Entry</th>
                                    
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $query = "SELECT workdiaryentry.ID, workdiaryentry.Regno,user_data.first_name,user_data.last_name, workdiaryentry.event_name,workdiaryentry.event_time,workdiaryentry.event_date,workdiaryentry.task,user_data.committee
                                    FROM workdiaryentry
                                    INNER JOIN user_data ON workdiaryentry.Regno=user_data.regno
                                    ORDER BY workdiaryentry.event_name ASC";
                                    $result = $link->query($query);

                                    if(mysqli_num_rows($result) > 0)
                                    {
                                        foreach($result as $student)
                                        {
                                            ?>
                                            <tr>
                                                <td><?= $student['ID']; ?></td>
                                                <td><?= $student['Regno']; ?></td>
                                                <td><?php echo"".$student['first_name']." ".$student['last_name']."";?></td>
                                                <td><?= $student['committee']; ?></td>
                                                <td><?= $student['event_name']; ?></td>
                                                <td><?= $student['event_time']; ?></td>
                                                <td><?= $student['event_date']; ?></td>
                                                <td><?= $student['task']; ?></td>
                                                
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