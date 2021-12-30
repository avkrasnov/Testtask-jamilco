<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);?>

<?=$arResult["FORM_NOTE"]?>
<?if ($arResult["isFormNote"] != "Y")
{
?>
<?=$arResult["FORM_HEADER"]?>

<div class="d-flex form-row">
	<?foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion):?>
		<?switch ($arQuestion['STRUCTURE'][0]['FIELD_TYPE']):
			case 'hidden':?>
				<input
					type="hidden"
					name="form_hidden_<?=$arQuestion['STRUCTURE'][0]['ID']?>"
					data-name="<?=$FIELD_SID?>"
					<?if ($FIELD_SID == 'route'):?>
						value="<?=$arParams['ROUTE_ID']?>"
					<?endif?>
				>
				<?break;?>
			<?case 'radio':?>
				<?foreach ($arQuestion['STRUCTURE'] as $structure):?>
					<label class="radio-label <?=$structure['FIELD_PARAM']?>">
						<?=$structure['MESSAGE']?>
						<input
							type="radio"
							<?=$structure['FIELD_PARAM']?>
							id="radio_<?=$arParams['ROUTE_ID']?>_<?=$structure['ID']?>"
							name="form_radio_<?=$FIELD_SID?>"
							value="<?=$structure['ID']?>"
						>
					</label>
				<?endforeach?>
				<?break;?>
			<?default:?>
				<input
					type="text"
					class="inputtext <?=$arQuestion['PARAMS']['class']?>"
					<?if($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'date'):?>
						data-toggle="datepicker"
						data-id="route_<?=$arParams['ROUTE_ID']?>_<?=$arQuestion['STRUCTURE'][0]['ID']?>"
					<?endif?>
					name="form_<?=$arQuestion['STRUCTURE'][0]['FIELD_TYPE']?>_<?=$arQuestion['STRUCTURE'][0]['ID']?>"
					placeholder="<?=$arQuestion["CAPTION"]?>"
				>
		<?endswitch?>
		<?if ($arQuestion['PARAMS']['EOL']):?></div><div class="d-flex form-row"><?endif?>
	<?endforeach?>
</div>
<div class="errors"></div>
<input type="submit" class="btn btn-primary btn-pink" name="web_form_submit" value="<?=htmlspecialcharsbx(trim($arResult["arForm"]["BUTTON"]) == '' ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>">
<div class="success"><?=Loc::getMessage("SUCCESS")?></div>
<?=$arResult["FORM_FOOTER"]?>
<?
} //endif (isFormNote)