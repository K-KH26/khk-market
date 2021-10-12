const title = document.querySelector("#title");

const CLICK_CLASS = "clicked";

function handClick(){
    
    let is = title.classList.toggle(CLICK_CLASS);
    console.log(is);

}

function init(){
    title.addEventListener("click", handClick);
}

init();