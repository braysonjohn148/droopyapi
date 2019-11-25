<?php
// include database and object files
include_once '../../DatabaseConnection/databaseconnection.php';

 
// get database connection
$database = new Database();
$db = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $data = json_decode(file_get_contents("php://input"));

    if($data != null){
        
        $messageid = $data -> messageid;
        $timestamp = $data -> timestamp;
        $servertimestamp = $data -> servertimestamp;
        

        $sql = "UPDATE chatwith SET timestamp = '$timestamp', servertimestamp = '$servertimestamp'  WHERE messageid = '$messageid'";
        $statement = $db->prepare($sql);  
        $statement->execute();

        $error= $statement->errorInfo();
        echo $error[2];

        if ($statement) {
            $response["result"] = "success";
            $response["message"] = "updated succesfully.";
            echo json_encode($response);
    
        } else {

         

            $response["result"] = "error";
            $response["message"] = "Ops..! An error occured, please try again.";
            echo json_encode($response);
    
        }


      

    }else{
        echo 'No Data';
    }

}
 


?>