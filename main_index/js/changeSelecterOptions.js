
/**
 *아이템 분류를 선택하면서 선택조건이 변경된다.
*/
const selectFirst = document.getElementById("select-first");
const selectSecond = document.getElementById("select-second");
const selectThird = document.getElementById("select-third");
let firstSelectValue = selectFirst.options[selectFirst.selectedIndex].value; //기본 value값

//첫번째 select 값에 따라 두번재 select를 바꾸는 함수
function changeOption(){
   firstSelectValue = selectFirst.options[selectFirst.selectedIndex].value; //변경된 value값

   let secondOptions = {
       all : ['전체'],
       armor : ['전체','모자','상의','하의','신발'],
       weapon : ['전체','검','창','스태프','완드'],
       accessories : ['전체','귀고리','반지','목걸이']
   };
   let secondOptionsValues = {
    all : ['all'],
    armor : ['all','hat','top','pants','shoes'],
    weapon : ['all','sword','spear','staff','wand'],
    accessories : ['all','earrings','rings','necklace']
};

    selectSecond.options.length = 0; //두번째 select 초기화

   switch(firstSelectValue){
    case 'all' :
        secondOptions.all;
        secondOptionsValues.all;
        changeSecondOptions(secondOptions.all, secondOptionsValues.all);
        break;
    case 'armor' :
        secondOptions.armor;
        secondOptionsValues.armor;
        changeSecondOptions(secondOptions.armor, secondOptionsValues.armor);
        console.log(secondOptions.armor);
        break;

    case 'weapon' : 
        secondOptions.weapon;
        secondOptionsValues.weapon;
        changeSecondOptions(secondOptions.weapon,secondOptionsValues.weapon);
        console.log(secondOptions.weapon);
        break;

    case 'accessories' : 
        secondOptions.accessories;
        secondOptionsValues.accessories;
        changeSecondOptions(secondOptions.accessories,secondOptionsValues.accessories);
        console.log(secondOptions.accessories);
        break;
   }

}


//두번째 옵션 생성 함수
function changeSecondOptions(secondOptions, optinosValues){
    for(var i = 0 ; i < secondOptions.length; i++ ){
        var options = document.createElement('option');
        options.innerText = secondOptions[i];
        options.value = optinosValues[i];
        selectSecond.append(options);
    }
}