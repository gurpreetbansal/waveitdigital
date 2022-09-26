@extends('layouts.main_layout')
@section('content')

<section class="payment-section">
	<div class="container">
		<div class="payment-section-inner">
			<div class="elem-left">
				@if (session('error'))
				<div class="alert alert-danger" role="alert">
					{{ session('error') }}
				</div>
				@endif
				<div class="payment-box">
					<h3>Payment Details</h3>
					<div class="discount-section" <?php if($coupon_state==1){ echo "style='display:block;'";}else{echo "style='display:none;'";}?>>
						<span class="original-amount">{{'$'.@$package_amount}}</span>
						<span class="discounted-amount">{{'$'.@$after_discount}}</span>
					</div>
					{!! Form::open(['action' => 'Front\PaymentController@stripePost', 'data-parsley-validate', 'id' => 'payment-form','method'=>'post']) !!}
					<input type="hidden" name="package_id" class="package_id" value="{{@$packageId}}">
					<input type="hidden" value="{{@$package_price_id}}" name="plan">
					<input type="hidden" value="{{@$string}}" name="data-key">

					<input type="hidden" value="{{@$user->id}}" name="existing_user" />
					<h4>Billing Info</h4>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label>Full Name <sup>*</sup></label>
								<input type="text" name="billing_name" class="form-control" required="required" onkeydown="uppercase();" id='billing_name' placeholder="Your name here" autocomplete="off" value="{{@$user->name}}">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Email <sup>*</sup></label>
								<input type="email" name="billing_email" class="form-control payment_email" required="required" value="{{$email}}" placeholder="Email ID here" disabled="disabled">
							</div>
						</div>
					</div>

					<h4>Billing Address</h4>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label>Address Line 1 <sup>*</sup></label>
								<input type="text" class="form-control" placeholder="Address here" required="required" name="address_line_1"  autocomplete="off"value="{{@$user->UserAddress->address_line_1}}">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Address Line 2 </label>
								<input type="text" class="form-control" placeholder="Address here" name="address_line_2"  autocomplete="off" value="{{@$user->UserAddress->address_line_2}}">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>City <sup>*</sup></label>
								<input type="text" class="form-control" placeholder="City" required="required" name="city"  autocomplete="off" value="{{@$user->UserAddress->city}}">
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Country <sup>*</sup></label>
								<select name="country" class="form-control selectpicker" required="required" data-live-search="true">
									<option value="">-Select-</option>
									<?php 
									if(!empty($countries) && isset($countries)){
										foreach($countries as $country){
											?>
											<option value="{{$country->id}}" @if(@$user->UserAddress->country ==$country->id) selected @endif>{{$country->countries_name}}</option>
											<?php
										}
									}
									?>
								</select>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Postal Code <sup>*</sup></label>
								<input type="text" name="postal_code" class="form-control" required="required" maxlength="6" placeholder="Postal Code here"  autocomplete="off" value="{{@$user->UserAddress->zip}}"/>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Select Plan <sup>*</sup></label>
								<select name="plan" class="form-control dynamic_prices" required="required" data-parsley-class-handler="#product-group" disabled>
									<?php
									if (!empty($prices) && count($prices) > 0) {
										foreach ($prices as $price) {
											?>
											<option value="{{$price->id}}" {{$price->id == $package_price_id  ? 'selected' : ''}}>
												<?php 
												if($package_state == 'year'){
													$package_amount = ($price->unit_amount/100)/12;
												}else{
													$package_amount = ($price->unit_amount/100);
												}
												?>
												{{$price->product_data->name .' ($'.$package_amount.')'}}</option>
												<?php
											}
										}
										?>
									</select>
								</div>
							</div>

							<div class="col-sm-6">
								<div class="form-group">
									<label>Coupon</label>
									<input type="text" name="coupon" class="form-control" placeholder="Coupon code here" value="{{@$coupon_code}}" id="coupon_code" />
									<span id="lblErrorCoupon"  class="errorStyle"></span>
								</div>
							</div>

							<!-- <div class="col-sm-12">
								<div class="form-group">
									<label>Card Info <sup>*</sup></label>
									<div id="card-element" class="form-control"></div>
								</div>
							</div>

							<div class="col-sm-12">
								<div class="form-group">
									<span class="payment-errors" id="card-errors" style="color: red;margin-top:10px;"></span>
								</div>
							</div> -->

							<div class="col-sm-12">
								
									<div class="form-group">
										<label>Pay With <sup>*</sup></label>
										<div class="col-sm-6">
											<div class="form-group">
												<label><input type="radio" name="payment_type" value="stripe">Stripe</label>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label><input type="radio" name="payment_type" value="razorpay">Razorpay</label>
											</div>
										</div>
								</div>
								
							</div>
							
						</div>

						<div class="text-left">
							<button id="card-button" class="btn btn-blue btn-xl">Place Order!</button>
						</div>

						{!! Form::close() !!}
					</div>
				</div>
				<div class="elem-right">
					<figure>
						<img src="{{URL::asset('public/front/img/payment-banner-img.png')}}">
					</figure>
				</div>
			</div>
		</div>

		<div class="shape3 rellax" data-rellax-speed="0">
			<img src="{{URL::asset('public/front/img/shape-3.png')}}">
		</div>
	</section>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- PARSLEY -->
	<script>
		window.ParsleyConfig = {
			errorsWrapper: '<div></div>',
			errorTemplate: '<div class="alert alert-danger parsley" role="alert"></div>',
			errorClass: 'has-error',
			successClass: 'has-success'
		};
	</script>
	<script src="//parsleyjs.org/dist/parsley.js"></script>

	<!-- <script type="text/javascript" src="//js.stripe.com/v2/"></script> -->
	<script src="//js.stripe.com/v3/"></script>
	<script>
		var style = {
			base: {
				color: '#32325d',
				lineHeight: '18px',
				fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
				fontSmoothing: 'antialiased',
				fontSize: '16px',
				'::placeholder': {
					color: '#aab7c4'
				}
			},
			invalid: {
				color: '#fa755a',
				iconColor: '#fa755a'
			}
		};

            const stripe = Stripe('{{ \config("app.STRIPE_KEY") }}', {locale: 'en'}); // Create a Stripe client.
            const elements = stripe.elements(); // Create an instance of Elements.
            const card = elements.create('card', {style: style, hidePostalCode: true}); // Create an instance of the card Element.

            card.mount('#card-element'); // Add an instance of the card Element into the `card-element` <div>.

            card.on('change', function (event) {
            	var displayError = document.getElementById('card-errors');
            	if (event.error) {
            		displayError.textContent = event.error.message;
            	} else {
            		displayError.textContent = '';
            	}
            });

// Handle form submission.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function (event) {
	event.preventDefault();
	var billing_name = $("input[name*='billing_name']").val();
	var address_line_1 = $("input[name*='address_line_1']").val();
	var city = $("input[name*='city']").val();
	var country = $("input[name*='country']").val();
	var postal_code = $("input[name*='postal_code']").val();

	if (billing_name != '' || address_line_1 != '' || city != '' || country != '' || postal_code != '') {
		stripe.createToken(card).then(function (result) {
			$('#card-button').attr('disabled','disabled');
			if (result.error) {
				$('#card-button').removeAttr('disabled');
				var errorElement = document.getElementById('card-errors');
				errorElement.textContent = result.error.message;
			} else {
				stripeTokenHandler(result.token);
			}
		});
	}
});

/* Submit the form with the token ID.*/
function stripeTokenHandler(token) {
	var form = document.getElementById('payment-form');
	var hiddenInput = document.createElement('input');
	hiddenInput.setAttribute('type', 'hidden');
	hiddenInput.setAttribute('name', 'stripeToken');
	hiddenInput.setAttribute('value', token.id);
	form.appendChild(hiddenInput);
	form.submit();
}

	function uppercase() {
		obj = document.getElementById("billing_name");
		var mystring = obj.value;
		var sp = mystring.split(' ');
		var wl = 0;
		var f, r;
		var word = new Array();
		for (i = 0; i < sp.length; i++) {
			f = sp[i].substring(0, 1).toUpperCase();
			r = sp[i].substring(1).toLowerCase();
			word[i] = f + r;
		}
		newstring = word.join(' ');
		obj.value = newstring;
		return true;
	}

	function restrictAlphabets(e) {
		var x = e.which || e.keycode;
		if ((x >= 48 && x <= 57))
			return true;
		else
			return false;
	}


	//coupon code starts
	var coupontypingTime;
	$(document).on('keyup','#coupon_code',function(e){
		e.preventDefault();
		clearTimeout(coupontypingTime);
		coupontypingTime = setTimeout(if_coupon_code_exists($(this).val(),$('input[name="plan"]').val()), 1000);
	});

	$(document).on('keydown', '#coupon_code',function () {
		clearTimeout(coupontypingTime);
	});

	function if_coupon_code_exists(code,amount){
		$.ajax({
			url: 'check_coupon_code',
			type: 'GET',
			data: {code:code},
			success: function (response) {
				if (response.trim() == 'not_exists') {
					$('#lblErrorCoupon.errorStyle').css('display','block');
					var lblError = document.getElementById("lblErrorCoupon");
					lblError.innerHTML = "";
					lblError.innerHTML = "Coupon code does not exists.";
				}
				else if(response.trim() == 'empty'){
					$('#lblErrorCoupon.errorStyle').css('display','none');
					var lblError = document.getElementById("lblErrorCoupon");
				}else{
					$('#lblErrorCoupon.errorStyle').css('display','none');
					var lblError = document.getElementById("lblErrorCoupon");
					lblError.innerHTML = "";
				}
				calculate_discounts(code,amount);
			}
		});
	}


	function calculate_discounts(code,amount){
		$.ajax({
			url: 'ajax_calculate_discounts',
			type: 'GET',
			data: {code,amount},
			success: function (response) {
				if(response.status == 'success'){
					$('.discount-section').css('display','block');
					$('.original-amount').html('$'+response['amount']);
					$('.discounted-amount').html('$'+response['after_discount']);
				}else{
					$('.discount-section').css('display','none');
					$('.original-amount').html('');
					$('.discounted-amount').html('');
				}
			}
		});
	}
</script>
@endsection