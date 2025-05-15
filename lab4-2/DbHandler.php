<?php
require("DbConfig.php");

class DbHandler extends DbConfig {

    public $conn;
    protected $databaseName;
    protected $hostName;
    protected $uName;
    protected $passCode;

    public function  __construct(){
        
        $dbpara = new DbConfig();
        $this -> databaseName =  $dbpara ->dbName;
        $this -> hostName = $dbpara -> serverName;
        $this -> uName = $dbpara -> userName;
        $this -> passCode= $dbpara -> passCode;
        $dbpara = NULL;

    }

    public function dbConnect(){
        try {
            $this->conn = new mysqli($this->hostName, $this->uName, $this->passCode, $this->databaseName);

            if (mysqli_connect_errno()){
                throw new Exception('Could not connect to database.');}
            else{
                return true;}
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function insert($id, $name){

        try{
            $sql = "INSERT INTO pets (id, name) VALUES(?,?)";
            $stmt= $this->conn->prepare($sql);
            $stmt->bind_param("is", $id, $name);
            
            return ($stmt->execute()) ? true : false;
        }catch(Exception $e){
           throw new Exception($e->getMessage());
        }
    }

    
    public function retrieve()
    {
        try {
            $sql = "SELECT * FROM pets";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
          
            return $result;
           
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function search_id($id){
        try{
            $sql = "SELECT * FROM pets WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();
          
            return($result);

        }catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function update($id, $name){
        try{
            $sql = 'UPDATE pets SET name = ? WHERE id = ?';
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('si', $name, $id);
            $stmt->execute();
            return($stmt) ? true : false;
        }catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    } 

    public function delete($id){
        try{
          $sql = "DELETE FROM pets WHERE id= ? ";
          $stmt = $this->conn->prepare($sql);
          $stmt->bind_param("i", $id);
          $stmt->execute();

          return($stmt) ? true : false;
          
        }catch (Exception $e) {
          throw new Exception($e->getMessage());
       }
    }

    public function login($username, $pass){
        try{
            $sql="SELECT * FROM users WHERE username = ? and password= ?";
            $stmt = $this->conn->prepare($sql);
            $stmt ->bind_param("ss", $username, $pass);
            $stmt->execute();
            $result= $stmt->get_result();
        }catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function updataAccess($auth_code, $user){
         try{
         $sql = "UPDATE users SET accesscode= ? WHERE username = ?";
         $stmt= $this->conn->prepare($sql);
         $stmt->bind_param("si", $auth_code, $user);
         $stmt->execute();

         return ($stmt->excute()) ? true : false ;
        }catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }

    public function access($username){
        try{
            $sql = "SELECT accesscode FROM user WHERE username = ?";
            $stmt = $this->conn->pepare($sql);
            $stmt->bind_param('s', $username);
            $stmt->execte();
            $result = $stmt->get_result();

            return $result;

        }catch (Exception $e){
            throw new Exception($e->getMessage());
        }
    }
        
    
}
?>