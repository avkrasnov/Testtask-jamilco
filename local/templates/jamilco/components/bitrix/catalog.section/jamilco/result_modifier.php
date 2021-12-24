<?

$items = [];
foreach ($arResult['ITEMS'] as $item) {
	if ($item['ACTIVE'] != 'Y') continue;
	$artnumber = $item['PROPERTIES']['ARTNUMBER']['VALUE'];
	$model = substr($artnumber, 0, 4);
	if (!isset($items[$model])) $items[$model] = [];
	$sku = [];
	foreach ($item['OFFERS'] as $offer) {
		$size = $offer['PROPERTIES']['SIZE']['VALUE'];
		$sku[$offer['ID']] = [
			'ID'   => $offer['ID'],
			'NAME' => $artnumber . $size,
			'SIZE' => $size,
			'SIZE_SORT' => $offer['PROPERTIES']['SIZE']['VALUE_SORT']
		];
	}
	if (!count($sku)) continue;
	uasort($sku, function($a, $b) {
		return $a['SIZE_SORT'] - $b['SIZE_SORT'];
	});
	foreach ($sku as $id => $offer) unset($sku[$id]['SIZE_SORT']);
	$items[$model][$item['ID']] = [
		'ITEM' => [
			'ID'        => $item['ID'],
			'NAME'      => $item['NAME'],
			'ARTNUMBER' => $artnumber
		],
		'SKU'  => $sku
	];
}
$items = array_filter($items);
$arResult['LINKED_ITEMS'] = [];
foreach ($items as $model_array) {
	$max_id = max(array_keys($model_array));
	$max_artnumber = $model_array[$max_id]['ITEM']['ARTNUMBER'];
	$arResult['LINKED_ITEMS'][$max_artnumber] = $model_array;
}

?>