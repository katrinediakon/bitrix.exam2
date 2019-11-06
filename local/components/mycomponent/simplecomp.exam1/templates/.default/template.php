<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<p><b><?= GetMessage("SIMPLECOMP_EXAM2_CAT_TITLE") ?></b></p>


<? foreach ($arResult['PRODUCT'] as $key => $value): ?>
    <ul>
        <li><?= $value['NAME'] ?>
            <? $section = '' ?>
            <? $element = '' ?>
            <? foreach ($value['SECTION'] as $key_section => $value_section): ?>
                <? $section .= $value_section['NAME'] . ',' ?>
                <? foreach ($value_section['ELEMENT'] as $value_element): ?>
                <?$link = str_replace('#ID_SECTION#' ,$value_section['ID'], $arParams['LINK'])?>
                    <?$element .= '<li>'.$value_element['NAME'] .' ('. str_replace('#ID_PRODUCT#' ,$value_element['ID'], $link) .') '. '-' . $value_element['PROPERTY_PRICE_VALUE'] . '-'. $value_element['PROPERTY_ARTNUMBER_VALUE'] . '-' . $value_element['PROPERTY_MATERIAL_VALUE'].'</li>'?>
                <? endforeach; ?>
            <? endforeach; ?>
            (<?= substr($section, 0, strlen($section) - 1) ?>)
            <ul><?=$element?></ul>
        </li>

    </ul>
<? endforeach; ?>
