<html lang="<?=LANGUAGE_ID?>">
	<head>
		<?$APPLICATION->ShowHead();?>
		<title><?$APPLICATION->ShowTitle()?></title>
		<?
			use Bitrix\Main\UI\Extension;
			use Bitrix\Main\Page\Asset;
			CJSCore::Init(['jquery']);
			Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/js/jquery.mask.js');
			Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/js/script.js');
		?>
	</head>

	<body>
		<?$APPLICATION->ShowPanel();?>
		<header>
			
		</header>

		<div id="content">
			