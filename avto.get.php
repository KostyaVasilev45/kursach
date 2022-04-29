<?php
require_once 'config.php';
$result = '';
try {
	$db = new PDO ('pgsql:host=' .DB_HOST.';dbname=' .DB_NAME, DB_USER, DB_PASS);
} catch (PDOException $e) {
	$result = '{"error": {"text: "' . $e->GetMessage().'"})';
	die($result);
	}
	
if (isset($_GET['token'])) {
	$token = $_GET['token'];
	//проверка токена
	$sql = sprintf ('SELECT "ID" FROM "users" WHERE "TOKEN" LIKE \'%s\' AND "EXPIRATION" > CURRENT_TIMESTAMP',$token);
	$stmt = $db->query($sql)->fetch();
	
	if (isset($stmt['ID'])) {
		$sql = 'SELECT * FROM "avto"';
		$stmt = $db->query($sql);
		$result = '{"avto": [';
		while($row = $stmt->fetch()) {
			$result .=sprintf('{"id":%d,"mark":"%s","year":%d,"logo":"%s"},',$row['ID'],$row['MARK'],$row['YEAR'],$row['LOGO']);
			}
		$result = rtrim($result,",");
		$result .= ']}';

	}
else {
    $result = '{"error": {"text":"ОШИБКА ТОКЕНА"}}';
}
}
else {
	$result = '{"error": {"text":"не передан токен"}}';
}
echo $result;

?> 