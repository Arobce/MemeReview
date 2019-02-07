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

    $email = $json_obj->email;
    $password = $json_obj->password;

    /*============ Check if records exists ===========*/
    $sql = "SELECT name,email FROM users WHERE email='".$email."'AND password='".$password."';";
    echo($sql);
    $q = mysqli_query($conn,$sql);
    //Check if sucess
    if($q){

        if($row=mysqli_fetch_row($q)){

            $responseArray = array('responseCode'=>'200',
            'name'=>$row[0],
            'email'=>$row[1]);
        
        }else{
            $responseArray = array('responseCode'=>'404','message'=>'Record not found');
        }

    }else{
    
        $responseArray = array('responseCode'=>'500','message'=>mysqli_error($conn));
        
    
    }
    header('Content-Type: application/json');
    echo json_encode($responseArray);

    //Close Connection
    mysqli_close($conn);


}

?>