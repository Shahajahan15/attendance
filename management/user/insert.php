<?php
	include "../../common/header.php";

	$fields = array('name', 'msisdn', 'email', 'password', 'role_id');
	$values = array($_POST['name'], $_POST['msisdn'], $_POST['email'], md5($_POST['password']), $_POST['role_id']);

	if(isset($_FILES['image']["name"]) && $_FILES['image']["name"] != ''){
		$file=$_FILES['image']['name'];
		$expfile=explode('.',$file);
			$fileexptype=$expfile[1];
			$file_name = time().rand(1000,9999).'.'.$fileexptype;
		$filepath='../../'.$photo_upload_dir.$file_name;
		move_uploaded_file($_FILES["image"]["tmp_name"],$filepath);

		$image = $base_url."/".$photo_upload_dir.$file_name;
	}else{
		$image = $base_url."/".$photo_upload_dir.'no_image.png';
	}

	$fields[] = 'image';
	$values[] = $image;

	$new_id = insertNew($conn, "users", $fields, $values);

	if($new_id){
		$_SESSION['success'] = "User created successfully";
		goToError($base_url."/management/user/manage.php");
	}else{
		$_SESSION['error'] = "Failed to insert user";
		goToError($base_url."/management/user/add.php");
	}