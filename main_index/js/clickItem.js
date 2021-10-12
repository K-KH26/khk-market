/***
 * 
 * 인벤토리의 클릭된 아이템 정보 담기
 * 
*/

$("#item-table .itemlist").click(function(){
    let itemIndex = $("#item-table td").index(this);
    // console.log(itemIndex);
    clickedTableItem(itemIndex);
});

function clickedTableItem(index){

    const itemlist = document.getElementsByClassName('itemlist');
    let column = itemlist[index].dataset.columns
    let itemName = itemlist[index].dataset.itemname;
    
    let imgsrc = itemlist[index].childNodes[1].getAttribute('src') ;    //선택 img소스
    const clickedDiv = document.querySelector('.clicked-item');         //부모 div
    const itemNameDiv = document.querySelector('.selected-itemName');

    const sellInput = document.getElementById("hidden_sell_item"); 
    sellInput.value = column;                                           //column number form-post

    const sellButton = document.getElementById("sell_button");          //버튼 활성화
    sellButton.disabled = false;
    
    refreshItemImg(clickedDiv,imgsrc);
    refreshItemName(itemNameDiv,itemName);

}

function refreshItemImg(parentDiv,imgsrc){
    
    const imgTag = document.querySelector('.selected-item'); //삭제img
    parentDiv.removeChild(imgTag);

    let clickedItem = document.createElement('img'); // img생성
    clickedItem.classList = "selected-item";
    clickedItem.src = imgsrc;
    parentDiv.append(clickedItem);
}

function refreshItemName(parentDiv,newItemName){

    const itemNameTag = parentDiv.firstChild; //삭제태그
    // console.log(itemNameTag);
    parentDiv.removeChild(itemNameTag);

    let clickedItemName = document.createElement('p');//p태그
    clickedItemName.innerHTML = newItemName;
    
    parentDiv.append(clickedItemName);
}
