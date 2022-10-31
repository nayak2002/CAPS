<h3  class="mt-5 mb-5" style="text-align:center"><strong>Work Diary Entries</strong></h3>

<hr>

<style>
  table th{
    font-weight: 500;
    text-align: center;
  }
  table td{
    text-align: center;
  }
</style>
<?php 
  $query = 'select distinct(event_title) from events';
  $fetch = mysqli_query($link,$query);
  while ($row = mysqli_fetch_array($fetch)){
    echo '<table class="table table-striped" style="width:60%;" align="center">
    <thead>
    <caption style="text-align: center;caption-side: top;font-size: 1.25rem;color:black;">'.$row['event_title'].'</caption>
    <tr>
      <th>#</th>
      <th>Register Number</th>
      <th>Name</th>
      <th>Diary Entry</th>
      <th>File Attached</th>
      <th>Grade</th>
    </tr>';

    $data_query = 'select * from workdiaryentry left join user_data on workdiaryentry.regno=user_data.regno where workdiaryentry.event_name="'.$row['event_title'].'"';
    $data_fetch = mysqli_query($link,$data_query);
    $count=1;
    while ($data_row = mysqli_fetch_array($data_fetch)){
      if($data_row['grade']==0){
        $grade = "No Grade";
      }
      else{
        $grade = $data_row['grade'];
      }
      $path = "grading.php?reg=".$data_row['regno']."&eid=".$data_row['ID']."";
      echo'<tr>
        <td>'.$count.'</td>
        <td>'.$data_row['regno'].'</td>
        <td>'.$data_row['first_name'].'</td>
        <td>'.$data_row['diary-entry'].'</td>
        <td><a class="btn btn-primary" style="background-color:#007bff;padding:0.5rem;" href="'.$path.'">Open File</a></td>
        <td>'.$grade.'</td>
        
      </tr>

      
    </thead>
    ';
    $count=$count+1;
  }
  }
?>