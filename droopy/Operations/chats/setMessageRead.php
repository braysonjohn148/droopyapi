<?php
// include database and object files
include_once '../../DatabaseConnection/databaseconnection.php';

 
// get database connection
$database = new Database();
$db = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));

    if($data != null){

        $messageID = $data -> messageID;
        $myID = $data -> myID;

}else{
    echo "error";
}

$sql = "UPDATE inbox SET isread = 1 WHERE messageID = '$messageID' AND idTo = '$myID' AND isread = 0";
$statement = $db->prepare($sql);  $statement->execute();


$response["result"] = "success";
//$response["message"] = "$updateName updated succesfully.";
echo json_encode($response);
?>