
<?php

include('dbconnect.php');

require_once('header.php');

$id = $_GET['id'];

$sql = "select * from courses where Course='$id'";

$result = dbcon('fwa',$sql);

if ($result->num_rows > 0) {

  $row = $result->fetch_assoc();

  ?>

<div class='form-group'>
<form action='coursesEdit.php' method='post'>
<input class='form-control' type='text' name='Course' value="<?php echo $row['Course']; ?>">
<input class='form-control' type='text' name='semester' value="<?php echo $row['semester']; ?>">
<input class='form-control' type='text' name='day' value="<?php echo $row['day']; ?>">
<input class='form-control' type='text' name='nStudents' value="<?php echo $row['nStudents']; ?>">
<input class='form-control' type='text' name='Duration' value="<?php echo $row['Duration']; ?>">
<input class='form-control' type='text' name='Deliverytype' value="<?php echo $row['Deliverytype']; ?>">
<input class='form-control' type='text' name='ExamMethod' value="<?php echo $row['ExamMethod']; ?>">
<head>
  <title>SIS</title>
  <meta charset='utf-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link rel='stylesheet' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
  <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js'></script>
  <script src='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
  

  <style>
.form-group{
    width:80%;
    margin-left:10%;
    margin-right:10%;
    margin-top:20px;
}

</style>

</head>
<input class='btn btn-primary' type='submit' name='submit' value='Update'>
</div>
<?php
}
?>
