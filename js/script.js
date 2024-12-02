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
            "source/card/1.jpg",
            [10, 20],
            [50, 100],
            document.querySelector(".card")),
        new Card(
            "Черная Львинка",
            "текст",
            "source/card/2.jpg",
            [10, 20],
            [50, 100],
            null),
        new Card(
            "Корм3",
            "текст",
            "source/card/3.jpg",
            [10, 20],
            [50, 100],
            null),
        new Card(
            "Корм4",
            "текст",
            "source/card/4.jpg",
            [10, 20],
            [50, 100],
            null),
        new Card(
            "Корм5",
            "текст",
            "source/card/5.jpg",
            [10, 20],
            [50, 100],
            null),
        new Card(
            "Корм6",
            "текст",
            "source/card/6.jpg",
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