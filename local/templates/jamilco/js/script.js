const datepickers = {};
$(() => {
	$('[data-toggle="datepicker"]').each(function() {
		const $datepicker = $(this).datepicker({
			autoHide: true,
			language:'ru-RU',
			format:'dd.mm.yyyy',
			weekStart: 1,
			days: ['Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'],
			daysMin: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
			months: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
			monthsShort: ['Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн', 'Июл', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек'],
		});
		
		$datepicker.on('pick.datepicker', function(e) {
			if ($(this).data('set-next')) $(this).next().val($(this).datepicker('getDate', true));
		});
		
		const datepickerOptions = {};
		if (!$datepicker.attr('placeholder'))
			datepickerOptions.placeholder = '__.__.____';
		
		$datepicker.mask('00.00.0000', datepickerOptions);
		
		datepickers[$(this).data('id')] = $datepicker;
	});
});