<?
// файл /bitrix/php_interface/init.php
// регистрируем обработчик
AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", Array("MyClass", "OnBeforeIBlockElementUpdateHandler"));

class MyClass
{
    // создаем обработчик события "OnBeforeIBlockElementUpdate"
    function OnBeforeIBlockElementUpdateHandler(&$arFields) {
        if($arFields['IBLOCK_ID'] == 1) {
            $arFields["PREVIEW_TEXT"] = str_replace("калейдоскоп", '[...]', $arFields["PREVIEW_TEXT"]);
            CEventLog::Add(array(
                "SEVERITY" => "NEWS_CHANGE",
                "AUDIT_TYPE_ID" => "NEWS_CHANGE",
                "MODULE_ID" => "main",
                "DESCRIPTION" => "Замена слова калейдоскоп на [...], в новости с ID = {" . $arFields['ID'] . "}",
            ));
        }
    }
}
?>