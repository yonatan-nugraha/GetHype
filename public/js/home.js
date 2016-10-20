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

	//message
	$('.message-submit').click(function() {
		var id = $(this).attr('id');

		var subject 	= $("input[name='"+id+"_subject']").val();
		var description 	= $("textarea[name='"+id+"_description']").val();
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
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('description')
		    }
		});

    	$.ajax({
    		url: '/messages', 
    		type: 'POST',
    		data: data,
    		success: function(result) {
    			if (result.success == 1) {
	    			$('#'+id+'-message').text(result.message);
	    		} else {
	    			$('#'+id+'-error').text(result.message);
	    		}
	    	},
	    	error: function (result) {
        		var errors = $.parseJSON(result.responseText);
        		if (errors.first_name) {
	        		$('#'+id+'-first-name').text(errors.first_name[0]);
	        	}
	        	if (errors.last_name) {
	        		$('#'+id+'-last-name').text(errors.last_name[0]);
	        	}
        		if (errors.email) {
	        		$('#'+id+'-email').text(errors.email[0]);
	        	}
	        	if (errors.phone) {
	        		$('#'+id+'-phone').text(errors.phone[0]);
	        	}
	        	if (errors.subject) {
	        		$('#'+id+'-subject').text(errors.subject[0]);
	        	}
	        	if (errors.description) {
	        		$('#'+id+'-description').text(errors.description[0]);
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

	//date
	$('input[name="date"').change(function() {
		if (this.value == '') {
			this.setAttribute('data-date', 'All Dates');
		} 
		else {
		    this.setAttribute('data-date', moment(this.value, 'YYYY-MM-DD').format(this.getAttribute('data-date-format')));
		}
	});

	$('input[name="date"').trigger('change');
});