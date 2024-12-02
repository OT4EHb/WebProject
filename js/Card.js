let list;

class Card {
    constructor(name, opisanie, img, grammArr, priceArr, element) {
        this.name = name;
        this.opisanie = opisanie;
        this.img = img;
        this.grammArr = grammArr;
        this.priceArr = priceArr;
        if (element === null) {
            let tovar = document.getElementById("tovar");
            let cardi = tovar.children[0].cloneNode(true);
            tovar.appendChild(cardi);
            this.element = cardi.children[0];
        } else {
            this.element = element;
        }
        this.update();
    }

    update() {
        let option = document.createElement("option");
        option.value = this.name;
        list.appendChild(option);
        this.element.id = this.name.toLowerCase();
        this.element.children[0].src = this.img;
        let body = this.element.children[1];
        body.children[0].innerHTML = this.name;
        body.children[1].innerHTML = this.opisanie;
    }
}