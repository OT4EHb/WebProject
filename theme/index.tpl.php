<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Планктон-ЮГ</title>
    <link rel="icon" href="source/Logo.png" type="image/x-icon">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js" defer></script>
    <script src="js/index.js" defer></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body class="container-fluid p-0">
    <header>
        <div class="row head">
            <div class="col-1">
                <img src="source/Logo.png">
            </div>
            <a class="col d-flex justify-content-end text-dark text-decoration-none" 
                <?php if (empty($c['user'])){ ?>
                href=<?php print(conf('clean_urls')?'login':'?q=login')?>>
                <h2>Войти</h2>
                <?php } else { ?>
                href=<?php print(conf('clean_urls')?'logout':'?q=logout')?>>
                <h2>Выйти</h2>
                <?php } ?>
            </a>
            <a class="col-1 d-flex justify-content-end" href=<?php print(conf('clean_urls')?'cart':'?q=cart')?>>
                <img src="source/icons/cart.svg">
            </a>
        </div>
        <div class="row">
            <img src="source/tipohead.svg" class="p-0">
        </div>
        <!--original video by BaldasaridStock
    https://ru.freepik.com/free-video/rippled-water-swimming-pool_3543547#fromView=search&page=1&position=8&uuid=643cc66e-d306-462d-87e4-ea62be5264bd
        -->
        <video autoplay loop muted playsinline preload="none" class="w-100">
            <source src="source/water.mp4" type="video/mp4">
        </video>
    </header>
    <main class="col-xl-8 col-lg-10 mx-auto">
        <div class="row panel my-3">
        <?php if ($c['user']){ ?>
            <h3 class="text-center">Вы уже оформили заказ с этого аккаунта</h3>
        <?php } else{ ?>
            <div class="col-2 col-md-1 px-1">
                <object type="image/svg+xml" data="source/icons/fish_icon.svg" class="fish"></object>
            </div>
            <div class="col-2 col-md-1 px-1">
                <object type="image/svg+xml" data="source/icons/turtle_icon.svg" class="interact turtle"></object>
            </div>
            <div class="col-2 col-md-1 px-1">
                <object type="image/svg+xml" data="source/icons/spider_icon.svg" class="interact spider"></object>
            </div>
            <div class="col-2 col-md-1 px-1">
                <object type="image/svg+xml" data="source/icons/crow_icon.svg" class="interact bird"></object>
            </div>
            <div class="col-4 col-md-2 order-md-1 pe-0">
                <select class="form-select h-100 bg-primary text-center py-0">
                    <option selected value="0">Прямой ход</option>
                    <option value="1">Обратный ход</option>
                </select>
            </div>
            <div class="col-12 col-md-6 mt-2 mt-md-0">
                <form class="d-flex h-100 find justify-content-center">
                    <input class="form-control me-1" type="search" placeholder="Поиск" list="datalistOptions">
                    <datalist id="datalistOptions">
                        <?php foreach($c as $k)
                            print("<option>".$k[1]."</option>")?>
                    </datalist>
                    <button class="btn btn-info btn-outline-primary p-1 p-md-2" type="submit">
                        <img src="source/icons/search.svg" class="h-100">
                    </button>
                </form>
            </div>
        </div>
        <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4" id="tovar">
            <?php foreach($c['data'] as $k){?>
            <div class="col py-4 px-md-4" id="<?php echo $k[0] ?>">
                <div class="card border-0 h-100 text-center<?php foreach(explode(", ",$k[4]) as $cl)
                        print(' '.$cl); ?>" id="<?php print($k[1])?>">
                    <img src="<?php print($k[3])?>" class="card-img-top" alt="...">
                    <div class="card-body p-0 p-md-2 d-flex flex-column justify-content-between">
                        <h5 class="card-title"><?php print($k[1])?></h5>
                        <a class="btn btn-primary" data-bs-target="#detalno" href="<?php echo (conf('clean_urls')?'add?id=':'?q=add&id=').$k[0]; ?>"
                            data-bs-toggle="modal">Добавить</a>
                    </div>
                    <div class="d-none">
                        <?php print('<span>'.$k[2].'</span>'.
                            '<span>'.$k[5].'</span>')?>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
        <div class="row justify-content-center zakaz">
            <div class="col-10 col-sm-8 col-md-4 h-100">
                <a class="btn-primary btn border-0 rounded-5 w-100 h-100 text-center p-0" href=<?php 
                    print(conf('clean_urls')?'cart':'?q=cart')?>>
                    <h3>Оформить заказ</h3>
                </a>
            </div>
        <?php }?>
        </div>
    </main>
    <br>
    <div class="modal fade" id="detalno" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog modal-fullscreen-lg-down modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <p class="opisanie p-3"></p>
                    <div class="container-fluid fs-5 p-0">
                        <div class="row my-2">
                            <div class="col-2 text-center">

                            </div>
                            <div class="col-3 text-center">

                            </div>
                            <button class="btn btn-primary col p-0">Убрать</button>
                            <p class="col-3 text-center">0</p>
                            <button class="btn btn-primary col p-0">Добавить</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="row justify-content-center">
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