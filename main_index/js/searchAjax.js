/**
 * ajax 게시글 불러오기
 * 빠른검색
 * 세부검색
*/


function searchQuick(){
    let current = currentTabPosition();
    if(current == "true"){
        $.ajax({
            url: '/action/action_search.php',
            type : 'get',
            data : $('.quick_form').serialize(),
            dataType: 'html'
        }).done(function(data){
            $('#quick-table').empty();
            $("#quick-table").append(data);
        });
    }else if (current == "false"){
        $.ajax({ 
            url: '/action/action_history_search.php',
            type : 'get',
            data : $('.quick_form').serialize(),
            dataType: 'html'
        }).done(function(data){
            $('#history-table').empty();
            $("#history-table").append(data);
        });
    }

}

function searchDetail(){
    let current = currentTabPosition();
    if(current == "true"){
        $.ajax({
            url: '/action/action_detail_search.php',
            type : 'get',
            data : $('.detail_form').serialize()
        }).done(function(data){
            $('#quick-table').empty();
            $("#quick-table").append(data);
        });
    }else if(current == "false"){
        $.ajax({
            url: '/action/action_history_detail_search.php',
            type : 'get',
            data : $('.detail_form').serialize()
        }).done(function(data){
            $('#history-table').empty();
            $("#history-table").append(data);
        });
    }
    
}

function currentTabPosition(){
    const search = document.getElementById("pills-search-tab");
    let current = search.getAttribute("aria-selected");

    return current;
}