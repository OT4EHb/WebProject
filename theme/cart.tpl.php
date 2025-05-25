<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Корзина-ЮГ</title>
    <link rel="icon" href="/source/Logo.png" type="image/x-icon">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="js/cart.js" defer></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body class="container-fluid p-0">
    <header>
        <div class="row head">
            <div class="col-1">
                <img src="/source/Logo.png">
            </div>
            <?php 
            $col='col';
            if (empty($c['user'])){
                $col='col-1'; ?>
            <a class="col d-flex justify-content-end text-dark text-decoration-none" href=<?php print(conf('clean_urls')?'login':'?q=login')?>>
                <h2>Войти</h2>
            </a>
            <?php }?>
            <a class="<?php echo $col;?> d-flex justify-content-end" href="/">
                <img src="/source/icons/house-door.svg">
            </a>
        </div>
    </header>
    <main class="col-xl-8 col-lg-10 mx-auto">
        <div id="cards">
            <?php 
                require_once("cards.php");
                getCards($c);
                $cards=$c['card'];
                if (empty($cards)){ ?>                    
                <a href="/" class="btn btn-primary my-4 mx-auto d-block" id="evileye">
                    <h3 class="mb-0">Вы ничего не заказали,<br>бегом исправляться</h3>
                </a>
                <?php }
                else foreach($cards as $k => $v){ ?>
            <div class="row my-4">
                <div class="col-4 col-md-3 d-flex justify-content-center flex-column p-1">
                    <img src="/source/card/<?php print($k)?>.jpeg" class="rounded-5 w-100">
                </div>
                <div class="col-8 col-md-9 bg-primary text-white rounded-5 p-3 fs-5 bodycart">
                    <?php foreach($v as $pr=>$arr){?>
                    <div class="row">
                        <p class="col-4 col-md-3 my-1"><?php print($pr.' грамм')?></p>
                        <p class="col-4 col-md-3 my-1"><?php print($arr[0].' руб')?></p>
                        <p class="col-4 col-md-3 my-1"><?php print($arr[1].' штук')?></p>
                    </div>
                    <?php }?>
                </div>
            </div>
            <?php }?>
        </div>
        <h3 class="bg-danger text-center text-white my-2 rounded-5 d-none nouspex">Не успешно, повторите попытку</h3>
        <h3 class="text-center my-2 zakaz">Оформите заказ (Итоговая стоимость может отличаться):</h3>
        <form action="/" method="post" class="p-2 bg-primary rounded-5">
            <input placeholder="Название компании" name="company" required class="form-control mx-auto my-2">
            <input placeholder="ФИО заказчика" name="FIO" required class="form-control mx-auto my-2">
            <input type="tel" placeholder="Номер телефона" name="tel" required class="form-control mx-auto my-2">
            <input type="email" placeholder="Электронная почта" name="email" required class="form-control mx-auto my-2">
            <input type="date" name="date" disabled class="form-control mx-auto my-2">
            <input type="text" name="cost" disabled class="form-control mx-auto my-2">
            <textarea placeholder="Дополнительные пожелания" name="descript" class="form-control mx-auto my-2"></textarea>
            <input type="submit" value="Отправить" class="btn-success btn d-block my-2 form-control mx-auto" id="buttonSave">
        </form>
        <div class="bg-success my-2 rounded-5 text-center w-100 d-none uspex">
        </div>
    </main>
    <footer class="row justify-content-center mt-5">
        <p class="text-center">
            ИП Шипула Юрий Владимирович Действующий на основании св-ва 23 № 001539812 от 11.11.2003г. ОГРНИП №
            304230915400047<br>
            ИНН 230905580352 КПП 230901001 Адрес юрид. : 350001, Россия, Краснодарский край, г. Краснодар, ул. 5-ая
            линия ПРК, д. 64<br>
            р/с 40802810200000000293 в КБ «Кубань Кредит» ООО г. Краснодар к/с 30101810200000000722 БИК 040349722 ОКВЭД
            15.72<br>
            Электронная почта: Shipyla@yandex.ru Тел.: 89184499520, 89186907410
        </p>
    </footer>
</body>
</html>