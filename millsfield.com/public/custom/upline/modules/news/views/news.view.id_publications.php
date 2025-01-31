<?php
/**
 * Шаблон страницы новости
 *
 * @package    DIAFAN.CMS
 * @author     diafan.ru
 * @version    7.0
 * @license    http://www.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2021 OOO «Диафан» (http://www.diafan.ru/)
 */

if (!defined('DIAFAN')) {
    $path = __FILE__;
    while (!file_exists($path . '/includes/404.php')) {
        $parent = dirname($path);
        if ($parent == $path) exit;
        $path = $parent;
    }
    include $path . '/includes/404.php';
}


if (!empty($result["img"][0])) {
    echo '<section class="front section-mg28 article-3 front front_min" style="background-image: url(' . ((!empty($result["img"][1])) ? $result["img"][1]["vs"]["top"] : $result["img"][0]["vs"]["top"]) . ');">';
} else {
    echo '<section class="front article-5 front front_min">';
}

echo '<div class="container">
		<div class="front__inner">';

echo $this->htmleditor('<insert name="show_breadcrumb"></insert>');

if ($this->htmleditor('<insert name="show_dynamic" module="site" id="2">')) {
    echo $this->htmleditor('<insert name="show_dynamic" module="site" id="2" template="easy">');
} else {
    echo '<h1 class="front__title">';
    echo $this->htmleditor('<insert name="show_h1">');
    echo '</h1>';
}

if ($this->htmleditor('<insert name="show_dynamic" module="site" id="5">')) {
    echo '<div class="front__discrip">';
    echo $this->htmleditor('<insert name="show_dynamic" module="site" id="5" template="easy">');
    echo '</div>';
}

echo '</div>
    </div>
</section>';

echo '<div class="container js-article-with-links-container">
          <div class="page__inner" itemscope itemtype="https://schema.org/Article">
	         <MAIN class="container780">';

echo '<meta itemprop="name" content="' . $result['name'] . '" />';

//вывод даты новости
if (!empty($result["date"])) {
    echo '<div class="date">' . $result["date"] . "</div>";
}
if (strpos($result['text'], '<h2>') !== false) {
    echo '
    <div class="js-article-with-links">
        <h2 class="js-article-with-links__title js-not-include-in-links">'. $this->diafan->_('contents-links-title') .'</h2>
        <div class="js-article-with-links__loader"></div>
    </div>';
}

//вывод основного текста новости
echo '<div class="articleBody" itemprop="articleBody">' . $this->htmleditor($result['text']) . '</div>';

//ссылки на все новости
// if (! empty($result["allnews"]))
// {
//     echo '<div><a class="btn btn-color" href="'.BASE_PATH_HREF.$result["allnews"]["link"].'">'.$this->diafan->_('Вернуться к списку новостей').'</a></div>';
// }

//рейтинг новости
if(! empty($result["rating"]))
{
    echo $result["rating"];
}

echo $this->htmleditor('<insert name="show_previous_next" module="news">');

echo '<div class="share-section">';

echo '<div class="share-section__title">'. $this->diafan->_('share-title') .'</div>';

echo '<script src="https://yastatic.net/share2/share.js"></script>
<div class="ya-share2" data-curtain data-size="l" data-shape="round" data-color-scheme="whiteblack" data-services="facebook,telegram,twitter"></div>';

echo '</div>';

if (! empty($this->htmleditor('<insert name="show_dynamic" module="site" id="6">'))) {
    echo '<section class="section-contacts-form">';
    echo $this->htmleditor('<insert name="show_form" module="feedback" site_id="172" template="contact">');
    echo '</section>';
}
echo '</MAIN>';

