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
                <td dir="ltr" bgcolor="#ffffff" align="center" height="100%" valign="top" width="100%"
                style="padding: 10px 0;">

                <table role="presentation" aria-hidden="true" border="0" cellpadding="0" cellspacing="0"
                align="center"
                width="100%" style="max-width:660px;">
                <tbody>
                    <tr>
                        <td align="center" valign="top" style="font-size:0; padding: 10px 0;">

                            <div style="display:inline-block; margin: 0 -2px; max-width: 200px; min-width:160px; vertical-align:top; width:100%;"
                            class="stack-column">
                            <table role="presentation" aria-hidden="true" cellspacing="0"
                            cellpadding="0" border="0"
                            width="100%">
                            <tbody>
                                <tr>
                                    <td dir="ltr" style="padding: 0 10px 10px 10px;">
                                        <img src="{{URL::asset('/public/front/img/invoice@2x.png')}}"
                                        aria-hidden="true" width="130" height="130"
                                        border="0" alt="invoice-img" class="center-on-narrow"
                                        style="width: 100%; max-width: 130px; height: auto; background: #ffffff; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div style="display:inline-block; margin: 0 -2px; min-width:320px; vertical-align:top;" class="stack-column">
                        <table role="presentation" aria-hidden="true" cellspacing="0"
                        cellpadding="0" border="0"
                        width="100%">
                        <tbody>
                            <tr>
                                <td style="padding: 40px 40px 20px 40px; text-align: left; font-family:'Poppins', -apple-system, BlinkMacSystemFont, Helvetica, Arial, sans-serif; color:#2e343b; font-size:16px; font-weight:600; letter-spacing:0.07em; line-height:2em;">
                                    Hi Admin,
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </td>
        </tr>
    </tbody>
</table>
</td>
</tr>

<tr>
    <td style="padding:0 40px; text-align: left; font-family:'Poppins', -apple-system, BlinkMacSystemFont, Helvetica, Arial, sans-serif; color:#2e343b; font-size:13.5px; font-weight:300; letter-spacing:0.07em; line-height:2em;">
        {{$agency_name}} has signed up for free forever plan
    </td>
</tr>
<tr>
    <td style="padding:0 40px; text-align: left; font-family:'Poppins', -apple-system, BlinkMacSystemFont, Helvetica, Arial, sans-serif; color:#2e343b; font-size:13.5px; font-weight:300; letter-spacing:0.07em; line-height:2em;">
        <p></p>
    </td>
</tr>
</tbody>
</table>
</td>
</tr>

<!-- Email Body : END -->
@include('mails.includes.footer')