let icons = [];

function find(event) {
    event.preventDefault();
    let text = document.querySelector("[type=search]");
    if (document.getElementById(text.value.toLowerCase()) !== null) {
        window.location.href = window.location.pathname + "#" + text.value.toLowerCase();
    }
}

function sort() {
    let arr = document.querySelector("#tovar").children;
    if (this.value === "0") {
        for (let i of arr) {
            i.style.order = 0;
        }
    } else {
        let j = 0;
        for (let i of arr) {
            i.style.order = j;
            j--;
        }
    }
}

window.addEventListener("DOMContentLoaded", function () {
    document.body.style.backgroundImage = "url(../source/BG.jpg)";
    list = document.querySelector("#datalistOptions");
    const cards = [
    ];
    for (let i = 0; i < sessionStorage.length; i++) {
        const key = sessionStorage.key(i);
        const scard = JSON.parse(sessionStorage.getItem(key));
        const zcard = cards.find(card => card.name === key);
        zcard.cartArr = scard.cartArr;
    }
    document.querySelectorAll(".interact").forEach(function (i) {
        i.contentWindow.addEventListener("DOMContentLoaded", function () {
            let svg = this.document.querySelector("path");
            this.document.addEventListener("click", function () {
                let path = this.querySelector("path");
                let clist = path.classList;
                let animal = i.classList[1];
                clist.toggle("selected");
                if (clist.value === "selected") {
                    path.attributes["fill"].value = "#44AEE8";
                    icons.push(animal);
                } else {
                    path.attributes["fill"].value = "black";
                    icons.pop(animal);
                }
                cards.forEach(function (j) {
                    let cardblock = j.element.parentElement;
                    if (icons.every(k=>j.animalsArr.includes(k))) {
                        cardblock.classList.remove("d-none");
                    } else {
                        cardblock.classList.add("d-none");
                    }
                });
            });
        });
    });
    let fish = document.querySelector(".fish");
    fish.classList.add("selected");
    icons.push("fish");
    document.querySelector(".find").addEventListener("submit", find);
    document.querySelector(".form-select").addEventListener("change", sort);
    document.querySelector("#detalno").addEventListener("hidden.bs.modal", function () {
        if (history.state !== null) {
            history.back();
        }
    });
    window.addEventListener("popstate", function () {
        const elemModal = document.querySelector(".modal");
        const modal = bootstrap.Modal.getOrCreateInstance(elemModal);
        modal.hide();
    });
});