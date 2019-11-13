<?php
// include database and object files
include_once 'DatabaseConnection/databaseconnection.php';

 
// get database connection
$database = new Database();
$db = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));

    if($data != null){

        $file = $data -> file;

}else{
    echo "error";
}

    // Get extension
   // $encodedImgString = explode(',', $file, 2)[1];
$decodedImgString = base64_decode($file);
$info = getimagesizefromstring($decodedImgString);

echo $info['mime'];

$date = date('YmdHis');

$ImagePath = "uploads/$date.jpg";

//$ServerURL = "/droopy/$ImagePath";

file_put_contents($ImagePath,base64_decode($file));

$response["result"] = "success";
$response["message"] = "http://192.168.6.49/droopy/$ImagePath";
echo json_encode($response);
?>