<?php
// include database and object files
include_once '../../DatabaseConnection/databaseconnection.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));

    if($data != null){

        $name = $data -> name;

        
}else{
    echo "error";
}


$sql="SELECT * FROM `users` WHERE `UserName` LIKE :name LIMIT 30;";
$q=$db->prepare($sql);
$q->bindValue(':name','%'.$name.'%');
$q->execute();
while ($r=$q->fetch(PDO::FETCH_ASSOC)) {
    $dbdata[] = $r;
}

//    $sql ="SELECT * FROM users WHERE UserName  LIKE :$name";
//    $statement = $db->prepare($sql); 
//     $statement->execute(); 

// while ($row = $statement->fetch()) {
//     $dbdata[] = $row;
// }
  
  echo json_encode($dbdata);

?>
