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
                <td style="padding:40px 40px 0 40px; text-align: center; font-family:'Poppins', -apple-system, BlinkMacSystemFont, Helvetica, Arial, sans-serif; color:#2e343b; font-size:20px; font-weight:700; letter-spacing:0; line-height:1.5em;">
                    Thank you for signing up for the Agency Dashboard Subscription
                </td>
            </tr>
            <tr>
                <td style="padding:20px 40px; text-align: left; font-family:'Poppins', -apple-system, BlinkMacSystemFont, Helvetica, Arial, sans-serif; color:#2e343b; font-size:13.5px; font-weight:300; letter-spacing:0.07em; line-height:2em;">
                    Here are your subscription details:
                </td>
            </tr>
            <tr>
                <td style="padding:0 40px 15px 40px; text-align: left; font-family:'Poppins', -apple-system, BlinkMacSystemFont, Helvetica, Arial, sans-serif; color:#2e343b; font-size:13.5px; font-weight:300; letter-spacing:0.07em; line-height:1.5em;">
                    Plan
                    <p style="font-weight:500; margin: 0">Freelancer</p>
                </td>
            </tr>
            <tr>
                <td style="padding:0 40px 15px 40px; text-align: left; font-family:'Poppins', -apple-system, BlinkMacSystemFont, Helvetica, Arial, sans-serif; color:#2e343b; font-size:13.5px; font-weight:300; letter-spacing:0.07em; line-height:1.5em;">
                    Date of Purchase
                    <p style="font-weight:500; margin: 0">04 Aug 2022</p>
                </td>
            </tr>
            <tr>
                <td style="padding:0 40px 15px 40px; text-align: left; font-family:'Poppins', -apple-system, BlinkMacSystemFont, Helvetica, Arial, sans-serif; color:#2e343b; font-size:13.5px; font-weight:300; letter-spacing:0.07em; line-height:1.5em;">
                    Renewal Price
                    <p style="font-weight:500; margin: 0">
                        $468
                    </p>
                </td>
            </tr>            
            <tr>
                <td style="padding:0 40px 20px 40px; text-align: left; font-family:'Poppins', -apple-system, BlinkMacSystemFont, Helvetica, Arial, sans-serif; color:#2e343b; font-size:13.5px; font-weight:300; letter-spacing:0.07em; line-height:2em;">
                    <hr style="opacity: 0.3;">
                    <p>
                        Thank you 
                        <br>
                        Agency Dashboard Support Team
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
</td>
</tr>

<!-- Email Body : END -->
@include('mails.includes.footer')