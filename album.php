<?php

  require_once("php/connection.php");

  if (empty($_GET['id']))
  {
    header('Location: index.php');
    exit();
  }

  session_start();

  if (empty($_SESSION['auth']) or !($_SESSION['auth'])) {

    if (!empty($_COOKIE['username']) and !empty($_COOKIE['key']) ) {

      $username = $_COOKIE['username'];
      $key = $_COOKIE['key'];

      $query = "select * from users where username='$username' and cookie='$key'";

      $result = mysqli_fetch_assoc(mysqli_query($connection, $query));

      if (!empty($result)) {
        $_SESSION['auth'] = true;
        $_SESSION['id'] = $result['id'];
        $_SESSION['username'] = $result['username'];
      }
    }
  }

  $query = "select name, description, create_date, permission, image_id, extension_name, count, user_id from all_albums where id=".$_GET['id'];

    $result = mysqli_query($connection, $query);

    $albums_count = mysqli_num_rows($result);

    if ($albums_count == 0)
    {
        header('Location: index.php');
        exit();
    }
    else
    {
        $row = mysqli_fetch_row($result);

        $album_name = $row[0];
        $album_description = $row[1];
        $album_create_date = $row[2];
        $album_count = $row[6];
        $user_id = $row[7];

        if ($row[3] != 1 && $_SESSION['id'] != $user_id)
        {
            header('Location: index.php');
            exit();
        }
    }
  
?>
<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Photo</title>
        <link rel="stylesheet" href="css/font-file.css">
        <link rel="stylesheet" href="css/header-style.css">
        <link rel="stylesheet" href="css/album.css">
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
                if (empty($_SESSION['auth']) || !$_SESSION['auth'])
                    echo
                    '<a class="header-nav-element" href="auth.php">Войти</a>
                    <a class="spec-nav-element" href="register.php">
                        <span class="header-nav-element">Регистрация</span>
                    </a>
                    <a class="header-nav-element">О сайте</a>';
                else
                {
                    echo
                    '<label for="header-upload" class="label-upload">
                        <img class="upload-image" src="img/upload.png">
                    </label>
                    <input id="header-upload" type="file" multiple>
                        <a href="profile.php?id='.$_SESSION['id'].'"><div class="spec-nav-element gallery-button">
                        <span class="header-nav-element">Моя галерея</span>
                    </div></a>
                    <span class="header-nav-element">О сайте</span>
                    <a class="header-nav-element" href="php/logout.php">Выйти</a>';
                }
                ?>
            </div>
        </header>
        <div class="album-info">
            <div class="album-name"><?php echo $album_name; ?></div>
            <div class="album-description"><?php echo $album_description; ?></div>
            <span class="created-date"><?php echo 'Создан: '.$album_create_date; ?></span>
            <span class="images-count"><?php echo 'Изображений: '.$album_count; ?></span>
            <div class="back-to-gallery">
                <?php
                    echo 
                    '<a href="profile.php?id='.$user_id.'">
                        <img src="img/back-arrow.png">
                        <span>Вернуться в галерею</span>
                    </a>';
                ?>
            </div>
        </div>
        <div class="images-block">
                <?php
                    $query = "select id, extension, create_data, header, description, permission, user_id from all_images WHERE album_id=".$_GET['id']." order by id ASC";
                
                    $result = mysqli_query($connection, $query);
    
                    $images_count = mysqli_num_rows($result);

                    if ($images_count == 0)
                    {
                        header('Location: index.php');
                        exit();
                    }

                    $images_block = '<ul id="images-unordered-list">';
                    
                    for ($i = 0; $i < $images_count; $i++)
                    {
                        $row = mysqli_fetch_row($result);
                        
                        $link = 'uploaded/'.$row[6].'/'.$row[0].'.'.$row[1];
                        $images_block .= '<li data-id="'.$row[0].'"><a href="image.php?id='.$row[0].'&album='.$_GET['id'].'"><img src="'.$link.'"></a></li> ';
                    }

                    $images_block .= '</ul>';

                    echo $images_block;
                ?>
        </div>
        <div id="loading-status" class="loading-status">  
        </div>
        <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
        <script type="text/javascript" src="js/header-actions.js"></script>
    </body>
</html>