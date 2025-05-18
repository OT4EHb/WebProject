let icons = [];
let Cart = {};

function createModal() {
    let detalno = document.getElementById("detalno");
    const info = this.parentElement.nextElementSibling;
    detalno.querySelector(".modal-title").textContent =
        this.parentElement.parentElement.id;
    detalno.querySelector(".opisanie").textContent =
        info.children[0].textContent;
    let container = detalno.querySelector(".container-fluid");
    let row = container.children[0].cloneNode(true);
    container.textContent = '';
    container.appendChild(row);
    let arr = info.children[1].textContent.split(', ');
    let erst = arr[0].split(':');
    let name = this.previousElementSibling.textContent;
    fillModal(row, Number(erst[0]), Number(erst[1]), name);
    for (let i = 1; i < arr.length; i++) {
        let newrow = row.cloneNode(true);
        container.appendChild(newrow);
        erst = arr[i].split(':');
        fillModal(newrow, Number(erst[0]), Number(erst[1]), name);
    }
    window.history.pushState({ modal: "true" }, "", "#" + name);
}

function fillModal(row, gramm, price, name) {
    if (Cart[name] == null) Cart[name] = {};
    if (Cart[name][gramm] == null)
        Cart[name][gramm] = 0;
    row.children[0].textContent = gramm + "гр";
    row.children[1].textContent = price + "руб";
    row.children[3].innerHTML = Cart[name][gramm];
    row.children[2].addEventListener("click", function () {
        if (Cart[name][gramm] > 0) {
            Cart[name][gramm] -= 100;
            row.children[3].innerHTML = Cart[name][gramm];
            if (Cart[name].every(x => x === 0)) {
                sessionStorage.removeItem(name);
            }
        }
    });
    row.children[4].addEventListener("click", function () {
        Cart[name][gramm] += 100;
        row.children[3].innerHTML = Cart[name][gramm];
    });
}

function find(event) {
    event.preventDefault();
    let text = document.querySelector("[type=search]");
    let id = text.value.toLowerCase();
    id = id.charAt(0).toUpperCase() + id.slice(1);
    console.log(document.getElementById(id));
    if (document.getElementById(id) !== null) {
        window.location.href = window.location.pathname + "#" + id;
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
    const cards = document.querySelectorAll(".card");
    cards.forEach(i => {
        i.children[1].children[1].addEventListener('click', createModal);
    });
    //for (let i = 0; i < sessionStorage.length; i++) {
    //    const key = sessionStorage.key(i);
    //    const scard = JSON.parse(sessionStorage.getItem(key));
    //    const zcard = cards.find(card => card.name === key);
    //    zcard.cartArr = scard.cartArr;
    //}
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
                    let cardblock = j;
                    if (icons.every(k=>Array.from(j.classList).includes(k))) {
                        cardblock.parentElement.classList.remove("d-none");
                    } else {
                        cardblock.parentElement.classList.add("d-none");
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