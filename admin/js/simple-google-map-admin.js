(function( $ ) {
	'use strict';

	 $(function() {
		$('#message').fadeTo(1500, 1).slideUp();
		if (!$('#editCSS').attr('checked')) {
			$('#SGMcss').hide();
		}
		$('#editCSS').change(function() {
			$('#SGMcss').slideToggle(200);
		});
	 });

})( jQuery );
