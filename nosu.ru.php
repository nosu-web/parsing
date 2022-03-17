<?php
/* Получаем исходный код страницы */
$html = file_get_contents('https://www.nosu.ru/');
/* Класс DOMDocument предназначен для работы с кодом HTML и XML */
$doc = new DOMDocument();
/* Загружаем html в класс */
$doc->loadHTML($html);
/* Класс DOMXpath реализует язык запросов XPath к элементам XML-документа */
$xpath = new DOMXpath($doc);

/* Пути для сохранения исходных изображений и миниатюр */
$img_full_path = './uploads/';
$img_tmb_path = './uploads/thumbnails/';

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

  if($image[0] !== null) {
    /* Миниатюра */
    $image_tmb = $image[0]->getAttribute('src');               // Ссылка на миниатюру
    $image_tmb_binary = file_get_contents($image_tmb);         // Бинарный код изображения

    /* Если директория не существует, создаем ее */
    if(!is_dir($img_tmb_path))
        mkdir($img_tmb_path);
    /* Сохраняем изображение миниатюры в файл с именем, состоящим из секунд.микросекунд */
    file_put_contents($img_tmb_path.microtime(true).'.jpg', $image_tmb_binary);


    /* Исходное изображение */
    $image_full = str_replace('-350x230', '', $image_tmb);      // Ссылка на исходное
    $image_full_binary = file_get_contents($image_full);        // Бинарный код изображения

    /* Если директория не существует, создаем ее */
    if(!is_dir($img_full_path))
        mkdir($img_full_path);
    /* Сохраняем исходное изображение в файл с именем, состоящим из секунд.микросекунд */
    file_put_contents($img_full_path.microtime(true).'.jpg', $image_full_binary);
  }
  

  echo "<h3>{$title_text}</h3>";
  echo "<date>{$date_text}<date>";
  echo "<div><img src=\"{$image_tmb}\"></div>";
}
