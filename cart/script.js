window.addEventListener("DOMContentLoaded", function () {
    document.body.style.backgroundImage = "url(../source/BG.jpg)";
    const cards = document.querySelector("#cards");
    const row = cards.children[0].cloneNode(true);
    cards.innerHTML = '';
    const elDate = document.querySelector("input[type=date]");
    elDate.value = new Date().toLocaleDateString("en-CA");
    if (sessionStorage.length == 0) {
        document.querySelector("form").addEventListener("submit", function (event) {
            event.preventDefault();
        });
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
        parentrow.removeChild(origrow);
        let sumi = 0;
        for (let j = 0; j < obj.cartArr.length; j++) {
            sumi += obj.cartArr[j] * obj.priceArr[j];
            const currentrow = origrow.cloneNode(true);
            currentrow.children[0].innerHTML = obj.priceArr[j] + "руб";
            currentrow.children[1].innerHTML = obj.cartArr[j] + "штук";
            parentrow.appendChild(currentrow);
        }
        sum += sumi;
        origrow.children[0].innerHTML = "Итого: ";
        origrow.children[1].innerHTML = sumi + "руб";
        parentrow.appendChild(origrow);
        cards.appendChild(newrow);
    }
    elDate.nextElementSibling.value = sum + "руб";
    document.querySelector("form").addEventListener("submit", function (event) {
        event.preventDefault();
        const button = this.querySelector(".btn");
        if (button.disabled) {
            return;
        }
        button.disabled = true;
        let httpRequest = new XMLHttpRequest();
        //временный адрес
        httpRequest.open("POST", "https://formcarry.com/s/77refVsM9Xy");
        httpRequest.setRequestHeader("Content-Type", "application/json");
        httpRequest.setRequestHeader("Accept", "application/json");
        let obj = {};
        let inputs = document.querySelectorAll("form > *");
        inputs.forEach(function (i) {
            if (i.name !== "") {
                obj[i.name] = i.value;
            }
        });
        httpRequest.send(JSON.stringify(obj));
        httpRequest.onreadystatechange = function () {
            if (this.readyState === 4) {
                const nouspex = document.querySelector(".nouspex");
                const uspex = document.querySelector(".uspex");
                if (this.status === 200) {
                    nouspex.classList.add("d-none");
                    uspex.classList.remove("d-none");
                    sessionStorage.clear();
                    cards.innerHTML = '';
                    document.querySelector("form").classList.add("d-none");
                    document.querySelector(".zakaz").classList.add("d-none");
                } else {
                    nouspex.classList.remove("d-none");
                }
                button.disabled = false;
            }
        };
    });
});