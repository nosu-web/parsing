<?php
include("./includes/mysql.inc.php");

/* Получаем исходный код страницы */
$html = file_get_contents('https://ossetia.news/news/');
/* Класс DOMDocument предназначен для работы с кодом HTML и XML */
$doc = new DOMDocument();
libxml_use_internal_errors(true);
/* Загружаем html в класс */
$doc->loadHTML($html);
libxml_clear_errors();
/* Класс DOMXpath реализует язык запросов XPath к элементам XML-документа */
$xpath = new DOMXpath($doc);

// Находим все контейнеры div с классом news_item (карточки новостей) в контейнере div склассом news_list
foreach ($xpath->query("//div[contains(@class, 'row')]//a") as $item) {

// Находим DOM-элемент заголовка
$title = $xpath->query(".//div[contains(@class, 'col-md-7 content_rubrica')]//p", $item);
// Получаем текстовое содержимое заголовка
$title_text = $title[0]->textContent;

/*Получаем дату новости */
$date = $xpath->query(".//div[contains(@class, 'date_rubrica')//p]", $item);
$dateText = @$date[0]->textContent;
$dateTime = $xpath->query(".//div[contains(@class, 'date_rubrica')//span]", $item);
$dateTimeText = @$dateTime[0]->textContent;
$dateFull = $dateText.' '.$dateTimeText;
$newDate = @date("Y-m-d h:m:s", strtotime($dateFull));

/* Находим DOM-элемент изображения*/
$image = $xpath->query(".//img", $item);
/* Если элемент не пустой, получаем значение атрибута src */
if($image[0] !== null) 
$image_tmb = $image[0]->getAttribute('src'); // Ссылка на миниатюру
$image_full = str_replace('-333x222', '', $image_tmb); // Ссылка на исходное
$image_full_binary = file_get_contents($image_full); // Бинарный код изображения


/* Находим DOM-элемент заголовка и получаем его href */
$href_news = $xpath->query("./@href", $item);
$href_text = $href_news[0]->textContent;

/* Получаем Xpath новости *///
$newsText = null;
$articleXpath = getXpath($href_text);
foreach($articleXpath->query("//div[contains(@class, 'col-md-12 content-stat')]//p") as $key => $articleElement) {
if($key == 0)
continue;
$newsText .= $articleElement->textContent."\n";
}


//Добавляем новость в таблицу news
$mysqli->query("INSERT INTO `news`
(`website_id`,`title`,`date`,`text`,`img`,`url`)
VALUES (8, '{$title_text}', '{$newDate}', '{$newsText}', '{$image_full}','{$href_text}')");

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
