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

    $id = $json_obj->id;

    /*============ Check if records exists ===========*/
    $sql = "SELECT id,name,email,image_url FROM users WHERE id=".$id;
    $q = mysqli_query($conn,$sql);
    //Check if sucess
    if($q){
        $row=mysqli_fetch_row($q);
        if(isset($row[0])){

            $responseArray = array('responseCode'=>'200',
            'id'=>$row[0],
            'name'=>$row[1],
            'email'=>$row[2],
            'imageUrl'=>$row[3]);
        
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