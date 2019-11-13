<?php
// include database and object files
include_once '../../../DatabaseConnection/databaseconnection.php';

 
// get database connection
$database = new Database();
$db = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));

    if($data != null){

        $postID = $data -> postID;
        $posterID = $data -> posterID;
}else{
    echo "error";
}

   $sql = "SELECT * FROM unipost WHERE id = '$postID' AND  posterID = '$posterID'";
   $statement = $db->prepare($sql);  $statement->execute();  
   $total_rows = $statement->rowCount();

   if($total_rows > 0){
    $sqls = "DELETE FROM unipost WHERE id = '$postID' AND  posterID = '$posterID'";
    $statement = $db->prepare($sqls);  $statement->execute();
   }

   if ($statement) {
    $response["result"] = "success";
    $response["message"] = "Post Successfully !";
    echo json_encode($response);
 

}