<?php
/* Подключаемся к БД (имя сервера, имя пользователя БД, пароль БД, имя БД)*/
$mysqli = new mysqli("localhost", "cc08668_osnews", "Pm21Pm21Pm21", "cc08668_osnews");

/* Получаем Xpath главной страницы */
$mainPageXpath = getXpath('https://nosu.ru');

/* Находим все контейнеры div с классом item (карточки новостей) в контейнере div склассом news-list */
foreach ($mainPageXpath->query("//div[contains(@class, 'news-list')]//div[contains(@class, 'item')]") as $item) {
  /* Находим DOM-элемент заголовка */
  $title = $mainPageXpath->query(".//div[contains(@class, 'title')]//a", $item);

  /* Получаем ссылку на новость */
  $link = $mainPageXpath->query(".//a", $item);
  if($link[0] !== null) {
    $newsUrl = $link[0]->getAttribute('href');
  }

  /* Получаем Xpath новости */
  $newsText = null;
  $articleXpath = getXpath($newsUrl);
  foreach($articleXpath->query("//div[contains(@class, 'content-text')]//p") as $key => $articleElement) {
    if($key == 0)
      	continue;
    $newsText .= $articleElement->textContent."\n";
  }

  /* Получаем текстовое содержимое заголовка */
  $titleText = $title[0]->textContent;
  /* Получаем дату новости */
  $date = $mainPageXpath->query(".//div[contains(@class, 'date')]", $item);
  $dateText = $date[0]->textContent;
  $newDate = date("Y-m-d 00:00:00", strtotime($dateText));

  /* Находим DOM-элемент изображения */
  $image = $mainPageXpath->query(".//a//img", $item);
  /* Если элемент не пустой получаем значение атрибута src */
  
  if($image[0] !== null) {
    //Миниатюра 
    $imageTmb = $image[0]->getAttribute('src');           // Ссылка на миниатюру
    //Исходное изображение 
    $imageFull = str_replace('-350x230', '', $imageTmb);  // Ссылка на исходное
  }

  /* Добавляем новость в таблицу news*/
  $mysqli->query("INSERT INTO `news`
  (`website_id`,`title`,`date`,`text`,`img`,`url`)
  VALUES (16, '{$titleText}', '{$newDate}', '{$newsText}', '{$imageFull}','{$newsUrl}')");
}

function getXpath($url) {
  /* Получаем исходный код страницы */
  $html = file_get_contents($url);
  /* Класс DOMDocument предназначен для работы с кодом HTML и XML */
  $doc = new DOMDocument();
  /* Загружаем html в класс */
  $doc->loadHTML($html);
  /* Класс DOMXpath реализует язык запросов XPath к элементам XML-документа */
  $xpath = new DOMXpath($doc);

  return $xpath;
}
