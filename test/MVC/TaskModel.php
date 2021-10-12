<?php
/**
 *  MVC - MODEL
 * task 목록 불러오기
*/

class TaskModel 
{
    public static function all()
    {
        $root = $_SERVER['DOCUMENT_ROOT'];

        include_once ($root.'/MODEL/DB/AccountDataBase.php');
        include_once ($root.'/MODEL/DB/ConnectDataBase.php');
        
        $db = new ConnectDataBase;
        $pdo = $db->getPDO();
        $sql = "SELECT * FROM tasks";
        $statement = $pdo->prepare($sql);
        $statement->execute();
        
        $statement -> setFetchMode(PDO::FETCH_ASSOC);
        
        //배열 생성해놓기
        $tasks = [];
        while($row = $statement->fetch()){
            $tasks[] = $row;
        }
        
        return $tasks;
    }
}