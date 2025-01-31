<?php 

ini_set('display_errors', 'on');
error_reporting(E_ALL | E_STRICT);
$fp = fsockopen('user.diafan.ru', 80);
echo '<p>Sockets: ';
echo $fp ? '<b><font color="green">yes</font></b>' : '<b><font color="red">no</font></b>';
echo '</p>';
