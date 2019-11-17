<?php
// include database and object files
include_once '../../../DatabaseConnection/databaseconnection.php';

 
// get database connection
$database = new Database();
$db = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $data = json_decode(file_get_contents("php://input"));

    if($data != null){

        $sellerID = $data -> sellerID;
        $name = $data -> name;
        $price = $data -> price;
        $description = $data -> description;
        $url = $data -> url;
        $points = $data -> points;
        $category = $data -> category;   
       
        

        $sql = 'INSERT INTO unimall SET sellerID =:sellerID,
            name =:name, price =:price, description =:description, url =:url, points =:points, category =:category';

        $query = $db ->prepare($sql);
        $query->execute(array(':sellerID' => $sellerID, ':name' => $name, ':price' => $price, ':description' => $description, 
        ':url' => $url, ':points' => $points, ':category' => $category));

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
