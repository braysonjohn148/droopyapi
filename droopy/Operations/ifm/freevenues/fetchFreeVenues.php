<?php
// include database and object files
include_once '../../../DatabaseConnection/databaseconnection.php';

 
// get database connection
$database = new Database();
$db = $database->getConnection();


$sql = "SELECT * FROM ifmfreevenues";
$statement = $db->prepare($sql);  $statement->execute(); 

while ($row = $statement->fetch()) {
    $dbdata[] = $row;
}

echo json_encode($dbdata);

?>