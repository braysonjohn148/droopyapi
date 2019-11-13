<?php
// include database and object files
include_once '../DatabaseConnection/databaseconnection.php';

 
// get database connection
$database = new Database();
$db = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));

    if($data != null){

        $UserID = $data -> UserID;
        $updateName = $data -> updateName;
        $updateValue = $data -> updateValue;

}else{
    echo "error";
}

$sql = "UPDATE users SET $updateName = '$updateValue' WHERE UserID = '$UserID'";
$statement = $db->prepare($sql);  $statement->execute();


$response["result"] = "success";
$response["message"] = "$updateName updated succesfully.";
echo json_encode($response);
?>