<?php
require("DbConfig.php");
class DbHandler extends DbConfig {
    public $conn;
    protected $databaseName;
    protected $hostName;
    protected $uName;
    protected $passCode;

    public function __construct() {
        //create object to access the database configuration data
        $dbPara = new DbConfig();
        $this -> databaseName = $dbPara -> dbName;
        $this -> hostName = $dbPara -> serverName;
        $this -> uName = $dbPara -> userName;
        $this -> passCode = $dbPara ->passCode;
        $dbPara = NULL;
    }
  
   public function dbConnect(){
        try{
	        $this->conn = new mysqli($this->hostName, $this->uName, $this->passCode, $this->databaseName);
		
            if( mysqli_connect_errno() ){
                throw new Exception("Could not connect to database.");   
            } else{
                return true;
            }
        }catch(Exception $e){
            throw new Exception($e->getMessage());   
        }
    }
   
    // Function to handle user login
    function login($username, $password) {
        // Sanitize input to prevent SQL injection
        $username = $this->conn->real_escape_string($username);
        $password = $this->conn->real_escape_string($password);
        
        // Hash the password before comparing
        $password = ($password);

        // Query to check if user exists
        $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
        $result = $this->conn->query($sql);

        return $result;
    }

    // Function to update user access with authentication code
    function updateAccess($auth_code, $username) {
        // Sanitize input to prevent SQL injection
        $auth_code = $this->conn->real_escape_string($auth_code);
        $username = $this->conn->real_escape_string($username);

        // Query to update user access
        try {
            $sql="UPDATE user SET accesscode= ? WHERE username = ?";
            $stmt=$this->conn->prepare($sql);
            $stmt->bind_param("ss",$auth_code, $user);
            
            return ($stmt->execute()) ? true: false;
    
        } catch (Exception $e) {
           throw new Exception($e->getMessage());
           
        }   
    }
    public function access($username){
        try{

            $sql = "SELECT accesscode FROM user WHERE username=?";
            $stmt = $this->conn->prepare($sql);
            $stmt ->bind_param("s",$username);
            $stmt ->execute();
            $result = $stmt->get_result();
            return $result;
        }catch (Exception $e){
                throw new Exception($e->getMessage());
        }
    }

    // Function to close database connection
    function __destruct() {
        $this->conn->close();
    }
    public function query($sql) {
        $result = $this->conn->query($sql);
        return $result;
    }
    
 // Function to insert new lab
 public function insertLab($lab_number, $type,$devices_count) {
    try {
     $sql = "INSERT INTO laboratory (lab_number, type, devices_count) VALUES (?, ?, ?)";
     $stmt=$this->conn->prepare($sql);
     $stmt->bind_param("isi",$lab_number,$type, $devices_count );
    
     return ($stmt->execute()) ? true: false;
 } catch (exception $e) {
    throw new Exception($e->getMessage());
    
 }   
 }
 
 // Function to insert new device
 public function insertDevice($name, $device_number, $operating_system, $lab_number, $components) {
     try {
      $sql = "INSERT INTO device (name,device_number,operating_system,lab_number,components) VALUES (?, ?, ?, ?, ?)";
      $stmt=$this->conn->prepare($sql);
      $stmt->bind_param("sisis",$name, $device_number, $operating_system, $lab_number, $components);
     
      return ($stmt->execute()) ? true: false;
  } catch (exception $e) {
     throw new Exception($e->getMessage());
     
  }   
  }
 
  // Function to delete device
  public function deleteDevice($device_number, $lab_number){
     try {
         $sql=" DELETE FROM device WHERE device_number= ? AND lab_number= ?";
         $stmt=$this->conn->prepare($sql);
         $stmt->bind_param("ii",$device_number, $lab_number);
         $stmt->execute();
         return ($stmt) ? true : false ;
 
     } catch (exception $e) {
        throw new Exception($e->getMessage());
        
     }  
 }
 
 // Function to update device
 public function updateDevice( $device_number, $name, $operating_system, $lab_number, $components){
     try {
         $sql="UPDATE device SET name= ?, operating_system=?, components=?  WHERE  device_number= ? AND lab_number=?";
         $stmt=$this->conn->prepare($sql);
         $stmt->bind_param("issis",$device_number, $name, $operating_system, $lab_number, $components);
         $stmt->execute();
         
         return ($stmt)? true: false;
 
     } catch (Exception $e) {
        throw new Exception($e->getMessage());
        
     }  
   
 }
 
 //Function to search for device
 public function searchForDevice($device_number) {
     try {
         $sql="SELECT * FROM device WHERE device_number= ?";
         $stmt=$this->conn->prepare($sql);
         $stmt->bind_param("i", $device_number);
         $stmt->execute();
         $result=$stmt->get_result();
 
         return $result;
     } catch (Exception $e) {
        throw new Exception($e->getMessage());
        
     }  
 }
}

?>