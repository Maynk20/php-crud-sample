<?php
require_once dirname(__DIR__) . "/db.php";

$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0 ;

$sqlDelete = "DELETE FROM emp WHERE id = ?"; 
$stmt = $conn->prepare($sqlDelete); 
$stmt->bind_param("i", $id); 
$stmt->execute(); 

//check
if($stmt){
     header("Location: main.php");
}else{
     echo "Shit";
}

?>