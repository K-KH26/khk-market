<?php

$totalPrice = 2000;
$email = "123@123.com";
$buyer = 'angel';
$phone = 01012341234;
$address = "대한민국 어딘가";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KHK AUCTION 결제</title>
</head>
<body>
    <h1>hi</h1>
</body>
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="https://cdn.iamport.kr/js/iamport.payment-1.1.5.js"></script>
<script>
    $(function(){
        var IMP = window.IMP; // 생략가능
        IMP.init('imp07951120'); // 'iamport' 대신 부여받은 "가맹점 식별코드"를 사용
        var msg;
        
        var totalPrice = '<?php echo $totalPrice;?>';
        var email = '<?php echo $email;?>';
        var buyer = '<?php echo $buyer; ?>';
        var tel = '<?php echo $phone; ?>';
        var addr = '<?php echo $address; ?>';

        IMP.request_pay({
            pg : 'kakaopay',
            pay_method : 'card',
            merchant_uid : 'merchant_' + new Date().getTime(),
            name : 'KHK AUCTION 충전',
            amount : totalPrice,
            buyer_email : email,
            buyer_name : buyer,
            buyer_tel : tel,
            buyer_addr : addr,
            buyer_postcode : '123-456',
            //m_redirect_url : 'http://www.naver.com'
        }, function(rsp) {
            if ( rsp.success ) {
                //[1] 서버단에서 결제정보 조회를 위해 jQuery ajax로 imp_uid 전달하기
                jQuery.ajax({
                    url: "/test/complete/pay_log.php", //cross-domain error가 발생하지 않도록 주의해주세요
                    type: 'POST',
                    // dataType: 'json',
                    data: {
                        imp_uid : rsp.imp_uid,
                        success : rsp.successtt
                        //기타 필요한 데이터가 있으면 추가 전달
                    }

                }).done(function(data) {
                    //[2] 서버에서 REST API로 결제정보확인 및 서비스루틴이 정상적인 경우
                    console.log(data);

                    if ( data == true ) {
                        msg = '결제가 완료되었습니다.';
                        msg += '\n고유ID : ' + rsp.imp_uid;
                        msg += '\n상점 거래ID : ' + rsp.merchant_uid;
                        msg += '\n결제 금액 : ' + rsp.paid_amount;
                        msg += '\n카드사 승인번호 : ' + rsp.apply_num;
                        msg += '\n결제 승인 시각 : ' + rsp.paid_at;
                        
                        alert(msg);
                    } else {
                        //[3] 아직 제대로 결제가 되지 않았습니다.
                        //[4] 결제된 금액이 요청한 금액과 달라 결제를 자동취소처리하였습니다.
                    }
                });
                
            } else {
                msg = '결제에 실패하였습니다.';
                msg += '에러내용 : ' + rsp.error_msg;
                //실패시 이동할 페이지
                location.replace("/index.php");
                alert(msg);
            }
        });
        
    });
    </script>
</html>