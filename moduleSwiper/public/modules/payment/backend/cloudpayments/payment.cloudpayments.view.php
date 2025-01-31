<?php
/**
 * Шаблон вывода виджета через систему CloudPayments
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
?>
<p><?= $result["text"]; ?></p>
<div class="cloudpayments_pay"><a id="cloudpayments_pay" href="#" class="button"><?= $this->diafan->_('Оплатить', false); ?></a></div>

<script src="https://widget.cloudpayments.ru/bundles/cloudpayments?cms=Diafan"></script>

<script>
    (function(show_widget_callback) {
        var button = document.getElementById('cloudpayments_pay');
        if (button.addEventListener) {
            button.addEventListener('click', show_widget_callback, false);
        } else {
            button.attachEvent('onclick', show_widget_callback);
        }
    })(function(e) {
        var evt = e || window.event; // Совместимость с IE8
        if (evt.preventDefault) {
            evt.preventDefault();
        } else {
            evt.returnValue = false;
            evt.cancelBubble = true;
        }
        var widget = new cp.CloudPayments({language: '<?= $result['lang'] ?>'});
        widget.<?= $result['payment_scheme'] ?>(<?= $result['widget_params'] ?>, '<?= $result['success_url'] ?>', '<?= $result['fail_url'] ?>');
    });
</script>

