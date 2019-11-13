<?php
// include database and object files
include_once '../../../DatabaseConnection/databaseconnection.php';

 
// get database connection
$database = new Database();
$db = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $data = json_decode(file_get_contents("php://input"));

    if($data != null){

        $userID = $data -> userID;
        $postID = $data -> postID;
        $timestamp = $data -> timestamp;
        $comment = $data -> comment;

        $sql = 'INSERT INTO unipostcomments SET userID =:userID,
            postID =:postID, timestamp =:timestamp, comment =:comment';

        $query = $db ->prepare($sql);
        $query->execute(array(':userID' => $userID, ':postID' => $postID, ':timestamp' => $timestamp, ':comment' => $comment));

        if ($query) {
            $response["result"] = "success";
            $response["message"] = "Commented Successfully !";
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