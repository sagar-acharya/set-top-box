<?php
require_once('databaseConfig.php');
class AdminController{
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

    public function checkLogin($username,$password){
        $password = md5($password);
        $stmt = $this->DBH->prepare("SELECT * FROM admin WHERE username LIKE :username AND password LIKE :password");
        $stmt->execute(array(":username"=>$username,":password"=>$password));
        $result=$stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}
?>