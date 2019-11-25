<?php
// include database and object files
include_once '../../DatabaseConnection/databaseconnection.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));

    if($data != null){

        $otherUserID = $data -> otherUserID;
        $userID = $data -> userID;

    }else{
        echo "error";
    }

   $sql ="SELECT * FROM chatwith WHERE userID = '$userID' AND otherUserID = '$otherUserID'";
   $statement = $db->prepare($sql);  $statement->execute();

   while ($row = $statement->fetch()) {
    $response["messageID"] = $row['messageid'];
    
    }

   $total_rows = $statement->rowCount();
    
    // if($total_rows > 0){
    //    $response["messageID"] = "success";
    // }
    $response["result"] = "success";
    $response["number"] = $total_rows;
    echo json_encode($response);

?>
