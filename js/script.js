let icons = [];

function find(event) {
    event.preventDefault();
    let text = document.querySelector("[type=search]");
    if (document.getElementById(text.value.toLowerCase()) !== null) {
        window.location.href = window.location.pathname + "#" + text.value.toLowerCase();
    }
}

window.addEventListener("DOMContentLoaded", function () {
    list = document.getElementById("datalistOptions");
    const card = [
        new Card(
            "Дафния",
            "это база",
            "source/card/1.jpeg",
            [10, 20, 180, 450],
            [15, 26, 240, 585],
            ["fish", "turtle", "bird"],
            document.querySelector(".card")),
        new Card(
            "Гаммарус",
            "это базовая база",
            "source/card/2.jpeg",
            [10, 20],
            [50, 100],
            ["fish", "turtle"],
            null),
        new Card(
            "Креветка",
            "это для тех кто любит побольше",
            "source/card/3.jpeg",
            [10, 20],
            [50, 100],
            ["fish", "turtle", "spider", "bird"],
            null),
        new Card(
            "Лакомка",
            "50% - дафния, 50% - мотыль",
            "source/card/4.jpeg",
            [10, 20],
            [50, 100],
            ["fish"],
            null),
        new Card(
            "Артемия",
            "для тех кто любит поменьше",
            "source/card/5.jpeg",
            [10, 20],
            [50, 100],
            ["fish"],
            null),
        new Card(
            "Гурман",
            "для гурманов, очевидно",
            "source/card/6.jpeg",
            [10, 20],
            [50, 100],
            ["fish"],
            null),
        new Card(
            "Оптима",
            "50% - дафния, 50% - гаммарус",
            "source/card/7.jpeg",
            [20],
            [22],
            ["fish"],
            null),
        new Card(
            "Мотыль",
            "нахуй нам тут вообще сдался текст",
            "source/card/8.jpeg",
            [20],
            [38],
            ["fish"],
            null),
        new Card(
            "Старт",
            "50% - дафния, 50% - опарыш",
            "source/card/9.jpeg",
            [20],
            [22],
            ["fish"],
            null),
        new Card(
            "Анчоус",
            "начало начал",
            "source/card/10.jpeg",
            [20, 400, 800],
            [40, 800, 1600],
            ["fish", "turtle"],
            null),
        new Card(
            "Чёрная львинька",
            "знать не хочу что это вообще такое",
            "source/card/11.jpeg",
            [20, 250, 500],
            [20, 250, 500],
            ["fish", "turtle", "bird"],
            null),
        new Card(
            "Хлопья для тропических рыб",
            "немо",
            "source/card/12.jpeg",
            [10, 250, 500],
            [20, 500, 1000],
            ["fish"],
            null),
        new Card(
            "Хлопья для золотых рыб",
            "Полагаю имеются ввиду рыбки Мидаса",
            "source/card/13.jpeg",
            [10, 250, 500],
            [20, 500, 1000],
            ["fish"],
            null),
        new Card(
            "Рацион",
            "-/(8-8)\\-",
            "source/card/14.jpeg",
            [20],
            [20],
            ["fish"],
            null),
        new Card(
            "Гладыш",
            "Поймай меня, если сможешь",
            "source/card/15.jpeg",
            [20],
            [15],
            ["fish", "bird"],
            null),
        new Card(
            "Гранулы",
            "следующие 4 по хорошему отдельно",
            "source/card/16.jpeg",
            [1000, 4000],
            [500, 2000],
            ["fish"],
            null),
        new Card(
            "Ассорти",
            "берем сначал укропу...",
            "source/card/17.jpeg",
            [1000, 4000],
            [620, 2480],
            ["fish"],
            null),
        new Card(
            "Палочки",
            "Гарри Поттер?",
            "source/card/18.jpeg",
            [500, 1000, 2000],
            [500, 1000, 2000],
            ["fish"],
            null),
        new Card(
            "Класс Карпа",
            "И тут ООП : (",
            "source/card/19.jpeg",
            [40],
            [24],
            ["fish"],
            null)
    ];

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