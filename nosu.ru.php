<?php
/* Получаем исходный код страницы */
$html = file_get_contents('https://www.nosu.ru/');
/* Класс DOMDocument предназначен для работы с кодом HTML и XML */
$doc = new DOMDocument();
/* Загружаем html в класс */
$doc->loadHTML($html);
/* Класс DOMXpath реализует язык запросов XPath к элементам XML-документа */
$xpath = new DOMXpath($doc);

/* Находим все контейнеры div с классом item (карточки новостей) в контейнере div склассом news-list */
foreach ($xpath->query("//div[contains(@class, 'news-list')]/div[contains(@class, 'item')]") as $item) {
  /* Находим DOM-элемент заголовка */
  $title = $xpath->query(".//div[contains(@class, 'title')]/a", $item);
  /* Получаем текстовое содержимое заголовка */
  $title_text = $title[0]->textContent;

  /* Находим DOM-элемент изображения */
  $image = $xpath->query(".//a/img", $item);
  /* Если элемент не пустой получаем значение атрибута src */
  if($image[0] !== null)
    $image_src = $image[0]->getAttribute('src');
  
  echo "{$title_text} - {$image_src}<br>";
}
