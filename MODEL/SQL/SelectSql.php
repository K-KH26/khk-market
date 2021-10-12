<?php

/**
 * 유저 인벤토리
 * 판매중인 인벤토리
 * 빠른 검색
 * 세부 검색
 * 
*/

class SelectSql{

    /**유저 인벤토리테이블 검색 */
    function userInventory($user_id){
        $sql =
        "SELECT items.*, inventories.id as inv_id, inventories.fk_auction_id as auc_id 
        FROM items, inventories
        WHERE inventories.fk_user_id = $user_id 
        AND items.id = inventories.fk_item_id ";

        return $sql;
    }

    /** 판매 등록 앞서 인벤토리 아이디 추가확인 */
    function sellInventory($user_id, $inventories_id){
        $sql = $this -> userInventory($user_id);
        $sql = $sql." AND inventories.id = $inventories_id";

        return $sql;
    }

    /**유저 보유금액 */
    function hasMoney($user_id){
        $sql =
        "SELECT money as has_money
        FROM users
        WHERE id = $user_id";

        return $sql ;
    }

    /** 접속 유저의 판매중인 아이템  */
    function sellingUserInventories($user_id){
        $sql = 
        "SELECT items.name, items.level, items.str, items.int, items.def, items.atk, items.mtk, items.hp, items.mp, auction.price
        FROM auction, items, inventories
        WHERE auction.selling = 'ing'
        AND auction.fk_inventories_id = inventories.id
        AND inventories.fk_user_id = $user_id
        AND inventories.fk_auction_id IS NOT NULL
        AND inventories.fk_item_id = items.id" ;

        return $sql;
        
    }

    /** 빠른검색 */
    function quickSearch($input){
        $sql = 
        "SELECT auction.id as auc_id, inventories.fk_user_id as usr_id, i.name, i.level, i.str, i.int, i.def, i.atk, i.mtk, i.hp, i.mp, auction.price
        FROM auction, items i, inventories
        WHERE auction.selling = 'ing'
        AND auction.fk_inventories_id = inventories.id
        AND inventories.fk_item_id = i.id
        AND i.name LIKE '%$input%'
        ORDER BY auction.registration_date DESC";

        return $sql;
    }

    /** 시세 빠른검색 */
    function quickHistory($input){
        $sql = 
        "SELECT s.price, i.name, i.level, i.str, i.int, i.def, i.atk, i.mtk, i.hp, i.mp
        FROM auction_sold s, items i, inventories
        WHERE s.fk_inventories_id = inventories.id
        AND inventories.fk_item_id = i.id
        AND i.name LIKE '%$input%'
        ORDER BY s.purchased_date DESC";
        
        return $sql;
    }

    /** 세부검색 sql*/
    function detailSearchSql(){
        $sql = 
        "SELECT auction.id as auc_id, inventories.fk_user_id as usr_id, i.name, i.level, i.str, i.int, i.def, i.atk, i.mtk, i.hp, i.mp, auction.price
        FROM auction, items i, inventories
        WHERE auction.selling = 'ing'
        AND auction.fk_inventories_id = inventories.id
        AND inventories.fk_item_id = i.id ";
        
        return $sql;
        
    }
    /** 세부 시세 검색 sql*/
    function detailHistorySql(){
        $sql = 
        "SELECT auction_sold.price, i.name, i.level, i.str, i.int, i.def, i.atk, i.mtk, i.hp, i.mp 
        FROM auction_sold, items i, inventories
        WHERE auction_sold.fk_inventories_id = inventories.id
        AND inventories.fk_item_id = i.id";

        return $sql;
    }

    /** 세부 검색 조건 */
    function detailSearch (string $ordinary_or_history, array $detail_search_options){

        $category = $detail_search_options['category'];
        $detail_category = $detail_search_options['detail_category'];
        $class = $detail_search_options['class'];
        $detail_name = $detail_search_options['detail_name'];

        if($detail_search_options['detail_level_min'] == null){
            $detail_level_min = 0;
        }else{
            $detail_level_min = $detail_search_options['detail_level_min'];
        }
        if($detail_search_options['detail_level_max'] == null ){
            $detail_level_max = 0;
        }else{
            $detail_level_max = $detail_search_options['detail_level_max'];
        }

        if($detail_search_options['detail_price_min'] == null){
            $detail_price_min = 0;
        }else{
            $detail_price_min = $detail_search_options['detail_price_min'];
        }
        if($detail_search_options['detail_price_max'] == null ){
            $detail_price_max = 0;
        }else{
            $detail_price_max = $detail_search_options['detail_price_max'];
        }

        $detail_option = $detail_search_options['detail_option'];
        $detail_option_min = $detail_search_options['detail_option_min'];

        //SQL
        if($ordinary_or_history == "history"){
            $sql = $this->detailHistorySql();
        }else{
            $sql = $this->detailSearchSql();
        }

        if($category !== "all"){
           $sql = $sql." AND i.category = '$category'"; 
        }
        if($detail_category !== "all"){
            $sql = $sql." AND i.detail_category = '$detail_category' ";  
        }
        if($class !== "all"){
            $sql = $sql. " AND i.class = '$class' ";
        }
        if($detail_name){
            $sql = $sql." AND i.name LIKE '%$detail_name%' ";
        }
        if($detail_level_min || $detail_level_max){
            
            if($detail_level_min > $detail_level_max){ //입력이 반대로 들어왔을 경우
                $sql = $sql." AND i.level BETWEEN $detail_level_max and $detail_level_min " ;
            }else{
                $sql = $sql." AND i.level BETWEEN $detail_level_min and $detail_level_max ";
            }

        }

        if($ordinary_or_history == "history"){
            if($detail_price_min || $detail_price_max){
                if($detail_price_min > $detail_price_max){ //입력이 반대로 들어왔을 경우
                    $sql = $sql." AND auction_sold.price BETWEEN $detail_price_max and $detail_price_min ";
                }else{
                    $sql = $sql." AND auction_sold.price BETWEEN $detail_price_min and $detail_price_max ";
                }
            }
        }else{
            if($detail_price_min || $detail_price_max){
                if($detail_price_min > $detail_price_max){ //입력이 반대로 들어왔을 경우
                    $sql = $sql." AND auction.price BETWEEN $detail_price_max and $detail_price_min ";
                }else{
                    $sql = $sql." AND auction.price BETWEEN $detail_price_min and $detail_price_max ";
                }
            }
        }

       

        if($detail_option !== null && $detail_option_min && $detail_option_min >= 0 ){
            if($detail_option == "str" || $detail_option == "int" || $detail_option == "def" || $detail_option == "atk" || $detail_option == "mtk" || $detail_option == "hp" || $detail_option == "mp"){
                $sql = $sql. " AND i.$detail_option >= $detail_option_min";
            }
           
        }

        return $sql;

    }

    /** 구매 전 옥션정보 확인 */
    function buyUserCheck($auction_id){
        $sql = 
        "SELECT inventories.fk_user_id, auction.price
        FROM auction, inventories
        WHERE auction.id = $auction_id
        AND auction.selling = 'ing'
        AND auction.fk_inventories_id = inventories.id";

        return $sql;
    }

    /** 구매 중 sold테이블에 저장된 판매기록의 판매금액 확인 */
    function salesAmount($auction_id){
        $sql =
        "SELECT price
        FROM auction_sold
        WHERE fk_auction_id = $auction_id";
        
        return $sql;
    }

}

