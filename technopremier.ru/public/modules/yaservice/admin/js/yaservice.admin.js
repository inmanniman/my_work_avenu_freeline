/**
 * JS-сценарий сервисов
 *
 * @package    DIAFAN.CMS
 * @author     diafan.ru
 * @version    7.0
 * @license    http://www.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2021 OOO «Диафан» (http://www.diafan.ru/)
 */



var yaserviceURL = '';
var yaserviceWindow = null;

function yaserviceOpenWindow(url, target, params)
{
    if (url)
    {
        var vw = Math.max(document.documentElement.clientWidth || 0, window.innerWidth || 0);
        var vh = Math.max(document.documentElement.clientHeight || 0, window.innerHeight || 0);

        target = target || 'yaservice_window';
        params = params || 'width=' + (vw ? vw : 1000) + ',height=' + (vh ? vh : 700) + ',scrollbars=yes,resizable=yes,menubar=no,toolbar=no,location=no,status=no';

        if (yaserviceWindow)
        {
            if (yaserviceWindow.closed)
            {
                yaserviceWindow = window.open(url, target, params);
            }
            else if (yaserviceURL != url)
            {
                yaserviceWindow = window.open(url, target, params);
            }
        }
        else
        {
            yaserviceWindow = window.open(url, target, params);
        }
        yaserviceWindow.focus();

        yaserviceURL = url;
    }
}