<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Loader,
	Bitrix\Iblock;

if(!Loader::includeModule("iblock"))
{
	ShowError(GetMessage("SIMPLECOMP_EXAM2_IBLOCK_MODULE_NONE"));
	return;
}

if ($arParams["PRODUCTS_IBLOCK_ID"] && $arParams["ALT_IBLOCK_ID"] && $arParams["CODE"] ) {
    $arResult = array();
    if ($this->StartResultCache()) {

        $arFilter = Array('IBLOCK_ID'=>$arParams["ALT_IBLOCK_ID"], 'GLOBAL_ACTIVE'=>'Y');
        $db_list = CIBlockSection::GetList(Array(), $arFilter, true, array("NAME", "ID"));
        while ($ar_result = $db_list->GetNext())
        {
           $arResult['PRODUCT'][$ar_result["ID"]]['NAME'] = $ar_result["NAME"];
           $arResult['PRODUCT'][$ar_result["ID"]]['ID'] = $ar_result["ID"];
        }
        $arFilter = Array('IBLOCK_ID'=>$arParams["PRODUCTS_IBLOCK_ID"], 'GLOBAL_ACTIVE'=>'Y');
        $db_list = CIBlockSection::GetList(Array(), $arFilter, true, array("NAME", "ID", "UF_NEW_CLASSIFIER"));
        while ($ar_result = $db_list->GetNext())
        {
            foreach ($arResult['PRODUCT'] as $key => $value) {
                if ($value['ID'] ==  $ar_result["UF_NEW_CLASSIFIER"]) {
                    $value['SECTION'][$ar_result['ID']]['NAME'] = $ar_result["NAME"];
                    $value['SECTION'][$ar_result['ID']]['ID'] = $ar_result["ID"];
                    $arResult['PRODUCT'][$key] = $value;
                }
            }
        }
        $arSelect = Array("ID", "NAME", "PROPERTY_PRICE", "PROPERTY_ARTNUMBER", "PROPERTY_MATERIAL", 'IBLOCK_SECTION_ID');
        $arFilter = Array("IBLOCK_ID"=>$arParams["PRODUCTS_IBLOCK_ID"], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
        $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
        while($ob = $res->GetNext())
        {
            foreach ($arResult['PRODUCT'] as $key => $value) {
                foreach ($value['SECTION'] as $key_section => $value_section) {
                    if ($value_section['ID'] == $ob['IBLOCK_SECTION_ID']) {
                        $value_section['ELEMENT'][] = $ob;
                    }
                    $arResult['PRODUCT'][$key]['SECTION'][$key_section]=$value_section;
                }
            }
        }
        $arResult['COUNT'] = count($arResult['PRODUCT']);
    }
    $this->SetResultCacheKeys('COUNT');
}
$APPLICATION->SetTitle("В каталоге товаров представлено разделов: " . $arResult['COUNT']);
$this->includeComponentTemplate();
?>