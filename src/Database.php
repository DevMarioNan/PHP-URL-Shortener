<?php
class Database{
    private $connection;
    private $dbName;
    private $host;
    private $username;
    private $password;

    public function __construct(){
        $config = require __DIR__. "/config.php";

        $this->host = $config['db_host'];
        $this->dbName = $config['db_name'];
        $this->username = $config['db_user'];
        $this->password = $config['db_pass'];

        $this->connection = new mysqli($this->host,$this->username,$this->password,$this->dbName);

        if($this->connection->connect_error){
            die("error happened while connecting to the database: ". $this->connection->connect_error); 
        }
    }

    public function query($sql){
        $result = $this->connection->query($sql);

        if($result === false){
            echo "Error: ". $this->connection->error;
            return false;
        }

        return $result;
    }

    public function fetchAll($sql){
        $result = $this->connection->query($sql);

        if($result !== false){
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        return [];
    }

    public function fetch($sql){
        $result = $this->connection->query($sql);

        if($result !== false){
            return $result->fetch_assoc();
        }

        return null;
    }

    public function prepare($sql,$params = []){
        $stmt = $this->connection->prepare($sql);

        if($stmt === false){
            echo 'Error' . $this->connection->error;
            return false;
        }

        $stmt->bind_param(...$params);

        $stmt->execute();

        return $stmt->get_result();
    }

    public function close(){
        $this->connection->close();
    }

}