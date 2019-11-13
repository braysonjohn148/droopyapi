<?php
// include database and object files
include_once '../DatabaseConnection/databaseconnection.php';

 
// get database connection
$database = new Database();
$db = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $data = json_decode(file_get_contents("php://input"));

    if($data != null){

        $UserID = $data -> UserID;
        $FullName = $data -> FullName;
        $UserName = $data -> UserName;
        $Email = $data -> Email;
        $Dp = $data -> Dp;
        $Privacy = $data -> Privacy;
        $Status = $data -> Status;
        $Program = $data -> Program;
        $University = $data -> University;
        $Verification = $data -> Verification;

        $sql = 'INSERT INTO users SET FullName =:FullName,
            UserName =:UserName, Email =:Email, Dp =:Dp, Privacy = :Privacy,
            Status =:Status, Program =:Program, University =:University, Verification =:Verification, UserID =:UserID';

        $query = $db ->prepare($sql);
        $query->execute(array(':FullName' => $FullName, ':UserName' => $UserName, ':Email' => $Email, ':Dp' => $Dp, ':Privacy' => $Privacy,
        ':Status' => $Status, ':Program' => $Program, ':University' => $University, ':Verification' => $Verification, ':UserID' => $UserID));

        if ($query) {
            $response["result"] = "success";
            $response["message"] = "User Registered Successfully !";
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