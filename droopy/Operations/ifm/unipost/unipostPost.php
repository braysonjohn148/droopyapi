<?php
// include database and object files
include_once '../../../DatabaseConnection/databaseconnection.php';

 
// get database connection
$database = new Database();
$db = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $data = json_decode(file_get_contents("php://input"));

    if($data != null){

        $message = $data -> message;
        $posterID = $data -> posterID;
        $timestamp = $data -> timestamp;
        $url = $data -> url;
        $document = $data -> document;
       
        

        $sql = 'INSERT INTO unipost SET posterID =:posterID,
            timestamp =:timestamp, url =:url, document =:document, message =:message';

        $query = $db ->prepare($sql);
        $query->execute(array(':posterID' => $posterID, ':timestamp' => $timestamp, ':url' => $url, ':document' => $document, 
        ':message' => $message));
//$query->execute()
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
