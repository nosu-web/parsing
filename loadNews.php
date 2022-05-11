<?php
/* Подключаем файл с соединением к БД */
include("includes/mysql.inc.php");
/* Проверка авторизация */
include("includes/auth.inc.php");
header('Content-Type: application/json; charset=utf-8');

$counter = $_GET['counter'];

/* Выбираем 10 последних новостей из таблицы news */
$result = $mysqli->query("SELECT * FROM `news` ORDER BY `date` DESC LIMIT 9 OFFSET ".$counter);
$newsArray = json_encode($result->fetch_all( MYSQLI_ASSOC ));
echo $newsArray;
