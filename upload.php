<?php

session_start();

$id = "";

if(isset($_SESSION['id']))
{
	$id = $_SESSION['id'];
}
else
{
	$id = uniqid('',true);
}

if(isset($_POST['submit']))
{
	$file = $_FILES['file'];
	
	$fileName = $file['name'];
	$fileTmpName = $file['tmp_name'];
	$fileSize = $file['size'];
	$fileError = $file['error'];

	$fileExt = explode('.', $fileName);
	$fileActualExt = strtolower(end($fileExt));

	$allowed = array('jpg', 'jpeg', 'png', 'bmp');

	if(in_array($fileActualExt, $allowed))
	{
		if($fileError === 0)
		{
			if($fileSize < 20000000)
			{
				$fileNameNew = 'profile'.$id.".".$fileActualExt;
				$fileDest = "uploads/".$fileNameNew;
				move_uploaded_file($fileTmpName, $fileDest);
				echo "<script>alert('File Uploaded Successfully');window.open('upload.html','_self');</script>";
			}
			else
			{
				echo "<script>alert('File Size Out Of Bound');window.open('upload.html','_self');</script>";
			}
		}
	}
	else
	{
		echo "<script>alert('File Not Supported');window.open('upload.html','_self');</script>";
	}
}

?>