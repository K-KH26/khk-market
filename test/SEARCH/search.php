<?php

/**컨트롤러
 * 요청사항을 확인 (ex. 빠른검색, 세부검색)
 * 모델에서 데이터를 가져온다
*/

if(isset($_GET['quick'])){  //빠른검색

    include ('SearchModel.php'); //데이터 받아오기
    $quickModel = new SearchModel;
    $list = $quickModel->quickSearch($_GET['quick']);

    include ('search-items.php');
    
}