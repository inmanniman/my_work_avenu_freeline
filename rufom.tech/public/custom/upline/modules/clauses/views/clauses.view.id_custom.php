<?php
/**
 * Шаблон страницы статьи
 *
 * @package    DIAFAN.CMS
 * @author     diafan.ru
 * @version    6.0
 * @license    http://www.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2018 OOO «Диафан» (http://www.diafan.ru/)
 */

if (! defined('DIAFAN'))
{
	$path = __FILE__;
	while(! file_exists($path.'/includes/404.php'))
	{
		$parent = dirname($path);
		if($parent == $path) exit;
		$path = $parent;
	}
	include $path.'/includes/404.php';
}

echo '<div class="content clearfix">';

//счетчик просмотров
if(! empty($result["counter"]))
{
	echo '<div class="clauses_counter">'.$this->diafan->_('Просмотров').': '.$result["counter"].'</div>';
}

//теги статьи
if (! empty($result["tags"]))
{
	echo $result["tags"];
}
$url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$url = explode('?', $url);
$url = $url[0];

echo '<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "NewsArticle",
  "mainEntityOfPage": {';
echo '"@type": "WebPage",';
echo '"@id": "https://rufom.tech/novosti/prokhodcheskiy-schit/"';
echo '},';
echo '"headline": "' . $this->htmleditor('<insert name="show_h1">') . '",';
echo '"description": "' . strip_tags($result['text']) . '",';
if(! empty($result["img"][0]["src"])){
    echo '"image": "' . $result["img"][0]["src"] . '",';
}
echo '"author": {
    "@type": "Organization",
    "name": "ООО ПК РУФОМ",
    "url": "https://rufom.tech/",
  },
  "publisher": {
    "@type": "Organization",
    "name": "ООО ПК РУФОМ",
    "logo": {
        "@type": "ImageObject",
      "url": "' . $url . '"
    }
  },';
echo '"datePublished": ""';
echo '}
</script>';
echo "<div hidden>";
print_r($result);
echo "</div>";
//изображения статьи
if(! empty($result["img"]))
{
	echo '<div class="clauses_all_img img-pull-left">';
	foreach($result["img"] as $img)
	{
		switch($img["type"])
		{
			case 'animation':
				echo '<a href="'.BASE_PATH.$img["link"].'" data-fancybox="gallery'.$result["id"].'clauses">';
				break;
			case 'large_image':
				echo '<a href="'.BASE_PATH.$img["link"].'" rel="large_image" width="'.$img["link_width"].'" height="'.$img["link_height"].'">';
				break;
			default:
				echo '<a href="'.BASE_PATH_HREF.$img["link"].'">';
				break;
		}
		echo '<img src="'.$img["src"].'" width="'.$img["width"].'" height="'.$img["height"].'" alt="'.$img["alt"].'" title="'.$img["title"].'" loading="lazy">'
		.'</a> ';
	}
	echo '</div>';
}


//описание статьи
echo $this->htmleditor($result['text']);

echo '</div>';

echo $this->htmleditor('<insert name="show_block_rel" module="clauses" count="4" images="1">');
