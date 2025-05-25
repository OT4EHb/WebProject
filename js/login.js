window.addEventListener("DOMContentLoaded", function () {
    document.body.style.backgroundImage = "url(../source/BG.jpg)";
    document.querySelector("form").addEventListener("submit", function (event) {
        event.preventDefault();
        const button = this.querySelector(".btn");
        if (button.disabled) {
            return;
        }
        button.disabled = true;
        let inputs = document.querySelectorAll("input");
        let obj = {};
        inputs.forEach(function (i) {
            if (i.name !== "") {
                obj[i.name] = i.value;
            }
        });
        let response = fetch('/?q=login', {
            method: 'POST',
            redirect: 'follow',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(obj)
        });
        const info = document.querySelector('#info');
        response.then(async r => {
            info.classList.remove('d-none');
            if (r.redirected) {
                window.location.href = r.url;
            } else {
                info.textContent = "Неверный логин или пароль";
            }
            button.disabled = false;
        });
    });
});