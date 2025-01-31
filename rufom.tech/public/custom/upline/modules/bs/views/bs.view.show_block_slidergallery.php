<?php
/**
 * Шаблон блока баннеров
 * 
 * Шаблонный тег <insert name="show_block" module="bs" [count="all|количество"]
 * [cat_id="категория"] [id="номер_баннера"] [template="шаблон"]>:
 * блок баннеров
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

if (empty($result))
{
	return false;
}               

if(! isset($GLOBALS['include_bs_js']))
{
	$GLOBALS['include_bs_js'] = true;
	//скрытая форма для отправки статистики по кликам
    //action=""
	echo '<form method="POST" enctype="multipart/form-data" class="ajax js_bs_form bs_form">
	<input type="hidden" name="module" value="bs">
	<input type="hidden" name="action" value="click">
	<input type="hidden" name="banner_id" value="0">
	</form>';
}

echo '<section class="gallery-work">
	<h2 class="c-title gallery-title">Галерея фотографий</h2>
	<div class="slider-gallery"><div class="slider-gallery__items popup-gallery">';
foreach ($result as $i => $row)
{
	if (! empty($row['html']) || ! empty($row['image']) || ! empty($row['swf']))
	{
		echo '<div class="slider-gallery__item'.(! $i ? ' active' : '').'"> <img src="'.(! empty($row['image']) ? BASE_PATH.USERFILES.'/bs/'.$row['image'] : '').'" loading="lazy" alt="'.(! empty($row['alt']) ? $row['alt'] : '').'" title="'.(! empty($row['title']) ? $row['title'] : '').'"/>';
			echo '<div class="item-block">';
	      
				//вывод баннера в виде html разметки
				if (! empty($row['html']))
				{
					echo $row['html'];
				}
				
				//вывод баннера в виде изображения
				if (! empty($row['image']))
				{
					// echo '<img src="'.BASE_PATH.USERFILES.'/bs/'.$row['image'].'" alt="'.(! empty($row['alt']) ? $row['alt'] : '').'" title="'.(! empty($row['title']) ? $row['title'] : '').'">';
				}
				
				//вывод баннера в виде flash
				if (! empty($row['swf']))
				{
						echo '<object type="application/x-shockwave-flash" 
						data="'.BASE_PATH.USERFILES.'/bs/'.$row['swf'].'" 
						width="'.$row['width'].'" height="'.$row['height'].'">
						<param name="movie" value="'.BASE_PATH.USERFILES.'/bs/'.$row['swf'].'" />
						<param name="quality" value="high" />
						<param name="bgcolor" value="#ffffff" />
						<param name="play" value="true" />
						<param name="loop" value="true" />
						<param name="wmode" value="opaque">
						<param name="scale" value="showall" />
						<param name="menu" value="true" />
						<param name="devicefont" value="false" />
						<param name="salign" value="" />
				
						<param name="allowScriptAccess" value="sameDomain" />
				
					</object>';
				}

				//вывод описания к баннеру
				if (! empty($row['text']))
				{
          echo '<div class="item__title">';
					echo $row['text'];
					echo '</div>';
				}
        echo '<a href="'.(! empty($row['image']) ? BASE_PATH.USERFILES.'/bs/'.$row['image'] : '').'" class="item-increase" title="'.(! empty($row['title']) ? $row['title'] : '').'"><i class="ic ic--increase"></i> <span class="link">Увеличить фото</span></a>';
				//вывод ссылки на баннер, если задана
				if (! empty($row['link']))
				{
					echo '<a href="'.$row['link'].'" class="js_bs_counter bs_counter button" rel="'.$row['id'].'" '.(! empty($row['target_blank']) ? 'target="_blank"' : '').'>'.$this->diafan->_("Заказать").'</a>';
				}

			echo '</div>';
		echo '</div>';	
	}
}
echo '</div></div>';
echo "<script>			  
        [].forEach.call(document.getElementsByClassName('slider-gallery'), function(gallery){
			  var items = gallery.getElementsByClassName('slider-gallery__item');
			  if(!items){
				return;
			  }
			  items[0].classList.add('slider-gallery__first');
				var length = items.length;
			  var q = 6;
			  var index = 0;
				console.log(length);
				var controls = document.createElement('div');
				var prev = document.createElement('button');
				prev.append(document.createElement('span'));
			  prev.className = 'slider-gallery__nav-btn slider-gallery__btn-prev';
				var next = document.createElement('button');
			  next.className = 'slider-gallery__nav-btn slider-gallery__btn-next';
  			    next.append(document.createElement('span'));
			  var change = function(new_value){
				items[index].classList.remove('slider-gallery__first');
				items[new_value].classList.add('slider-gallery__first');
				index = new_value;
			  };
			  prev.addEventListener('click', function(){
				if(index > 0){
				  change(index - 1);
				}
			  });
			  next.addEventListener('click', function(){
				if(index < length - q + 1){
				  change(index + 1);
				}
			  });
				controls.append(prev);
				controls.append(next);
				gallery.append(controls);
			});
		</script></section>";