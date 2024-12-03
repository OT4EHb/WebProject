let icons = [];

function find(event) {
    event.preventDefault();
    let text = document.querySelector("[type=search]");
    if (document.getElementById(text.value.toLowerCase()) !== null) {
        window.location.href = window.location.pathname + "#" + text.value.toLowerCase();
    }
}

window.addEventListener("DOMContentLoaded", function () {
    list = document.getElementById("datalistOptions");
    const card = [
        new Card(
            "Дафния",
            "текст",
            "source/card/1.jpeg",
            [10, 20],
            [50, 100],
            document.querySelector(".card")),
        new Card(
            "Гаммарус",
            "текст",
            "source/card/2.jpeg",
            [10, 20],
            [50, 100],
            null),
        new Card(
            "Креветка",
            "текст",
            "source/card/3.jpeg",
            [10, 20],
            [50, 100],
            null),
        new Card(
            "Лакомка",
            "текст",
            "source/card/4.jpeg",
            [10, 20],
            [50, 100],
            null),
        new Card(
            "Артемия",
            "текст",
            "source/card/5.jpeg",
            [10, 20],
            [50, 100],
            null),
        new Card(
            "Гурман",
            "текст",
            "source/card/6.jpeg",
            [10, 20],
            [50, 100],
            null)
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