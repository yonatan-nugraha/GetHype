$(document).ready(function() {
	//subscribe
	$('#journal-subscribe-submit').click(function() {
		var email = $('#journal-subscribe-email').val();
		
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
	    			$('#journal-subscribe-message').text(result.message);
	    		}
	    	},
	    	error: function (result) {
        		var errors = $.parseJSON(result.responseText);
        		if (errors.email) {
	        		$('#journal-subscribe-message').text(errors.email[0]);
	        	}
	    	},
	    	beforeSend: function () {
	    		$('#journal-subscribe-submit').addClass('disabled');
	    	},
	    	complete: function () {
	    		$('#journal-subscribe-submit').removeClass('disabled');
	    	}
	    });
	});
});