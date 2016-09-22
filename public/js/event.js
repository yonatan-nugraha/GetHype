function calculate_grand_total() {
	var grand_total = 0;
  	$(".ticket-quantity").each(function() {
  		quantity = $(this).val();
  		price = $("#ticket-price-"+ $(this).attr('id')).val();

  		grand_total += parseInt(quantity * price);
  		$(".ticket-grand-total").text('Rp '+ grand_total.toLocaleString());
	});
}

$(document).ready(function() {
	calculate_grand_total();

	//change ticket quantity
    $(".ticket-quantity").change(function() {
    	var ticket_group_id = $(this).attr('id');
	  	var quantity = $(this).val();
	  	var price = $("#ticket-price-"+ticket_group_id).val();

	  	var total_price = quantity * price;
	  	$("#ticket-total-"+ticket_group_id).text('Rp '+ total_price.toLocaleString());

	  	calculate_grand_total();
	});

    //select payment
	$(".payment-box").click(function() {
		var payment = $(this).attr('id');
		$(".payment").val(payment);

		$(".payment-box").removeClass('payment-selected');
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

		var subtotal = parseInt($(".subtotal-hidden").val());
		var adminfee = parseInt(payment_fees[payment]);
		var grandtotal = parseInt(subtotal + adminfee);

		$(".adminfee-price").text('Rp '+ adminfee.toLocaleString());
		$(".grandtotal-price").text('Rp '+ grandtotal.toLocaleString());
	});

	//click tab panel
	var hash = window.location.hash;
	hash && $('ul.nav a[href="' + hash + '"]').tab('show');

	$('.nav-tabs a').click(function (e) {
	    $(this).tab('show');
	    var scrollmem = $('body').scrollTop();
	    window.location.hash = this.hash;
	    $('html,body').scrollTop(scrollmem);
	});
});