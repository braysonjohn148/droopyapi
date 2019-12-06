<?php
// include database and object files
include_once '../../DatabaseConnection/databaseconnection.php';

 
// get database connection
$database = new Database();
$db = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));

    if($data != null){

        $id = $data -> id;
        $subjectname = $data -> subjectname;
        $semister = $data -> semister;
        $year = $data -> year;
     
     echo $id;
     echo $subjectname;
     echo $semister;
     echo $year;

}else{
    echo "error";
}

$sql = "UPDATE programnotesdetails SET subjectname = '$subjectname',  semister = '$semister', year = '$year' WHERE id = '$id'";
$statement = $db->prepare($sql);  $statement->execute();


$response["result"] = "success";
$response["message"] = "Subject updated succesfully.";
echo json_encode($response);
?>
