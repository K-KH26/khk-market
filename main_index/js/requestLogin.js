/**
 * 판매 탭을 클릭했을 경우 로그인이 되어있지 않을때 로그인을 요청한다.
*/

const pillsSellTab = document.getElementById("pills-sell-tab");         //판매 탭

function requestLogin(){
    alert('로그인 후 이용할 수 있습니다.');
    location.href="../login.php";
}

function clickRequestLoginTab(){
    if(sessionStorage.getItem("logon") !== "true"){ //로그인 안되어있을 때 
        pillsSellTab.addEventListener("click",requestLogin);
    }
}

clickRequestLoginTab();