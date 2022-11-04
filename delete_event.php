<?php


$date = date('Y-m-d');
$del_query = "DELETE FROM `events` WHERE end_date<='".$date."'";
$result = mysqli_query($link, $del_query);

?>