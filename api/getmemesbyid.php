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

    /*============ Get Post Data ===========*/
    $json_str = file_get_contents('php://input');

    $json_obj = json_decode($json_str);

    $userId = $json_obj->id;

    /*============ Send Data ===========*/
    $sql = "SELECT * FROM meme WHERE user_id=".$userId;
    //Check if sucess
    $q = mysqli_query($conn,$sql);
    $rows = array();
    while($r = mysqli_fetch_assoc($q)) {
        $rows[] = $r;
    }
    echo json_encode($rows);

    header('Content-Type: application/json');

    //Close Connection
    mysqli_close($conn);


}

?>