<?php
// include database and object files
include_once '../DatabaseConnection/databaseconnection.php';

 
// get database connection
$database = new Database();
$db = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $data = json_decode(file_get_contents("php://input"));

    if($data != null){

        $UserID = $data -> UserID;
        $University = $data -> University;
        $Program = $data -> Program;
        $Year = $data -> Year;

        // echo $UserID;
        // echo $University;
        // echo $Program;
        // echo $Year;

        $sql = "UPDATE users SET University =:University, Program =:Program, Year =:Year WHERE UserID = '$UserID'";

        $query = $db ->prepare($sql);
        $query->execute(array(':University' => $University, ':Program' => $Program, ':Year' => $Year))or die(print_r($query->errorInfo(), true));


        if ($query->execute()) {
            $response["result"] = "success";
            $response["message"] = "User Registered Successfully !";
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