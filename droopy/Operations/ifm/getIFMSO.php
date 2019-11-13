<?php
// include database and object files
include_once '../../DatabaseConnection/databaseconnection.php';

 
// get database connection
$database = new Database();
$db = $database->getConnection();


    $stmt = $db->query("SELECT * FROM users WHERE Verification = 'minister'");
while ($row = $stmt->fetch()) {
    $dbdata[] = $row;
}
  
  echo json_encode($dbdata);





?>