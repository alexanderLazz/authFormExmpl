<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?=$title ?></title>
</head>
<body>

<header>
    <nav>
        <p><a href="index.php">Главная</a></p>
        <?php if (isset($user_name)) { ?>
          <div>
            <p><?=$user_name ?></p>
            <p><a href="logout.php">Выход</a></p>
          </div>
        <?php } else { ?>
          <ul>
            <li>
              <a href="register.php">Регистрация</a>
            </li>
            <li>
              <a href="enter.php">Вход</a>
            </li>
          </ul>
        <?php
        } ?>
    </nav>
</header>

<main><?=$content; ?></main>

</body>
</html>
