<?php

function createDelete($loop,$database){

mysql_data_seek($loop, 0);

while($table = mysql_fetch_array($loop))
{


$target = $table[0] . "Edit.php";

$i = 0; //row counter
    $row = mysql_query("SHOW columns FROM " . $table[0])
    or die ('cannot select table fields');

$col = mysql_fetch_array($row);

mysql_data_seek($row, 0);

$getRecord = "
<?php\n
include('dbconnect.php');\n
\$id = \$_GET['id'];

\$sql = \"select * from $table[0] where $col[0]='\$id'\";\n
\$result = dbcon('$database',\$sql);\n
if (\$result->num_rows > 0) {\n
  \$row = \$result->fetch_assoc();\n
  ?>\n
";


// Create Inset data file
$fnameInsert = "source/" . $table[0] . "Delete" . ".php";
$myfile2 = fopen($fnameInsert, "w") or die("Unable to open file!");
fwrite($myfile2,"<?php\n");
$php_hader = "require_once('header.php');\n
include('dbconnect.php');\n
";
fwrite($myfile2,$php_hader);
$fields = "$" . "sql = \"Delete from $table[0] ";
$values = "(";


    

    while ($col = mysql_fetch_array($row))
    {

       $col2 = "\$row['$col[0]']";
    

    if ($i  == 0){
       $primerykey = $col[0];
    }
                      

//Insert data file
if ($i==0)
{
$var = "$" . $col[0] . " = $" . "_GET['$col[0]']" . ";" . "\n";
fwrite($myfile2,$var);
}

        
      

        $i++;
    } //end row loop



$loc = $table[0] . 'List.php';

$sql2 = $fields . " where $primerykey=". "$" . $primerykey ." \";\n";
        fwrite($myfile2,$sql2); 
        
$ex = "\$result = dbcon('$database',\$sql);\n

header('Location:  $loc');\n";
fwrite($myfile2,$ex); 

        
        fwrite($myfile2,"?>");  
    echo "</table>";

   echo "Generated  " . $table[0] . "Delete.php<br>";

    fclose($myfile2);

} //end table loop


return;

}

//New function




?>
