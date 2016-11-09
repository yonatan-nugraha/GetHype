$(document).ready(function() {
	//subscribe
	$('.subscribe-submit').click(function() {
		var email = $('.subscribe-email').val();
		
		$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('description')
		    }
		});

    	$.ajax({
    		url: '/subscribers/subscribe', 
    		type: 'POST',
    		data: { email: email },
    		success: function(result) {
    			if (result.success == 1) {
	    			$('#subscribe-message').text(result.message);
	    		}
	    	},
	    	error: function (result) {
        		var errors = $.parseJSON(result.responseText);
        		if (errors.email) {
	        		$('#subscribe-message').text(errors.email[0]);
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