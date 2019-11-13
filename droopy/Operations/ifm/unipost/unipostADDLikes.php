<?php
// include database and object files
include_once '../../../DatabaseConnection/databaseconnection.php';

 
// get database connection
$database = new Database();
$db = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));

    if($data != null){

        $UserID = $data -> UserID;
}else{
    echo "error";
}




   // $dbdata[] = array();

    $stmt = $db->query("SELECT * FROM users WHERE UserID = '$UserID'");
while ($row = $stmt->fetch()) {
    $dbdata[] = $row;
}
  
  echo json_encode($dbdata);





?>