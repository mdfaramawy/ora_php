<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
include_once '../config/database.php';

// instantiate users object
include_once '../objects/users.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare user object
$user = new Users($db);
 
// get id of user to be edited
//$data = json_decode(file_get_contents("php://input"));
 
// set ID property of product to be edited
$user->id = $_POST['id'];
$user->last_name = $_POST['last_name'];
 
if (isset ($_POST['id']) &&
    !empty($_POST['id']) &&
	isset ($_POST['last_name']) &&
    !empty($_POST['last_name'])){
	// if product was updated
	if($user->update()==1){
	 
		// tell the user
		echo json_encode(array("message" => "user was updated."));
	}
	 
	// if unable to update the product
	elseif ($user->update()==-1){
	 
		// tell the user
		echo json_encode(array("message" => "Unable to update user."));
	}
	// if user was not found
	elseif ($user->update()==0){
		
		// tell the user
		echo json_encode(array("message" => "User not found."));
	}
}else {
	echo json_encode(array("message" => "unable to update data , data incomplete"));
}
?>