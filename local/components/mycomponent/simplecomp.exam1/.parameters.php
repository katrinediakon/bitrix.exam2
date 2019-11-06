<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arComponentParameters = array(
	"PARAMETERS" => array(
		"PRODUCTS_IBLOCK_ID" => array(
			"NAME" => GetMessage("SIMPLECOMP_EXAM2_CAT_IBLOCK_ID"),
			"TYPE" => "STRING",
		),
        "ALT_IBLOCK_ID" => array(
            "NAME" => GetMessage("SIMPLECOMP_EXAM2_ALT_IBLOCK_ID"),
            "TYPE" => "STRING",
        ),
        "CODE" => array(
            "NAME" => GetMessage("SIMPLECOMP_EXAM2_CODE"),
            "TYPE" => "STRING",
        ),
        "LINK" => array(
            "NAME" => GetMessage("SIMPLECOMP_EXAM2_LINK"),
            "TYPE" => "STRING",
        ),
        'CACHE_TIME'  =>  Array('DEFAULT'=>36000000),
	),
);