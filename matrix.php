

<?php

        require_once('header.php');
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

<style>
td{
    border: 1px solid;
}

</style>

</head>
<?php
include('dbconnect.php');
$sql = "select * from courses order by day ASC";
$result = dbcon('fwa',$sql);

echo "<table class='table'>";
echo "<tr><td></td><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td><td>7</td><td>8</td>
<td>9</td><td>10</td><td>11</td><td>12</td><td>13</td><td>14</td><td>15</td><td>16</td><td>17</td>
<td>18</td><td>19</td><td>20</td><td>21</td><td>22</td><td>23</td></tr>";
for ($j=1; $j<=35; $j++){
echo "<tr><td>" . $j . "</td>";
  for($i=1; $i<=35; $i++){
    echo "<td>" . intersectDay($i,$j) . "</td>";
  }
echo "</tr>";
}

echo "</table>";


function countCampus($course,$campus){
  $sqlCampus = "select * from registeration where Campus = '$campus' and Course = '$course'";
  $rs = dbcon("fwa",$sqlCampus);
  $rowC = $rs->num_rows;
  return($rowC);
}

function intersectDay($day1,$day2){
  $sqlInt = "select StudentId from registeration where day = '$day1' or day = '$day2' group by StudentId";
  $rsT = dbcon("fwa",$sqlInt);
  $rowGroupped= $rsT->num_rows;
  $sqlInt = "select StudentId from registeration where day = '$day1' or day = '$day2'";
  $rsT2 = dbcon("fwa",$sqlInt);
  $rowTotal= $rsT2->num_rows;
  return($rowTotal-$rowGroupped);


}
?>
