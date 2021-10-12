<?php
/**
 * ***경매장 판매중 물품을 구매한다***
 * *** controller *** 
 * 1. 현재 로그인 되어있어야함
 * 2. 자신이 판매중인 아이템은 판매 불가능 
 * 3. 구매를 원하는 아이템이 자신의 보유 금액보다 높으면 구매 불가능
 * 
*/
session_start();

error_reporting(E_ALL);
ini_set("display_errors",1);

/**
 * 인풋 데이터 필터링
*/ 
include ('./action_detail_filter.php');
$detail_filter = new DetailFilter;

$input_buy_list = array(
    "auction_no",
    "user_no",
    "session_no"
);

$has_var = $detail_filter -> detailSearchCheck($input_buy_list); // input 유효성 검사

/**
 * 데이터 필터링 -> 구매 조건확인 -> 구매 트랜젝션
*/
if($has_var){

    // input 데이터 필터링
    $filters = array(
        "auction_no" => FILTER_VALIDATE_INT, //판매 등록 옥션 id : 판매자
        "user_no" => FILTER_VALIDATE_INT,    //판매 등록 유저 id : 판매자
        "session_no" => FILTER_VALIDATE_INT  //js 로그인 세션 id : 구매자
    );

    ["auction_no"=>$auction_id, "user_no"=>$sell_user_id, "session_no"=> $buy_user_id] = filter_input_array(INPUT_GET,$filters);

    // 1. 현재 로그인되어 있어야 하고 php저장 세션id와 js로 전달받은 세션넘버(session_no)가 같아야 한다
    if(isset($_SESSION['user_logon']) && $_SESSION['user_logon'] == true){      // php 세션 로그인을 확인한다
        if($_SESSION['user_id'] == $buy_user_id){                               // 전달받은 js세션 id 확인 ==> 정상 로그인 상태

            //2. 자신이 판매중인 아이템은 구매 불가능 -> sql로 auction_no와 user_no를 비교해서 동일하면 구매 불가능
            if($auction_id && $sell_user_id){               //둘다 false가 아닌값으로 존재해야한다
                include ('../main_index/MODEL/auctionBuyItem.php');
                $auction = new AuctionBuyItem($auction_id, $sell_user_id, $buy_user_id);
                $input_normal = $auction -> checkBuyUser(); // 판매 아이템 판매정보 일치 확인

                if($input_normal == true){                              //false 일 경우 판매아이템 정보 오류로 구매 불가능
                    if($_SESSION['user_id'] != $sell_user_id){          //구매자 id $_SESSION['user_id'] 와 판매자 id 가 일치하는지 마지막으로 확인하고 다를시에만 구매 가능
                        $result = $auction-> calculatePrice();

                        //3. 구매를 원하는 아이템이 자신의 보유 금액보다 높으면 구매 불가능
                        if($result && $result >= 0){                    
                            $buy = $auction -> buyItemTransaction();
                            if($buy){
                                replaceIndex("구매가 완료되었습니다.");
                            }else{
                                replaceIndex("DB 오류로 구매에 실패하였습니다!");
                            }
                        }else{
                            replaceIndex("보유 금액이 부족해 아이템을 구매할 수 없습니다!");
                        }
                    }else{
                        replaceIndex("자신이 등록한 판매물품은 구매 불가능 합니다!");
                    }
                }else{
                    replaceIndex("판매 아이템 정보 오류로 구매할 수 없습니다!");
                }
            }else{  
                replaceIndex("정상적인 아이템 정보가 아닙니다!");
            }
        }else if(!$buy_user_id){
            replaceIndex("구매할 아이템이 선택되지 않았습니다.");
        }else{ 
            replaceIndex("로그인 정보가 올바르지 않습니다!");
        }
    }else{
        replaceIndex("로그아웃 상태입니다! 로그인을 해주세요.");
    }
}else{
    replaceIndex("아이템 입력 정보 오류로 구매 할 수 없습니다!");
}

function replaceIndex(string $message)
{
?>
<script>
    var message = '<?php echo $message; ?>';
    alert(message);
    location.replace('/index.php');
</script>
<?php
}