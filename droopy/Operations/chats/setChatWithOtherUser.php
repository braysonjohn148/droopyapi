<?php
// include database and object files
include_once '../../DatabaseConnection/databaseconnection.php';

 
// get database connection
$database = new Database();
$db = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $data = json_decode(file_get_contents("php://input"));

    if($data != null){
        
        $userID = $data -> userID;
        $otherUserID = $data -> otherUserID;
        $messageid = $data -> messageid;
        $timestamp = $data -> timestamp;
        $servertimestamp = $data -> servertimestamp;
        

        $sql = 'INSERT INTO chatwith SET userID =:userID,
            otherUserID =:otherUserID, messageid =:messageid, timestamp =:timestamp, servertimestamp =:servertimestamp';

        $query = $db ->prepare($sql);
        $query->execute(array(':userID' => $userID, ':otherUserID' => $otherUserID, ':messageid' => $messageid, ':timestamp' => $timestamp, 
        ':servertimestamp' => $servertimestamp));

        if ($query) {
            $response["result"] = "success";
            $response["message"] = "Message sent succussfully";
            echo json_encode($response);
         
    
        } else {

          //  or die(print_r($query->errorInfo(), true));

            if(! empty( $query->error ) ){
                echo $query->error;  // <- this is not a function call error()
             }

            //  $error= $query->errorInfo();
            // echo $error[2];

            $response["result"] = "error";
            $response["message"] = "Ops..! An error occured, please try again.";
            echo json_encode($response);
    
        }


      

    }else{
        echo 'No Data';
    }

}
 


?>