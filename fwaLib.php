<?php

function startFWA(){
$sqlcourse ="select * from courses ORDER BY nStudents DESC";
$resultc = dbcon("fwa",$sqlcourse);
echo "Welcome</br>";

while($row = $resultc->fetch_assoc()){
  
    $cc = $row['Course'];
    for($sday=1;$sday<50;$sday++){
    if(searchStudent($cc,$sday)==1){
        break 1;
    }

    }
}
}


function findConflict($day,$studentid){
    $examDate = findExamDate($day);
    $sqlf="SELECT * FROM registeration WHERE day = $day and StudentId='$studentid'";
    $resultf = dbcon("fwa",$sqlf);
    if($resultf->num_rows > 0 || findMTExam($studentid,$day)==true){
        return true;
    }
}

function findMTExam($studentid,$day){
 $examDate = findExamDate($day);
    $sqlf="SELECT * FROM registeration WHERE examDate='$examDate' and StudentId='$studentid'";
    $resultf = dbcon("fwa",$sqlf);
    if($resultf->num_rows > 1)
        return true;
    
}
function searchStudent($cc,$day)
{
  
  $sqlSearch ="Select * from registeration where Course = '$cc'";
  $resultS = dbcon("fwa",$sqlSearch);
  while($rowS = $resultS->fetch_assoc()){
      if(findConflict($day,$rowS['StudentId'])==true){
         return 0;
      }
  }
  
   scheduleFWA($cc,$day);
   return 1;

  
}

function searchStudentNS($cc,$day)
{
  
  $sqlSearch ="Select * from registeration where Course = '$cc'";
  $resultS = dbcon("fwa",$sqlSearch);
  while($rowS = $resultS->fetch_assoc()){
      if(findConflict($day,$rowS['StudentId'])==true){
         return 0;
      }
  }
   return 1;

  
}


function scheduleFWA($course,$sday){
  $nrs = callNumberOfStudents($course);
  $nrc = callNumberOfCampuses($course);
  $sqlCourses = "UPDATE courses SET day = '$sday', nStudents='$nrs', nCampus ='$nrc' WHERE Course = '$course'";
  dbcon("fwa",$sqlCourses);
  $examdate = findExamDate($sday);
  $sqlSch = "UPDATE registeration SET day = '$sday', examDate ='$examdate' WHERE Course = '$course'";
  dbcon("fwa",$sqlSch);

  callNumberOfStudents($course);

  echo "<p>" . $course . " Scheduled on day : " . $sday;

}

function callNumberOfStudents($course){
$sqln = "select Course from registeration where Course = '$course'";
$nr = dbcon("fwa",$sqln);
$row_c = $nr->num_rows;

return $row_c;


}

function callNumberOfCampuses($course){
$sqlnc = "SELECT count(Campus) FROM `registeration` WHERE Course='$course' group by campus";

$nrc = dbcon("fwa",$sqlnc);
$row_cc = $nrc->num_rows;

return $row_cc;


}

function findStart($slot){
  $sql = "select * from examsession where slot = '$slot'";
  $results = dbcon("fwa",$sql);
  $rowS = $results->fetch_assoc();
  return ($rowS['Start']);

}


function findEnd($slot,$dur){
  $sql = "select * from examsession where slot = '$slot'";
  $results = dbcon("fwa",$sql);
  $rowS = $results->fetch_assoc();
  $dd = date_parse($rowS['Start']);
  $minutes = $dd['hour']*60 + $dd['minute'];
  $endMinutes = $minutes + $dur;
  return (hour_min($endMinutes));
}


function findDateOnly($slot){
  $sql = "select * from examsession where slot = '$slot'";
  $results = dbcon("fwa",$sql);
  $rowS = $results->fetch_assoc();
  return ($rowS['Date']);

}


function findExamDate($slot){
  $sql = "select * from examsession where slot = '$slot'";
  $results = dbcon("fwa",$sql);
  $rowS = $results->fetch_assoc();
  if($rowS['Start']==8)
    $dd = "08";
    else
    $dd = $rowS['Start'];
  return ($rowS['Date']);

}

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

function NoConf($course,$day){
  
  $sqlInt = "select StudentId from registeration where day = '$day1' or day = '$day2' group by StudentId";
  $rsT = dbcon("fwa",$sqlInt);
  $rowGroupped= $rsT->num_rows;
  $sqlInt = "select StudentId from registeration where day = '$day1' or day = '$day2'";
  $rsT2 = dbcon("fwa",$sqlInt);
  $rowTotal= $rsT2->num_rows;
  return($rowTotal-$rowGroupped);


}

function hour_min($minutes){// Total
   if($minutes <= 0) return '00 Hours 00 Minutes';
else    
   return sprintf("%02d",floor($minutes / 60)).':'.sprintf("%02d",str_pad(($minutes % 60), 2, "0", STR_PAD_LEFT));
}

?>