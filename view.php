<?php
include('config.php');

// $sel = "SELECT id,name,email,password,image FROM register";
$sql = "SELECT * FROM  register";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
   
  while($row = $result->fetch_assoc()) 
  {
	echo "
	id: " . $row["id"]. " <br> 
	Name: " . $row["name"]. "<br>
	Email-id:". $row["email"] ."<br>
	Password:". $row["password"] ."<br>
	image:<img src='".$row['img']."'height = '100px' width = '100px'>
	<br>";
	
    	}

 } 
else
	 {

    echo "No  details Found";
	
	}


?>


