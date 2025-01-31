<?php
/**
 * Основной шаблон сайта
 *
 * @package    DIAFAN.CMS
 * @author     diafan.ru
 * @version    6.0
 * @license    http://www.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2018 OOO «Диафан» (http://www.diafan.ru/)
 */

if (!defined("DIAFAN")) {
    $path = __FILE__;
    while (!file_exists($path . '/includes/404.php')) {
        $parent = dirname($path);
        if ($parent == $path) exit;
        $path = $parent;
    }
    include $path . '/includes/404.php';
}
?>

<insert name="show_include" file="head"></insert>
<body class="page">
<div class="page__wrap">
    <insert name="show_include" file="header"></insert>
    <div class="inner">
        <div class="container">
            <h1>
                <insert name="show_h1"></insert>
            </h1>
            <insert name="show_breadcrumb" current="true"></insert>
            <?php
            $products = [
                1 => 'Неопрен CR',
                2 => 'EPDM 150',
                3 => 'Неопрен СR/SBR',
                4 => 'EPDM 100',
                //5 => 'Пористая резина SBR',
                6 => 'EPDM полуоткрытые поры',
                7 => 'EPDM 100',  // Уплотнитель
                8 => 'EPDM 150', // Уплотнитель
                9 => 'Неопрен CR', // Уплотнитель
                10 => 'Неопрен CR/SBR',// Уплотнитель
                11 => 'Уплотнитель ТЭП (TPE-S)',
                12 => 'ФЭШН неопрен',
                13 => 'Неопрен с тканью',
                14 => 'Дайвинг Неопрен',
                15 => 'Аэропрен (ортопрен)',
                //16 => 'EVA (Эвапласт)',
                17 => 'Листы EVA с ячейками',
                18 => 'Термоэластопласт TPE-S',
                19 => 'Пищевой EPDM100',
                20 => 'Неопрен с тиснением',
                21 => 'Автоковрики',
                22 => 'EVA (Эвапласт)',
                23 => 'Ложементы'
            ];

            $applications = [
                [
                    'name' => 'Уплотнения',
                    'image' => 'ico-obl-01.svg',
                    'list' => [
                        8, 7, 10, 9, 18
                    ]
                ],
                [
                    'name' => 'Амортизаторы',
                    'image' => 'ico-obl-02.svg',
                    'list' => [
                        2, 4, 3, 1
                    ]
                ],
                [
                    'name' => 'Звукоизоляция',
                    'image' => 'ico-obl-03.svg',
                    'list' => [
                        8, 7, 10, 18
                    ]
                ],
                [
                    'name' => 'Автомобильная промышленность',
                    'image' => 'ico-obl-04.svg',
                    'list' => [
                        2, 4, 3, 1, 6
                    ]
                ],
                [
                    'name' => 'Станкостроение',
                    'image' => 'ico-obl-05.svg',
                    'list' => [
                        2, 4, 3, 1
                    ]
                ],
                [
                    'name' => 'Нефтегазовая промышленность',
                    'image' => 'ico-obl-06.svg',
                    'list' => [
                        2, 4, 1
                    ]
                ],
                [
                    'name' => 'Ж/Д',
                    'image' => 'ico-obl-07.svg',
                    'list' => [
                        8, 7, 9, 18
                    ]
                ],
                [
                    'name' => 'Электроника',
                    'image' => 'ico-obl-08.svg',
                    'list' => [
                        8, 7, 10
                    ]
                ],
                [
                    'name' => 'Вентиляционные системы',
                    'image' => 'ico-obl-09.svg',
                    'list' => [
                        8, 22
                    ]
                ],
                [
                    'name' => 'Рекламная продукция',
                    'image' => 'ico-obl-10.svg',
                    'list' => [
                        22, 13, 20
                    ]
                ],
                [
                    'name' => 'Спортивные снаряды',
                    'image' => 'ico-obl-11.svg',
                    'list' => [
                        2, 4, 22
                    ]
                ],
                [
                    'name' => 'Тара и упаковка',
                    'image' => 'ico-obl-12.svg',
                    'list' => [
                        18, 2, 22
                    ]
                ],
                [
                    'name' => 'Машиностроение',
                    'image' => 'ico-obl-13.svg',
                    'list' => [
                        8, 7, 10, 9
                    ]
                ],
                [
                    'name' => 'Строительство',
                    'image' => 'ico-obl-14.svg',
                    'list' => [
                        8, 7, 10, 9, 18
                    ]
                ],
                [
                    'name' => 'Электроизоляция',
                    'image' => 'ico-obl-15.svg',
                    'list' => [
                        8, 7, 10, 9, 18
                    ]
                ],
                [
                    'name' => 'Судостроение',
                    'image' => 'ico-obl-16.svg',
                    'list' => [
                        8, 7, 10, 9
                    ]
                ],
                [
                    'name' => 'Авиация',
                    'image' => 'ico-obl-17.svg',
                    'list' => [
                        8, 7, 10, 9
                    ]
                ],
                [
                    'name' => 'Ортопедия',
                    'image' => 'ico-obl-18.svg',
                    'list' => [
                        22, 13, 2, 4
                    ]
                ],
                [
                    'name' => 'Спортивная медицина (фиксаторы, бандажи)',
                    'image' => 'ico-obl-19.svg',
                    'list' => [
                        13, 15, 22
                    ]
                ],
                [
                    'name' => 'Товары для детей',
                    'image' => 'ico-obl-20.svg',
                    'list' => [
                        22
                    ]
                ],
                [
                    'name' => 'Средства защиты',
                    'image' => 'ico-obl-21.svg',
                    'list' => [
                        1, 18, 22
                    ]
                ],
                [
                    'name' => 'Дайвинг',
                    'image' => 'ico-obl-22.svg',
                    'list' => [
                        14
                    ]
                ],
                [
                    'name' => 'Тюнинг автомобиля',
                    'image' => 'ico-obl-23.svg',
                    'list' => [
                        2, 22, 1
                    ]
                ],
                [
                    'name' => 'Сантехнические прокладки',
                    'image' => 'ico-obl-24.svg',
                    'list' => [
                        8, 10, 22
                    ]
                ],
                [
                    'name' => 'Косплей',
                    'image' => 'ico-obl-25.svg',
                    'list' => [
                        22
                    ]
                ],
                [
                    'name' => 'Ложементы',
                    'image' => 'ico-obl-26.svg',
                    'list' => [
                        8, 22
                    ]
                ],
                [
                    'name' => 'Товары для животных',
                    'image' => 'ico-obl-27.svg',
                    'list' => [
                        13, 15, 22
                    ]
                ],
                [
                    'name' => 'Мусоропроводы',
                    'image' => 'ico-obl-28.svg',
                    'list' => [
                        11, 8
                    ]
                ],
                [
                    'name' => 'Прыжковые ямы',
                    'image' => 'ico-obl-29.svg',
                    'list' => [
                        18
                    ]
                ],
                [
                    'name' => 'Ремни для охоты/рыбалки',
                    'image' => 'ico-obl-30.svg',
                    'list' => [
                        20
                    ]
                ],
                [
                    'name' => 'Охота/рыбалка',
                    'image' => 'ico-obl-31.svg',
                    'list' => [
                        13, 20, 22, 14
                    ]
                ],
                [
                    'name' => 'Коврики',
                    'image' => 'ico-obl-32.svg',
                    'list' => [
                        21, 13, 20, 22
                    ]
                ],
                [
                    'name' => 'Изделия общего потребления',
                    'image' => 'ico-obl-33-2.svg',
                    'list' => [
                        13, 12, 22, 21
                    ]
                ],
                [
                    'name' => 'Амортизационные блоки',
                    'image' => 'ico-obl-34.svg',
                    'list' => [
                        1, 2, 4, 22
                    ]
                ],
                [
                    'name' => 'Оснастки, штанцевальные матрицы',
                    'image' => 'ico-obl-35.svg',
                    'list' => [
                        1, 2, 14
                    ]
                ],
            ];
            ?>
            <div class="application-grid">
                <?php foreach ($applications as $application) {
                    echo '<div class="application-item">';
                    echo '<div class="application-item-image"><img width="80" height="80" src="', '/custom/upline/img/applications-v2/', $application['image'], '" loading="lazy" alt="', $application['name'], '" title="', $application['name'], '" /></div>';
                    echo '<div class="application-item-title">', $application['name'], '</div>';
                    echo '<ul class="application-item-list">';
                    foreach ($application['list'] as $id) {
                        echo '<li><a href="/', $this->diafan->_route->link(4, $id, "shop"), '">', $products[$id], '</a></li>';
                    }
                    echo '</ul>';
                    echo '</div>';
                } ?>
            </div>
            <div class="content">
                <insert name="show_text"></insert>
            </div>
            <insert name="show_module"></insert>
        </div>
    </div>
    <insert name="show_include" file="footer"></insert>
</div>

<insert name="show_include" file="foot"></insert>
</body>
</html>
