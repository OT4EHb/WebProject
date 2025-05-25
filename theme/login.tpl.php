<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Логин-ЮГ</title>
    <link rel="icon" href="/source/Logo.png" type="image/x-icon">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="js/login.js" defer></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .maxw600 {
            max-width: 600px;
            width: 50vw;
        }
    </style>
</head>
<body class="container-fluid p-0">
    <header>
        <div class="row head">
            <div class="col-1">
                <img src="/source/Logo.png">
            </div>
            <a class="col d-flex justify-content-end" href="../">
                <img src="/source/icons/house-door.svg">
            </a>
        </div>
    </header>
    <main class="mx-auto">
        <p class="d-none bg-info maxw600 mx-auto text-center" id="info"></p>
        <form action="<?php print(conf('clean_urls')?'login':'?q=login')?>" 
        method="post" class="px-2 maxw600 position-absolute top-50 translate-middle start-50">
            <label class="form-control bg-warning border-0 form-label w-100 text-center">
                Введите логин:
                <input name="login" required class="form-control req w-100">
            </label>
            <label class="form-control bg-warning border-0 form-label w-100 text-center">
                Введите пароль:
                <input type="password" name="pass" required class="form-control req w-100">
            </label>
            <div class="form-control d-flex bg-info w-100">
                <input type="submit" value="Войти" class="btn-success btn m-1 w-100">
            </div>
        </form>
    </main>
</body>
</html>