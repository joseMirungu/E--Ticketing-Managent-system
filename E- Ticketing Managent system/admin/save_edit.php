<?php
include_once("inc/connection.php");
//error reporting. Disable these three lines before deployment.
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

$input = filter_input_array(INPUT_POST);
if ($input['action'] == 'edit') {	
	$updateField='';
	if(isset($input['name'])) {
		$updateField.= "name='".$input['name']."'";
	} else if(isset($input['usertype'])) {
		$updateField.= "usertype='".$input['usertype']."'";
	} else if(isset($input['aos'])) {
		$updateField.= "aos='".$input['aos']."'";
	} 
	else if(isset($input['status'])) {
		$updateField.= "status='".$input['status']."'";
	}

	if($updateField && $input['UserId']) {
		$sqlQuery = "UPDATE users SET $updateField WHERE UserId='" . $input['UserId'] . "'";	
		mysqli_query($conn, $sqlQuery) or die("database error:". mysqli_error($conn));	

	}



	header('Content-type: application/json');
    echo json_encode($input);

}

else if ($input['action'] == 'delete') {	
	
	if($input['UserId']) {
		$sqlQuery = "UPDATE users SET status = 2 WHERE UserId='" . $input['UserId'] . "'";	
		mysqli_query($conn, $sqlQuery) or die("database error:". mysqli_error($conn));		
	}
	header('Content-type: application/json');
    echo json_encode($input);
}

/* if ($input['action'] == 'edit') {	
	$updateField='';
	if(isset($input['name'])) {
		$updateField.= "name='".$input['name']."'";
	} else if(isset($input['gender'])) {
		$updateField.= "gender='".$input['gender']."'";
	} else if(isset($input['address'])) {
		$updateField.= "address='".$input['address']."'";
	} else if(isset($input['Status'])) {
		$updateField.= "Status='".$input['Status']."'";
	}
	if($updateField && $input['id']) {
		$sqlQuery = "UPDATE users SET $updateField WHERE UserId='" . $input['UserId'] . "'";	
		mysqli_query($conn, $sqlQuery) or die("database error:". mysqli_error($conn));		
	}
}

/*if ($input['action'] == 'edit') {   
    $updateField='';
     alert("Why");

    if(isset($input['Status'])) {
        $updateField.= "Status='".$input['Status']."'";
    }
    if($updateField && $input['UserId']) {
        $sqlQuery = "UPDATE users SET $updateField WHERE UserId ='" . $input['UserId'] . "'";   
        mysqli_query($conn, $sqlQuery) or die("database error:". mysqli_error($conn));

    }

} */

?>


