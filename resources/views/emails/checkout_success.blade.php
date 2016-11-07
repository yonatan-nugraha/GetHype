<!DOCTYPE html>
<html lang="en">
<body>
	<div style="font-family: arial,helvetica neue,helvetica,sans-serif; font-size: 14px; background: #fff; line-height: 1.5; border: 2px solid #eceded; background: #fff; width: 100%; max-width: 600px; margin: 0 auto; background: #f7f7f7;">

		<table style="border-spacing: 10px; width: 100%; background-color: #0f3844">
			<tbody>
				<tr>
					<td align="center">
						<span style="color: #fff; font-size: 16px;"> Gethype
						</span> 
					</td>
				</tr>
			</tbody>
		</table>

		<div style="text-decoration: none; padding: 0 20px">
			<div style="color:#505050">
				<p><b>Hai, {{ $user->first_name }} @if ($user->last_name) {{ $user->last_name }}@endif!</b></p>
				<p>This is your order confirmation for {{ $order->event->name }}</p>
			</div>
		</div>


		<div style="padding:0 15px;">
			<table style="padding:20px; background: #fff; width: 100%">
				<tr>
					<td width="50%" style="border-right: 1px dashed #0f3844;">
						<small style="text-transform: uppercase; letter-spacing: 0.1em; font-size: 10px;">Order Summary</small>
						<h3 style="font-size: 50px; margin-top:30px;margin-bottom: 0;line-height: 25px; color: #ebd58e; ">2<span style="font-size: 16px; margin-left: 5px;">Tickets</span></h3>
						<p style="margin-top: 5px; margin-bottom: 0px; font-size: 22px; line-height: 26px; color: #0f3844;">{{ $order->event->name }}</p>
						<p style="margin-top: 0px; font-size: 12px; color: #0f3844;">Order #: {{ $order->id }}</p>
						<p style="margin-top: 0px; font-size: 14px; margin-bottom: 0; line-height: 1.3; color: #0f3844;">{!! nl2br(e($order->event->location)) !!}</p>
						<p style="margin-top: 10px; font-size: 14px; margin-bottom: 0; line-height: 1.3; color: #0f3844;">{{ Carbon\Carbon::parse($order->event->started_at)->format('l, M d, Y') }}</p>
						<p style="margin-top: 0px; font-size: 14px; margin-bottom: 0; color: #0f3844;">{{ Carbon\Carbon::parse($order->event->started_at)->format('h.i A') }}</p>
					</td>

					<td width="50%">
						<table style="font-size: 12px;  padding-bottom: 10px; width: 100%; color: #0f3844;">
							@foreach ($order->order_details as $order_detail)
							<tr>
								<td style="padding-left: 15px;">
									{{ $order_detail->ticket_group->name }}
								</td>
								<td align="right">
									{{ $order_detail->quantity }} ticket
								</td>
								<td align="right">
									{{ 'Rp ' .number_format($order_detail->quantity * $order_detail->ticket_group->price) }}
								</td>
							</tr>
							@endforeach
							<tr>
								<td><br></td>
							</tr>
							<tr >
								<td colspan="2" style="border-bottom: 1px dashed #a8a8a8;padding-left: 15px; padding-bottom: 10px;">
									Sub Total
								</td>
								<td align="right" style="border-bottom: 1px dashed #a8a8a8; padding-bottom: 10px;">
									{{ 'Rp '.$order->order_amount }}
								</td>
							</tr>

							<tr >
								<td colspan="2" style="padding-left: 15px; padding-top: 10px; color: #888;">
									(+)
								</td>
								<td align="right" >
								</td>
							</tr>

							<tr >
								<td colspan="2" style="padding-left: 15px; ">
									Administration Fee
								</td>
								<td align="right" style="">
									{{ 'Rp '.$order->administration_fee }}
								</td>
							</tr>
							<tr >
								<td colspan="2" style="padding-left: 15px; font-size: 10px; color: #a8a8a8;">
									Including of VAT
								</td>
								<td align="right" >
								</td>
							</tr>

							<tr>
								<td><br></td>
							</tr>

							<tr>
								<td colspan="2" style="padding-left: 15px;">
									Grand Total
								</td>
								<td align="right">
									{{ 'Rp '. $order->payment_amount }}
								</td>
							</tr>
						</table>


					</td>
				</tr>
			</table>
		</div>

		<div style="padding:0 20px;">
			<h4 style="margin-bottom: 0; color: #0f3844;">The invoice and tickets are attached on this email, however, you can also check them on:</h4>
			<p style="margin-bottom: 0; color: #0f3844;">
				Invoice: <a href="http://gethype.co.id/tickets/{{ $order->id }}/invoice" target="_blank">here</a>
			</p>
			<p style="margin-top: 10px; color: #0f3844;">
				Tickets: <a href="http://gethype.co.id/tickets/{{ $order->id }}/ticket" target="_blank">here</a>
			</p>
		</div>

		<table style="margin-top: 30px; border-top: 1px solid #d6d6d6; background-color: #fff; width: 100%; border-spacing: 10px;">
			<tbody>
				<tr>
					<td style="margin: 0; padding: 0; width: 45%; text-align: center">
						<div style="margin-bottom: 10px;margin-top: 20px;"><img src="http://gethype.co.id/images/emails/logo-footer-email.png" alt=""></div>
						<div style="color:#606060; font-size:12px;line-height: 30px;">
							<a href="http://gethype.co.id/" target="_blank" style="text-decoration: none; color:#0f3844;">Website</a> &nbsp;|&nbsp; <a href="http://gethype.co.id/contact-us" target="_blank" style="text-decoration: none; color:#0f3844;">Contact</a> &nbsp;|&nbsp; <a href="http://gethype.co.id/services" target="_blank" style="text-decoration: none; color:#0f3844;">Service</a><br>
							<a href="" target="_blank" style="text-decoration:none">
								<img src="http://gethype.co.id/images/emails/facebook.png" style="margin-top: 5px; height: 15px;margin-right: 15px;"> 
							</a>
							<a href="" target="_blank" style="text-decoration:none">
								<img src="http://gethype.co.id/images/emails/twitter.png" style="margin-top: 5px; height: 15px;margin-right: 10px;"> 
							</a>
							<a href="https://www.instagram.com/gethype.id/" target="_blank" style="text-decoration:none">
								<img src="http://gethype.co.id/images/emails/instagram.png" style="margin-top: 5px; height: 15px;margin-right: 10px;"> 
							</a>
							<a href="" target="_blank" style="text-decoration:none">
								<img src="http://gethype.co.id/images/emails/linkedin.png" style="margin-top:5px; height: 15px;"> 
							</a>
							<br>
						</div>
					</td>
				</tr>
			</tbody>
		</table>

		<table style="border-spacing: 10px; width: 100%; background-color: #0f3844">
			<tbody>
				<tr>
					<td align="center">
						<span style="color: #fff; font-size: 12px;"> 2016 | Gethype.co.id
						</span> 
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</body>
</html>
