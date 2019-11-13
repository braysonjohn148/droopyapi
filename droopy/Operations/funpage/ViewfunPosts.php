<?php
// include database and object files
include_once '../../DatabaseConnection/databaseconnection.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'GET'){

   // $dbdata[] = array();

    $stmt = $db->query("SELECT * FROM funpagePosts ORDER BY id DESC");
// $user = $stmt->fetch();
while ($row = $stmt->fetch()) {
    $dbdata[] = $row;
}
  
  echo json_encode($dbdata);


}


?>