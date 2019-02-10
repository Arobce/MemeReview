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

    $memeId = $json_obj->memeId;
    $action = $json_obj->action;

    /*============ Like/Dislike ===========*/
    if($action=='like'){
        $sql = "UPDATE meme SET likes=likes+1 where meme_id =".$memeId.";";
    }else{
        $sql = "UPDATE meme SET dislikes=dislikes+1 where meme_id =".$memeId.";";
    }
    //Check if sucess
    if(mysqli_query($conn,$sql)){

        if($action=='like'){
            $responseArray = array('responseCode'=>'200','message'=>'Liked sucessfully');
        }else{
            $responseArray = array('responseCode'=>'200','message'=>'Disliked sucessfully');
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