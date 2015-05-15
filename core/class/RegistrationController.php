<?php
require_once('databaseConfig.php');
class RegistrationController{

    protected $host = DB_HOST;
    protected $dbname = DB_NAME;
    protected $user = DB_USER;
    protected $pass = DB_PASSWORD;
    protected $DBH;

    function __construct() {

        try {
            $this->DBH = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pass);
        }
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function __destruct() {
        $this->DBH = null;
    }

    public function addNewUser($name,$username,$email,$password){
        try
        {
            $passowrd = md5($password);
            $stmt = $this->DBH->prepare("INSERT INTO admin(username,password,name,email) VALUES(:username, :password, :name, :email)");
            $stmt->bindparam(":username",$username);
            $stmt->bindparam(":password",$passowrd);
            $stmt->bindparam(":name",$name);
            $stmt->bindparam(":email",$email);
            $stmt->execute();
            return true;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
            return false;
        }
    }
}