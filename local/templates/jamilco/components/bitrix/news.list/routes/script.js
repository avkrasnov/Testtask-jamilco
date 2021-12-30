$(() => {
	$('#content').on('click', '.routes .open-buy-form', function() {
		$route = $(this).closest('.route');
		$('.routes .route').removeClass('opened');
		$route.addClass('opened');
		const $thisForm = $route.find('.buy-ticket');
		$('.routes .buy-ticket').not($thisForm).slideUp();
		$thisForm.slideDown();
	});
	
	$('#content').on('click', '.train .seat:not(.disabled)', function() {
		$(this).toggleClass('selected');
		$route = $(this).closest('.route');
		const $selectedSeats = $route.find('.selected-seats');
		const selectedArr = [];
		$route.find('.seat.selected').each(function() {
			selectedArr.push($(this).data('seat'));
		});
		if (selectedArr.length) {
			$selectedSeats.show();
			$selectedSeats.find('.seats-info').html(selectedArr.join(', '));
			$oneSeatSelected = $selectedSeats.find('.one-seat-selected');
			$seatsSelected = $selectedSeats.find('.seats-selected');
			if (selectedArr.length > 1) {
				$seatsSelected.show();
				$oneSeatSelected.hide();
			} else {
				$seatsSelected.hide();
				$oneSeatSelected.show();
			}
		} else {
			$selectedSeats.hide();
		}
		$route.find('[data-name="seats"]').val(selectedArr.join(',')).trigger('change');
		
	});
});