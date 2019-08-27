<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// database connection will be here
include_once '../config/database.php';
include_once '../objects/users.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$users = new Users($db);
 
// read users will be here
// query users
$stmt = $users->read();

// users array
$users_arr=array(); 
$users_arr["records"]=array();
 
// retrieve our table contents  
while(($row=oci_fetch_array($stmt,OCI_ASSOC+OCI_RETURN_NULLS)) != false){
    $users_item=array(
	    "Employee_Id" => $row['EMPLOYEE_ID'],
        "First_Name" => $row['FIRST_NAME'],
        "Last_Name" => $row['LAST_NAME'],
        "Phone_Number" => $row['PHONE_NUMBER'],
        "Hire_Date" => $row['HIRE_DATE']
    );
    array_push($users_arr["records"], $users_item);
}  
    
// show Employees data in json format
echo json_encode($users_arr);