<?php

if ($_SESSION['login'] != "true") {
  header("location:login.php");
  exit;
} else {
  $regno = $_SESSION['regno'];
  $result = $link->query("select count(distinct event_name) from attendance")->fetch_assoc();
  $total_events = $result['count(distinct event_name)'];
  $attended_events_row = $result = $link->query("select count(regno) from attendance where regno=" . $regno . " and attendance_status='P'")->fetch_assoc();
  $attended_events = $attended_events_row['count(regno)'];
  $att_percent = ($attended_events / $total_events) * 100;
  $att_percent = round($att_percent, 2);

  $grade = 0;
  $grade_result= $link->query("SELECT * FROM `workdiaryentry` WHERE regno=".$regno."");
  while($grade_row = $grade_result->fetch_assoc()){
    $grade = $grade + $grade_row['grade'];
  }

  $diary_marks = $grade;

  if($att_percent>=91 && $att_percent<=100){
    $atmark=5;
    $grade = $grade+5;
  }
  elseif($att_percent>=81 && $att_percent<=90){
    $atmark=4;
    $grade = $grade+4;
  }
  elseif($att_percent>=71 && $att_percent<=80){
    $atmark=3;
    $grade = $grade+3;
  }
  elseif($att_percent>=60 && $att_percent<=70){
    $atmark=2;
    $grade = $grade+2;
  }
  elseif($att_percent>=30 && $att_percent<=59){
    $atmark=1;
    $grade = $grade+1;
  }
  else{

  }

  $event_count_row = $result = $link->query("SELECT count(event_title) FROM `events`")->fetch_assoc();
  $event_count = $event_count_row['count(event_title)'];
  $total = ($event_count*10)+5;
}
?>


<center>
  <div class="container mt-5">
  <h2 style="font-weight: 700;">Your Calculated Grade is : <?php echo ''.$grade.'/'.$total.'';?></h2>
  <p>Your attendance percentage is <?php echo $att_percent?>% which equates to <?php echo $atmark?> mark(s) <br>Your work diary evaluation totals up to <?php echo $diary_marks?> mark(s) out of <?php echo ($total_events*10);?></p>
  <img src="assets\images\4119036.jpg" width="500px">  
</div>
</center>