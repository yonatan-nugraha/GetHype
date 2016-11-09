$(document).ready(function() {
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
    			console.log(result);
    			if (result.success == 1) {
	    			$('.after-effect.message').fadeIn();
				    setTimeout(function(){
				        $('.after-effect.message').fadeOut();
				    }, 3000);
	    		} else {
	    			$('#'+id+'-error').text(result.message);
	    		}
	    	},
	    	error: function (result) {
        		var errors = $.parseJSON(result.responseText);
        		if (errors.first_name) {
	        		$('#'+id+'-first-name-error').text(errors.first_name[0]);
	        	}
	        	if (errors.last_name) {
	        		$('#'+id+'-last-name-error').text(errors.last_name[0]);
	        	}
        		if (errors.email) {
	        		$('#'+id+'-email-error').text(errors.email[0]);
	        	}
	        	if (errors.phone) {
	        		$('#'+id+'-phone-error').text(errors.phone[0]);
	        	}
	        	if (errors.subject) {
	        		$('#'+id+'-subject-error').text(errors.subject[0]);
	        	}
	        	if (errors.description) {
	        		$('#'+id+'-description-error').text(errors.description[0]);
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

	//services
	$('.btn-create').on('click',function(){
        if($(window).width() > 767){
            if($(this).closest('.service-content').hasClass('service-content-right')){
                $(this).closest('.service-list').find('.service-img').css('margin-left','-30%');
                $(this).closest('.service-list').find('.service-content').css('width','80%');
                $(this).closest('.content').find('.content-default').hide();
                $(this).closest('.content').find('.content-form').show();
            }
            else{
                $(this).closest('.service-list').find('.service-img').css('margin-right','-30%');
                $(this).closest('.service-list').find('.service-content').css('width','80%');
                $(this).closest('.content').find('.content-default').hide();
                $(this).closest('.content').find('.content-form').show();
            }
        }
        else{
            $(this).closest('.content').find('.content-default').hide();
            $(this).closest('.content').find('.content-form').show();
        }
    });


    $('.cancel-form').on('click',function(){
        if($(window).width() > 767){
            if($(this).closest('.service-content').hasClass('service-content-right')){
                $(this).closest('.service-list').find('.service-img').css('margin-left','auto');
                $(this).closest('.service-list').find('.service-content').css('width','50%');
                $(this).closest('.content').find('.content-default').show();
                $(this).closest('.content').find('.content-form').hide();
            }
            else{
                $(this).closest('.service-list').find('.service-img').css('margin-right','auto');
                $(this).closest('.service-list').find('.service-content').css('width','50%');
                $(this).closest('.content').find('.content-default').show();
                $(this).closest('.content').find('.content-form').hide();
            }
        }
        else{
            $(this).closest('.content').find('.content-default').show();
            $(this).closest('.content').find('.content-form').hide();
        }
    });

	//help
    $('.help-list-button').on('click',function(){
        $(this).closest('.help-list').find('.help-list-content').slideToggle();
    });
});