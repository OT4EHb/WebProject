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

    createModal() {
        let detalno = document.getElementById("detalno");
        detalno.querySelector(".modal-title").textContent = this.name;
        detalno.querySelector(".opisanie").textContent = this.opisanie;
        let container = detalno.querySelector(".container-fluid");
        let row = container.children[0].cloneNode(true);
        container.textContent = '';
        container.appendChild(row);
        this.fillModal(row, 0);        
        for (let i = 1; i < this.grammArr.length; i++) {            
            let newrow = row.cloneNode(true);
            container.appendChild(newrow);
            this.fillModal(newrow, i);
        }
        window.history.pushState({ modal: "true" }, "", "#" + this.name);
    }

    fillModal(row, index) {
        row.children[0].textContent = this.grammArr[index] + "гр";
        row.children[1].textContent = this.priceArr[index] + "руб";   
        row.children[2].addEventListener("click", function () {
            if (this.cartArr[index] > 0) {
                this.cartArr[index] -= 100;
                row.children[3].innerHTML = this.cartArr[index];
                sessionStorage.setItem(this.name, JSON.stringify(this));
            }
        }.bind(this));
        row.children[4].addEventListener("click", function () {
            this.cartArr[index] += 100;
            row.children[3].innerHTML = this.cartArr[index];
            sessionStorage.setItem(this.name, JSON.stringify(this));
        }.bind(this));
    }
}