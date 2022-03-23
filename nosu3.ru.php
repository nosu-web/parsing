<?php
/* Подключаемся к БД (имя сервера, имя пользователя БД, пароль БД, имя БД)*/
$mysqli = new mysqli("localhost", "root", "", "ossetianews");

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
  foreach($articleXpath->query("//div[contains(@class, 'content-text')]//p") as $articleElement) {
    $newsText .= $articleElement->textContent."\n";
  }

  /* Получаем текстовое содержимое заголовка */
  $titleText = $title[0]->textContent;
  /* Получаем дату новости */
  $date = $mainPageXpath->query(".//div[contains(@class, 'date')]", $item);
  $dateText = $date[0]->textContent;

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
  (`website_id`, `title`,`text`, `img`)
  VALUES (3, '{$titleText}', '{$newsText}', '{$imageFull}')");
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



  /*$news_txt='';
  $aa = $mainPageXpath->query(".//a", $item);
  if($aa[0] !== null) {
    $news_url = $aa[0]->getAttribute('href');
    
    $news_txt = getNewsText($news_url);
  }*/
/*
foreach($news_xpath->query("//div[@class='content-block content-text']//p") as $item) {
  $text .= $item->textContent."\n";
}

$html_doc = null;*/