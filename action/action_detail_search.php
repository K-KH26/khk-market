<?php
/**
 * controller
 * 디테일 검색 
 * 필터링 이후 검색 sql리스트 불러오기
 * view 생성하기
*/

error_reporting(E_ALL);
ini_set("display_errors",1);

//세부 검색 목록 입력값 필터링
include ('../action/action_detail_filter.php');
$detail_filter = new DetailFilter;
$input_detailsearch_list = array(
    "category",
    "detail_category",
    "class",
    "detail_name",
    "detail_level_min",
    "detail_level_max",
    "detail_price_min",
    "detail_price_max",
    "detail_option",
    "detail_option_min"
);
$has_var = $detail_filter -> detailSearchCheck($input_detailsearch_list); // 유효성 확인


//모두 정상 유효일 경우 데이터 필터링, view 생성
if($has_var){

    $filters = $detail_filter->detailSearchFiltering();
    $detail_search_list = filter_input_array(INPUT_GET, $filters);

    /** 
     * sql문 작성, sql문 쿼리 execute
     * execute 이후 array 리스트 불러오기
    */
    include ('../main_index/MODEL/SearchList.php');
    $search_list = new SearchList;
    $detail_search_arraylist = $search_list->getDetailSearchList($detail_search_list);

    //리스트 Table view 생성하기
    include ('../main_index/VIEW/view-search.php');
    $view = new ViewSearch;
    if($detail_search_arraylist){
        $detail_table = $view->makeSearchTable($detail_search_arraylist);
    }else{
        $detail_table = $view ->emptyAnnounceDiv();
    }

    

}else{ //요구되는 GET 값이 없으므로 페이지 replace ?>
<script>
    alert('세부 검색 오류');
    location.replace('/index.php');
</script> 
<?php  
}

