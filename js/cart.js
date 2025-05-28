window.addEventListener("DOMContentLoaded", function () {
    document.body.style.backgroundImage = "url(source/BG.jpg)";
    const cards = document.querySelector("#cards").children;
    const elDate = document.querySelector("input[type=date]");
    if (elDate.value == "")
        elDate.value = new Date().toLocaleDateString("en-CA");
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
        let response = fetch('?q=cart', {
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
                let res = await r.json();
                if (r.ok) {
                    nouspex.classList.add("d-none");
                    uspex.classList.remove("d-none");
                    uspex.innerHTML = "<h3>Спасибо за заказ! " + (res.auth == null ? '' : "Стоимость составила: " + res.cost +
                        "руб<br>Вы можете изменить данные формы:" +
                        "<br>Ваш логин: " + res.auth.login + "<br>Ваш пароль: " + res.auth.password)
                        + "</h3>";
                    sessionStorage.clear();
                    cards.innerHTML = '';
                    document.querySelector("form").classList.add("d-none");
                    document.querySelector(".zakaz").classList.add("d-none");
                } else {
                    nouspex.classList.remove("d-none");
                    nouspex.textContent = '';
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