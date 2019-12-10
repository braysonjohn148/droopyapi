<?php
// include database and object files
include_once '../../../DatabaseConnection/databaseconnection.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
$data = json_decode(file_get_contents("php://input"));
    if($data != null){
        $notesID = $data -> notesID;
     
            $sql = "UPDATE notes SET notesID = $notesID+' - Deleted' WHERE notesID = '$notesID'";
            $statement = $db->prepare($sql);   
         
       $statement = $db->prepare($sql);  $statement->execute();
     
            $response["result"] = "success";
            $response["message"] = "Posted Successfully !";
            echo json_encode($response);
       
    }else{
    echo "error";
    }
?>
