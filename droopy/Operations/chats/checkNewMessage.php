<?php
// include database and object files
include_once '../../DatabaseConnection/databaseconnection.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));

    if($data != null){

        $messageID = $data -> messageID;
        $userID = $data -> userID;

    }else{
        echo "error";
    }

   $sql ="SELECT * FROM inbox WHERE idTo = '$userID' AND messageID = '$messageID' AND isread = 0";
   $statement = $db->prepare($sql);  $statement->execute();

//    while ($row = $statement->fetch()) {
//     $response["messageID"] = $row['messageID'];
    
//     }

   $total_rows = $statement->rowCount();
    

    $response["result"] = "success";
    $response["number"] = $total_rows;
    echo json_encode($response);

?>
