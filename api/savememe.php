<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    
    /*============ Connection ===========*/
    $serverName = 'localhost';
    $dbName = 'meme_review';
    $username = 'root';
    $password = '';
    $responseArray = [];


    //Create Connection
    $conn = mysqli_connect($serverName,$username,$password,$dbName);

    //Check connection
    if(!$conn){

        $responseArray = array('responseCode'=>'500','message'=>mysqli_connect_error());
        echo json_encode($responseArray);
        die();
        
    
    }

    /*============ Get Data ===========*/
    $json_str = file_get_contents('php://input');

    $json_obj = json_decode($json_str);

    $name = $json_obj->name;
    $userID = $json_obj->userId;
    $url = $json_obj->url;

    /*============ Save Data ===========*/
    $sql = "INSERT INTO meme (name,user_id,url) VALUES('".$name."','".$userID."','".$url."')";
    
    //Check if sucess
    if(mysqli_query($conn,$sql)){

        $responseArray = array('responseCode'=>'200','message'=>'Record added sucessfully');
    
    }else{
    
        $responseArray = array('responseCode'=>'500','message'=>mysqli_error($conn));
        
    
    }
    header('Content-Type: application/json');
    echo json_encode($responseArray);

    //Close Connection
    mysqli_close($conn);


}

?>