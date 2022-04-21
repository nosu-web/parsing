<?php
/* Стартуем сессию */
session_start();

/* Проверяем существование переменной is_user (прользователь прошел авторизацию) */
if(!$_SESSION['is_user'])
    header("Location: login.php");
