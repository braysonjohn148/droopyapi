<?php
// include database and object files
include_once '../../../DatabaseConnection/databaseconnection.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
$data = json_decode(file_get_contents("php://input"));
    if($data != null){
        $notesID = $data -> notesID;
       $topic = $data -> topic;


      $sql = "UPDATE notes SET notesID = '$notesID - Deleted' WHERE notesID = '$notesID' AND topic = '$topic'";
      $statement = $db->prepare($sql);  $statement->execute();
      $response["result"] = "success";
      $response["message"] = "Notes Deleted succesfully. To refresh reOpen this page";
      echo json_encode($response);
       
    }else{
    echo "error";
    }
?>
