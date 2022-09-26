@include('mails.includes.header')

<!-- Email Body : BEGIN -->
<table role="presentation" aria-hidden="true" cellspacing="0" cellpadding="0" border="0" align="center"
width="100%" style="max-width: 680px;" class="email-container">


<!-- Email Body : BEGIN -->

<tr>
    <td bgcolor="#ffffff">
        <table role="presentation" aria-hidden="true" cellspacing="0" cellpadding="0" border="0"
        width="100%">
        <tbody>
            <tr>
                <td style="padding: 40px 40px 20px 40px; text-align: center; font-family:'Poppins', -apple-system, BlinkMacSystemFont, Helvetica, Arial, sans-serif; color:#2e343b; font-size:20px; font-weight:600; letter-spacing:0.07em; line-height:2em;">
                    Password Reset
                </td>
            </tr>
            <tr>
                <td style="padding: 20px 0; text-align: center">
                    <img src="{{URL::asset('/public/front/img/passwordreset@2x.png')}}" aria-hidden="true"
                    width="97"
                    height="123" alt="passwordreset-img"
                    border="0"
                    style="height: auto; background: #ffffff; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;">
                </td>
            </tr>
            <tr>
                <td style="padding: 40px; text-align: center;  font-family:'Poppins', -apple-system, BlinkMacSystemFont, Helvetica, Arial, sans-serif; color:#2e343b; font-size:13.5px; font-weight:300; letter-spacing:0.07em; line-height:2em;">
                    <strong>Hello {{$name}},</strong>
                    <br><br>
                    Someone requested that the password for your Agency Dashboard account be reset.
                    <br><br>
                    <!-- Button : BEGIN -->
                    <table role="presentation" aria-hidden="true" cellspacing="0" cellpadding="0" border="0"
                    align="center" style="margin: auto">
                    <tbody>
                        <tr>
                            <td style="border-radius: 3px; background: #222222; text-align: center;"
                            class="button-td">
                            <a href="{{$link}}"
                            style="background: #37c2ef; border: 15px solid #37c2ef; font-family: sans-serif; font-size: 13px; line-height: 1.1; text-align: center; text-decoration: none; display: block; border-radius: 3px; font-weight: bold;"
                            class="button-a">
                            <span style="color:#ffffff;" class="button-link">&nbsp;&nbsp;&nbsp;&nbsp;RESET PASSWORD&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- Button : END -->
    </td>
</tr>
<tr>
    <td bgcolor="#ffffff">
        <table role="presentation" aria-hidden="true" cellspacing="0" cellpadding="0" border="0"
        width="100%">
        <tbody>
            <tr>
                <td style="padding: 0px 40px 40px 40px; text-align: left; font-family:'Poppins', -apple-system, BlinkMacSystemFont, Helvetica, Arial, sans-serif; color:#2e343b; font-size:13.5px; font-weight:300; letter-spacing:0.07em; line-height:2em;">
                    If you did not request this password set up and would like more information, contact us at <a href="mailto:support@agencydashboard.io">support@agencydashboard.io</a>
                </td>
            </tr>
        </tbody>
    </table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>

<!-- Email Body : END -->
@include('mails.includes.footer')