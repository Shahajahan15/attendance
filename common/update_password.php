<?php
	include "header.php";

	$sql = "SELECT * FROM users
				WHERE id = '".$_SESSION['user']['id']."'
				AND password = '".md5($_POST['password'])."'
				AND status = 1";
	$result = mysqli_query($conn, $sql);

	if($result){
		if(mysqli_num_rows($result) > 0){
			
			if($_POST['new_password'] == $_POST['con_password']){

				$condition = array('field_name' => 'id', 'condition' => 'equal', 'field_value' => $_SESSION['user']['id']);
				$result = updateRowWithOneCondition($conn, 'users', array('password'), array(md5($_POST['new_password'])), $condition);

				if($result == 1){
					$_SESSION['success'] = "Password updated successfully";
					goToError($_POST['redirect_url']);
				}else{
					$_SESSION['error'] = "Failed to update password";
					goToError($_POST['redirect_url']);
				}

			}else{
				$_SESSION['error'] = "New password & Confirm password mismatach.";
				goToError($_POST['redirect_url']);
			}

		}else{
			$_SESSION['error'] = "Current password is wrong.";
			goToError($_POST['redirect_url']);
		}
	}else{
		$_SESSION['error'] = "Failed to update password.";
		goToError($_POST['redirect_url']);
	}