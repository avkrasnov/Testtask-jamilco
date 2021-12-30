<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<?
if ($_REQUEST['ajax']) {
	$APPLICATION->RestartBuffer();
	echo json_encode($arResult['LINKED_ITEMS'], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
	exit();
}?>

<input id="artnumber" placeholder="Артикул">
<button class="ajax" onclick="sendAjax()">Отправить запрос</button>

<script>
	async function sendAjax() {
		const artnumber = document.getElementById('artnumber').value;
		const response = await fetch('ajax.php/?ajax=1&artnumber=' + artnumber);
		const result = await response.json();
		window.linkedItems = result;
		alert('Данные сохранены в window.linkedItems');
	}
</script>

<pre><?print_r($arResult['LINKED_ITEMS'])?></pre>