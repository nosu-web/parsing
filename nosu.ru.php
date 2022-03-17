<?php
/* Получаем исходный код страницы */
$html = file_get_contents('https://www.nosu.ru/');
/* Класс DOMDocument предназначен для работы с кодом HTML и XML */
$doc = new DOMDocument();
/* Загружаем html в класс */
$doc->loadHTML($html);
/* Класс DOMXpath реализует язык запросов XPath к элементам XML-документа */
$xpath = new DOMXpath($doc);

$img_full_path = '/uploads/';
$img_tmb_path = '/uploads/thumbnails';

/* Находим все контейнеры div с классом item (карточки новостей) в контейнере div склассом news-list */
foreach ($xpath->query("//div[contains(@class, 'news-list')]//div[contains(@class, 'item')]") as $item) {
  /* Находим DOM-элемент заголовка */
  $title = $xpath->query(".//div[contains(@class, 'title')]//a", $item);
  /* Получаем текстовое содержимое заголовка */
  $title_text = $title[0]->textContent;
  /* Получаем дату новости */
  $date = $xpath->query(".//div[contains(@class, 'date')]", $item);
  $date_text = $date[0]->textContent;

  /* Находим DOM-элемент изображения */
  $image = $xpath->query(".//a//img", $item);
  /* Если элемент не пустой получаем значение атрибута src */
  if($image[0] !== null)
    $image_tmb = $image[0]->getAttribute('src'); // Ссылка на миниатюру

  $image_tmb_binary = file_get_contents($image_tmb);
  echo $image_tmb_binary;

  $image_full = str_replace('-350x230', '', $image_tmb);
  
  echo "<h3>{$title_text}</h3>";
  echo "<date>{$date_text}<date>";
  echo "<div><img src=\"{$image_tmb}\"></div>";
}
