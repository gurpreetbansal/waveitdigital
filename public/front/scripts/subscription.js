var BASE_URL = $('.base_url').val();

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
  var keyCode = e.keyCode;
  var excludedKeys = [8, 37, 39, 46];
  if (!((keyCode >= 48 && keyCode <= 57) || (keyCode >= 96 && keyCode <= 105) || (excludedKeys.includes(keyCode)))) {
    e.preventDefault();
  }
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

  $(document).on('change','#country',function(){    
    if($(this).val() == ''){
      $("#country").addClass('is-invalid'); 
    }else{
      $("#country").removeClass('is-invalid'); 
    }
    // if($(this).val() == 99){
    //   $('#display-stripe-element').css('display','none');
    //   $("input[name=payment_mode][value='razorpay']").removeAttr('disabled','disabled');
    //   $("input[name=payment_mode][value='stripe']").attr('disabled','disabled');
    //   $("input[name=payment_mode][value='razorpay']").prop("checked",true);
    // }else{
    //   $('#display-stripe-element').css('display','block');
    //   display_stripe_element();
    //   $("input[name=payment_mode][value='stripe']").removeAttr('disabled','disabled');
    //   $("input[name=payment_mode][value='razorpay']").attr('disabled','disabled');
    //   $("input[name=payment_mode][value='stripe']").prop("checked",true);
    // }
  });

  // function display_stripe_element(){
  //   var style = {
  //     base: {
  //       color: '#32325d',
  //       lineHeight: '18px',
  //       fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
  //       fontSmoothing: 'antialiased',
  //       fontSize: '16px',
  //       '::placeholder': {
  //         color: '#aab7c4'
  //       }
  //     },
  //     invalid: {
  //       color: '#fa755a',
  //       iconColor: '#fa755a'
  //     }
  //   };

  //   const stripe = Stripe('{{ \config("app.STRIPE_KEY") }}', {locale: 'en'});
  //   const elements = stripe.elements();
  //   const card = elements.create('card', {style: style, hidePostalCode: true});
  //   card.mount('#card-element');
  //   card.on('change', function (event) {
  //     var displayError = document.getElementById('card-errors');
  //     if (event.error) {
  //       displayError.textContent = event.error.message;
  //     } else {
  //       displayError.textContent = '';
  //     }
  //   });
  // }

  // $(document).on('click', '.place-order', function () {
  //   var billing_name = $("input[name='billing_name']").val();
  //   var billing_email = $("input[name='billing_email']").val();
  //   var billing_phone = $("input[name='billing_phone']").val();
  //   var address_line_1 = $("input[name='address_line_1']").val();
  //   var address_line_2 = $("input[name='address_line_2']").val();
  //   var city = $("input[name='city']").val();
  //   var country = $("input[name='country']").val();
  //   var postal_code = $("input[name='postal_code']").val();
  //   var payment_mode = $('input[name="payment_mode"]:checked').val();
  //   var package_id = $('input[name="package_id"]').val();
  //   // var package_state = $('.package_state').val();
  //   var coupon_code = $('#coupon_code').val();
  //   var registeration_data = $('.registeration_data').val();
  //   var subscription_type = $('.registeration_data').attr('data-type');

  //   if(billing_name == ''){
  //     $('#billing_name').addClass('is-invalid');
  //   }else{
  //     $('#billing_name').removeClass('is-invalid');  
  //   }
  //   if(billing_phone == ''){
  //     $('#billing_phone').addClass('is-invalid');
  //   }else{
  //     $('#billing_phone').removeClass('is-invalid');  
  //   }
  //   if(address_line_1 == ''){
  //     $('input[name="address_line_1"]').addClass('is-invalid');
  //   }else{
  //     $('input[name="address_line_1"]').removeClass('is-invalid');  
  //   }
  //   if(city == ''){
  //     $("input[name='city']").addClass('is-invalid');
  //   }else{
  //     $("input[name='city']").removeClass('is-invalid');  
  //   }
  //   if(country == undefined || country == 'undefined'){
  //     $("#country").addClass('is-invalid');
  //   }
  //   if(postal_code == ''){
  //     $("input[name='postal_code']").addClass('is-invalid');
  //   }else{
  //     $("input[name='postal_code']").removeClass('is-invalid');  
  //   }

  //   if(billing_name != '' && billing_email != '' && billing_phone != '' && address_line_1 != '' && city != '' && country != '' && postal_code != ''){
  //     if(payment_mode == 'razorpay'){

  //       $.ajax({
  //         url: BASE_URL+'/initiate_subscriptions',
  //         type: 'post',
  //         data: {billing_email,billing_name,billing_phone,address_line_1,address_line_2,city,country,postal_code,payment_mode,registeration_data,subscription_type,coupon_code,_token:$('meta[name="csrf-token"]').attr('content')},  
  //         dataType: 'json',
  //         success: function (json) {
  //           if(json['status'] == 1){
  //             window.location = BASE_URL+'/'+json['url'];
  //           }
  //         },
  //         error: function (xhr, ajaxOptions, thrownError) {
  //             //console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
  //           }
  //         });
  //     }else if(payment_mode == 'stripe'){
  //       // Handle form submission.
  //       var form = document.getElementById('payment-form');
  //       form.addEventListener('submit', function (event) {
  //         event.preventDefault();
  //         var billing_name = $("input[name*='billing_name']").val();
  //         var address_line_1 = $("input[name*='address_line_1']").val();
  //         var city = $("input[name*='city']").val();
  //         var country = $("input[name*='country']").val();
  //         var postal_code = $("input[name*='postal_code']").val();

  //         if (billing_name != '' || address_line_1 != '' || city != '' || country != '' || postal_code != '') {
  //           stripe.createToken(card).then(function (result) {
  //             $('#card-button').attr('disabled','disabled');
  //             if (result.error) {
  //               $('#card-button').removeAttr('disabled');
  //               var errorElement = document.getElementById('card-errors');
  //               errorElement.textContent = result.error.message;
  //             } else {
  //               stripeTokenHandler(result.token);
  //             }
  //           });
  //         }
  //       });

  //       /* Submit the form with the token ID.*/
  //       function stripeTokenHandler(token) {
  //         var form = document.getElementById('payment-form');
  //         var hiddenInput = document.createElement('input');
  //         hiddenInput.setAttribute('type', 'hidden');
  //         hiddenInput.setAttribute('name', 'stripeToken');
  //         hiddenInput.setAttribute('value', token.id);
  //         form.appendChild(hiddenInput);
  //         form.submit();
  //       }
  //     } //end of else
  //   }
  // });


/*free-forever-section*/
$(document).on('click','.place-order-free-forever',function(){
 var billing_name = $("input[name='billing_name']").val();
 var billing_email = $("input[name='billing_email']").val();
 var address_line_1 = $("input[name='address_line_1']").val();
 var address_line_2 = $("input[name='address_line_2']").val();
 var city = $("input[name='city']").val();
 var country = $("#free-forever-country").val();
 var postal_code = $("input[name='postal_code']").val();
 var package_id = $('input[name="package_id"]').val();
 var data_key = $('input[name="data-key"]').val();
 var existing_user = $('input[name="existing_user"]').val();

 if(billing_name == ''){
  $('#billing_name').addClass('is-invalid');
}else{
  $('#billing_name').removeClass('is-invalid');  
}
if(address_line_1 == ''){
  $('input[name="address_line_1"]').addClass('is-invalid');
}else{
  $('input[name="address_line_1"]').removeClass('is-invalid');  
}
if(city == ''){
  $("input[name='city']").addClass('is-invalid');
}else{
  $("input[name='city']").removeClass('is-invalid');  
}
if(country == undefined || country == 'undefined' || country == ''){
  $("#country").addClass('is-invalid');
}else{
  $("#country").removeClass('is-invalid');
}
if(postal_code == ''){
  $("input[name='postal_code']").addClass('is-invalid');
}else{
  $("input[name='postal_code']").removeClass('is-invalid');  
}


if(billing_name != '' && billing_email != '' && address_line_1 != '' && city != '' && country != '' && postal_code != ''){
  $.ajax({
   url: BASE_URL+'/create_free_forever_subscription',
   type: 'post',
   data: {package_id,data_key ,existing_user,billing_email,billing_name,address_line_1,address_line_2,city,country,postal_code,_token:$('meta[name="csrf-token"]').attr('content')},  
   dataType: 'json',
   success: function (json) {
    if(json['status'] == 1){
    window.location.href = json['url'];
    }else{
      Command: toastr["error"]('Error, kindly select the plan again.');
    }
  }
});
}
});



$(document).on('change','#free-forever-country',function(){    
  if($(this).val() == '' || $(this).val()==undefined){
    $("#country").addClass('is-invalid'); 
  }else{
    $("#country").removeClass('is-invalid'); 
  }
});

function getCookie(name) {
let matches = document.cookie.match(new RegExp(
  "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
));
return matches ? decodeURIComponent(matches[1]) : undefined;
}

$(document).ready(function() {
  $('.referrer_from').val(getCookie('referral'));
});