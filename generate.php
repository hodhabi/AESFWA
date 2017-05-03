<?php

function createForm($loop,$database){

mysql_data_seek($loop, 0);

while($table = mysql_fetch_array($loop))
{
 
$fname = "source/" . $table[0] . "Form" . ".php";
$myfile = fopen($fname, "w") or die("Unable to open file!");



$target = $table[0] . "Insert.php";

$include ="
<?php\n
        require_once('header.php');\n ?>

";

fwrite($myfile,$include);
fwrite($myfile,"<div class='form-group'>\n");


fwrite($myfile,"<form action='$target' method='post'>\n");

// Create Inset data file
$fnameInsert = "source/" . $table[0] . "Insert" . ".php";
$myfile2 = fopen($fnameInsert, "w") or die("Unable to open file!");
fwrite($myfile2,"<?php\n");
$php_hader = "require_once('header.php');\n
include('dbconnect.php'); \n" . "if(isset(" . "$" . "_POST['submit'])){\n
";
fwrite($myfile2,$php_hader);
$fields = "$" . "sql = \"Insert Into $table[0] (";
$values = "(";


    $i = 0; //row counter
    $row = mysql_query("SHOW columns FROM " . $table[0])
    or die ('cannot select table fields');

    while ($col = mysql_fetch_array($row))
    {

        if ($col[5] != "auto_increment"){
            
        fwrite($myfile,"<input class='form-control' type='text' name='$col[0]' placeholder='Enter $col[0]'>\n");
        
        $fields = $fields . " " . $col[0] . ",";
        $values = $values . "'$" . $col[0] . "',";
        }
        
      

//Insert data file

$var = "$" . $col[0] . " = $" . "_POST['$col[0]']" . ";" . "\n";
fwrite($myfile2,$var);


        $i++;
    } //end row loop


$head = "<head>
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

</head>\n";



 fwrite($myfile,$head);   


        fwrite($myfile,"<input class='btn btn-primary' type='submit' name='submit' value='Add'>\n");   
        fwrite($myfile,"</div>");   
        

//$result = dbcon("sis",$sql);

//header('Location: main.php');


$sql2 = substr($fields, 0, -1) . ") values " . substr($values, 0, -1) . ")\";\n";
        fwrite($myfile2,$sql2); 

$targetUrl = $table[0] . "list.php";

$ex = "\$result = dbcon('$database',\$sql);\n

header('Location: $targetUrl');\n";
fwrite($myfile2,$ex); 

        fwrite($myfile2,"}\n");  
        fwrite($myfile2,"?>");  
    echo "</table>";

echo "Generated  " . $table[0] . "Form.php<br>";
echo "Generated  " . $table[0] . "Insert.php<br>";
    fclose($myfile);

    fclose($myfile2);

} //end table loop


return;

}

//New function




?>
