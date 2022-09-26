<?php
$txnid = $payInfo['txnid'];
$productinfo = $payInfo['productinfo'];
$surl = $payInfo['surl'];
$furl = $payInfo['furl'];
$key_id = \config('app.RAZORPAY_KEY_ID');
$currency_code = $payInfo['currency_code'];
$amount = ($payInfo['amount'] );
$merchant_order_id = $payInfo['order_id'];
$card_holder_name = $payInfo['card_holder_name'];
$email = $payInfo['email'];
$phone = $payInfo['phone'];
$return_url = $payInfo['return_url'];
$merchant_subscription_id = $payInfo['subscription_id'];
$merchant_plan_id = $payInfo['plan_id'];
$package = $payInfo['package'];
$productinfo = $payInfo['productinfo'];
?>
<form name="razorpay-subscription-form" id="razorpay-subscription-form" action="<?php echo $return_url; ?>" method="POST">  
    <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id" />
    <input type="hidden" name="merchant_order_id" id="merchant_order_id" value="<?php echo $merchant_order_id; ?>"/>
    <input type="hidden" name="merchant_trans_id" id="merchant_trans_id" value="<?php echo $txnid; ?>"/>
    <input type="hidden" name="merchant_surl_id" id="merchant-surl-id" value="<?php echo $surl; ?>"/>
    <input type="hidden" name="merchant_furl_id" id="merchant-furl-id" value="<?php echo $furl; ?>"/>
    <input type="hidden" name="card_holder_name_id" id="card-holder-name-id" value="<?php echo $card_holder_name; ?>"/>
    <input type="hidden" name="merchant_subscription_id" id="merchant-subscription-id" value="<?php echo $merchant_subscription_id; ?>"/>
</form>
<div class="buttons">
    <div class="pull-right">
        <input style="display:none;" id="submit-subscription-pay" type="submit" onclick="razorpaySubscriptionSubmit(this);" value="Pay Now" class="btn btn-primary" />
    </div>
</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    var razorpay_subscription_options = {
        'key': "rzp_live_uXDe2iy31ntQrr",
        'subscription_id': "<?php echo $merchant_subscription_id; ?>",
        'name': "Agency Dashboard",
        'description': "<?php echo $package; ?> - subscription",
        'prefill': {
            "name": "<?php echo $card_holder_name; ?>",
            "email": "<?php echo $email; ?>",
            "contact": "<?php echo $phone; ?>"
        },
        'notes': {
            "order_id": "<?php echo $merchant_order_id; ?>"
        },
        handler: function (transaction) {
            document.getElementById('razorpay_payment_id').value = transaction.razorpay_payment_id;
            document.getElementById('razorpay-subscription-form').submit();
        },
        "modal": {
            "ondismiss": function () {
                location.reload()
            }
        },
        "theme": {
          "color": "#F37254"
      }
  };



  var razorpay_submit_btn, razorpay_instance;

  function razorpaySubscriptionSubmit(el) {
    if (typeof Razorpay == 'undefined') {
        setTimeout(razorpaySubscriptionSubmit, 200);
        if (!razorpay_submit_btn && el) {
            razorpay_submit_btn = el;
            el.disabled = true;
            el.value = 'Please wait...';
        }
    } else {
        if (!razorpay_instance) {
            razorpay_instance = new Razorpay(razorpay_subscription_options);
            if (razorpay_submit_btn) {
                razorpay_submit_btn.disabled = false;
                razorpay_submit_btn.value = "Pay Now";
            }
        }
        razorpay_instance.open();
    }
}
jQuery("#submit-subscription-pay").trigger("click");
</script>