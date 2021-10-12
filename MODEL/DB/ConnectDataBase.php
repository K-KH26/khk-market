<?php

/*
* DB 계정정보를 가져와 PDO 객체를 생성
* 소멸자로 PDO객체 NULL 
*/

// include ('./AccountDataBase.php');
class ConnectDataBase extends AccountDataBase{

    private $pdo = NULL;
    private $db_host, $db_id, $db_password, $db_name;
    private $dns= "";
   
    function __construct(){
        $this->db_host = $this->getHost();
        $this->db_id = $this->getID();
        $this->db_password = $this->getPassword();
        $this->db_name = $this->getName();
        $this->dns = sprintf("mysql:host=%s; dbname=%s", $this->db_host, $this->db_name);
       
        try{

            $this->pdo = new PDO($this->dns, $this->db_id, $this->db_password);
            $this->pdo -> setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
            $this->pdo -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            
        }catch(PDOException $e){
            print "CONNECTION #ERR :" . $e->getMessage();
        }
    }

    //기본적인 트랜잭션
    function transactionPDO($pdo, $statement){
        try{
            $pdo->beginTransaction();
            $statement->execute();
            
            $pdo->commit();
        
        }catch(PDOException $e){
            $pdo->rollback();
            echo $e->getMessage();
        }
    }

    function getPDO(){
        return $this->pdo;
    }

    function __destruct(){
        $this->pdo = NULL;
    }

}
