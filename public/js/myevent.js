function render_event_statistic(event_id, start_date_s, end_date_s) {
	var ctx = $('.event-statistic');

	var now_date   = new Date(start_date_s);
	var end_date   = new Date(end_date_s);

	if (start_date_s == end_date_s) {
		now_date.addDays(-1);
	}

	var days_range = Math.abs(end_date - now_date) / (1000 * 60 * 60 * 24);
	var add_days = Math.ceil((days_range/10));

	if (add_days == 0) {
		add_days = 1;
	}

	$.ajax({
		url: '/myevents/'+event_id+'/statistic/event?start_date='+start_date_s+'&end_date='+end_date_s, 
		type: 'GET',
		success: function(result) {
			var dates = [];
			var views = [];

			while (now_date <= end_date) {
				now_date_s = now_date.toString('yyyy-MM-dd');
				now_date_e = now_date.toString('dd MMM');

				dates.push(now_date_e);
				views.push((result.views[now_date_s]) ? result.views[now_date_s] : 0);

			    now_date.addDays(add_days);
			}

			$('#views-statistic').highcharts({
                title: {
                    text: 'Number of views',
                    x: -20
                },
                subtitle: {
                    text: '',
                    x: -20
                },
                xAxis: {
                    categories: dates
                },
                yAxis: {
                    title: {
                        text: 'Total Views'
                    },
                    plotLines: [{
                        value: 0,
                        width: 2,
                        color: '#ebd58e'
                    }]
                },
                tooltip: {
                    valueSuffix: ''
                },
                legend: {
                    enabled: false,
                    floating: true,
                    verticalAlign: 'top',
                    align: 'right',
                },
                series: [{
                    name: 'Number of views',
                    data: views
                }]
            });

			$('.total-views').html(result.total_views);
    	}
    });
}


function render_event_statistic_by_gender(event_id, start_date_s, end_date_s) {
	var ctx = $('.event-statistic-gender');

	$.ajax({
		url: '/myevents/'+event_id+'/statistic/event/gender?start_date='+start_date_s+'&end_date='+end_date_s, 
		type: 'GET',
		success: function(result) {
			var genders = ['male', 'female'];
			var views = [];

			var total_views = 0;
			for (i in genders) {
				total_views += (result[genders[i]]) ? result[genders[i]] : 0;
			}

			for (i in genders) {
				v = (result[genders[i]]) ? result[genders[i]] : 0;
				views_percentage = Math.round((v/total_views) * 100);

				views.push(views_percentage);
			}

			$('#gender').highcharts({
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Gender'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: false
                        },
                        showInLegend: true
                    }
                },
                series: [{
                    name: 'Brands',
                    colorByPoint: true,
                    data: [{
                        name: 'Male',
                        y: 56.33
                    }, {
                        name: 'Female',
                        y: 44.67
                    }]
                }]
            });
    	}
    });
}

function render_event_statistic_by_age(event_id, start_date_s, end_date_s) {
	var ctx = $('.event-statistic-age');

	$.ajax({
		url: '/myevents/'+event_id+'/statistic/event/age?start_date='+start_date_s+'&end_date='+end_date_s, 
		type: 'GET',
		success: function(result) {
			var age_groups = ['> 17', '18-23', '24-34', '35-44', '45+'];
			var views = [];

			var total_views = 0;
			for (i in age_groups) {
				total_views += (result[age_groups[i]]) ? result[age_groups[i]] : 0;
			}

			for (i in age_groups) {
				v = (result[age_groups[i]]) ? result[age_groups[i]] : 0;
				views_percentage = Math.round((v/total_views) * 100);

				views.push(views_percentage);
			}

			$('#age').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Views by Age'
                },
                subtitle: {
                    text: ''
                },
                xAxis: {
                    categories: age_groups,
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Total Views'
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: [{
                    name: 'Age Groups',
                    data: views
                }]
            });
    	}
    });
}

function render_ticket_statistic(event_id, start_date_s, end_date_s) {
	var ctx = $('.ticket-statistic');

	var now_date   = new Date(start_date_s);
	var end_date   = new Date(end_date_s);

	var days_range  = Math.abs(end_date - now_date) / (1000 * 60 * 60 * 24);
	var add_days 	= Math.ceil((days_range/10));

	if (add_days == 0) {
		add_days = 1;
	}

	if (start_date_s == end_date_s) {
		now_date.addDays(-1);
	}

	$.ajax({
		url: '/myevents/'+event_id+'/statistic/ticket?start_date='+start_date_s+'&end_date='+end_date_s, 
		type: 'GET',
		success: function(result) {
			var dates = [];
			var orders = [];

			while (now_date <= end_date) {
				now_date_s = now_date.toString('yyyy-MM-dd');
				now_date_e = now_date.toString('dd MMM');

				dates.push(now_date_e);
				orders.push((result[now_date_s]) ? parseInt(result[now_date_s]) : 0);

			    now_date.addDays(add_days);
			}

			console.log(dates);
			console.log(orders);

			$('#ticket-statistic').highcharts({
                title: {
                    text: 'Order Statistic',
                    x: -20 //center
                },
                subtitle: {
                    text: '',
                    x: -20
                },
                xAxis: {
                    categories: dates
                },
                yAxis: {
                    title: {
                        text: 'Total Orders'
                    },
                    plotLines: [{
                        value: 0,
                        width: 2,
                        color: '#ebd58e'
                    }]
                },
                tooltip: {
                    valueSuffix: ''
                },
                legend: {
                    enabled: false,
                    floating: true,
                    verticalAlign: 'top',
                    align: 'right',
                },
                series: [{
                    name: 'Number of order',
                    data: orders,
                }]
            });
    	}
    });
}

function render_order_details(event_id, start_date_s, end_date_s, page) {
	$.ajax({
		url: '/myevents/'+event_id+'/order-details?start_date='+start_date_s+'&end_date='+end_date_s+'&page='+page, 
		type: 'GET',
		success: function(result) {
			var order_details = '';

			if (result.length > 0) {
				for (i in result) {
					var date = (new Date(result[i].created_at)).toString('MMM d, yyyy | h.mm tt');

					order_details += '<tr><td>'+ result[i].id +'</td><td>'+result[i].first_name+' '+result[i].last_name+'</td><td>'+result[i].email+'</td><td>'+result[i].name+'</td><td>'+result[i].quantity+'</td><td>'+date+'</td></tr>';
				}
			} else {
				order_details = '<tr align="center"><td colspan="6">No Orders Yet</td></tr>';
			}

			$('.order-details').html(order_details);
    	}
    });
}

function render_ticket_sales(event_id, start_date_s, end_date_s) {
	$.ajax({
		url: '/myevents/'+event_id+'/ticket-sales?start_date='+start_date_s+'&end_date='+end_date_s, 
		type: 'GET',
		success: function(result) {
			var ticket_sales = '';

			if (result.ticket_sales.length > 0) {
				for (i in result.ticket_sales) {
					ticket_sales += '<tr><td>'+ result.ticket_sales[i].name +'</td><td>'+result.ticket_sales[i].tickets_sold+'</td><td>'+(result.ticket_sales[i].total_tickets - result.ticket_sales[i].tickets_sold)+'</td><td>Rp '+result.ticket_sales[i].price.toLocaleString()+'</td><td>Rp '+(result.ticket_sales[i].tickets_sold*result.ticket_sales[i].price).toLocaleString()+'</td></tr>';
				}
			} else {
				ticket_sales = '<tr align="center"><td colspan="6">No Orders Yet</td></tr>';
			}

			$('.ticket-sales').html(ticket_sales);
			$('.total-tickets-sold').html(result.total_tickets_sold);
			$('.total-revenue').html('Rp '+result.total_revenue.toLocaleString());
			$('.total-cost').html('Rp '+result.total_cost.toLocaleString());
			$('.total-profit').html('Rp '+result.total_profit.toLocaleString());
    	}
    });
}

function render_all(event_id, start_date_s, end_date_s) {
	render_event_statistic(event_id, start_date_s, end_date_s);
	render_event_statistic_by_gender(event_id, start_date_s, end_date_s);
	render_event_statistic_by_age(event_id, start_date_s, end_date_s);
	render_ticket_statistic(event_id, start_date_s, end_date_s);
	render_order_details(event_id, start_date_s, end_date_s, 0);
	render_ticket_sales(event_id, start_date_s, end_date_s);
}

$(document).ready(function() {
	var event_id = $('.event-id').val();

	var start_date 	= moment().subtract(6, 'days');
	var end_date 	= moment();

	var start_date_s = start_date.format('YYYY-MM-DD');
	var end_date_s 	 = end_date.format('YYYY-MM-DD');

	render_all(event_id, start_date_s, end_date_s);

    $('#daterange').daterangepicker(
    	{
        	startDate: start_date,
          	endDate: end_date,
	        ranges: {
	        	'Today': [moment(), moment()],
	            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
	            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
	            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
	            'This Month': [moment().startOf('month'), moment().endOf('month')],
	            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
	        },
        },
        function (start, end) {
          	$('#daterange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

          	start_date_s = start.format('YYYY-MM-DD');
          	end_date_s 	 = end.format('YYYY-MM-DD');

          	render_all(event_id, start_date_s, end_date_s);

          	$('.pagination li').removeClass('active');
			$('.pagination .first').addClass('active');
        }
    );

	$('.pagination li').click(function() {
		var page = $(this).attr('id');
		render_order_details(event_id, start_date_s, end_date_s, page);

		$('.pagination li').removeClass('active');
		if ($(this).hasClass('laquo')) {
			$('.pagination .first').addClass('active');
		} else if ($(this).hasClass('raquo')) {
			$('.pagination .last').addClass('active');
		} else {
			$(this).addClass('active');
		}
	});

	$('.show-hide').click(function() {
		if ($(this).hasClass('shown')) {
			$(this).parents('.panel').children('.panel-body').slideDown();
			$(this).children('span').text('Hide');
			$(this).children('.show-image').hide();
			$(this).children('.hide-image').show();
			$(this).addClass('hiden');
			$(this).removeClass('shown');
		} else {
			$(this).parents('.panel').children('.panel-body').slideUp();
			$(this).children('span').text('Show');
			$(this).children('.hide-image').hide();
			$(this).children('.show-image').show();
			$(this).addClass('shown');
			$(this).removeClass('hiden');
		}
	});

});