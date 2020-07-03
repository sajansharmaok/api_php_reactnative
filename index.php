<?php
if (isset($_POST['btnsubmit'])) {
    $file_tmp= $_FILES['mg']['tmp_name'];
    $type = pathinfo($file_tmp, PATHINFO_EXTENSION);
    $data = file_get_contents($file_tmp);
    $base64 = base64_encode($data);
	$post = [
	    'request' => '1',
		'name' => $_POST['name'],
		'email' => $_POST['email'],
		'pass' => $_POST['password'],
		'img' => $base64,	
	];
	$ch = curl_init('http://localhost:8081/reactnativeapi/axios.php');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	$response = curl_exec($ch);
	curl_close($ch);
	$response=json_decode($response);
	print_r($response);
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form action="" enctype="multipart/form-data" method="POST">
<input type="text" name="name">
<input type="text" name="email">
<input type="text" name="password">
<input type="file" name="mg">
<input type="submit" value="submit" name="btnsubmit">
<a href="view.php">view</a>
</form>
</body>
</html>
