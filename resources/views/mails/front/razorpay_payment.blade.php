@include('mails.includes.header')
<table role="presentation" aria-hidden="true" cellspacing="0" cellpadding="0" border="0" width="100%">
<tbody>
    <tr>
        <td bgcolor="#F5A623" style="padding: 10px 40px 10px 40px; text-align: center; font-family:'Poppins', -apple-system, BlinkMacSystemFont, Helvetica, Arial, sans-serif; color:#ffffff; font-size:20px; font-weight:600; letter-spacing:0.07em; line-height:2em;">
            Payment Failed
        </td>
    </tr>
    <tr>
        <td style="padding: 60px 0; text-align: center">
            <img src="{{URL::asset('/public/front/img/warning@2x.png')}}" aria-hidden="true"
            width="97"
            height="123" alt="alt_text"
            border="0"
            style="height: auto; background: #ffffff; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;">
        </td>
    </tr>
    <tr>
        <td style="padding: 0 40px 20px 40px; text-align: center;  font-family:'Poppins', -apple-system, BlinkMacSystemFont, Helvetica, Arial, sans-serif; color:#2e343b; font-size:13.5px; font-weight:300; letter-spacing:0.07em; line-height:2em;">
            <strong>Hello {{@$account_name}},</strong>
            <br>
             <br>
            <?php 
                if($payment_status == 'cancelled'){
                    echo "This email is to inform you that, the subscription has been cancelled as the payment was not successful.";
                }elseif($payment_status == 'pending'){
                    echo "This email is to inform you that, the payment failed as the card didnot go through.";
                }elseif($payment_status == 'halted'){
                    echo "This email is to inform you that, the payment failed as the card didnot go through.";
                }
            ?>
            <br>
        </td>
    </tr>
</tbody>
</table>
</td>
</tr>
<!-- Email Body : END -->
@include('mails.includes.footer')