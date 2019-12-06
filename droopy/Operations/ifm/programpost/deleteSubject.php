<?php
// include database and object files
include_once '../../../DatabaseConnection/databaseconnection.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
$data = json_decode(file_get_contents("php://input"));
    if($data != null){
        $id = $data -> id;
        $year = $data -> year;
}else{
    echo "error";
}
$sql = "UPDATE programnotesdetails SET year = '$year - Deleted' WHERE id = '$id'";
$statement = $db->prepare($sql);  $statement->execute();
$response["result"] = "success";
$response["message"] = "Subject Deleted succesfully.";
echo json_encode($response);
?>
