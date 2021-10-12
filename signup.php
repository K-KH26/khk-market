<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap5/css/bootstrap.css">
    <link rel="stylesheet" href="login/css/login.css">
    <link rel="stylesheet" href="signup/css/signup.css">
    <title>회원가입</title>
</head>
<body>
    <div class="main-div">
        <div class="form-div">
            <!-- 회원가입 폼 -->
            <form action="action/action_signup.php" method="POST">
                <div class="input-title">회원가입</div>
                <div class="input-email-div row">
                    <label class="col-auto form-label" for="input-email">Email address</label>
                    <input class="col-auto form-control" name="email" autofocus type="email" autofocus id="input-email" placeholder="name@example.com" required >
                </div>
                <div class="input-password-div row">
                    <label class="col-auto form-label" for="input-password">Password</label>
                    <input class="col-auto form-control" name="password" type="password" id="input-password" required>
                </div>
                <div class="input-password-check-div row">
                    <label class="col-auto form-label" for="input-password-check">Password check</label>
                    <input class="col-auto form-control" type="password" name="check_password" id="input-password-check" required>
                </div>
                <div class="input-userid-div row">
                    <label class="col-auto form-label" for="input-user-alias">ID</label>
                    <input class="col-auto form-control" name="alias" type="text" id="input-user-alias" placeholder="alias" required>
                </div>
                <div class="row" id="sign-btn-div">
                    <button class="col btn btn-primary" type="submit">회원가입</button>
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="bootstrap5/js/bootstrap.bundle.js"></script>
</body>
</html>