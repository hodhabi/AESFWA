<?php
require_once('header.php');

include('dbconnect.php'); 
if(isset($_POST['submit'])){

$Course = $_POST['Course'];
$semester = $_POST['semester'];
$vsemester = mysql_real_escape_string($semester);
$day = $_POST['day'];
$vday = mysql_real_escape_string($day);
$nStudents = $_POST['nStudents'];
$vnStudents = mysql_real_escape_string($nStudents);
$Duration = $_POST['Duration'];
$vDuration = mysql_real_escape_string($Duration);
$Deliverytype = $_POST['Deliverytype'];
$vDeliverytype = mysql_real_escape_string($Deliverytype);
$ExamMethod = $_POST['ExamMethod'];
$vExamMethod = mysql_real_escape_string($ExamMethod);
$sql = "Update courses Set  semester='$vsemester', day='$vday', nStudents='$vnStudents', Duration='$vDuration', Deliverytype='$vDeliverytype', ExamMethod='$vExamMethod' where Course=$Course ";
$result = dbcon('fwa',$sql);


header('Location:  coursesList.php');
}
?>