<?php
class Users{
 
    // database connection and table name
    private $conn;
    private $table_name = "EMPLOYEES";

    // object properties
    public $id;
	public $first_name;
    public $last_name;
    public $email;
	public $hire_date;
	public $job_id;
	
    // constructor with $db as database connection
    public function __construct($db){
		$this->conn = $db;
	}
	
// read products
function read(){

    // select all query
    $query = "SELECT * FROM " . $this->table_name;
 
    // prepare query statement
	$stmt =oci_parse ($this->conn , $query);     	

    // execute query
	oci_execute($stmt);
		
	return $stmt;
}

// search products
function search(){
     
	// select all query
    $query = "SELECT * FROM " . $this->table_name . " WHERE Employee_Id =:id" ;

    // prepare query statement
    $stmt =oci_parse ($this->conn , $query);  
    
    //Assign User input into Variables
	$empid = $this->id;
    
	// bind new values
    oci_bind_by_name($stmt , ':id' , $empid );

    // execute query
    @oci_execute($stmt);
 
    return $stmt;
}
// create product
function create(){
 
    // query to insert record
    $query = "INSERT INTO " . $this->table_name . " (Employee_Id , First_Name, Last_Name , Email , Hire_Date , Job_Id) 
                                             VALUES (:id ,:first_name, :last_name, :email, :hire_date, :job_id )";
 
    // prepare query
    $stmt =OCI_PARSE ($this->conn , $query);     	
 
    // sanitize
    $this->id        = htmlspecialchars(strip_tags($this->id));
	$this->first_name= htmlspecialchars(strip_tags($this->first_name));
    $this->last_name = htmlspecialchars(strip_tags($this->last_name));
    $this->email     = htmlspecialchars(strip_tags($this->email));
	$this->hire_date = htmlspecialchars(strip_tags($this->hire_date));
	$this->job_id    = htmlspecialchars(strip_tags($this->job_id));
 
 
    //Assign User input into Variables
	$empid        = $this->id;
	$empfirst_name= $this->first_name;
	$emplast_name = $this->last_name;
	$empemail     = $this->email;
	$emphire_date = $this->hire_date;
	$empjob_id    = $this->job_id;
	
    
	// bind values
    oci_bind_by_name($stmt , ':id'         , $empid         );
	oci_bind_by_name($stmt , ':first_name' , $empfirst_name );
	oci_bind_by_name($stmt , ':last_name'  , $emplast_name  );
	oci_bind_by_name($stmt , ':email'      , $empemail      );
	oci_bind_by_name($stmt , ':hire_date'  , $emphire_date  );
	oci_bind_by_name($stmt , ':job_id'     , $empjob_id     );
 
    // execute query
	//using @ to handle exceptions, like :ORA-02292: integrity constraint (HR.JHIST_EMP_FK) violated - child record
	@OCI_EXECUTE($stmt , OCI_COMMIT_ON_SUCCESS);
		$rowcount=oci_num_rows($stmt);
	
	if (oci_error($stmt)){
		return  0;
	}else {
		if ($rowcount==0){
			return -1;
			}else{
				return 1;
			}
	}
}


//update the product
function update(){
    // update query
    $query = "UPDATE " . $this->table_name . " SET last_name = :last_name
	                                           WHERE employee_id = :id";
 
    // prepare query statement
    $stmt =OCI_PARSE ($this->conn , $query);     	
 
    // sanitize
    $this->id=htmlspecialchars(strip_tags($this->id));
	$this->last_name=htmlspecialchars(strip_tags($this->last_name));
	
 
    //Assign User input into Variables
	$empid = $this->id;
	$emplast_name = $this->last_name;

	
	// bind new values
    oci_bind_by_name($stmt , ':id' , $empid );
	oci_bind_by_name($stmt , ':last_name' , $emplast_name );
	

    // execute query
	//using @ to handle exceptions, like :ORA-02292: integrity constraint (HR.JHIST_EMP_FK) violated - child record
	@OCI_EXECUTE($stmt , OCI_COMMIT_ON_SUCCESS);
	$rowcount=oci_num_rows($stmt);
	
	if (oci_error($stmt)){
		return  0;
	}else {
		if ($rowcount==0){
			return -1;
			}else{
				return 1;
			}
	}
}
// delete the product
function delete(){
 
    // delete query
    $query = "DELETE FROM " . $this->table_name . " WHERE Employee_Id =:id" ;
 
    // prepare query statement
	$stmt =OCI_PARSE ($this->conn , $query);     	
    // sanitize
	$this->id        = htmlspecialchars(strip_tags($this->id));
	
	//Assign User input into Variables
	$empid = $this->id;
    
	// bind new values
    oci_bind_by_name($stmt , ':id' , $empid );
    // execute query
	//using @ to handle exceptions, like :ORA-02292: integrity constraint (HR.JHIST_EMP_FK) violated - child record
	@OCI_EXECUTE($stmt);
 
    // commit query
    OCI_COMMIT_ON_SUCCESS;
	
	if (OCI_ERROR($stmt)) {
		//$e = OCI_ERROR($stmt); // Statement handle passed
		return false;
		//var_dump($e);
		}
	else{
		return true;
		}
}
}
