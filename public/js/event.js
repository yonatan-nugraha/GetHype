function calculate_ticket() {
	var grand_total = 0;
	var total_quantity = 0;
  	$('.ticket-quantity').each(function() {
  		quantity = parseInt($(this).val());
  		price = $('#ticket-price-'+ $(this).attr('id')).val();

  		grand_total += parseInt(quantity * price);
  		$('.ticket-grandtotal').text('Rp '+ grand_total.toLocaleString());

  		total_quantity += quantity;
  		$('.ticket-quantity-total').text('QTY: '+total_quantity);
	});
}

$(document).ready(function() {
	calculate_ticket();

	//change ticket quantity
    $('.ticket-quantity').change(function() {
    	var ticket_group_id = $(this).attr('id');
	  	var quantity = $(this).val();
	  	var price = $('#ticket-price-'+ticket_group_id).val();

	  	var total_price = quantity * price;
	  	$('#ticket-total-'+ticket_group_id).text('Rp '+ total_price.toLocaleString());

	  	calculate_ticket();
	});

    //ticket checkout
	$('.ticket-checkout').click(function() {
		var event_id = $(this).attr('id');

		var data = {};
		$("select[name^='ticket_quantity']").each(function() {
			data[$(this).attr('name')] = $(this).val();
		});

	    $.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
		    }
		});

    	$.ajax({
    		url: '/events/'+event_id+'/book-ticket', 
    		type: 'POST',
    		data: data,
    		success: function(result) {
    			if (result.success == 0) {
    				if (result.login == 0) {
	    				location.href = '/login';
	    			} else {
	    				$('.ticket-message').fadeIn();
		        		$('.ticket-message p').text(result.message);
	    			}
    			} else {
    				location.href = '/checkout';
    			}
	    	}
	    });
	});

	//add-bookmark
	$('.add-bookmark').click(function() {
		var event_id = $(this).attr('id');

	    $.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});

    	$.ajax({
    		url: '/events/'+event_id+'/add-bookmark', 
    		type: 'POST',
    		success: function(result) {
    			if (result.login == 0) {
    				location.href = '/login';
    				return;
    			}
		        alert(result.message);
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