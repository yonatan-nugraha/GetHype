function edit_interest() {
	var interests_array = [];
	$('.interest .label').each(function() {
		$category_id = $(this).attr('id');

		if ($(this).hasClass('selected')) {
			interests_array.push($category_id);
		}
	});

	var interests = interests_array.join(',');
	$('.interests').val(interests);
}

$(document).ready(function() {
	edit_interest();

	//click tab panel
	var hash = window.location.hash;
	hash && $('ul.nav a[href="' + hash + '"]').tab('show');

	$('.nav-tabs a').click(function () {
	    $(this).tab('show');
	    var scrollmem = $("body").scrollTop();
	    window.location.hash = this.hash;
	    $('html,body').scrollTop(scrollmem);
	});

	//click interest
	$('.interest .label').click(function () {
		if (!$(this).hasClass('selected')) {
		    $(this).addClass('selected');
		} else {
		    $(this).removeClass('selected');
		}

		edit_interest();
	});

	//upload image
	$('.edit-profile-image').change(function() {
	    var file = this.files[0];

	    var form_data = new FormData();
    	form_data.append('photo', file);

    	$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});

    	$.ajax({
    		url: '/account/update-picture', 
    		type: 'POST',
	        data: form_data,
	        contentType: false,
			processData: false,
    		success: function(result) {
	        	location.reload();
	    	}
	    });
	})

	//date
	$('input[name="birthdate"').change(function() {
	    this.setAttribute('data-date', moment(this.value, 'YYYY-MM-DD').format(this.getAttribute('data-date-format')));
	});

	$('input[name="birthdate"').trigger('change');

	$('.after-effect.profile').fadeIn();
    setTimeout(function(){
        $('.after-effect.profile').fadeOut();
    }, 3000);

    $('.after-effect.password').fadeIn();
    setTimeout(function(){
        $('.after-effect.password').fadeOut();
    }, 3000);
});