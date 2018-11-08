<?php

require_once('functions.php');

$userSes = startSession();

if (!isset($userSes)) {
	header("Location: enter.php");
	die();
}

$getHobby = dbCheckHobby($userSes);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$hobby = htmlspecialchars($_POST['hobby']);
	$required = 'hobby';
	$errors = [];

	/* проверка на заполненность текстовых полей */
	if (empty($required)) {
    	$errors[$required] = 'Заполните поле';
	}

	if (empty($errors)) {
		if (dbAddHobby($hobby, $userSes) === 1) {
			header("Location: hobby.php");
		}
	}
	else {
		$pageContent = include_template('hobby.php', ['errors' => $errors]);
	}

}

$pageContent = include_template('hobby.php', ['getHobby' => $getHobby]);

$layoutContent = include_template('layout.php', ['content' => $pageContent, 'title' => 'Мое хобби',
         'user_name' => $userSes]);

print($layoutContent);

?>
