<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object file
include_once '../config/database.php';
include_once '../objects/users.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$user = new Users($db);
 

// get keywords
//$data = json_decode(file_get_contents("php://input"));
 
// set product id to search for
$user->id = $_POST['id'];
 
if ( isset ($_POST['id']) &&
     !empty ($_POST['id'])) {
		// delete the user
		if(!$user->delete()){
		  
			//if unable to delete the user tell the user
			echo json_encode(array("message" => "Unable to delete user."));

		}
		 
		// if user was deleted tell the user
		else {

			echo json_encode(array("message" => "user was deleted."));
			
		}
	}
elseif (!isset($_POST['id'])) {
	echo json_encode(array( "message" => "id is required"));
	}
	elseif (empty($_POST['id'])) {
		echo json_encode(array("message" => "id is empty"));
}

?>