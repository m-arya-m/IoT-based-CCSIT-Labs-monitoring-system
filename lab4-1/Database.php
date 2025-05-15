<?php

require('DbConfig.php');

class Database extends DbConfig
{
    public $connection;
    protected $databaseName;
    protected $hostName;
    protected $uName;
    protected $passCode;

    public function __construct()
    {
        $dbPara = new DbConfig();
        $this->databaseName = $dbPara->dbName;
        $this->hostName = $dbPara->serverName;
        $this->uName = $dbPara->userName;
        $this->passCode = $dbPara->passCode;
        $dbPara = NULL;
    }

    public function dbConnect()
    {
        try {
            $this->connection = new mysqli($this->hostName, $this->uName, $this->passCode, $this->databaseName);

            if (mysqli_connect_errno())
                throw new Exception('Could not connect to database.');
            else
                return true;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function insert($pid, $descreption, $price, $quantity)
    {
        try {
            $sql = 'INSERT INTO products (pid , description , price , quantity) VALUES(?,?,?,?)';
            $stmt = $this->connection->prepare($sql);
            $stmt->bind_param('isdi', $pid, $descreption, $price, $quantity);    
            $stmt->execute();

            return ($stmt) ? true : false;
        } catch (Exception $e) {
            return false;
           // throw new Exception($e->getMessage());
        }
    }

    public function retrieve($id)
    {
        try {
            $sql = 'SELECT * FROM products WHERE pid = ?';
            $stmt = $this->connection->prepare($sql);
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();
          
            return($result);
           
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function retrieveall() 
    {
        try {
            $sql = 'SELECT * FROM products';
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            $res = $stmt->get_result();  
            return($res);  
            while($row = mysqli_fetch_array($res)){         
            echo '<table border = 2>' . '<tr>' . '<td>' . 'PID' . '</td>' .'<td>' . 'Description' . '</td>' . '<td>' . 'Price' . '</td>' . '<td>' . 'Quantity' . '</td>' . '</tr>';
            // while($row = mysqli_fetch_array($res)){
            // echo '<tr>';
            // echo '<td>' . $row['pid'] . '</td>';
            // echo '<td>' . $row['description'] .'</td>';
            // echo '<td>' . $row['price'] . '</td>';
            // echo '<td>' . $row['quantity'] . '</td>';
            // echo "</tr>";}
        } 
        echo '</table>';
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    public function retrieveall_() 
    {
        try {
            $sql = 'SELECT * FROM products';
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            $res = $stmt->get_result();
            while($row = mysqli_fetch_array($res)){
            echo '<tr>';
            echo '{' . $row['pid'] . '}'; 
            echo '{' . $row['description'] . '}';
            echo '{' . $row['price'] . '}';
            echo '{' . $row['quantity'] . '}';
            echo "<br>";
        }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

}
?>