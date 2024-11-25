let icons = [];

function find(event) {
    event.preventDefault();
    let text = document.querySelector("[type=search]");
    console.log(text.value);
}

window.addEventListener("DOMContentLoaded", function () {
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