<?php
/* Стартуем сессию */
session_start();

/* Проверяем существование переменной is_user (прользователь прошел авторизацию) */
if(isset($_GET['logout']))
    session_unset();

/* Проверяем существование переменной is_user (прользователь прошел авторизацию) */
if(!$_SESSION['is_user'])
    header("Location: login.php");
