<?php
// include database and object files
include_once '../../../DatabaseConnection/databaseconnection.php';

 
// get database connection
$database = new Database();
$db = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));

    if($data != null){

        $program = $data -> program;
        $year = $data -> year;
        $university = $data -> university;
        $semister = $data -> semister;

        if($semister == 'all'){
            $sql = "SELECT * FROM programnotesdetails WHERE program = '$program' AND year = '$year' AND university = '$university'";
            $statement = $db->prepare($sql);  $statement->execute(); 
         
            while ($row = $statement->fetch()) {
               $dbdata[] = $row;
            }
           
           echo json_encode($dbdata);
        }else{
            $sql = "SELECT * FROM programnotesdetails WHERE program = '$program' AND year = '$year' AND university = '$university' AND semister = '$semister'";
            $statement = $db->prepare($sql);  $statement->execute(); 
         
            while ($row = $statement->fetch()) {
               $dbdata[] = $row;
            }
           
           echo json_encode($dbdata);
    
        }

    }else{
    echo "error";
    }


?>