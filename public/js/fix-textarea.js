$(function() {
	$('form').on('submit', function() {
		$(this).find('textarea').each(function() {
			var text = $(this).val();
			text = text.replace(/\r?\n/g, '<br />');
			$(this).val(text);
		});
	})
})