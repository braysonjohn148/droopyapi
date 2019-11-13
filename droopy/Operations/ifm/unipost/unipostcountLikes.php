<?php
// include database and object files
include_once '../../../DatabaseConnection/databaseconnection.php';

 
// get database connection
$database = new Database();
$db = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));

    if($data != null){

        $postID = $data -> postID;
}else{
    echo "error";
}

   $sql = "SELECT * FROM unipostlikes WHERE postID = '$postID'";
   $statement = $db->prepare($sql);  $statement->execute();  
   $total_rows = $statement->rowCount();
  
    $response["result"] = "success";
    $response["number"] = $total_rows;
    echo json_encode($response);

?>