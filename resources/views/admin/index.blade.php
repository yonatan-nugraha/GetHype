<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Gethype</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset("/bower_components/adminlte/dist/css/AdminLTE.min.css") }}">
    <link rel="stylesheet" href="{{ asset("/bower_components/adminlte/dist/css/skins/skin-blue.min.css") }}">
    <link rel="stylesheet" href="{{ asset ("/bower_components/adminlte/plugins/daterangepicker/daterangepicker.css") }}">
    <link rel="stylesheet" href="{{ asset ("/bootstrap-switch-master/dist/css/bootstrap3/bootstrap-switch.min.css") }}">

</head>
<body class="skin-blue">
<div class="wrapper">

    @include('admin.header')

    @include('admin.sidebar')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                {{ $page_title or "Page Title" }}
                <small>{{ $page_description or null }}</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
                <li class="active">Here</li>
            </ol>
        </section>

        <section class="content">
            @yield('content')
        </section>
    </div>

    @include('admin.footer')

</div>


<script src="{{ asset ("/bower_components/adminlte/plugins/jQuery/jQuery-2.2.3.min.js") }}"></script>
<script src="{{ asset ("/bower_components/adminlte/bootstrap/js/bootstrap.min.js") }}"></script>
<script src="{{ asset ("/bower_components/adminlte/dist/js/app.min.js") }}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="{{ asset ("/bower_components/adminlte/plugins/daterangepicker/daterangepicker.js") }}"></script>
<script src="{{ asset ("/bootstrap-switch-master/dist/js/bootstrap-switch.min.js") }}"></script>

<script>
$(function () {
    // date range picker with time picker
    $('#reservationtime').daterangepicker({
        timePicker: true, 
        timePickerIncrement: 30, 
        locale: {
            format: 'YYYY-MM-DD hh:mm:ss'
        }
    });

    // add ticket
    var i = -1;
    var ticket_count = 0;
    $(".add-ticket").click(function() {
        i++;
        ticket_count++;

        $("#ticket-row-"+i).after('<div class="row" id="ticket-row-'+ticket_count+'"><div class="col-xs-6"><label>Name</label><input type="text" class="form-control" name="ticket_name_'+ticket_count+'" placeholder="Name" required pattern=".{3,20}"></div><div class="col-xs-3"><label>Quantity</label><input type="number" class="form-control" name="ticket_quantity_'+ticket_count+'" placeholder="Quantity" required min="1" max="500"></div><div class="col-xs-3"><label>Price</label><input type="number" class="form-control" name="ticket_price_'+ticket_count+'" placeholder="Price" required min="0" max="5000000"></div></div>');

        $(".ticket-group").val(ticket_count);
    });

    // status switcher
    $(".status").bootstrapSwitch();
    $(".status").on('switchChange.bootstrapSwitch', function(event, state) {
        $(this).closest('form').submit();
    });
});
</script>

</body>
</html>