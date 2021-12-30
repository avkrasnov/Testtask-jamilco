<?

use Bitrix\Main\Application,
    Bitrix\Main\Web\Uri,
	Bitrix\Main\Localization\Loc;
	
Loc::loadMessages(__FILE__);

$request = Application::getInstance()->getContext()->getRequest();
$uriString = $request->getRequestUri();

$arResult['HEAD_FIELDS'] = [];
foreach ([
	'NAME' => 'Y',
	'PROPERTY_PATH' => 'N',
	'PROPERTY_DEPARTURE_DATE' => 'Y',
	'PROPERTY_ARRIVAL_DATE' => 'Y',
	'PROPERTY_SEATS' => 'N'
] as $field => $canBeSorted) {
	if ($canBeSorted == 'Y') {
		$uri = new Uri($uriString);
		if ($arParams['SORT_BY1'] == $field) {
			if ($arParams['SORT_ORDER1'] == 'DESC')
				$uri->deleteParams(['sort_order']);
			else
				$uri->addParams(['sort_order' => 'DESC']);
		} else {
			$uri->addParams(['sort' => $field]);
			$uri->deleteParams(['sort_order']);
		}
		$arResult['HEAD_FIELDS'][$field] = $uri->getUri();
	} else {
		$arResult['HEAD_FIELDS'][$field] = false;
	}
}

CModule::IncludeModule("form");

$ids = array_map(function($item) {
	return $item['ID'];
}, $arResult['ITEMS']);
$rsFormResult = CFormResult::GetList($arParams['WEB_FORM_ID'], $by = 's_id', $order = 'asc', ['FIELDS' => [['CODE' => 'route', 'VALUE' => implode(' | ', $ids)]]], $is_filtered);
$ids = [];
while ($arFormResult = $rsFormResult->Fetch()) {
	$ids[] = $arFormResult['ID'];
}

$seatsOccupied = [];
foreach ($ids as $id) {
	CFormResult::GetDataByID($id, ['seats', 'route'], $arFormResult, $arFormAnswer);
	$route = array_shift($arFormAnswer['route'])['USER_TEXT'];
	foreach ($arFormAnswer['seats'] as $arSeats) {
		$seats = array_map(function($seat) {return intval($seat);}, explode(',', $arSeats['USER_TEXT']));
		if (!isset($seatsOccupied[$route]))
			$seatsOccupied[$route] = [];
		$seatsOccupied[$route] = array_merge($seatsOccupied[$route], $seats);
	}
}

foreach ($arResult['ITEMS'] as &$item) {
	$date_now = (new DateTime)->format('d.m.Y');
	$date_tomorrow = (new DateTime)->add(new DateInterval('P1D'))->format('d.m.Y');
	foreach (['departure_date', 'arrival_date'] as $key) {
		$date = DateTime::createFromFormat('d.m.Y H:i:s', $item['DISPLAY_PROPERTIES'][$key]['VALUE']);
		$date_string = $date->format('H:i');
		switch ($date->format('d.m.Y')) {
			case $date_tomorrow:
				$date_string .= ', '.Loc::getMessage('DATE_TOMORROW');
				break;
			case $date_now:
				break;
			default:
				$date_string .= ', '.FormatDate('j F', $date->getTimestamp());
		}
		$item['DISPLAY_PROPERTIES'][$key]['DISPLAY_VALUE'] = $date_string;
		$item['OCCUPIED_SEATS'] = $seatsOccupied[$item['ID']];
		$item['SEATS_LEFT'] = 40 - count($item['OCCUPIED_SEATS']);
	}
}

?>