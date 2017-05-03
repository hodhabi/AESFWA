<?php

function createHeader($database){


$fname = "source/header.php";
$myfile = fopen($fname, "w") or die("Unable to open file!");

$header = "

<HEAD>
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\n
  <link rel=\"stylesheet\" href=\"http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css\">\n
  <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js\"></script>\n
  <script src=\"http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js\"></script>\n
</HEAD>
<div id='header'>
<h2><?php echo ucfirst('$database'); ?></h2>\n

</div>\n

<style>\n
#header{\n
    text-align:center;\n
    background: gold;\n
    height: 120px;\n
    padding: 5px;\n
}\n
</style>\n

";

fwrite($myfile,$header);
echo "Generated header.php <br>";
fclose($myfile);

return;

}

//New function




?>
