<?php

function include_template($name, $data) {
    $name = 'templates/' . $name;
    $result = '';

    if (!file_exists($name)) {
        return $result;
    }

    ob_start();
    extract($data);
    require_once $name;

    $result = ob_get_clean();

    return $result;
}

/**
* Подключение к БД
*
* @return object 
*/
function dbConnect() {
    $dbParams = [
    'host' => 'localhost', // адрес сервера
    'database' => 'userdata', // имя базы данных
    'user' => 'user', // имя пользователя
    'password' => '' // пароль
    ];

    $link = mysqli_connect($dbParams['host'], $dbParams['user'], $dbParams['password'], $dbParams['database']);
    mysqli_set_charset($link, "utf8");

    if (!$link) {
        printf("Не удалось подключиться: %s\n", mysqli_connect_error());
        die();
    }

    return $link;
}

/**
* Проверка - есть ли пользователь с введенным именем в БД
*
* @param string $name
*
* @return int возвращает количество строк запроса
*/
function dbCheckName($name) {
    $link = dbConnect();

    $nameClear = mysqli_real_escape_string($link, $name);

    $queryCheckName = "SELECT `id` FROM `user` WHERE `name` = '$nameClear'";

    $resultCheckName = mysqli_query($link, $queryCheckName);

    if (!$resultCheckName) {
        printf("Не удалось выполнить запрос: %s\n", mysqli_error($link));
        http_response_code(404);
        die();
}
    return mysqli_num_rows($resultCheckName);
}

/**
* Проверка - заполнено ли у пользователя поле хобби
*
* @param string $name
*
* @return int возвращает количество строк запроса
*/
function dbCheckHobby($name) {
    $link = dbConnect();

    $nameClear = mysqli_real_escape_string($link, $name);

    $queryCheckHobby = "SELECT `hobby` FROM `user` WHERE `name` = '$nameClear' AND `hobby` is not NULL";

    $resultCheckHobby = mysqli_query($link, $queryCheckHobby);

    if (!$resultCheckHobby) {
        printf("Не удалось выполнить запрос: %s\n", mysqli_error($link));
        http_response_code(404);
        die();
}
    return mysqli_fetch_assoc($resultCheckHobby);
}

/**
* Регистрация пользователя в БД
*
* @param array $data данные пользователя из формы
*
* @return int в случае успеха, возвращается значение 1
*/
function dbAddUser($data) {
    $link = dbConnect();

    $nameClear = mysqli_real_escape_string($link, $data['name']);
    $passClear = mysqli_real_escape_string($link, $data['password']);

    $queryAddUser = "INSERT INTO `user` (`reg_date`, `name`, `password`) 
                        VALUES  (NOW(), '$nameClear', '$passClear')";

    $resultAddUser = mysqli_query($link, $queryAddUser);

    if (!$resultAddUser) {
        printf("Не удалось выполнить запрос: %s\n", mysqli_error($link));
        http_response_code(404);
        die();
    }

    return 1;
}

/**
* Добавление записи о хобби
*
* @param string $hobby данные пользователя из формы
*
* @return int в случае успеха, возвращается значение 1
*/
function dbAddHobby($hobby, $username) {
    $link = dbConnect();

    $hobbyClear = mysqli_real_escape_string($link, $hobby);
    $nameClear = mysqli_real_escape_string($link, $username);

    $queryAddHobby = "UPDATE `user` SET `hobby` = '$hobbyClear' WHERE `name` = '$nameClear'";

    $resultAddHobby = mysqli_query($link, $queryAddHobby);

    if (!$resultAddHobby) {
        printf("Не удалось выполнить запрос: %s\n", mysqli_error($link));
        http_response_code(404);
        die();
    }

    return 1;
}

/**
* Получение информации о пользователе в БД по введенному имени
*
* @param string $name
*
* @return array
*/
function dbGetUserData($name) {
    $link = dbConnect();

    $nameClear = mysqli_real_escape_string($link, $name);

    $queryCheckName = "SELECT * FROM `user` WHERE `name` = '$nameClear'";

    $resultCheckName = mysqli_query($link, $queryCheckName);

    if (!$resultCheckName) {
        printf("Не удалось выполнить запрос: %s\n", mysqli_error($link));
        http_response_code(404);
        die();
}

    return mysqli_fetch_assoc($resultCheckName);
}

/**
* Запуск сессии пользователя
*
* @return string имя пользователя
*/
function startSession() {
    session_start();

    if (!empty($_SESSION['user'])) {
        $userSes = $_SESSION['user']['name'];
    }
    else {
        $userSes = NULL;
    }

    return $userSes;
}
