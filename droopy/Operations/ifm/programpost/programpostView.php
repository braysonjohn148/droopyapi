<?php
    // include database and object files
include_once '../../../DatabaseConnection/databaseconnection.php';

 
// get database connection
$database = new Database();
$db = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    $data = json_decode(file_get_contents("php://input"));

   if($data != null){

        $program = $data -> program;

    $stmt = $db->query("SELECT * FROM programposts WHERE program = '$program'  ORDER BY id DESC");

while ($row = $stmt->fetch()) {
    $dbdata[] = $row;
}
  
  echo json_encode($dbdata);

  }
}


?>