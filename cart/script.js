window.addEventListener("DOMContentLoaded", function () {
    document.body.style.backgroundImage = "url(../source/BG.jpg)";
    const cards = document.querySelector("#cards");
    const row = cards.children[0].cloneNode(true);
    cards.innerHTML = '';
    const elDate = document.querySelector("input[type=date]");
    elDate.value = new Date().toLocaleDateString("en-CA");
    if (sessionStorage.length == 0) {
        return;
    }
    const evileye = document.querySelector("#evileye");
    evileye.classList.remove("d-block");
    evileye.classList.add("d-none");
    let sum = 0;
    for (let i = 0; i < sessionStorage.length; i++) {
        let key = sessionStorage.key(i);
        let obj = JSON.parse(sessionStorage.getItem(key));
        let newrow = row.cloneNode(true);
        newrow.querySelector("img").src = "../" + obj.img;
        newrow.querySelector("h3").innerHTML = key;
        const origrow = newrow.querySelector("div.row");
        const parentrow = origrow.parentElement;
        const inforow = origrow.cloneNode(true);
        //parentrow.re

        cards.appendChild(newrow);
    }
});