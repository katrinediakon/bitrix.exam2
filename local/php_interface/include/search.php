<?
// файл /bitrix/php_interface/init.php
// регистрируем обработчик
AddEventHandler("search", "BeforeIndex", "BeforeIndexHandler");


    // создаем обработчик события "BeforeIndex"
    function BeforeIndexHandler($arFields)
    {

        if($arFields["MODULE_ID"] == "iblock" && $arFields["PARAM2"] == 1)
        {
            if(array_key_exists("TITLE", $arFields))
            {
                $arFields["TITLE"] = substr($arFields['BODY'], 0, 50) ;
            }
        }
        return $arFields;
    }

?>