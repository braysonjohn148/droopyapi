<?php
// include database and object files
include_once '../../../DatabaseConnection/databaseconnection.php';

 
// get database connection
$database = new Database();
$db = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $data = json_decode(file_get_contents("php://input"));

    if($data != null){

        $subjectname = $data -> subjectname;
        $semister = $data -> semister;
        $program = $data -> program;
        $university = $data -> university;
        $year = $data -> year; 
       
        

        $sql = 'INSERT INTO programnotesdetails SET subjectname =:subjectname,
            semister =:semister, program =:program, university =:university, year =:year';

        $query = $db ->prepare($sql);
        $query->execute(array(':subjectname' => $subjectname, ':semister' => $semister, ':program' => $program, ':university' => $university, 
        ':year' => $year));

        if ($query) {
            $response["result"] = "success";
            $response["message"] = "Posted Successfully !";
            echo json_encode($response);
         
    
        } else {
            $response["result"] = "error";
            $response["message"] = "Ops..! An error occured, please try again.";
            echo json_encode($response);
    
        }


      

    }else{
        print('No Data');
    }

}
 


?>