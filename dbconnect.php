

<?php

global $conn;


function dbcon($db,$sql){

$conn = new mysqli("localhost", "root", "", $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$result = $conn->query($sql);

$conn->close();

return ($result);

}


?>


