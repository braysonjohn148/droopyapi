<?php
// include database and object files
include_once '../../DatabaseConnection/databaseconnection.php';

 
// get database connection
$database = new Database();
$db = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $data = json_decode(file_get_contents("php://input"));

    if($data != null){
        
        $idFrom = $data -> idFrom;
        $idTo = $data -> idTo;
        $content = $data -> content;
        $type = $data -> type;
        $isread = $data -> isread;
        $timestamp = $data -> timestamp;
        $messageID = $data -> messageID;

        $sql = 'INSERT INTO inbox SET idFrom =:idFrom,
            idTo =:idTo, content =:content, type =:type, isread =:isread, timestamp =:timestamp, messageID =:messageID';

        $query = $db ->prepare($sql);
        $query->execute(array(':idFrom' => $idFrom, ':idTo' => $idTo, ':content' => $content, ':type' => $type, 
        ':isread' => $isread, ':timestamp' => $timestamp, ':messageID' => $messageID));

        if ($query) {
            $response["result"] = "success";
            $response["message"] = "Message sent succussfully";
            echo json_encode($response);
         
    
        } else {

          //  or die(print_r($query->errorInfo(), true));

            if(! empty( $query->error ) ){
                echo $query->error;  // <- this is not a function call error()
             }

            $response["result"] = "error";
            $response["message"] = "Ops..! An error occured, please try again.";
            echo json_encode($response);
    
        }


      

    }else{
        echo 'No Data';
    }

}
 


?>