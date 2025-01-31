<?php
/**
 * Файл-блок шаблона
 *
 * @package    DIAFAN.CMS
 * @author     diafan.ru
 * @version    7.0
 * @license    http://www.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2020 OOO «Диафан» (http://www.diafan.ru/)
 */

?>
<nav class="nav">
    <div class="nav__header">
        <!--<div class="nav__phone">
            <a href='tel:<insert name="show_theme" module="site" tag="logo_text" useradmin="false"></insert>' class="phone"><insert name="show_theme" module="site" tag="phone" useradmin="false"></a>
        </div>-->
        <div class="pushmenu opened"><span></span><span></span><span></span><span></span></div>
    </div>
    <insert name="show_block" module="menu" id="1" template="pushmenu"></insert>
    <insert name="show_block" module="menu" id="3" template="pushmenu"></insert>
</nav>
