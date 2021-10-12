<?php
/***
 * 빠른검색
 * 세부검색 
 * sql을 검색해 데이터를 가지고 온다
 */


class SearchList
{
    private $db, $pdo;
    private $select_sql;

    function __construct()
    {
        include ('conn.php');
        $this->db = new ConnectDataBase;
        $this->pdo = $this->db->getPDO();
        $this->select_sql = new SelectSql;
    }

    /** 빠른 검색 리스트 */
    function getQuickSearchList($input)
    {
        $quick_sql = $this->getQuickSearchSql($input);
        return $this->getList($quick_sql);
    }

    /** 세부 검색 리스트 */
    function getDetailSearchList(array $input)
    {
        $detail_search_sql = $this->getDetailSearchSql($input);
        return $this->getList($detail_search_sql);
    }

    /** 히스토리 빠른 검색 리스트 */
    function getQuickHistoryList($input)
    {
        $quick_history_sql = $this->getQuickHistroySql($input);
        return $this->getList($quick_history_sql);
    }

    /** 히스토리 세부 검색 리스트 */
    function getDetailHistoryList(array $input)
    {
        $detail_history_sql = $this->getDetailHistroySql($input);
        return $this->getList($detail_history_sql);
    }


    /** 어레이 리스트 만들어서 리턴 */ 
    private function getList($sql)
    {
        $stmt = $this->statementExecute($sql); //execute

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $list = array();
        foreach($result as $row){
            $list[] = $row;
        }

        return $list;
    }
    
    /** 빠른검색 sql 리턴  */
    function getQuickSearchSql($input)
    {
        $sql = $this->select_sql->quickSearch($input);
        return $sql;
    }
    /** 빠른 히스토리 검색 sql 리턴  */
    function getQuickHistroySql($input)
    {
        $sql = $this->select_sql->quickHistory($input);
        return $sql;
    }

    /** 세부검색 sql 리턴  */
    function getDetailSearchSql($input)
    {
        $sql = $this->select_sql->detailSearch("ordinary",$input);
        return $sql;
    }

    /** 세부 히스토리 검색 sql 리턴  */
    function getDetailHistroySql($input)
    {
        $sql = $this->select_sql->detailSearch("history",$input);
        return $sql;
    }

    /** stmt 만들고 execute  */
    function statementExecute($sql)
    {
        $stmt = $this->pdo -> prepare($sql);
        $stmt->execute();
        return $stmt;
    }


}

