<?php
//  header('Content-type : bitmap; charset=utf-8');
 
 if(isset($_POST["encoded_string"])){
 	
	$encoded_string = $_POST["encoded_string"];
	$meme_name =isset($_POST["meme_name"]) ? $_POST["meme_name"] : "";
	$meme_url = $_POST["meme_url"];
	$type = isset($_POST["type"]) ? $_POST["type"] : "";
	$userId = isset($_POST["userId"]) ? $_POST["userId"] : "";
	
	$decoded_string = base64_decode($encoded_string);
	
	$path = 'images/'.$meme_url;
	
	$file = fopen($path, 'wb');
	
	$is_written = fwrite($file, $decoded_string);
	fclose($file);
	
	if($is_written > 0) {
		
		if($type=="meme"){
			$connection = mysqli_connect('localhost', 'root', '','meme_review');
			$query = "INSERT INTO meme(name,user_id,url) values('$meme_name','$userId','$meme_url');";
			
			$result = mysqli_query($connection, $query) ;
			
			if($result){
				echo "success";
			}else{
				echo "failed";
			}
			
			mysqli_close($connection);

		}

		
	}
 }
?>