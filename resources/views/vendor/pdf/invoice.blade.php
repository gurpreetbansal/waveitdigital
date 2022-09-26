<html>
    <head>
        <title>Invoice-{{@$number}}.pdf</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    </head>
    <body>
		<table cellspacing="0" border="0" align="center" cellpadding="0" width="650px" >
			<tr>
				<td>
					<table cellspacing="0" border="0" align="left" cellpadding="0" width="100%" style="border-bottom: 1px solid #ccc; margin-top:0px; padding: 40px 0;">
						<tr>
							<td style="font-family: 'Roboto', sans-serif;"><strong style="display:inline-block;">
								<img src="https://agencydashboard.io/public/front/img/logo.png" alt="agencydashboard-logo">
							</strong></td>
						</tr>
					</table>
					<table cellspacing="0" border="0" cellpadding="10" width="100%" style="border-bottom: 1px solid #ccc; padding: 40px 0;">

						<tr>
							<td style="padding:0px;">
								<table cellspacing="0" border="0" cellpadding="0" width="100%">
									<tr>
										<td align="left" height="20" style="width:20%; font-family: 'Roboto', sans-serif; font-size: 18px; padding-top: 0px; padding-bottom: 30px; padding-left: 0px; padding-right: 0px;"><strong>Invoice {{@$number}}</strong></td>
										<td  height="20" style="width:20%; font-family: 'Roboto', sans-serif; font-size:18px; padding-top: 0px; padding-bottom: 30px; padding-left: 0px; padding-right: 0px;"><strong>{{date('M d, Y',@$created)}}</strong></td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td  align="left" style="width:100%; font-family: 'Roboto', sans-serif; font-size: 15px; padding-top: 0px; padding-bottom: 0px; padding-left: 0px; padding-right: 0px;">{{@$customer_address['line1'].' '.@$customer_address['line2']}}</td>
						</tr>
						<tr>
							<td  align="left" style="width:100%; font-family: 'Roboto', sans-serif; font-size: 15px; padding-top: 0px; padding-bottom: 0px; padding-left: 0px; padding-right: 0px;">{{@$customer_address['city'].','.@$customer_address['postal_code']}}</td>
						</tr>
						<tr>
							<td  align="left" style="width:100%; font-family: 'Roboto', sans-serif; font-size: 15px; padding-top: 0px; padding-bottom: 0px; padding-left: 0px; padding-right: 0px;">{{@$customer_address['country']}}</td>
						</tr>
					</table>
					<table cellspacing="0" border="0" align="center" cellpadding="10" width="100%" style="padding: 40px 0; margin-bottom: 30px;">
						
						<tr>
							<td style="padding:0px;">
								<table cellspacing="0" border="0" cellpadding="0" width="100%">
									<tr>
										<td  height="20" style="width:20%; font-family: 'Roboto', sans-serif; font-size:13px; padding:8px;">Hi {{@$customer_shipping['name']}}!</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					<table cellspacing="0" border="0" align="center" cellpadding="10" width="100%" style="margin-bottom: 50px;">
						<tr>
							<td style="padding:0px;">
								<table cellspacing="0" border="0" cellpadding="0" width="100%">
									<tr>
										
										<td style="width:40%; font-family: 'Roboto', sans-serif; font-size:16px; padding-top: 15px;  padding-bottom: 15px;  padding-left: 20px; padding-right: 20px; color:#242424; background: #e7e7e7; font-size:16px;"><strong>Description</strong></td>
										<td style="width:10%; font-family: 'Roboto', sans-serif; font-size:16px; padding-top: 15px;  padding-bottom: 15px;  padding-left: 20px; padding-right: 20px; color:#242424; background: #e7e7e7; font-size:16px;"></td>
										<td style="width:20%; font-family: 'Roboto', sans-serif; font-size:16px; padding-top: 15px;  padding-bottom: 15px;  padding-left: 20px; padding-right: 20px; color:#242424; background: #e7e7e7; font-size:16px;"><strong>Quantity</strong></td>
										
										<td style="width:20%; font-family: 'Roboto', sans-serif; font-size:16px; padding-top: 15px;  padding-bottom: 15px;  padding-left: 20px; padding-right: 20px; color:#242424; background: #e7e7e7; font-size:16px;"><strong>Amount</strong></td>
									</tr>
									<tr>
										<td style="width:40%; font-family: 'Roboto', sans-serif; font-size:16px; padding-top: 15px;  padding-bottom: 15px;  padding-left: 20px; padding-right: 20px; color:#242424; font-size:14px; border-bottom: 1px solid #ccc;">
										{{@$lines['data'][0]['description']}}</td>
										<td style="width:10%; font-family: 'Roboto', sans-serif; font-size:16px; padding-top: 15px;  padding-bottom: 15px;  padding-left: 20px; padding-right: 20px; color:#242424; font-size:14px; border-bottom: 1px solid #ccc;"></td>
										<td style="width:30%; font-family: 'Roboto', sans-serif; font-size:16px; padding-top: 15px;  padding-bottom: 15px;  padding-left: 20px; padding-right: 20px; color:#242424; font-size:14px; border-bottom: 1px solid #ccc;">1</td>
										
										<td style="width:20%; font-family: 'Roboto', sans-serif; font-size:16px; padding-top: 15px;  padding-bottom: 15px;  padding-left: 20px; padding-right: 20px; color:#242424; font-size:14px; border-bottom: 1px solid #ccc;">${{number_format((@$lines['data'][0]['amount']/100),2)}}</td>
									</tr>
									<tr>
										<td style="width:30%; font-family: 'Roboto', sans-serif; font-size:16px; padding-top: 15px;  padding-bottom: 15px;  padding-left: 20px; padding-right: 20px; color:#242424; font-size:14px; border-bottom: 1px solid #ccc;"></td>
										<td style="width:30%; font-family: 'Roboto', sans-serif; font-size:16px; padding-top: 15px;  padding-bottom: 15px;  padding-left: 20px; padding-right: 20px; color:#242424; font-size:14px; border-bottom: 1px solid #ccc;"></td>
										<td style="width:20%; font-family: 'Roboto', sans-serif; font-size:16px; padding-top: 15px;  padding-bottom: 15px;  padding-left: 20px; padding-right: 20px; color:#242424; font-size:14px; border-bottom: 1px solid #ccc;"><strong>Subtotal</strong></td>
										<td style="width:20%; font-family: 'Roboto', sans-serif; font-size:16px; padding-top: 15px;  padding-bottom: 15px;  padding-left: 20px; padding-right: 20px; color:#242424; font-size:14px; border-bottom: 1px solid #ccc;">${{number_format((@$lines['data'][0]['amount']/100),2)}}</td>
									</tr>
									<tr>
										<td style="width:30%; font-family: 'Roboto', sans-serif; font-size:16px; padding-top: 15px;  padding-bottom: 15px;  padding-left: 20px; padding-right: 20px; color:#242424; font-size:14px;"></td>
										<td style="width:30%; font-family: 'Roboto', sans-serif; font-size:16px; padding-top: 15px;  padding-bottom: 15px;  padding-left: 20px; padding-right: 20px; color:#242424; font-size:14px;"></td>
										<td style="width:20%; font-family: 'Roboto', sans-serif; font-size:16px; padding-top: 15px;  padding-bottom: 15px;  padding-left: 20px; padding-right: 20px; color:#242424; font-size:14px;"><strong>Paid</strong>
											@if(isset($total_discount_amounts) && !empty($total_discount_amounts))
											{{$discount['coupon']['name'].'('.$discount['coupon']['percent_off'].'% off)'}}
											@endif
										</td>
										<td style="width:20%; font-family: 'Roboto', sans-serif; font-size:16px; padding-top: 15px;  padding-bottom: 15px;  padding-left: 20px; padding-right: 20px; color:#242424; font-size:14px; ">
											@if(isset($total_discount_amounts) && !empty($total_discount_amounts))
											${{number_format((@$lines['data'][0]['amount']/100) - (@$total_discount_amounts[0]['amount']/100),2)}}
											@else
											${{number_format(@$amount_paid/100,2)}}
											@endif
										</td>
									</tr>
									<tr>
										<td style="width:30%; font-family: 'Roboto', sans-serif; font-size:16px; padding-top: 15px;  padding-bottom: 15px;  padding-left: 20px; padding-right: 20px; color:#242424; font-size:14px; background: #cdebfb;"></td>
										<td style="width:30%; font-family: 'Roboto', sans-serif; font-size:16px; padding-top: 15px;  padding-bottom: 15px;  padding-left: 20px; padding-right: 20px; color:#242424; font-size:14px; background: #cdebfb;"></td>
										<td style="width:20%; font-family: 'Roboto', sans-serif; font-size:16px; padding-top: 15px;  padding-bottom: 15px;  padding-left: 20px; padding-right: 20px; color:#242424; font-size:14px; background: #cdebfb;"><strong>Amount due</strong></td>
										<td style="width:20%; font-family: 'Roboto', sans-serif; font-size:16px; padding-top: 15px;  padding-bottom: 15px;  padding-left: 20px; padding-right: 20px; color:#242424; font-size:14px; background: #cdebfb;">${{number_format(@$amount_remaining/100,2)}}</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					<table align="center" cellspacing="0" border="0" align="center" cellpadding="10" width="100%" style="margin-bottom: 50px;">
						<tr>
							<td style="padding:0px;">
								<table cellspacing="0" border="0" cellpadding="0" width="100%">
									<tr>
										<td align="center" style="width:20%; font-family: 'Roboto', sans-serif; font-size:16px; padding-top: 15px;  padding-bottom: 15px;  padding-left: 20px; padding-right: 20px; color:#242424; font-size:14px; background: #cdebfb;">
										<a href="tel:(0172) 466-6470">(0172) 466-6470</a>
										</td>
										<td align="center" style="width:20%; font-family: 'Roboto', sans-serif; font-size:16px; padding-top: 15px;  padding-bottom: 15px;  padding-left: 20px; padding-right: 20px; color:#242424; font-size:14px; background: #cdebfb;">
										<a href="mailto: support@agencydashboard.io";>support@agencydashboard.io</a>
										</td>
										<td align="center" style="width:20%; font-family: 'Roboto', sans-serif; font-size:16px; padding-top: 15px;  padding-bottom: 15px;  padding-left: 20px; padding-right: 20px; color:#242424; font-size:14px; background: #cdebfb;"><a href="mailto:support@agencydashboard.io">www.agencydashboard.io</a>
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>   
			</tr>
		</table>
	</body>
</html>