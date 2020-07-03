<?php
 include "config.php";
    $data = json_decode(file_get_contents("php://input"));
    $request = 0;
if (isset($_POST['request'])) 
{
    $request = $_POST['request'];
}
else
{
    $request = $data->request;
}
if($request==1) 
{       
        $name = $_POST['name'] ? $_POST['name'] : $data->name;
        $email =$_POST['email'] ? $_POST['email'] : $data->email;
        $pass = $_POST['pass'] ? $_POST['pass'] : $data->pass;
        $img = $_POST['img'] ? $_POST['img'] : $data->image;   
      
        define('UPLOAD_DIR', 'images/');   
        $img = str_replace('data:image/png;base64,', '', $img);   
        $img = str_replace(' ', '+', $img);   
        $datas = base64_decode($img);   
        $file = UPLOAD_DIR . uniqid() . '.jpg';   
        $success = file_put_contents($file, $datas);

        mysqli_query($conn,"INSERT INTO register(name,email,password,img) VALUES('".$name."','".$email."','".$pass."','".$file."')");
        echo "Insert successfully";
}
    if($request==2) 
    {     
        $email = $data->email;   
        $pass = $data->pass;
     $userData=   mysqli_query($conn,"SELECT * from register where email='".$email."'and password='".$pass."'");
        if(mysqli_num_rows($userData) > 0){
            $response = array();
            while($row = mysqli_fetch_assoc($userData)){
                $response[] = $row;
            }
            echo json_encode($response);
        }else{
           echo "no";
        }
        exit;
}     
    // Fetch All records
    if($request == 3){
        $userData = mysqli_query($conn,"select * from register order by id asc");
        $response = array();
        while($row = mysqli_fetch_assoc($userData)){
            $response[] = $row;
        }
        echo json_encode($response);
        exit;
    }
     // Delete record
    if($request == 4)
    {
        $id = $data->id;
        mysqli_query($conn,"DELETE FROM register WHERE id=".$id);

        echo "Delete Successfully";
        exit;
    }
      if($request == 5)
      {
        $id = $data->id;
        $name = $data->name;
        $email = $data->email;
        $pass = $data->pass;
        mysqli_query($conn,"UPDATE register SET name='".$name."',email='".$email."',password='".$pass."' WHERE id=".$id);
        echo "Update Successfully";
        exit;
    }

  


?>
