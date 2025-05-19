let Cart = {
    cards: {}
};

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
        Cart.cards[key] = [];
        let obj = JSON.parse(sessionStorage.getItem(key));
        let newrow = row.cloneNode(true);
        newrow.querySelector("img").src = "/source/card/" + key+".jpg";
        const origrow = newrow.querySelector("div.row");
        const parentrow = origrow.parentElement;
        parentrow.removeChild(origrow);
        let sumi = 0;
        for (let j in obj) {
            let erst = obj[j];
            Cart.cards[key].push([j, erst[1]]);
            sumi += erst[0] * erst[1];
            const currentrow = origrow.cloneNode(true);
            currentrow.children[0].innerHTML = erst[0] + "руб";
            currentrow.children[1].innerHTML = erst[1] + "штук";
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
        httpRequest.open("POST", "/?q=cart");
        httpRequest.setRequestHeader("Content-Type", "application/json");
        httpRequest.setRequestHeader("Accept", "application/json");
        let inputs = document.querySelectorAll("form > *");
        inputs.forEach(function (i) {
            if (i.name !== "") {
                Cart[i.name] = i.value;
            }
        });
        httpRequest.send(JSON.stringify(Cart));
        console.log(Cart);
        
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