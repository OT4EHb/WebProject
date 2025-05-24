window.addEventListener("DOMContentLoaded", function () {
    document.body.style.backgroundImage = "url(../source/BG.jpg)";
    const cards = document.querySelector("#cards").children;
    const elDate = document.querySelector("input[type=date]");
    elDate.value = new Date().toLocaleDateString("en-CA");
    let sum = 0;
    for (let i = 0; i < cards.length;i++) {
        let obj = cards[i].children[1].children;
        let sumi = 0;
        for (let j = 0; j < obj.length; j++) {
            let erst = obj[j].children;
            sumi += Number(erst[1].textContent.split(' ')[0])
                * Number(erst[2].textContent.split(' ')[0]);
        }
        sum += sumi;
    }
    elDate.nextElementSibling.value = sum + " руб";
    document.querySelector("form").addEventListener("submit", function (event) {
        event.preventDefault();
        const button = this.querySelector(".btn");
        if (button.disabled) {
            return;
        }
        button.disabled = true;
        let inputs = document.querySelectorAll("form > *");
        let Cart = {};
        inputs.forEach(function (i) {
            if (i.name !== "") {
                Cart[i.name] = i.value;
            }
        });
        let response = fetch('/?q=cart', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(Cart)
        });
        const nouspex = document.querySelector(".nouspex");
        const uspex = document.querySelector(".uspex");
        response.then(async r => {
            try {
                if (r.ok) {
                    nouspex.classList.add("d-none");
                    uspex.classList.remove("d-none");
                    sessionStorage.clear();
                    cards.innerHTML = '';
                    document.querySelector("form").classList.add("d-none");
                    document.querySelector(".zakaz").classList.add("d-none");
                } else {
                    nouspex.classList.remove("d-none");
                    nouspex.textContent = '';
                    let res = await r.json();
                    for (let i in res) {
                        nouspex.innerHTML += res[i] + '<br>';
                    }
                }
            }
            finally {
                button.disabled = false;
            }
        });
    });
});