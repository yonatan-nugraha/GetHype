$(document).ready(function() {   
    //select payment
	$('.payment-box').click(function() {
		if ($(this).hasClass('payment-disabled')) {
			return;
		}
		
		var payment_method = $(this).attr('id');
		$('.payment-method').val(payment_method);

		$('.payment-box').removeClass('payment-selected');
		$(this).addClass('payment-selected');

		var payment_fees = {
			bank_transfer: 4900, 
			credit_card: 5000, 
			bca_klikpay: 2000,
			mandiri_clickpay: 5000,
			cimb_clicks: 5000,
			epay_bri: 5000,
			mandiri_ecash: 4000,
			indosat_dompetku: 3000,
			telkomsel_cash: 3000,
			xl_tunai: 3000,
		};

		var subtotal = parseInt($('.subtotal-hidden').val());
		var adminfee = parseInt(payment_fees[payment_method]);
		var grandtotal = parseInt(subtotal + adminfee);

		$('.adminfee-price').text('Rp '+ adminfee.toLocaleString());
		$('.grandtotal-price').text('Rp '+ grandtotal.toLocaleString());
	});

	$('#pay-button').click(function() {
		var first_name 	= $("input[name='first_name']").val();
		var last_name 	= $("input[name='last_name']").val();
		var email 		= $("input[name='email']").val();
		var phone 		= $("input[name='phone']").val();
		var payment_method 	= $("input[name='payment_method']").val();
		var order_amount = $('#order-amount').val();

		var data = {
			'first_name': first_name,
			'last_name': last_name,
			'email': email,
			'phone': phone,
			'payment_method': payment_method,
		}

		$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
		    }
		});

		var action = (order_amount > 0) ? 'pay':'proceed';

    	$.ajax({
    		url: '/checkout/' + action, 
    		type: 'POST',
    		data: data,
    		success: function(result) {
    			if (result.success == 0) {
    				if (result.login == 0) {
    					location.href = '/login';
    				} else {
    					location.href = '/';
    				}
    			}
    			else {
    				if (order_amount == 0) {
    					location.href = '/checkout/success?order_id='+result.order_id;
    				} else {
		    			snap.pay(result.token, {
						  	onSuccess: function(result) {
						  		location.href = '/checkout/success?order_id='+result.order_id;
						  	},
						  	onPending: function(result) {
						  		console.log('pending');
						  		console.log(result);
						  	},
						  	onError: function(result) {
						  		console.log('error');
						  		console.log(result);
						  	},
						  	onClose: function() {
						  		console.log('customer closed the popup without finishing the payment');
						  	}
						});
		    		}
	    		}
	    	},
	    	error: function (result) {
	    		snap.hide();

	    		$(window).scrollTop(0);

	    		var status = result.status;
	    		var errors = $.parseJSON(result.responseText);
	    		if (status == 422) {
	        		if (errors.first_name) {
		        		$('#first-name-error').html(errors.first_name[0]);
		        	}
		        	if (errors.last_name) {
		        		$('#last-name-error').html(errors.last_name[0]);
		        	}
	        		if (errors.email) {
		        		$('#email-error').html(errors.email[0]);
		        	}
		        	if (errors.phone) {
		        		$('#phone-error').html(errors.phone[0]);
		        	}
		        	if (errors.error) {
		        		$('#error-message').show();
		        		$('#error-message p').html(errors.error[0]);
		        	}
		        } else {
	    			$('#error-message').show();
	        		$('#error-message p').html(errors.error);
	    		}
	    	},
	    	beforeSend: function() {
	    		snap.show();

	    		$('.error-block').html('');
	    		$('#error-message').hide();
	    	},
	    	complete: function() {
	    		snap.hide();
	    	}
	    });
	});


	var remaining_time = $('#remaining-time').val();
	var countdown = moment().add(remaining_time, 'seconds')
	countdown = countdown.format('MM/DD/YYYY HH:mm:ss');

	$('#countdown').countdown(countdown, function(event) {
        var $this = $(this).html(event.strftime(''
        + '<div class="countdown-element"><span>%H</span> <label>H</label></div> '
        + '<div class="countdown-element"><span>%M</span> <label>M</label></div> '
        + '<div class="countdown-element"><span>%S</span> <label>S</label></div>'));
    }).on('finish.countdown', function() {
    	location.href = '/';
    });
});