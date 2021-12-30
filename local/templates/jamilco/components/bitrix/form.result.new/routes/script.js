$(() => {
	$('#content').on('change', '.routes form input[type="radio"]', function() {
		const name = $(this).attr('name');
		$(this).closest('form').find(`input[name="${name}"]`).closest('.radio-label').removeClass('checked');
		if ($(this).prop('checked'))
			$(this).closest('.radio-label').addClass('checked');
		else
			$(this).closest('.radio-label').removeClass('checked');
	});
	
	$('#content').on('submit', '.routes form', function(event) {
		event.preventDefault();
		$(this).find('[type="submit"]').prop('disabled', true);
		const fd = new FormData(this);
		fd.append('action', 'book_route');
		$.ajax({
			method: 'POST',
			url: '/ajax.php',
			processData: false,
			contentType: false,
			data: fd
		}).then((response) => {
			response = JSON.parse(response);
			if (response.error) {
				Object.keys(response.error).forEach((key) => {
					$(this).find('[name="' + key + '"]').addClass('error');
					$(this).find('.errors').append('<div class="error" data-error-key="' + key + '">' + response.error[key] + '</div>');
				});
			} else {
				$(this).find('.success').show();
			}
		});
	});
	
	$('#content').on('input change', '.routes form input', function(event) {
		$(this).removeClass('error');
		const $form = $(this).closest('form');
		$form.find('.errors [data-error-key="' + $(this).attr('name') + '"]').remove();
		if (!$form.find('.errors .error').length) $form.find('[type="submit"]').prop('disabled', false);
	});
});