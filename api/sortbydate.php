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


    /*============ Send Data ===========*/
    $sql = "SELECT * FROM meme ORDER BY date_created DESC;";
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