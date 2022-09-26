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
                                Activate your Account
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 0px 16.66% 10px 16.66%; text-align: center; display: block;">
                                <img style="width: 100%" src="{{URL::asset('/public/front/img/registration-flow.png')}}"  alt="Activate Your Account">
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#ffffff">
                                <table role="presentation" aria-hidden="true" cellspacing="0" cellpadding="0" border="0"
                                width="100%">
                                <tbody>
                                    <tr>
                                        <td style="padding:40px; text-align: center; font-family:'Poppins', -apple-system, BlinkMacSystemFont, Helvetica, Arial, sans-serif; color:#2e343b; font-size:13.5px; font-weight:300; letter-spacing:0.07em; line-height:2em;">
                                            Thank you for registering with us. In order to activate your account please
                                            click the button below.
                                            <br><br>
                                            <!-- Button : BEGIN -->
                                            <table role="presentation" aria-hidden="true" cellspacing="0"
                                            cellpadding="0" border="0"
                                            align="center" style="margin: auto">
                                            <tbody>
                                                <tr>
                                                    <td style="border-radius: 3px; background: #222222; text-align: center;"
                                                    class="button-td">
                                                    <a href="{{$link}}"
                                                    style="background: #37c2ef; border: 15px solid #37c2ef; font-family: sans-serif; font-size: 13px; line-height: 1.1; text-align: center; text-decoration: none; display: block; border-radius: 3px; font-weight: bold;"
                                                    class="button-a">
                                                    <span style="color:#ffffff;" class="button-link">&nbsp;&nbsp;&nbsp;&nbsp;ACTIVATE ACCOUNT&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!-- Button : END -->
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tbody>
    </table>
</td>
</tr>

<!-- Email Body : END -->
@include('mails.includes.footer')