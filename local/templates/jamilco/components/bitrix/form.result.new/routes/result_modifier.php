<?

foreach ($arResult['arQuestions'] as $PID => $question) {
	if ($question['FIELD_TYPE'] == 'hidden') continue;
	$arResult['QUESTIONS'][$PID]['PARAMS'] = [];
	if ($question['COMMENTS']) {
		$params_strings = explode(PHP_EOF, $question['COMMENTS']);
		foreach ($params_strings as $param_string) {
			[$key, $val] = explode('=', $param_string);
			if (!$val) $val = true;
			$arResult['QUESTIONS'][$PID]['PARAMS'][$key] = $val;
		}
	}
}

?>