<?php
class Database{
	// specify your own database credentials
	private $host     = "localhost";
	private $db_name  = "prod";
	private $username = "hr";
	private $password = "hr";
	public  $conn;
	
	// get the database connection
        public function getConnection(){
		$this->conn = null;
		try{
			$this->conn = oci_connect($this->username, 
			                          $this->password, 
						  '(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)
						                             (HOST = '.$this->host.')
						  			     (PORT = 1521)) 
									     (CONNECT_DATA = (SERVICE_NAME = '.$this->db_name.') 
									     (SID = '.$this->db_name.')))');
			}
		catch(Exception $exception){
			echo "Connection error: " . $exception->getMessage();
			}
			return $this->conn;
			}
}
