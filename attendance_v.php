    <?php
    if (isset($_SESSION['regno'])) {
        $regno = $_SESSION['regno'];
        $result = $link->query("select count(distinct event_name) from attendance")->fetch_assoc();
        $total_events = $result['count(distinct event_name)'];
        $attended_events_row = $result = $link->query("select count(regno) from attendance where regno=" . $regno . " and attendance_status='P'")->fetch_assoc();
        $attended_events = $attended_events_row['count(regno)'];
        $att_percent = ($attended_events / $total_events) * 100;
        $att_percent = round($att_percent, 2);
    }


    ?>

    <div class="<?php if ($att_percent >= 85 && $att_percent <= 100) {
                    echo "alert alert-success";
                } elseif ($att_percent >= 75 && $att_percent <= 84) {
                    echo "alert alert-warning";
                } else {
                    echo "alert alert-danger";
                } ?>" style="text-align:center" role="alert">
        Your Attendance is currently <strong> <?php echo $att_percent; ?> </strong> %
    </div>


    <h3  class="mt-5 mb-5" style="text-align:center"><strong>Event Attendance</strong></h3>

    <div class="row justify-content-center">
        <div class="col-auto">
            <div class="table-responsive">
                <table class="table table-striped">

                    <!--Table head-->
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Event Name</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <!--Table head-->

                    <!--Table body-->
                    <tbody>
                        <?php

                        $eventcount = 1;
                        if ($result = $link->query("select * from attendance where regno=" . $regno . "")) {
                            while ($eventrow = $result->fetch_assoc()) {
                                $field0name = $eventrow['event_name'];
                                $field1name = $eventrow['date'];
                                $field2name = $eventrow['time'];
                                if($eventrow['attendance_status']=="P"){
                                    $field3name = "Present";
                                }
                                else{
                                    $field3name = "Absent";
                                };
                                echo "      <tr>
                                      
                    <th scope='row' class='align-middle'>" . $eventcount . "</th>
                    <td style='text-align:center'>" . $field0name . "</td>
                    <td style='text-align:center'>" . $field1name . "</td>
                    <td style='text-align:center'>" . $field2name . "</td>
                    <td style='text-align:center'>" . $field3name . "</td>
                  </tr>";
                  $eventcount+=1;
                            }
                        }


                        ?>

                    </tbody>
                    <!--Table body-->
                </table>
            </div>
        </div>
    </div>