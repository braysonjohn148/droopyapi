<?php
// include database and object files
include_once '../../../DatabaseConnection/databaseconnection.php';

 
// get database connection
$database = new Database();
$db = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $data = json_decode(file_get_contents("php://input"));

    if($data != null){

        $file_url = $data -> file_url;
        $filesize = $data -> filesize;
        $lectureName = $data -> lectureName;
        $topic = $data -> topic;
        $type = $data -> type;
        $notesID = $data -> notesID;
        $posterID = $data -> posterID;
        $timestamp = $data -> timestamp;    
       
        

        $sql = 'INSERT INTO notes SET file_url =:file_url,
            filesize =:filesize, lectureName =:lectureName, topic =:topic, type =:type, notesID =:notesID, posterID =:posterID, timestamp =:timestamp';

        $query = $db ->prepare($sql);
        $query->execute(array(':file_url' => $file_url, ':filesize' => $filesize, ':lectureName' => $lectureName, ':topic' => $topic, 
        ':type' => $type, ':notesID' => $notesID, ':posterID' => $posterID, ':timestamp' => $timestamp));

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