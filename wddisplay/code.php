<?php
session_start();
include_once('../database/config.php');

if(isset($_POST['delete_student']))
{
    $student_id = mysqli_real_escape_string($link, $_POST['delete_student']);

    $query = "DELETE FROM workdiaryentry WHERE ID='$student_id' ";
    $result = $link->query($query);

    if($result)
    {
        $_SESSION['message'] = "Event Entry Deleted Successfully";
        header("Location: ../workdiary.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Entry Not Deleted";
        header("Location: ../workdiary.php");
        exit(0);
    }
}

if(isset($_POST['update_student']))
{
    $event_id = $_POST['event-id'];
    $ename_row = $link->query("SELECT * FROM events where ID=" . $event_id . "")->fetch_assoc();
    $name= $ename_row['event_title'];
    $time =strval(date('h:i:sa'));
    $date = date('Y-m-d');
    $task = mysqli_real_escape_string($link, $_POST['task']);

    $query = "UPDATE workdiaryentry SET event_name='$name', event_time='$time', event_date='$date', task='$task' WHERE ID='$student_id' ";
    $result = $link->query($query);

    if($result)
    {
        $_SESSION['message'] = "Diary Updated";
        header("Location: ../workdiary.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Diary Not Updated";
        header("Location: ../workdiary.php");
        exit(0);
    }

}


if(isset($_POST['save_student']))
{
    $name = mysqli_real_escape_string($link, $_POST['event_name']);
    $time = mysqli_real_escape_string($link, $_POST['event_time']);
    $date = mysqli_real_escape_string($link, $_POST['event_date']);
    $task = mysqli_real_escape_string($link, $_POST['task']);
    
    $query = "INSERT INTO workdiaryentry (event_name,event_time,event_date,task) VALUES ('$name','$time','$date','$task')";

    $result = $link->query($query);
    if($result)
    {
        $_SESSION['message'] = "Event Created Successfully";
        header("Location: student-create.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Event Not Created";
        header("Location: student-create.php");
        exit(0);
    }
}

?>