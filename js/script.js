let icons = [];
window.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".interact").forEach(function (i) {
        i.contentWindow.addEventListener("DOMContentLoaded", function () {
            let svg = this.document.querySelector("path");
            icons.push(svg);
            svg.addEventListener("click", function () {
                let list = this.classList;
                list.toggle("selected");
                if (list.value === "selected") {
                    this.attributes["fill"].value = "#44AEE8";
                } else {
                    this.attributes["fill"].value = "black";
                }
            });
        });
    });
});