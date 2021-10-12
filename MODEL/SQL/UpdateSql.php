<?php

class UpdateSql
{
    /** auction 테이블에 판매중인 아이템 구매 SQL */  
    function buyItemForAuction(int $auction_id, int $buy_user_id){
        $sql = 
        "UPDATE auction 
        SET
        selling = 'sold',
        fk_users_buyer = $buy_user_id
        WHERE id = $auction_id";

        return $sql ;
    }

    /** inventories 소유자 fk_user_id와 옥션등록 fk_auction_id를 변경한다 */
    function changeOwner(int $auction_id, int $buy_user_id){
        $sql =
        "UPDATE inventories
        SET
        inventories.fk_user_id = $buy_user_id,
        inventories.fk_auction_id = null
        WHERE inventories.fk_auction_id = $auction_id";

        return $sql;
    }
    /** 판매 후 판매금액 입금 */
    function plusMoney(int $seller_id, int $price){
        $sql =
        "UPDATE users 
        SET 
        money = money + $price
        WHERE id = $seller_id";
        
        return $sql;
    }

    /** 구매 후 구매금액 차감 */
    function minusMoney(int $buyer_id, int $price){
        $sql =
        "UPDATE users 
        SET 
        money = money - $price
        WHERE id = $buyer_id";
        
        return $sql;
    }

}