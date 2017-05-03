<?php
ini_set('max_execution_time', 1500); //300 seconds = 5 minutes
include("dbconnect.php");
include("fwaLib.php");

$sch = "";

$sql1 = "UPDATE registeration SET day = 0, examDate ='' WHERE Course <> ''";
dbcon("fwa",$sql1);

$sql2 = "UPDATE courses SET day = 0 WHERE Course <> '' ";
dbcon("fwa",$sql2);


startFWA();




?>

<div id="stat"></div>

<style>

#stat{
    border: 2px solid;
    background: lightgreen;
}

</style>