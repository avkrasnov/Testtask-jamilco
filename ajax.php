<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<?

Class Ajax {
	public $response = false;
	
	function __construct() {
		$this->response = (object) ['data' => '', 'error' => ''];
	}
	
	static function err404() {
		include_once($_SERVER['DOCUMENT_ROOT'].'/404.php');
		exit();
	}
	
	function send($params = []) {
		echo json_encode($this->response, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
		exit();
	}
	
	function send_error($error) {
		$this->response->data = '';
		$this->response->error = $error;
		$this->send();
	}
	
	function book_route() {
		CModule::IncludeModule("form");
		$errors = CForm::Check($_POST['WEB_FORM_ID'], false, false, 'Y', 'Y');
		if ($errors) {
			$rsQuestions = CFormField::GetList(
				$_POST['WEB_FORM_ID'], 
				'ALL', 
				$by = 's_id', 
				$order = 'asc', 
				['SID' => implode(' | ', array_keys($errors))], 
				$is_filtered
			);
			while ($arQuestion = $rsQuestions->Fetch()) {
				$rsAnswers = CFormAnswer::GetList(
					$arQuestion['ID'], 
					$by = 's_id', 
					$order = 'asc', 
					[], 
					$is_filtered
				);
				if ($arAnswer = $rsAnswers->Fetch()) {
					$errorText = $errors[$arQuestion['SID']];
					$errors['form_'.($arAnswer['FIELD_TYPE']).'_'.$arAnswer['ID']] = $errorText;
				}
				unset($errors[$arQuestion['SID']]);
			}
			$this->send_error($errors);
		}
		CFormResult::Add($_POST['WEB_FORM_ID']);
		$this->send();
	}
}

$APPLICATION->RestartBuffer();
if (!defined('PUBLIC_AJAX_MODE')) define('PUBLIC_AJAX_MODE', true);
	
if (isset($_REQUEST['action'])) {
	$ajax = new Ajax();
	$a = $_REQUEST['action'];
	if (method_exists($ajax, $a)) $response = $ajax->$a(); else Ajax::err404();
	exit();
}

Ajax::err404();
?>