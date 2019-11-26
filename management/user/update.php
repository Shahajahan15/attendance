<?php
	include "../../common/header.php";

	if(!isset($_POST['id']) || $_POST['id'] == ""){
	    goToError($base_url."/common/403.php");
	}


	if(isset($_POST['password']) && $_POST['password'] != ""){

		$fields = array('name', 'msisdn', 'email', 'password', 'role_id');
		$values = array($_POST['name'], $_POST['msisdn'], $_POST['email'], md5($_POST['password']), $_POST['role_id']);

	}else{
		
		$fields = array('name', 'msisdn', 'email', 'role_id');
		$values = array($_POST['name'], $_POST['msisdn'], $_POST['email'], $_POST['role_id']);

	}

	$id = $_POST['id'];

	$user_condition = array('field_name' => 'id', 'condition' => 'equal', 'field_value' => $id);
	$user = selectSingleTableWithOneCondition($conn, 'users', $user_condition);
	if(mysqli_num_rows($user) > 0){

		$data = mysqli_fetch_array($user);

		if(isset($_FILES['image']["name"]) && $_FILES['image']["name"] != ''){
			// Delete Previous
			$cur_image = $data['image'];
			$exp_cur_image =explode('/',$cur_image);
			$last_index = count($exp_cur_image) - 1;
			$cur_image_file = $exp_cur_image[$last_index];
			unlink('../../'.$photo_upload_dir.$cur_image_file);

			// Insert New
			$file=$_FILES['image']['name'];
			$expfile=explode('.',$file);
 			$fileexptype=$expfile[1];
 			$file_name = time().$_POST['id'].'.'.$fileexptype;
			$filepath='../../'.$photo_upload_dir.$file_name;
			move_uploaded_file($_FILES["image"]["tmp_name"],$filepath);

			$image = $base_url."/".$photo_upload_dir.$file_name;
		}else{
			$image = $data['image'];
		}

		$fields[] = 'image';
		$values[] = $image;
	    
		$user_condition = array('field_name' => 'id', 'condition' => 'equal', 'field_value' => $id);
		$result = updateRowWithOneCondition($conn, "users", $fields, $values, $user_condition);

		if($result == 1){
			$_SESSION['success'] = "User updated successfully";
			goToError($base_url."/management/user/manage.php");
		}else{
			$_SESSION['error'] = "Failed to update user";
			goToError($base_url."/management/user/edit.php?id=".$id);
		}

	}else{
	    $_SESSION['error'] = "No user found with this ID";
	    goToError($base_url."/management/user/manage.php");
	}