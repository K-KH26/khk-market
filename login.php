<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="bootstrap5/css/bootstrap.css">
    <link rel="stylesheet" href="login/css/login.css?ver=1">
    <title>로그인</title>
</head>
<body>
    <div class="main-div">
        <div class="form-div">
            <!-- 로그인 폼 -->
            <form action="action/action_login.php" method="POST">
                <div class="input-title">로그인</div>
                <div class="input-email-div row">
                    <label class="col-auto form-label" for="input-email">Email address</label>
                    <input class="col-auto form-control" required type="email" id="input-email" placeholder="name@example.com" name="email">
                </div>
                <div class="input-password-div row">
                    <label class="col-auto form-label" for="input-password">Password</label>
                    <input class="col-auto form-control" required type="password" id="input-password"  name="password">                   
                </div>
                <div class="row">
                    <p class="error_code"><?php  //에러 코드 추가 가능 ex) 5번 이상 비밀번호 입력 실패시 에러코드=2
                    if($_GET['error_cd']==="1"){ //int형으로 변경시 4바이트,string 한글자 저장시 2바이트 
                        echo "이메일 혹은 비밀번호를 잘못 입력하셨거나<br>등록되지 않은 이메일 입니다.";
                    }
                    ?>
                    </p>
                </div>
                <div class="row" id="login-btn-div">
                    <button class="btn btn-primary col" type="submit">로그인</button>
                </div>
            </form>
            <div class="row" id="signup-btn-div">
                <button class="btn col" id="signup" onclick="signupPage()">회원가입</button>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="bootstrap5/js/bootstrap.bundle.js"></script>
    <script src="login/js/location.js"></script>
</body>

</html>