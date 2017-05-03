

<?php
ini_set('max_execution_time', 1200); //300 seconds = 5 minutes
        require_once('header.php');
        include("fwaLib.php");
 ?>


<head>
  <title>SIS</title>
  <meta charset='utf-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link rel='stylesheet' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
  <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js'></script>
  <script src='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
  

  <style>
.table{
    width:90%;
    margin-left:5%;
    margin-right:5%;
    margin-top:20px;
}

</style>

<script>

function delete_id(id)
{

     if(confirm('Sure To Remove This Record ?'))
     {
        window.location.href='coursesDelete.php?Course='+id;
     }
}

</script>


</head>
<?php
include('dbconnect.php');
$sql = "select * from courses order by day ASC";
$result = dbcon('fwa',$sql);

if($result->num_rows > 0){
echo "<table class='table'>";
$i = 0;
while($row = $result->fetch_assoc()){
$idv = $row['Course'];
if($i==0){
echo "<tr class='success'>";
echo "<th> Exam Date and Time</th>";
echo " <th> Course  </th>";
echo "<td>No Conflict</td>";




echo "</tr>";
}
if($row['nCampus']>1){
$i = $i + 1;
echo "<tr>";
echo "<td>" . findDate($row['day']) . "</td>";
echo "<td>" . $row['Course'] . "</td>";

$co = "";

if (searchStudentNS($row['Course'],1)==1)
$co .= findDate(1) . "(1)=";
if (searchStudentNS($row['Course'],2)==1)
$co .= findDate(2). "(2)=";
if (searchStudentNS($row['Course'],3)==1)
$co .= findDate(3). "(3)=";
if (searchStudentNS($row['Course'],4)==1)
$co .= findDate(4). "(4)=";
if (searchStudentNS($row['Course'],5)==1)
$co .= findDate(5). "(5)=";
if (searchStudentNS($row['Course'],6)==1)
$co .= findDate(6). "(6)=";
if (searchStudentNS($row['Course'],7)==1)
$co .= findDate(7). "(7)=";
if (searchStudentNS($row['Course'],8)==1)
$co .= findDate(8). "(8)=";
if (searchStudentNS($row['Course'],9)==1)
$co .= findDate(9). "(9)=";
if (searchStudentNS($row['Course'],10)==1)
$co .= findDate(10). "(10)=";
if (searchStudentNS($row['Course'],11)==1)
$co .= findDate(11). "(11)=";
if (searchStudentNS($row['Course'],12)==1)
$co .= findDate(12). "(12)=";
if (searchStudentNS($row['Course'],13)==1)
$co .= findDate(13). "(13)=";
if (searchStudentNS($row['Course'],14)==1)
$co .= findDate(14). "(14)=";
if (searchStudentNS($row['Course'],15)==1)
$co .= findDate(15). "(15)=";
if (searchStudentNS($row['Course'],16)==1)
$co .= findDate(16). "(16)=";
if (searchStudentNS($row['Course'],17)==1)
$co .= findDate(17). "(17)=";
if (searchStudentNS($row['Course'],18)==1)
$co .= findDate(18). "(18)=";
if (searchStudentNS($row['Course'],19)==1)
$co .= findDate(19). "(19)=";
if (searchStudentNS($row['Course'],20)==1)
$co .= findDate(20). "(20)=";
if (searchStudentNS($row['Course'],21)==1)
$co .= findDate(21). "(21)=";

echo "<td>" . $co . "</td>";






echo "</tr>";
}
}
}
echo '</table>';


?>
