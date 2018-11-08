<?php 

require_once('functions.php');

$userSes = startSession();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$userData = array_map('htmlspecialchars', $_POST); 
	$required = ['name', 'password'];
	$errors = [];

	/* проверка на заполненность текстовых полей */
	foreach ($required as $key) {
		if (empty($userData[$key])) {
            $errors[$key] = 'Заполните все поля';
		}
	}

	/* проверка на уникальность введенного имени */
	if (dbCheckName($userData['name']) > 0) {
        $errors['name'] = 'Пользователь с таким именем уже зарегистрирован';
	} 
	
	if (empty($errors)) {
		$userData['password'] = password_hash($userData['password'], PASSWORD_DEFAULT);

		/* если пользователь был добавлен */
		if (dbAddUser($userData) === 1) {
			header("Location: enter.php");
			die();
		}
	}
	else {
		$page_content = include_template('register.php', ['userData' => $userData, 'errors' => $errors]);
	}

}
else {
	$page_content = include_template('register.php', []);
}

$layout_content = include_template('layout.php', ['content' => $page_content, 'title' => "Регистрация пользователя", 'user_name' => $userSes]);

print($layout_content);    

?>