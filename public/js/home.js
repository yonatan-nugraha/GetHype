$(document).ready(function() {
	$('.subscribe-submit').click(function() {

		var email = $('.subscribe-email').val();
		
		$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});

    	$.ajax({
    		url: '/subscribers/subscribe', 
    		type: 'POST',
    		data: { email: email },
    		success: function(result) {
    			$('.subscribe-message').text(result);
	    	},
	    	error: function (result) {
        		var errors = $.parseJSON(result.responseText);
        		if (errors.email) {
	        		$('.subscribe-message').text(errors.email[0]);
	        	}
	    	},
	    	beforeSend: function () {
	    		$('.subscribe-submit').addClass('disabled');
	    	},
	    	complete: function () {
	    		$('.subscribe-submit').removeClass('disabled');
	    	}
	    });
	});

});