<?php
/**
 * Шаблон формы добавления сообщения в обратной связи
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

echo '<section class="form-view form-survey" hidden id="dialog-survey">';

echo '<form method="POST" enctype="multipart/form-data" action="" class="ajax">
	<input type="hidden" name="module" value="feedback">
	<input type="hidden" name="action" value="add">
	<input type="hidden" name="form_tag" value="' . $result["form_tag"] . '">
	<input type="hidden" name="site_id" value="' . $result["site_id"] . '">
	<input type="hidden" name="tmpcode" value="' . md5(mt_rand(0, 9999)) . '">';

echo '<div class="form-view__items" data-id="1">';

$required = false;
if (!empty($result["rows"])) {
    foreach ($result["rows"] as $row) //вывод полей из конструктора форм
    {
        if ($row['id'] == 27) {
            echo '<div class="calc-nav"><div class="calc-nav__text">' . $this->diafan->_('Заполняя форму, я даю согласие <br />на <a href="%s" class="modal-application__condition-txt_red">обработку персональных данных</a>.', true, BASE_PATH_HREF . 'privacy' . ROUTE_END) . '</div><div class="calc-nav__btn"><button class="calc-nav__btn-next btn" type="button">Далее →</button></div></div>';
//            echo '<span class="modal-application__condition-txt"></span>';
            echo '</div><div class="form-view__items" style="display:none" data-id="2">';
        }
        if ($row['id'] == 28) {
            echo '<div class="calc-nav"><div class="calc-nav__btn-back"><button class="calc-nav__btn-back btn" type="button">Назад</button></div><div class="calc-nav__btn"><button class="calc-nav__btn-next btn" type="button">Далее →</button></div></div>';
            echo '</div><div class="form-view__items" style="display:none" data-id="3">';
        }
        if ($row['id'] == 29) {
            echo '<div class="calc-nav"><div class="calc-nav__btn-back"><button class="calc-nav__btn-back btn" type="button">Назад</button></div><div class="calc-nav__btn"><button class="calc-nav__btn-next btn" type="button">Далее →</button></div></div>';
            echo '</div><div class="form-view__items" style="display:none" data-id="4">';
        }
        if ($row['id'] == 30) {
            echo '<div class="calc-nav"><div class="calc-nav__btn-back"><button class="calc-nav__btn-back btn" type="button">Назад</button></div><div class="calc-nav__btn"><button class="calc-nav__btn-next btn" type="button">Далее →</button></div></div>';
            echo '</div><div class="form-view__items" style="display:none" data-id="5">';
        }
        if ($row["required"]) {
            $required = true;
        }
        if ($row['id'] == 16) {
            echo '<div class="form-view__group">';
        }
        echo '<div class="form-view__param form-view__' . $row["type"] . '  field-d  form-view-param-' . $row["id"] . '">';
        if (!empty($row["text"])) {
            echo '<div class="form-view__header">' . $row["text"] . '</div>';
        }

        switch ($row["type"]) {
            case 'title':
                echo $row["name"];
                break;

            case 'text':
                if ($row['id'] == 18) {
                    echo '<input type="hidden" name="p' . $row["id"] . '" value="" class="form-view__input form-view__text-input leasing-calc-text-data-18" placeholder="' . $row["name"] . '">';
                    echo '<div class="js-leasing-calc">';
                    echo '<template id="trTpl">';
                    echo '<div class="leasing-calc-item__picture"><img src="" alt="" width="80" height="47" class="leasing-calc-item__img"></div>';
                    echo '<div class="leasing-calc-item__name">name</div>';
                    echo '<div class="leasing-calc-item__count">
                            <select class="leasing-calc-item__count-select">
                            <option value="1">1 шт</option>
                            <option value="2">2 шт</option>
                            <option value="3">3 шт</option>
                            <option value="4">4 шт</option>
                            <option value="5">5 шт</option>
                            <option value="6">6 шт</option>
                            <option value="7">7 шт</option>
                            <option value="8">8 шт</option>
                            <option value="9">9 шт</option>
                            <option value="10">10 шт</option>
                            </select></div>';
                    echo '<div class="leasing-calc-item__sum">0 $</div>';
                    echo '<div class="leasing-calc-item__delete"><button class="leasing-calc-item__delete-btn" type="button"><svg class="leasing-calc-item__delete-svg"><use href="/assets/sprite.svg#trash"></use></svg></button></div>';
                    echo '</template>';
                    echo '<div class="leasing-calc__list">';
                    echo '</div>';
                    echo '<div class="leasing-calc__button">';
                    echo '<button class="btn btn-secondary leasing-calc__add-button" type="button">+ Добавить ещё технику</button>';
                    echo '</div>';

                    echo '<div id="tr-list" class="leasing-calc__tr-list hide">';
                    echo '<div class="leasing-calc-tr__search-block">';
                    echo '<input class="search" placeholder="Поиск по названию"/>';
                    echo '<span class="sort-name">Сортировка по:</span>';
                    echo '<span class="sort" data-sort="name">имени</span>';
                    echo '<span class="sort" data-sort="price">цене</span>';
                    echo '<span class="leasing-calc-tr__close"><svg class="leasing-calc-tr__close-svg"><use href="/assets/sprite.svg#cross"></use></svg></span>';
                    echo '</div>';
                    echo $this->htmleditor('<insert name="show_block" count="1000" module="shop" template="json">');
                    echo '</div>';

                    echo '<div class="leasing-calc__sum-block">';
                    echo '<span class="leasing-calc__sum-text">Общая сумма покупки:</span>';
                    echo '<span class="leasing-calc__sum">0 $</span>';
                    echo '</div>';
                    echo '</div>';
                } else {
                    echo '<input type="text" name="p' . $row["id"] . '" value="" class="form-view__input form-view__text-input" placeholder="' . $row["name"] . '">';
                }
                break;

            case "email":
                echo '<input type="email" name="p' . $row["id"] . '" value="" class="form-view__input form-view__email-input" placeholder="' . $row["name"] . '">';
                break;

            case "phone":
                echo '<input type="tel" name="p' . $row["id"] . '" value="" class="form-view__input form-view__phone-input" placeholder="' . $row["name"] . '">';
                break;

            case 'numtext':
                $min = 0;
                $max = 0;
                $prefix = '';
                $postfix = '';
                $id = $row['id'];
                switch ($id) {
                    case 12:
                        $min = 50000;
                        $max = 2000000;
                        $prefix = '$';
                        $postfix = '';
                        break;
                    case 13:
                        $min = 5;
                        $max = 30;
                        $prefix = '';
                        $postfix = '%';
                        break;
                }
                echo '<div class="survey-nouislider" data-min="' . $min . '" data-max="' . $max . '" data-postfix="' . $postfix . '" data-prefix="' . $prefix . '">';
                echo '<div class="form-view__numtext-value"></div>';
                echo '<input type="hidden" name="p' . $row["id"] . '" value="" class="form-view__input form-view__numtext-input" placeholder="' . $row["name"] . '">';
                echo '<div class="form-view__nouislider"></div>';
                echo '</div>';
                break;

            case 'radio':
                echo '<div class="form-view__radios" >';
                foreach ($row["select_array"] as $select) {
                    echo '<label class="form-view__radio-label"><input class="form-view__radio-input" name="p' . $row["id"] . '" type="radio" value="' . $select["id"] . '" id="feedback_form_p' . $row["id"] . '_' . $select["id"] . '">
							<span class="form-view__radio-name">' . $select["name"] . '</span></label>';
                }
                echo '</div>';
                break;

            case 'select':
                echo '<select name="p' . $row["id"] . '" class="form-view__select">
						<option value="">-</option>';
                foreach ($row["select_array"] as $select) {
                    echo '<option value="' . $select["id"] . '">' . $select["name"] . '</option>';
                }
                echo '</select>';
                break;

        }

        if ($row["type"] != 'title') {
            echo '<div class="errors error_p' . $row["id"] . '"' . ($result["error_p" . $row["id"]] ? '>' . $result["error_p" . $row["id"]] : ' style="display:none">') . '</div>';
        }

        echo '</div>';
        if ($row['id'] == 17) {
            echo '</div>';
        }
    }
}


//Защитный код
echo $result["captcha"];

//Кнопка Отправить
echo '<div class="errors error_p16" style="display:none"></div>';
echo '<div class="modal-application__wrapper-btn-condition">';
echo '<div class="calc-nav"><div class="calc-nav__btn-back"><button class="calc-nav__btn-back btn" type="button">Назад</button></div>
      <div class="calc-nav__btn"><button type="submit" class="btn modal-application__btn-condition btn-next button-d">' . $this->diafan->_('Отправить') . '</button></div></div>';

echo '</div>';

echo '</div>';

//	if($required)
//	{
//		echo '<div class="required_field"><span class="_asterisk"></span> — '.$this->diafan->_('Поля, обязательные для заполнения').'</div>';
//	}

echo '</form>';

echo '<div class="errors error"' . ($result["error"] ? '>' . $result["error"] : ' style="display:none">') . '</div>';


echo '</section>';
