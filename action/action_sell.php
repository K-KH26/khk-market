<?php
/**
 * inventories_id를 받아오고, auction table 에 추가하기
*/
session_start();

//로그인 되어있는지 세션부터 확인 $user_id에 변수 저장
if(isset($_SESSION['user_logon'])){
    if(isset($_SESSION['user_id'])){
        $user_id = $_SESSION['user_id'];
    }
}

//빈칸으로 들어왔는지 확인하고 필터링한다
if(!empty($_POST['sell_price'])&&!empty($_POST['sell_item'])){

    $filters = array(
        'sell_item' => FILTER_VALIDATE_INT,
        'sell_price'=> array(
            'filter' => FILTER_VALIDATE_INT,
            'options' => array(
                'min_range' => 50,
                'max_range' => 500000000
            )
        )
    );
    
    ['sell_item'=> $inventories_id, 'sell_price' => $price] = filter_input_array(INPUT_POST,$filters);

    //필터링해서 판매금액이 범위 이내의 값이 아님
    if(!$price){ ?>
      <script>
        alert('판매 금액은 50이상 500000000이하만 가능합니다.');
        location.replace('../index.php');
      </script>  
    <?php
    //세션에 저장된 user_id와 전송된 inventories_id로 인벤토리 테이블을 검색해 user_id가 맞는지 확인한다 동일시 판매 table에 등록을 한다
    }else{
      include ('../main_index/MODEL/auctionRegistration.php');
      $auctionRegistration = new auctionRegistration;
      $selling = $auctionRegistration->checkAndUpForAuction($user_id, $inventories_id, $price);
      if($selling == true){
        ?>
        <script>
          alert('판매 등록이 완료되었습니다');
          location.replace('../index.php');
        </script>
        <?php
      }else{
        ?>
        <script>
          alert('판매 등록 오류입니다.');
          location.replace('../index.php');
        </script>
        <?php
      }
    
    }

}else{
    //inventories_id 또는 입력 받은 판매 금액 중 하나라도 값이 없음
    ?>
    <script>
      alert('입력 받은 값이 올바르지 않습니다');
      location.replace('../index.php');
    </script>  
  <?php
}
