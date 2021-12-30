<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<?use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);?>

<div class="routes">
	<div class="routes-head">
		<?foreach ($arResult['HEAD_FIELDS'] as $field => $uri):?>
			<?if ($uri):?>
				<a
					href="<?=$uri?>"
					data-sort="<?=$field?>"
					<?if ($arParams['SORT_BY1'] == $field):?>
						class="active"
						data-sort-order="<?=$arParams['SORT_ORDER1']?>"
					<?endif?>
				>
					<?=Loc::getMessage("SORT_BY_".$field)?>
				</a>
			<?else:?>
				<div><?=Loc::getMessage("SORT_BY_".$field)?></div>
			<?endif?>
		<?endforeach?>
		<div></div>
	</div>
	
	<?foreach ($arResult['ITEMS'] as $route):?>
		<div class="route">
			<div class="route-name"><?=$route['NAME']?></div>
			<div>
				<div class="route-cities open-buy-form"><?=$route['DISPLAY_PROPERTIES']['departure_city']['DISPLAY_VALUE']?> - <?=$route['DISPLAY_PROPERTIES']['arrival_city']['DISPLAY_VALUE']?></div>
				<div class="route-company">поезд, <?=$route['DISPLAY_PROPERTIES']['company']['DISPLAY_VALUE']?></div>
			</div>
			<div><?=$route['DISPLAY_PROPERTIES']['path']['DISPLAY_VALUE']?></div>
			<div><?=$route['DISPLAY_PROPERTIES']['departure_date']['DISPLAY_VALUE']?></div>
			<div><?=$route['DISPLAY_PROPERTIES']['arrival_date']['DISPLAY_VALUE']?></div>
			<div><?=$route['SEATS_LEFT']?> <?=format_text(Loc::getMessage('SEATS_LEFT'), $route['SEATS_LEFT'])?></div>
			<div>
				<button class="btn btn-primary open-buy-form">Купить билет</button>
			</div>
			<div class="buy-ticket">
				<div class="d-flex">
					<div class="train">
						<div class="seats">
							<?for ($i = 1; $i <= 40; $i++):?>
								<div class="seat<?if (in_array($i, $route['OCCUPIED_SEATS'])):?> disabled<?endif?>" data-seat="<?=$i?>"><?=($i < 10 ? '0'.$i : $i)?></div>
							<?endfor?>
						</div>
					</div>
					<div class="selected-seats">
						<div><?=Loc::getMessage('YOU_SELECTED')?></div>
						<div class="numbers">
							<span class="seats-info"></span>
							<span class="one-seat-selected"><?=Loc::getMessage('ONE_SEAT')?></span>
							<span class="seats-selected"><?=Loc::getMessage('SEATS')?></span>
						</div>
					</div>
				</div>
				<?$APPLICATION->IncludeComponent(
					"bitrix:form.result.new",
					"routes",
					Array(
						"CACHE_TIME" => "3600",
						"CACHE_TYPE" => "A",
						"CHAIN_ITEM_LINK" => "",
						"CHAIN_ITEM_TEXT" => "",
						"EDIT_URL" => "result_edit.php",
						"IGNORE_CUSTOM_TEMPLATE" => "N",
						"LIST_URL" => "result_list.php",
						"SEF_MODE" => "N",
						"SUCCESS_URL" => "",
						"USE_EXTENDED_ERRORS" => "N",
						"VARIABLE_ALIASES" => Array("RESULT_ID"=>"RESULT_ID","WEB_FORM_ID"=>"WEB_FORM_ID"),
						"WEB_FORM_ID" => $arParams["WEB_FORM_ID"],
						"ROUTE_ID" => $route['ID']
					)
				);?>
			</div>
		</div>
	<?endforeach?>
</div>