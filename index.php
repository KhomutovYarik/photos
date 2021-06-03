<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>photos</title>
        <link rel="stylesheet" href="css/font-file.css">
        <link rel="stylesheet" href="css/header-style.css">
        <link rel="stylesheet" href="css/main-page.css">
    </head>
    <body>
        <header class="default-header">
            <a class="header-logo" href="index.php">
                <span class="logo-text">photos</span>
                <div class="logo-circle first-logo-circle"></div>
                <div class="logo-circle second-logo-circle"></div>
            </a>
            <div class="search-block">
                <img class="search-image" src="img/zoom.png">
                <input type="text" class="search-field" placeholder="Поиск по пользователям и заголовкам">
            </div>
            <div class="header-nav">
                <?php
                if (true)
                    echo
                    '<a class="header-nav-element" href="auth.php">Войти</a>
                    <a class="spec-nav-element" href="register.php">
                        <span class="header-nav-element">Регистрация</span>
                    </a>
                    <a class="header-nav-element">О сайте</a>';
                else
                    echo 
                    '<img class="upload-image" src="img/upload.png">
                    <div class="spec-nav-element gallery-button">
                        <span class="header-nav-element">Моя галерея</span>
                    </div>
                    <span class="header-nav-element">О сайте</span>
                    <span class="header-nav-element">Выйти</span>';
                ?>
            </div>
        </header>
        <div class="middle-page-part">
            <span class="main-top-label">Делись изображениями</span>
            <?php
            if (true)
                echo
                '<span class="main-bottom-label">Регистрируйся прямо сейчас и начни <br> бесплатно загружать всё, что пожелаешь </span>
                <a href="register.php"><button class="start-now-button">
                    Начни сейчас
                </button></a>';
            else
                echo
                '<span class="main-bottom-label">Для загрузки изображений просто перетащите их <br>
                сюда либо выберите соответствующий элемент ниже</span>
                <button class="start-load-button">
                    Начать загрузку
                </button>';
            ?>
        </div>
    </body>
</html>