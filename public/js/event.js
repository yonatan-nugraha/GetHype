function calculate_ticket() {
	var grand_total = 0;
	var total_quantity = 0;
  	$(".ticket-quantity").each(function() {
  		quantity = parseInt($(this).val());
  		price = $("#ticket-price-"+ $(this).attr('id')).val();

  		grand_total += parseInt(quantity * price);
  		$(".ticket-grandtotal").text('Rp '+ grand_total.toLocaleString());

  		total_quantity += quantity;
  		$(".ticket-quantity-total").text('QTY: '+total_quantity);
	});
}

$(document).ready(function() {
	calculate_ticket();

	//change ticket quantity
    $(".ticket-quantity").change(function() {
    	var ticket_group_id = $(this).attr('id');
	  	var quantity = $(this).val();
	  	var price = $("#ticket-price-"+ticket_group_id).val();

	  	var total_price = quantity * price;
	  	$("#ticket-total-"+ticket_group_id).text('Rp '+ total_price.toLocaleString());

	  	calculate_ticket();
	});
});