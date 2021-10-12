
/*
네비게이션 바의 탭 클릭시 상세검색 div 포지션 변경
*/

function changeTabPosition(){
    const searchTab = document.getElementById("pills-search-tab");
    const historyTab = document.getElementById("pills-history-tab");
    
    const existActiveSearchTab = searchTab.classList.contains("active"); //active 확인
    const existActiveHistoryTab = historyTab.classList.contains("active"); 
    
    const detailedTab = document.querySelector("#detailed-div"); //classlist col-sm-4
    const contentTab = document.querySelector("#pills-tabContent"); //classlist col-sm-8

    if(sessionStorage.getItem("logon") == "true"){ //로그인 확인
        
        if(existActiveSearchTab || existActiveHistoryTab){
            detailedTab.classList.add("col-sm-4");
            contentTab.classList.add("col-sm-8");
            document.getElementById("detailed-div").style.display = "";
    
        }else{
             document.getElementById("detailed-div").style.display = "none";
            detailedTab.classList.remove("col-sm-4");
            contentTab.classList.remove("col-sm-8");
        }
    }
   
}

function clickPillsTab(){
    const pills = document.querySelector("#pills-tab");
    pills.addEventListener("click",changeTabPosition);
}

clickPillsTab();