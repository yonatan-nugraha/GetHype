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
    			if (result.success == 1) {
	    			$('.subscribe-message').text(result.message);
	    		}
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

	$('.message-submit').click(function() {
		var id = $(this).attr('id');

		var subject 	= $("input[name='"+id+"_subject']").val();
		var description = $("textarea[name='"+id+"_description']").val();
		var first_name 	= $("input[name='"+id+"_first_name']").val();
		var last_name 	= $("input[name='"+id+"_last_name']").val();
		var email 		= $("input[name='"+id+"_email']").val();
		var phone 		= $("input[name='"+id+"_phone']").val();

		var data = {
			subject: subject,
			description: description,
			first_name: first_name,
			last_name: last_name,
			email: email,
			phone: phone
		}
		
		$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});

    	$.ajax({
    		url: '/messages', 
    		type: 'POST',
    		data: data,
    		success: function(result) {
    			if (result.success == 1) {
	    			$('#'+id+'Message').text(result.message);
	    		} else {
	    			$('#'+id+'Error').text(result.message);
	    		}
	    	},
	    	error: function (result) {
        		var errors = $.parseJSON(result.responseText);
        		if (errors.first_name) {
	        		$('#'+id+'FirstName').text(errors.first_name[0]);
	        	}
	        	if (errors.last_name) {
	        		$('#'+id+'LastName').text(errors.last_name[0]);
	        	}
        		if (errors.email) {
	        		$('#'+id+'Email').text(errors.email[0]);
	        	}
	        	if (errors.phone) {
	        		$('#'+id+'Phone').text(errors.phone[0]);
	        	}
	        	if (errors.subject) {
	        		$('#'+id+'Subject').text(errors.subject[0]);
	        	}
	        	if (errors.description) {
	        		$('#'+id+'Description').text(errors.description[0]);
	        	}
	    	},
	    	beforeSend: function () {
	    		$('.message-submit').addClass('disabled');
	    		$('.contact-error').text('');
	    	},
	    	complete: function () {
	    		$('.message-submit').removeClass('disabled');
	    	}
	    });
	});

});