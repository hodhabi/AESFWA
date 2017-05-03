<?php

function createDbConnect($loop,$database){


$fname = "source/dbconnect.php";

$myfile = fopen($fname, "w") or die("Unable to open file!");



$dbc = "

<?php

global \$conn;


function dbcon(\$db,\$sql){

\$conn = new mysqli(\"localhost\", \"root\", \"\", \$db);

// Check connection
if (\$conn->connect_error) {
    die(\"Connection failed: \" . \$conn->connect_error);
} 

\$result = \$conn->query(\$sql);

\$conn->close();

return (\$result);

}


?>

\n";

fwrite($myfile,$dbc);

echo "Generated dbconnect.php<br>";
fclose($myfile);

return;

}

//New function




?>
