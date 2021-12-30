<?

//const CATALOG_IBLOCK_ID = 1; // инфоблок каталога товаров
//const SKU_IBLOCK_ID = 2; // инфоблок торг. предложений (разные размеры одного товара)

define('CATALOG_IBLOCK_ID', getIBlockIDByCode('clothes'));
define('SKU_IBLOCK_ID', getIBlockIDByCode('clothes_offers'));

include($_SERVER['DOCUMENT_ROOT'].'/local/php_interface/class.custom_localization.php');

function getIBlockIDByCode($code) {
	\Bitrix\Main\Loader::includeModule('iblock');
	$row = \Bitrix\Iblock\IblockTable::getRow([
		'select' => ['ID'],
		'filter' => ['CODE' => $code]
	]);
	return $row ? $row['ID'] : 0;
}

function getIBlockPropertyIDByCode($code, $ibcode) {
	if (!is_numeric($ibcode)) $ibcode = getIBlockIDByCode($ibcode);
	\Bitrix\Main\Loader::includeModule('iblock');
	$row = \Bitrix\Iblock\PropertyTable::getRow([
		'select' => ['ID'],
		'filter' => ['CODE' => $code, 'IBLOCK_ID' => $ibcode]
	]);
	return $row ? $row['ID'] : 0;
}

function format_text($text, $n = 1) {
	$n = intval($n);
	list($word_one, $word_two, $word_five) = explode('|', $text);
	if ($n % 10 > 4 || $n % 10 == 0 || ($n % 100 >= 11 && $n % 100 <= 14)) return $word_five ?? $word_two; else if ($n % 10 == 1) return $word_one;
	return $word_two;
}

?>