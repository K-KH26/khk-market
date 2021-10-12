<?php
session_start();
if(isset($_SESSION['user_logon'])){
    $login = true;
}

// 인벤토리 컨트롤러
if($_SESSION['user_id']){
    include ('action/action_inventory.php');
}else{
    include ('main_index/VIEW/view-money.php');
    $view_make_money_div = new ViewMoney;
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>khk.market</title>

        <link rel="stylesheet" href="bootstrap5/css/bootstrap.css">
        <link rel="stylesheet" href="main_index/css/block.css?version=2105040611">
        <link rel="stylesheet" href="main_index/css/top.css">
        <link rel="stylesheet" href="main_index/css/search.css?ver=1">
        <link rel="stylesheet" href="main_index/css/inventories.css?ver=2104020">
        <link rel="stylesheet" href="main_index/css/selling-list.css">

    </head>
    <body>
        <!-- title div -->
        <div class="container-fluid" id="title-div">
            <div class="row align-items-center ">
                <div class="col" id="title-title">
                    KHK.MARKET
                </div>
                <div class="col-12" id="title-login">

                    <?php //로그인 세션 확인, 세션존재-> 유저별명 , 로그아웃 버튼  / 세션X -> 로그인 버튼
                if($login){
                    echo $_SESSION['user_alias']. " 님 반갑습니다";
                    ?>
                    <button
                        type="button"
                        class="btn btn-secondary float-end"
                        onclick="location.href='/action/action_logout.php'">로그아웃</button>
                <?php
                }else{
                    ?>
                    <button
                        type="button"
                        class="btn btn-secondary float-end"
                        onclick="location.href='login.php'">로그인</button>
                    <?php
                }
                ?>
                </div>
                <div class="col-12" id="title-payment">
                    <button type="button" class="btn btn-warning float-end" onClick="location.href='/test/test_pay.php'">결제API</button>
                </div>
            </div>
        </div>

        <!-- search div -->
        <div class="container-fluid" id="search-div">
            <div class="row align-items-center">
                <div class="col-6">
                <form class="quick_form" onsubmit="return false">
                    <div class="input-group ">
                        <input type="text" class="form-control" name="quick_search" placeholder="아이템 이름">
                        <button class="input-group-text btn-secondary" onclick="searchQuick()">검색</button>
                    </div>
                </form>
                </div>
                <?php
                    $view_make_money_div -> hasMoneyDiv($has_money);
                ?>
            </div>
        </div>

        <!-- 네비게이션바 -->
        <div class="navigation mt-1">
            <ul class="nav nav-pills nav-fill px-2" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a
                        class="nav-link active"
                        id="pills-search-tab"
                        data-bs-toggle="pill"
                        data-bs-target="#pills-search"
                        type="button"
                        role="tab"
                        aria-controls="pills-search"
                        aria-selected="true">검색</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a
                        class="nav-link"
                        id="pills-history-tab"
                        data-bs-toggle="pill"
                        data-bs-target="#pills-history"
                        type="button"
                        role="tab"
                        aria-controls="pills-history"
                        aria-selected="false">시세</a>
                </li>
                <li class="nav-item active" role="presentation">
                    <a
                        class="nav-link"
                        id="pills-sell-tab"
                        data-bs-toggle="pill"
                        data-bs-target="#pills-sell"
                        type="button"
                        role="tab"
                        aria-controls="pills-sell"
                        aria-selected="false">판매</a>
                </li>
            </ul>
        </div>

        <!-- 세부 검색창, 검색 목록 -->
        <div class="container-fluid" id="main-div">
            <div class="row">
                <!-- 세부검색 col-sm-4 -->
                <div class="container-fluid col-xs-0 col-sm-4" id="detailed-div">
                  <form class="detail_form" onsubmit="return false">
                  <div class="row row-cols-1" id="detailed-div-box">
                        <!-- 단락 1 -->
                        <div class="col py-1" id="detailed1">아이템 분류
                            <select
                                name = "category"
                                class="mt-1 mb-1 form-select form-select-sm"
                                onchange="changeOption()"
                                id="select-first">
                                <option selected="selected" value="all">전체</option>
                                <option value="armor">방어구</option>
                                <option value="weapon">무기</option>
                                <option value="accessories">장신구</option>
                            </select>
                            <select name="detail_category" class="my-2 form-select form-select-sm" id="select-second">
                                <option selected="selected" value="all">전체</option>
                            </select>
                            <select name="class" class="my-2 form-select form-select-sm" id="select-third">
                                <option selected="selected" value="all">전체</option>
                                <option value="normal">일반</option>
                                <!-- <option value="rare">레어</option>
                                <option value="unique">유니크</option> -->
                            </select>
                        </div>
                        <!-- 단락 2 -->
                        <div class="pt-1 col" id="detailed2">
                            <div class="input-group input-group-sm mt-2 mb-2">
                                <span class="input-group-text" id="inputGroup-sizing-sm">아이템 이름</span>
                                <input
                                    name="detail_name"
                                    type="text"
                                    class="form-control"
                                    aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-sm">
                            </div>
                            레벨 범위
                            <div class="input-group input-group-sm mb-2">
                                <input
                                    name="detail_level_min"
                                    type="number"
                                    min="0"
                                    max="60"
                                    class="form-control"
                                    placeholder="0"
                                    aria-label="Username">
                                <span class="input-group-text">~</span>
                                <input
                                    name="detail_level_max"
                                    type="number"
                                    min="0"
                                    max="60"
                                    class="form-control"
                                    placeholder="0"
                                    aria-label="Server">
                            </div>
                            가격
                            <div class="input-group input-group-sm mb-2" id="search-price">
                                <input
                                    name="detail_price_min"
                                    type="number"
                                    min="0"
                                    class="form-control"
                                    placeholder="0"
                                    aria-label="Username">
                                <span class="input-group-text">~</span>
                                <input
                                    name="detail_price_max"
                                    type="number"
                                    min="0"
                                    class="form-control"
                                    placeholder="0"
                                    aria-label="Server">
                            </div>
                        </div>
                        <!-- 단락 3 -->
                        <div class="py-1 col container-fluid" id="detailed3">
                            <div class="row">
                                <div class="col-6">세부검색
                                    <select
                                        name="detail_option"
                                        class="mb-2 form-select form-select-sm"
                                        aria-label="Default select example">
                                        <option value="null" selected="selected">선택안함</option>
                                        <option value="str">힘</option>
                                        <option value="int">인트</option>
                                        <option value="def">방어력</option>
                                        <option value="atk">공격력</option>
                                        <option value="mtk">마력</option>
                                        <option value="hp">HP</option>
                                        <option value="mp">MP</option>
                                    </select>
                                </div>
                                <div class="col-6">최소수치
                                    <input
                                        value="0"
                                        name="detail_option_min"
                                        type="number"
                                        min="0"
                                        class="form-control form-select-sm"
                                        placeholder="0">
                                </div>
                            </div>
                        </div>
                        <!-- 단락 4 -->
                        <div class="py-1 container-fluid" id="detailed4">
                            <div class="row ">
                                <div class="col">
                                    <button class="btn btn-warning position-sticky start-100" type="reset">초기화</button>
                                </div>
                                <div class="col position-relative">
                                    <button class="btn btn-success position-sticky start-100" onclick="searchDetail()">검색시작</button>
                                </div>
                            </div>
                        </div>
                    </div>
                  </form>
                </div>

                <!-- 게시판 col-sm-8 div-->
                <div class="tab-content col-xs-12 col-sm-8" id="pills-tabContent">
                    <div
                        class="tab-pane position-relative fade show active"
                        id="pills-search"
                        role="tabpanel"
                        aria-labelledby="pills-search-tab">
                        <table class="table table-striped search-table">
                            <thead>
                                <th scope="col">#</th>
                                <th scope="col">이름</th>
                                <th scope="col">가격</th>
                                <th scope="col">Level</th>
                                <th scope="col">힘</th>
                                <th scope="col">인트</th>
                                <th scope="col">방어력</th>
                                <th scope="col">공격력</th>
                                <th scope="col">마력</th>
                                <th scope="col">HP</th>
                                <th scope="col">MP</th>
                            </thead>
                            <tbody id="quick-table">
                            </tbody>
                        </table>
                    </div>
                    <div
                        class="tab-pane fade position-relative "
                        id="pills-history"
                        role="tabpanel"
                        aria-labelledby="pills-history-tab">
                        <table class="table table-striped">
                            <thead>
                                <th scope="col">#</th>
                                <th scope="col">이름</th>
                                <th scope="col">가격</th>
                                <th scope="col">Level</th>
                                <th scope="col">힘</th>
                                <th scope="col">인트</th>
                                <th scope="col">방어력</th>
                                <th scope="col">공격력</th>
                                <th scope="col">마력</th>
                                <th scope="col">HP</th>
                                <th scope="col">MP</th>
                            </thead>
                            <tbody id="history-table">
                            </tbody>   
                        </table>
                    </div>
                    <div
                        class="tab-pane fade container-fluid"
                        id="pills-sell"
                        role="tabpanel"
                        aria-labelledby="pills-sell-tab">
                        <div class="row">
                            <div class="col-md-6 inner-left col-xs-0">
                                <div class="sell-tab-top">
                                    <!-- inventory 판매 -->
                                    <?php if($inventory_list) : $view_make_table -> inventoryTable($inventory_list); endif;?>
                                </div>
                                <div class="container-fluid sell-tab-bottom">
                                    <form action="action/action_sell.php" method="POST">
                                        <div class="row">
                                            <div class="col-3 clicked-item">
                                                <img class="selected-item">
                                            </div>
                                            <div class="col-6">
                                                <div class="d-grid">
                                                    <div class="my-1 selected-itemName"><p></p></div>
                                                </div>
                                                <input class="form-control my-1" type="number" placeholder="판매금액" min="50" max="500000000" name="sell_price" required></input>
                                            </div>
                                            <div class="col-3 position-relative">
                                            <input type="hidden" id="hidden_sell_item" name="sell_item">
                                                <button id ="sell_button"
                                                    class="btn btn-primary position-absolute top-50 start-50 translate-middle"
                                                    type="submit" disabled="disabled">판매
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-6 inner-right col-xs-0">
                                <table class="table table-striped">
                                    <thead>
                                        <th scope="col">#</th>
                                        <th scope="col">이름</th>
                                        <th scope="col">가격</th>
                                        <th scope="col">Level</th>
                                        <th scope="col">힘</th>
                                        <th scope="col">인트</th>
                                        <th scope="col">방어력</th>
                                        <th scope="col">공격력</th>
                                        <th scope="col">마력</th>
                                        <th scope="col">HP</th>
                                        <th scope="col">MP</th>
                                    </thead>
                                    <?php if($selling_list) : $view_make_table->sellingTable($selling_list); endif;?>
                                </table> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- 구매 div -->
        <div class="col buy-tab">
            <div class="row">
                <div class="col-md-8 col-xs-8"></div>
                <div class="col-md-1 col-xs-1 bottom-image"><img id="buy-item-image"></div>
                <div class="col-md-1 col-xs-1 bottom-desc">
                    <p><h6 id="buy-item-name">아이템 이름</h6></p>
                    <p><h6 id="buy-itme-price">가격</h6></p>
                </div>
                <div class="col-md-2 col-xs-2 bottom-button">
                <form action="action/action_buy_item.php" method="PATCH">
                    <input type="hidden" id="auction_no" name="auction_no">
                    <input type="hidden" id="user_no" name="user_no">
                    <input type="hidden" id="session_no" name="session_no">
                    <button type="button" id="history_search" class="btn btn-primary">시세 검색</button>
                    <button type="submit" id="buy_item" class="btn btn-danger" >구매 하기</button>
                </form>
                </div>
            </div>
        </div>  
        <script src="http://code.jquery.com/jquery-latest.min.js"></script>
        <script type="text/javascript" src="bootstrap5/js/bootstrap.bundle.js"></script>
        <script type="text/javascript" src="main_index/js/changeTapSize.js?ver=210518"></script>
        <script type="text/javascript" src="main_index/js/requestLogin.js?ver=210503"></script>
        <script type="text/javascript" src="main_index/js/changeSelecterOptions.js?ver=210518"></script>
        <script type="text/javascript" src="main_index/js/clickItem.js?ver=2105041104"></script>
        <script type="text/javascript" src="main_index/js/searchAjax.js?ver=210518"></script>
        <script type="text/javascript" src="main_index/js/buyItems.js?ver=210518"></script>
    </body>  
</html>