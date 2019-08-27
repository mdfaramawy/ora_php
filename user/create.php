<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate users object
include_once '../objects/users.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare user object
$users = new Users($db);
 
// get posted data
//$data = json_decode(file_get_contents("php://input"));
 
// make sure data is not empty
if( isset ($_POST['id'])  &&
    !empty($_POST['id']) &&
	isset ($_POST['first_name'])  &&
    !empty($_POST['first_name']) &&
	isset ($_POST['last_name'])  &&
    !empty($_POST['last_name']) &&
	isset ($_POST['email'])  &&
    !empty($_POST['email']) &&
	isset ($_POST['hire_date'])  &&
    !empty($_POST['hire_date']) &&
	isset ($_POST['job_id'])  &&
    !empty($_POST['job_id'])
){
 
    // set users property values
    $users->id = $_POST['id'];
    $users->first_name = $_POST['first_name'];
    $users->last_name = $_POST['last_name'];
    $users->email = $_POST['email'];
	$users->hire_date = $_POST['hire_date'];
	$users->job_id = $_POST['job_id'];
 
    // create the users
    if($users->create()==1){
  
        // tell the user
        echo json_encode(array("message" => "users was created."));

    }
 
    // if unable to create the users, tell the user
    else{
 
        // tell the user
        echo json_encode(array("message" => "Unable to create users."));

    }
}
 
// tell the user data is incomplete
else{

    // tell the user
    echo json_encode(array("message" => "Unable to create product. Data is incomplete."));
    
}
?>