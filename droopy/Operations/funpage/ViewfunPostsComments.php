<?php
// include database and object files
include_once '../../DatabaseConnection/databaseconnection.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));

    if($data != null){

        $postID = $data -> postID;
}else{
    echo "error";
}

   $sql = "SELECT * FROM funpagepostcomments WHERE postID = '$postID'";
   $statement = $db->prepare($sql);  $statement->execute(); 

while ($row = $statement->fetch()) {
    $dbdata[] = $row;
}
  
  echo json_encode($dbdata);

?>