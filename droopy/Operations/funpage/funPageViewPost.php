<?php
// include database and object files
include_once '../../DatabaseConnection/databaseconnection.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));

    if($data != null){

        $postID = $data -> postID;
        $viewerID = $data -> viewerID;
}else{
    echo "error";
}

   $sql = "SELECT * FROM funpagepostviews WHERE postID = '$postID' AND  userID = '$viewerID'";
   $statement = $db->prepare($sql);  $statement->execute();  
   $total_rows = $statement->rowCount();

   if($total_rows < 1){
    $sql = 'INSERT INTO funpagepostviews SET postID =:postID, userID =:userID';

    $query = $db ->prepare($sql);
    $query->execute(array(':postID' => $postID, ':userID' => $viewerID));
   }

   if ($query) {
    $response["result"] = "success";
    $response["message"] = "Viewed Successfully !";
    echo json_encode($response);
 

}