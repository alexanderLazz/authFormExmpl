<?php

require_once('functions.php');

$userSes = startSession();

$pageContent = include_template('index.php', ['user_name' => $userSes]);

$layoutContent = include_template('layout.php', ['content' => $pageContent, 'title' => 'Главная страница',
         'user_name' => $userSes]);

print($layoutContent);

?>
