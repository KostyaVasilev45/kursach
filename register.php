<?php
require_once 'config.php';

try {
	$db = new PDO('pgsql:host='.DB_HOST.';dbname='.DB_NAME,DB_USER,DB_PASS);
}
catch (PDOException $e) {
	echo '{"Error!": {"text": "' . $e->getMessage().'"}}';
	die();
}
$where = '';

if (!empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['email'])) {
	$login = $_POST['login'];
	$pas = $_POST['password'];
	$email = $_POST['email'];
	$sql = sprintf('INSERT INTO "users" ("LOGIN", "EMAIL", "PASSWORD") VALUES (\'%s\',\'%s\',\'%s\')', $login,$email,$pas);
	
	
	$count = $db->exec($sql);
	if ($count === 1) {
		echo '{"response":{"text":"Вы успешно зарегистрировались"}}';
	}
	else {
		echo '{"error":{"text":"Не удалось создать пользователя"}}';
	}
}
else {
	echo '{"error":{"text":"Не передан логин или пароль"}}';
}
?>