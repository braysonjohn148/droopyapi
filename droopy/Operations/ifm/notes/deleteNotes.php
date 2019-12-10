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
           
           if($statement->execute()){
            $response["result"] = "success";
            $response["message"] = "Posted Successfully !";
            echo json_encode($response);
           }else{
           
           
           $error= $query->errorInfo();
            echo $error[2];       
            $response["result"] = "error";
            $response["message"] = "Ops! an error occured";
            echo json_encode($response);
           }
       
    }else{
    echo "error";
    }
?>
