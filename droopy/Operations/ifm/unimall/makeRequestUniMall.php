<?php
// include database and object files
include_once '../../../DatabaseConnection/databaseconnection.php';

 
// get database connection
$database = new Database();
$db = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $data = json_decode(file_get_contents("php://input"));

    if($data != null){
        
        $requesterID = $data -> requesterID;
        $sellerID = $data -> sellerID;
        $realtime = $data -> realtime;
        $roomName = $data -> roomName;
        $amount = $data -> amount;
        $itemID = $data -> itemID; 
        

        $sql = 'INSERT INTO requestorders SET requesterID =:requesterID,
            sellerID =:sellerID, realtime =:realtime, roomName =:roomName, amount =:amount, itemID =:itemID';

        $query = $db ->prepare($sql);
        $query->execute(array(':requesterID' => $requesterID, ':sellerID' => $sellerID, ':realtime' => $realtime, ':roomName' => $roomName, 
        ':amount' => $amount, ':itemID' => $itemID));

        if ($query) {
            $response["result"] = "success";
            $response["message"] = "Ordered Successfully please wait while we give you feedback!";
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
