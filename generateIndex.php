<?php

function createIndex($loop){

mysql_data_seek($loop, 0);

$fname = "source/index.php";
$myfile = fopen($fname, "w") or die("Unable to open file!");

$head ="

<?php\n
require_once('header.php');\n

echo \"<div class='Container'>\";\n
";

fwrite($myfile,$head);



while($table = mysql_fetch_array($loop))
{

$url = "$table[0]" . "List.php";
$in = "

\$title= ucfirst('$table[0]');

echo \"<a class = 'btn btn-success' href='$url'>\$title</a>\";\n

";

fwrite($myfile,$in);



}


$footer="

echo '</div>';\n

?>\n
<style>\n

.Container{\n

     text-align: center;\n

    }\n
  </style>\n
";
fwrite($myfile,$footer);
echo "Generated index.php<br><hr>End.";
fclose($myfile);
return;
}
?>
