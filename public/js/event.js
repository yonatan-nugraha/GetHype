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

	$('.add-bookmark').click(function() {
		var event_id = $(this).attr('id');

	    $.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});

    	$.ajax({
    		url: '/events/add-bookmark', 
    		type: 'POST',
    		data: {event_id: event_id},
    		success: function(result) {
    			if (result == 1) {
		        	alert('This event has been succesfully added to your bookmark list');
		        } else {
		        	alert('This event is already on your bookmark list');
		        }
	    	}
	    });
	});

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
});