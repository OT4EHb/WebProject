class Card {
    constructor (name, opisanie, img, grammArr, priceArr, element) {
        this.name = name;
        this.opisanie = opisanie;
        this.img = img;
        this.grammArr = grammArr;
        this.priceArr = priceArr;
        this.element = element;
        this.update();
    }

    update() {
        this.element.id = this.name;
        this.element.children[0].src = this.img;
        console.log(this.element.children[0]);
        let body = this.element.children[1];
        body.children[0].innerHTML = this.name;
        body.children[1].innerHTML = this.opisanie;
    }
}

let icons = [];

function find(event) {
    event.preventDefault();
    let text = document.querySelector("[type=search]");
    if (document.getElementById(text.value) !== null) {
        window.location.href = window.location.pathname + "#" + text.value;
    }
}

window.addEventListener("DOMContentLoaded", function () {
    const card = [
        new Card(
            "Дафния",
            "текст",
            "source/card/1.jpg",
            [10, 20],
            [50, 100],
            document.querySelectorAll(".card")[0]),
        new Card(
            "Черная Львинка",
            "текст",
            "source/card/2.jpg",
            [10, 20],
            [50, 100],
            document.querySelectorAll(".card")[1]),
        new Card(
            "Корм3",
            "текст",
            "source/card/3.jpg",
            [10, 20],
            [50, 100],
            document.querySelectorAll(".card")[2]),
        new Card(
            "Корм4",
            "текст",
            "source/card/4.jpg",
            [10, 20],
            [50, 100],
            document.querySelectorAll(".card")[3]),
        new Card(
            "Корм5",
            "текст",
            "source/card/5.jpg",
            [10, 20],
            [50, 100],
            document.querySelectorAll(".card")[4]),
        new Card(
            "Корм6",
            "текст",
            "source/card/6.jpg",
            [10, 20],
            [50, 100],
            document.querySelectorAll(".card")[5])
    ];

    document.querySelectorAll(".interact").forEach(function (i) {
        i.contentWindow.addEventListener("DOMContentLoaded", function () {
            let svg = this.document.querySelector("path");
            icons.push(svg);
            this.document.addEventListener("click", function () {
                let path = this.querySelector("path");
                let list = path.classList;
                list.toggle("selected");
                if (list.value === "selected") {
                    path.attributes["fill"].value = "#44AEE8";
                } else {
                    path.attributes["fill"].value = "black";
                }
                icons.forEach(function (i) {
                    if (i.classList.value === "selected") {
                        //filter
                        ;
                    }
                });
            });
        });
    });
    document.querySelector(".find").addEventListener("submit", find);
});