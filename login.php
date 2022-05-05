<?php
session_start();
/* Подключаемся к БД */
include('includes/mysql.inc.php');


if(isset($_POST['submit']))
{
    $login = $_POST['login'];
    $password = $_POST['password'];

    /* Запросы SELECT, возвращают набор результатов */
    $result = $mysqli->query("SELECT password FROM `users` WHERE `login`='{$login}'");
    while($row = $result->fetch_assoc()) {
        if(password_verify($password, $row['password']))
        {
            $_SESSION['is_user'] = true;
            header("Location: index.php");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container py-5">
        <form method="post" action="login.php" class="w-25 mx-auto">
            <h1>Авторизация</h1>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Логин</label>
                <input type="text" name="login" class="form-control" id="login" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Пароль</label>
                <input type="password" name="password" class="form-control" id="password">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Вход</button>
        </form>
    </div>
</body>

</html>
