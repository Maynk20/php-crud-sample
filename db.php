<?php
//Configure
$db_server = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "";//Enter Your Database Name

//Make conn
$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

//check connection
if (!$conn) {
     die("Connection Failed!" . mysqli_connect_error());
}
?>