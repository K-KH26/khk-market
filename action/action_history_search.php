<?php
/**
 * 시세 검색
 * contoller
*/

error_reporting(E_ALL);
ini_set("display_errors",1);

//검색 필터링
if(filter_has_var(INPUT_GET, "quick_search")){

    $input_quick = filter_input(INPUT_GET,"quick_search",FILTER_SANITIZE_STRING);

    //리스트 불러오기
    include ('../main_index/MODEL/SearchList.php');
    $search_list = new SearchList;
    $history_list = $search_list->getQuickHistoryList($input_quick);

    include ('../main_index/VIEW/view-search.php');
    $make_table = new ViewSearch;

    /** 불러온 리스트로 테이블 view만들기 */
    if($history_list){   
        $quick_table = $make_table->makeHistoryTable($history_list);
    }else{
        $quick_table = $make_table->emptyAnnounceDiv();
    }

}else{ ?>
<script >
    alert('잘못된 입력입니다');
    location.replace('/index.php');
</script>
<?php
}