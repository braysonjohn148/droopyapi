<?php
// include database and object files
include_once 'DatabaseConnection/databaseconnection.php';

 
// get database connection
$database = new Database();
$db = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));

    if($data != null){

        $file = $data -> file;
        $filetype = $data -> filetype;
        $extension = $data -> extension;


}else{
    echo "error";
}

    // Get extension
   // $encodedImgString = explode(',', $file, 2)[1];
// $decodedImgString = base64_decode($file);
// $info = getimagesizefromstring($decodedImgString);

// echo $info['mime'];

$date = date('YmdHis');

$ImagePath = "uploads/$filetype/$date.$extension";

//$ServerURL = "/droopy/$ImagePath";

file_put_contents($ImagePath,base64_decode($file));

$response["result"] = "success";
$response["message"] = "http://167.172.224.251/droopyapi/droopy/$ImagePath";
echo json_encode($response);
?>
