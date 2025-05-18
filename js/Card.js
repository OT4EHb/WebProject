let list;

class Card {
    constructor(name, opisanie, img, grammArr, priceArr, animalsArr, element) {
        this.cartArr = new Array(grammArr.length).fill(0);
        this.name = name;
        this.opisanie = opisanie;
        this.img = img;
        this.grammArr = grammArr;
        this.priceArr = priceArr;
        this.animalsArr = animalsArr;
        if (element === null) {
            let tovar = document.getElementById("tovar");
            let cardi = tovar.children[0].cloneNode(true);
            tovar.appendChild(cardi);
            this.element = cardi.children[0];
        } else {
            this.element = element;
        }
        let body = this.element.children[1];
        body.children[1].addEventListener("click", this.createModal.bind(this));
        this.update(body);
    }

    update(body) {
        let option = document.createElement("option");
        option.value = this.name;
        list.appendChild(option);
        this.element.id = this.name.toLowerCase();
        this.element.children[0].src = this.img;
        body.children[0].innerHTML = this.name;
    }

}