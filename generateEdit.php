<?php

function createEdit($loop,$database){

mysql_data_seek($loop, 0);

while($table = mysql_fetch_array($loop))
{

    
$fname = "source/" . $table[0] . "FormEdit" . ".php";
$myfile = fopen($fname, "w") or die("Unable to open file!");



$target = $table[0] . "Edit.php";

$i = 0; //row counter
    $row = mysql_query("SHOW columns FROM " . $table[0])
    or die ('cannot select table fields');

$col = mysql_fetch_array($row);

mysql_data_seek($row, 0);

$getRecord = "
<?php\n
include('dbconnect.php');\n
require_once('header.php');\n
\$id = \$_GET['id'];

\$sql = \"select * from $table[0] where $col[0]='\$id'\";\n
\$result = dbcon('$database',\$sql);\n
if (\$result->num_rows > 0) {\n
  \$row = \$result->fetch_assoc();\n
  ?>\n
";

fwrite($myfile,$getRecord);

fwrite($myfile,"<div class='form-group'>\n");


fwrite($myfile,"<form action='$target' method='post'>\n");

// Create Inset data file
$fnameInsert = "source/" . $table[0] . "Edit" . ".php";
$myfile2 = fopen($fnameInsert, "w") or die("Unable to open file!");
fwrite($myfile2,"<?php\n");
$php_hader = "require_once('header.php');\n
include('dbconnect.php'); \n" . "if(isset(" . "$" . "_POST['submit'])){\n
";
fwrite($myfile2,$php_hader);
$fields = "$" . "sql = \"Update $table[0] Set ";
$values = "(";


    

    while ($col = mysql_fetch_array($row))
    {

       $col2 = "\$row['$col[0]']";
    

    if ($i  == 0){
       $primerykey = $col[0];
    }
                      
            
            

        fwrite($myfile,"<input class='form-control' type='text' name='$col[0]' value=\"<?php echo $col2; ?>\">\n");
        
        
      
        
      

//Insert data file

$var = "$" . $col[0] . " = $" . "_POST['$col[0]']" . ";" . "\n";
fwrite($myfile2,$var);
if($i !=0){

         
         fwrite($myfile2,"\$v" . "$col[0] = mysql_real_escape_string(\$$col[0]);\n");
         $fields = $fields . " " . $col[0] . "='"  . "\$v" . $col[0] . "',";

        }
        

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


        fwrite($myfile,"<input class='btn btn-primary' type='submit' name='submit' value='Update'>\n");   
        fwrite($myfile,"</div>\n");   
        fwrite($myfile,"<?php\n"); 
        fwrite($myfile,"}\n"); 
       fwrite($myfile,"?>\n"); 
         

//$result = dbcon("sis",$sql);

//header('Location: main.php');

$loc = $table[0] . 'List.php';

$sql2 = substr($fields, 0, -1) . " where $primerykey=". "$" . $primerykey ." \";\n";
        fwrite($myfile2,$sql2); 
        
$ex = "\$result = dbcon('$database',\$sql);\n

header('Location:  $loc');\n";
fwrite($myfile2,$ex); 

        fwrite($myfile2,"}\n");  
        fwrite($myfile2,"?>");  
    echo "</table>";

echo "Generated  " . $table[0] . "EditForm.php<br>";
echo "Generated  " . $table[0] . "Edit.php<br>";

    fclose($myfile);

    fclose($myfile2);

} //end table loop


return;

}

//New function




?>
