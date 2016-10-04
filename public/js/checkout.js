$(document).ready(function() {   
    //select payment
	$('.payment-box').click(function() {
		if ($(this).hasClass('payment-disabled')) {
			return;
		}
		
		var payment_type = $(this).attr('id');
		$('.payment-type').val(payment_type);

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
		var adminfee = parseInt(payment_fees[payment_type]);
		var grandtotal = parseInt(subtotal + adminfee);

		$('.adminfee-price').text('Rp '+ adminfee.toLocaleString());
		$('.grandtotal-price').text('Rp '+ grandtotal.toLocaleString());
	});
});