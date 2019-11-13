<?php
// include database and object files
include_once '../DatabaseConnection/databaseconnection.php';

 
// get database connection
$database = new Database();
$db = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $data = json_decode(file_get_contents("php://input"));

    if($data != null){
        
        $name = $data -> name;
        $description = $data -> description;
        

        $sql = 'INSERT INTO ifmPrograms SET name =:name,  description =:description';

        $query = $db ->prepare($sql);
        $query->execute(array(':name' => $name, ':description' => $description));

        if ($query->execute()) {
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