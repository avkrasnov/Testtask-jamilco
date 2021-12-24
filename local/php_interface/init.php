<?

//const CATALOG_IBLOCK_ID = 1; // инфоблок каталога товаров
//const SKU_IBLOCK_ID = 2; // инфоблок торг. предложений (разные размеры одного товара)

define('CATALOG_IBLOCK_ID', getIBlockIDByCode('clothes'));
define('SKU_IBLOCK_ID', getIBlockIDByCode('clothes_offers'));

function getIBlockIDByCode($code) {
	\Bitrix\Main\Loader::includeModule('iblock');
	$row = \Bitrix\Iblock\IblockTable::getRow([
		'select' => ['ID'],
		'filter' => ['CODE' => $code]
	]);
	return $row ? $row['ID'] : 0;
}

?>