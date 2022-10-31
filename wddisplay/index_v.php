    <div class="container mt-4">
        <?php include('message.php');
        $regno = $_SESSION['regno'];
        $vol_row = $link->query("select first_name,last_name from user_data where regno=" . $regno . "")->fetch_assoc(); ?>
        <div class=" text-center mt-5">
        <h3>Work Diary - <?php echo "" . $vol_row['first_name'] . " " . $vol_row['last_name'] . "" ?></h3>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Event Name</th>
                                    <th>Event Time</th>
                                    <th>Event Date</th>
                                    <th>Task</th>
                                    <th>Operations</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM workdiaryentry where regno=$regno";
                                $result = $link->query($query);

                                if (mysqli_num_rows($result) > 0) {
                                    foreach ($result as $student) {
                                ?>
                                        <tr>
                                            <td><?= $student['ID']; ?></td>
                                            <td><?= $student['event_name']; ?></td>
                                            <td><?= $student['event_time']; ?></td>
                                            <td><?= $student['event_date']; ?></td>
                                            <td><?= $student['task']; ?></td>
                                            <td>
                                                <a href="./wddisplay/student-view.php?id=<?= $student['ID']; ?>" class="btn btn-info btn-sm">View</a>
                                                <a href="./wddisplay/student-edit.php?id=<?= $student['ID']; ?>" class="btn btn-success btn-sm">Edit</a>
                                                <form action="./wddisplay/code.php" method="POST" class="d-inline">
                                                    <button type="submit" name="delete_student" value="<?= $student['ID']; ?>" class="btn btn-danger btn-sm">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
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