//
function reklama() {
    let myToastEl = document.getElementById("liveToast");
    let myToast = bootstrap.Toast.getOrCreateInstance(myToastEl);
    if (myToast["_element"].classList[2] !== "show") {
        myToast.show();
    }
}
//

let icons = [];
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
                        //фильтрация
                        ;
                    }
                });
            });
        });
    });

    //
    setInterval(reklama, 10000);
    //
});