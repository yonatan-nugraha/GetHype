$(document).ready(function() {
	//click order list
	$(".order-list-row").click(function () {
		var order_id = $(this).attr('id');

		if ($(this).hasClass('shown')) {
			$("#order-detail-"+order_id).slideUp();
			$("#show-hide-text-"+order_id).text('show');
			$("#show-image-"+order_id).show();
			$("#hide-image-"+order_id).hide();
			$(this).addClass('hiden');
			$(this).removeClass('shown');
		} else {
			$("#order-detail-"+order_id).slideDown();
			$("#show-hide-text-"+order_id).text('hide');
			$("#show-image-"+order_id).hide();
			$("#hide-image-"+order_id).show();
			$(this).addClass('shown');
			$(this).removeClass('hiden');
		}
	});
});