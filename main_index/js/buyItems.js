/***
 * 옥션 등록 판매되고 있는 아이템 클릭
 * 클릭 아이템 bottom 이미지 , 이름, 가격 변경
 * 
*/

$(".search-table").on('click','.auction-ing-item', function(){
    // console.log(this);
    const imgSrc = this.childNodes[1].firstChild.getAttribute('src');   //아이템 이미지
    const itemName = this.childNodes[3].innerHTML;                      //아이템 이름
    const itemPrice = this.childNodes[5].innerHTML;                     //아이템 가격
    const auctionID = this.dataset.auction;                             //dataset auction
    const userID = this.dataset.usr;                                    //dataset usr
    const sessionUserID = sessionStorage.getItem("user_id");            //세션 아이디 
    
    bottomImageChange(imgSrc);
    bottomItemNameChange(itemName);
    bottomItemPriceChange(itemPrice);
    bottomItemInfoChange(auctionID, userID, sessionUserID);
});

/** 옥션 클릭 이미지 변경 */
function bottomImageChange(imgSrc){
    let imgTag = document.getElementById("buy-item-image"); //기존 요소 찾기
    let parentDiv = imgTag.parentNode;
    // console.log(parentDiv);
    imgTag.remove();

    let clickedItem = document.createElement('img'); // img생성
    clickedItem.id = "buy-item-image";
    clickedItem.src = imgSrc;
    
    parentDiv.append(clickedItem);  //추가

}

/** 옥션 클릭 아이템 이름 변경 */
function bottomItemNameChange(itemName){
    let itemNameH6 = document.getElementById("buy-item-name");
    itemNameH6.innerHTML = itemName;
}

/** 옥션 클릭 아이템 가격 변경 */
function bottomItemPriceChange(itemPrice){
    let itemPriceH6 = document.getElementById("buy-itme-price");
    itemPriceH6.innerHTML = itemPrice;
}

/** 히든 인풋에 아이템정보와 현재 접속 유저 정보를 담는다 */
function bottomItemInfoChange(auctionID, userID, sessionID){
    let auctionNoInput = document.getElementById("auction_no");
    let userNoInput = document.getElementById("user_no");
    let sessionInput = document.getElementById("session_no");
   
    auctionNoInput.value = auctionID;
    userNoInput.value = userID;

    if(sessionID){
        sessionInput.value = sessionID;
    }
   

}