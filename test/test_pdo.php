<?php

session_start();

error_reporting(E_ALL);
ini_set("display_errors", 1);

echo $_SESSION['user_logon'] ;

try{
    $pdo = new PDO("mysql:host=localhost; dbname=khk_market;","root","dnqnsxn23");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);

    print ("PDO connection success <br>");

}catch(PDOException $e){
    print $e->getMessage();
}

$name = "드"; // << 바인드 변수
$alias = "사과";

$sql = 'SELECT * FROM test WHERE test.name LIKE ? AND test.alias LIKE ? ORDER BY no DESC';
// $sql = 'SELECT * FROM test';
$statement = $pdo -> prepare($sql);

// $statement->bindValue(':name',$name);
$statement -> execute(array("%$name%", "%$alias%"));

$result = $statement->fetchAll(PDO::FETCH_ASSOC);

foreach($result as $row){
    echo $row['no']." = ".$row['name']." ".$row['alias'].'<br>';
}

echo "<br>";

$t_sql = 'SELECT * FROM test WHERE test.alias LIKE ?';
$t_statement = $pdo -> prepare($t_sql);

// $t_statement -> bindParam(':alias', $alias);
// $t_statement->execute(array(':alias'=> $alias , "%$name%"));
$alias = "%과%";

$t_statement -> bindParam(1,$alias);
$t_statement -> execute();

$result = $t_statement->fetchAll(PDO::FETCH_ASSOC);

foreach($result as $row){
    echo $row['no']." / ". $row['name']." / ".$row['alias']."<br>";
}

$pdo = NULL;

include 'class/AccountDataBase.php';

class DB extends AccountDataBase{

    private $conn = NULL;
    private $dbHost;
    private $dbId;
    private $dbPwd;
    private $dbName;

    function __construct(){
        $this->dbHost = $this->getHost();
        $this->dbId = $this->getID();
        $this->dbPwd = $this->getPassword();
        $this->dbName = $this->getName();

        try{
            $this->conn = new PDO('mysql:host='.$this->dbHost.';dbname='.$this->dbName,$this->dbId,$this->dbPwd);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        }catch(PDOException $e){
            print $e->getMessage();
        }
    }

    public function getPDO(){
       return $this->conn;
    }

}

$db = new DB;
$pdo = $db->getPDO();
// print_r($pdo);
// $result = $db->getResult();

$sql = "SELECT * FROM test";
$statement = $pdo->prepare($sql);
$statement->execute();

$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach($result as $row){
    echo $row['name'];
}