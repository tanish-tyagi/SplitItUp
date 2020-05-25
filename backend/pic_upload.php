<?php 

if($_FILES['picFile']['error'] === 0){

	$file = $_FILES['picFile'];

	$fileName = $file['name'];
	$fileTmpName = $file['tmp_name'];
	$fileSize = $file['size'];
	$fileError = $file['error'];

	$fileExt = explode('.', $fileName);
	$fileActualExt = strtolower(end($fileExt));

	$allowed = array('jpg', 'jpeg', 'png', 'bmp', '');

	if(! in_array($fileActualExt, $allowed)){
		array_push($errors, "This Type of File Is Not Allowed");
	}
	elseif ($fileError != 0) {
		array_push($errors, "Error Uploading File");
	}
	elseif ($fileSize > 10000000) {
		array_push($errors, "File Size Is Bigger Than 10MB");
	}

}

?>