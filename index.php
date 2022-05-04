<?php
/* Подключаем файл с соединением к БД */
include("includes/mysql.inc.php");
/* Проверка авторизация */
include("includes/auth.inc.php");

/* Выбираем 10 последних новостей из таблицы news */
$result = $mysqli->query("SELECT * FROM `news` ORDER BY `date` DESC LIMIT 10");

if (isset($_POST["submit"])) {
    $search_phrase = $_POST["search_phrase"];

    $result = $mysqli->query("SELECT * FROM `news`
    WHERE
        `title` LIKE '%{$search_phrase}%'
    OR 
        `text` LIKE '%{$search_phrase}%'
    ORDER BY
        `date` DESC LIMIT 10");
}

$news = '';
while ($row = $result->fetch_assoc()) {

    $title = $row['title'];
    $text = $row['text'];
    $date = date("d.m.Y H:i", strtotime($row['date']));
    $img = $row['img'];
    $url = $row['url'];

    $text = mb_substr($text, 0, 100) . '...';
    if(isset($_POST['search_phrase']))
    {
        $text = highlightKeywords($search_phrase, $text);
        $title = highlightKeywords($search_phrase, $title);
    }

    $news .= "
    <div class=\"card my-2\">
        <img src=\"{$img}\" class=\"card-img-top\" alt=\"{$title}\">
        <div class=\"card-body\">
            <h5 class=\"card-title\">{$title}</h5>
            <h6 class=\"card-subtitle mb-2 text-muted\">{$date}</h6>
            <p class=\"card-text\">{$text}</p>
            <a href=\"{$url}\" class=\"btn btn-primary\" target=\"_blank\">Подробнее</a>
        </div>
    </div>";
}
function highlightKeywords($keyword, $string) {
    return preg_replace("/(\p{L}*?)(".preg_quote($keyword).")(\p{L}*)/ui", "$1<span style='background-color:yellow;'>$2</span>$3", $string);
}
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Новости Осетии</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">Новости Осетии</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/">Новости</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">О проекте</a>
                        </li>
                    </ul>
                    <form class="d-flex" action="" method="post">
                        <input class="form-control me-2" name="search_phrase" type="search" placeholder="Введите запрос" aria-label="Найти">
                        <button class="btn btn-outline-success" name="submit" type="submit">Найти</button>
                    </form>
                    <form class="d-flex" action="" method="post">
                        <button class="btn btn-outline-info" name="logout" type="submit">Выход</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>
    <main class="mt-3">
        <div class="container">
            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3">
                <?= $news; ?>
            </div>
        </div>
    </main>
</body>

</html>
