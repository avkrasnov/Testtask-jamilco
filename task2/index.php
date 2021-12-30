<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");
use Bitrix\Main\UI\Extension;
Extension::load('ui.bootstrap4');?>

<div class="container">
	<div class="d-flex mt-4 mb-4">
		<img src="<?=SITE_TEMPLATE_PATH?>/images/tickets-logo.svg" class="logo mr-5">
		<?$APPLICATION->IncludeComponent(
			"bitrix:catalog.smart.filter",
			"tickets",
			Array(
				"CACHE_GROUPS" => "Y",
				"CACHE_TIME" => "36000000",
				"CACHE_TYPE" => "A",
				"CONVERT_CURRENCY" => "N",
				"DISPLAY_ELEMENT_COUNT" => "Y",
				"FILTER_NAME" => "arrFilter",
				"FILTER_VIEW_MODE" => "horizontal",
				"HIDE_NOT_AVAILABLE" => "N",
				"IBLOCK_ID" => "8",
				"IBLOCK_TYPE" => "trains",
				"PAGER_PARAMS_NAME" => "arrPager",
				"POPUP_POSITION" => "left",
				"PREFILTER_NAME" => "smartPreFilter",
				"PRICE_CODE" => array(),
				"SAVE_IN_SESSION" => "N",
				"SECTION_CODE" => "",
				"SECTION_DESCRIPTION" => "-",
				"SECTION_ID" => $_REQUEST["SECTION_ID"],
				"SECTION_TITLE" => "-",
				"SEF_MODE" => "N",
				"TEMPLATE_THEME" => "blue",
				"XML_EXPORT" => "N"
			)
		);?>
	</div>
	<?$APPLICATION->IncludeComponent(
		"bitrix:news.list",
		"routes",
		Array(
			"ACTIVE_DATE_FORMAT" => "d.m.Y",
			"ADD_SECTIONS_CHAIN" => "Y",
			"AJAX_MODE" => "N",
			"AJAX_OPTION_ADDITIONAL" => "",
			"AJAX_OPTION_HISTORY" => "N",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"CACHE_FILTER" => "N",
			"CACHE_GROUPS" => "Y",
			"CACHE_TIME" => "36000000",
			"CACHE_TYPE" => "N",
			"CHECK_DATES" => "Y",
			"DETAIL_URL" => "",
			"DISPLAY_BOTTOM_PAGER" => "Y",
			"DISPLAY_DATE" => "Y",
			"DISPLAY_NAME" => "Y",
			"DISPLAY_PICTURE" => "Y",
			"DISPLAY_PREVIEW_TEXT" => "Y",
			"DISPLAY_TOP_PAGER" => "N",
			"FIELD_CODE" => array("",""),
			"FILTER_NAME" => "arrFilter",
			"HIDE_LINK_WHEN_NO_DETAIL" => "N",
			"IBLOCK_ID" => "8",
			"IBLOCK_TYPE" => "trains",
			"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
			"INCLUDE_SUBSECTIONS" => "Y",
			"MESSAGE_404" => "",
			"NEWS_COUNT" => "0",
			"PAGER_BASE_LINK_ENABLE" => "N",
			"PAGER_DESC_NUMBERING" => "N",
			"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
			"PAGER_SHOW_ALL" => "N",
			"PAGER_SHOW_ALWAYS" => "N",
			"PAGER_TEMPLATE" => ".default",
			"PAGER_TITLE" => "Новости",
			"PARENT_SECTION" => "",
			"PARENT_SECTION_CODE" => "",
			"PREVIEW_TRUNCATE_LEN" => "",
			"PROPERTY_CODE" => array("path","departure_date","arrival_date","departure_city","arrival_city","company",""),
			"SET_BROWSER_TITLE" => "Y",
			"SET_LAST_MODIFIED" => "N",
			"SET_META_DESCRIPTION" => "Y",
			"SET_META_KEYWORDS" => "Y",
			"SET_STATUS_404" => "N",
			"SET_TITLE" => "Y",
			"SHOW_404" => "N",
			"SORT_BY1" => $_REQUEST["sort"] ?? "NAME",
			"SORT_BY2" => "SORT",
			"SORT_ORDER1" => $_REQUEST["sort_order"] ?? "ASC",
			"SORT_ORDER2" => "ASC",
			"STRICT_SECTION_CHECK" => "N",
			"WEB_FORM_ID" => 1
		)
	);?>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>