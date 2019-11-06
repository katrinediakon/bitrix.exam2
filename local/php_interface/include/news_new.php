<?
// файл /bitrix/php_interface/init.php
// регистрируем обработчик
AddEventHandler("iblock", "OnBeforeIBlockElementAdd",  "OnBeforeIBlockElementAddHandler");


    // создаем обработчик события "OnBeforeIBlockElementAdd"
    function OnBeforeIBlockElementAddHandler(&$arFields)
    {
        if ($arFields["IBLOCK_ID"] == 1) {
            if (stristr($arFields['PREVIEW_TEXT'], 'калейдоскоп') == true) {
                global $APPLICATION;
                $APPLICATION->throwException("Мы не используем слово калейдоскоп в анонсах новостей");
                return false;
            }
        }
    }

?>