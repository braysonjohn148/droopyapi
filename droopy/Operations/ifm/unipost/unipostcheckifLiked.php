<?php
// include database and object files
include_once '../../../DatabaseConnection/databaseconnection.php';

 
// get database connection
$database = new Database();
$db = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));

    if($data != null){

        $postID = $data -> postID;
        $likerID = $data -> likerID;
}else{
    echo "error";
}

$sql = "SELECT * FROM unipostlikes WHERE postID = '$postID' AND  userID = '$likerID'";
   $statement = $db->prepare($sql);  $statement->execute();  
   $total_rows = $statement->rowCount();

   if($total_rows > 0){
    $response["result"] = "success";
    $response["message"] = 'liked';
    echo json_encode($response);
   }else{
    $response["result"] = "success";
    $response["message"] = 'notliked';
    echo json_encode($response);
   }

   
    
 

?>