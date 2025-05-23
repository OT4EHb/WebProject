window.addEventListener("DOMContentLoaded", function () {
    document.body.style.backgroundImage = "url(../source/BG.jpg)";
    document.querySelector('#reg').addEventListener('click', e => {
        e.preventDefault();
        let response = fetch('/?q=register', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        });
        response.then(async r => {
            let info = document.querySelector('#info');
            let data = await r.json();
            info.innerHTML = "Ваш логин: " + data['login'] +
                "<br>Ваш пароль: " + data['password'];
            info.classList.remove('d-none');
            console.log(data);
        });
    });
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
            button.disabled = false;
        });
    });
});