<?php
class Database{
	// specify your own database credentials
	private $host     = "localhost";
    private $db_name  = "PROD";
    private $username = "hr";
    private $password = "hr";
    public  $conn;
	
	// get the database connection
    public function getConnection(){
		$this->conn = null;
		try{
			$this->conn = oci_connect($this->username, 
			                          $this->password, 
									  $this->db_name, 'AL32UTF8');
			}
		catch(Exception $exception){
			echo "Connection error: " . $exception->getMessage();
			}
			return $this->conn;
			}
}
?>