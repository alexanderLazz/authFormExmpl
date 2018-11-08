<?php 

require_once('functions.php');

$userSes = startSession();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$loginForm = array_map('htmlspecialchars', $_POST); 
	$required = ['name', 'password'];
	$errors = [];

	/* проверка на заполненность текстовых полей */
	foreach ($required as $key) {
		if (empty($loginForm[$key])) {
            $errors[$key] = 'Заполните все поля';
		}
	}

	$user = dbGetUserData($loginForm['name']);

	if (empty($errors) and !empty($user)) {
		if (password_verify($loginForm['password'], $user['password'])) {
			$_SESSION['user'] = $user;
		}
		else {
			$errors['password'] = 'Вы ввели неверный пароль';
		}
	}
	else {
		$errors['name'] = 'Вы ввели неверное имя';
	}

	if (empty($errors)) {
		header("Location: index.php");
		die();
	}
	else {
		$page_content = include_template('enter.php', ['loginForm' => $loginForm, 'errors' => $errors]);
	}
}
else {
   	$page_content = include_template('enter.php', []);
}

$layout_content = include_template('layout.php', ['content' => $page_content, 'title' => "Авторизация", 
										'user_name' => $userSes]);

print($layout_content);  

?>