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
                                Welcome
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 20px 0; text-align: center">
                                <img src="{{URL::asset('/public/front/img/registrationthanks@2x.png')}}" aria-hidden="true"
                                width="128"
                                height="128" alt="welcome-img"
                                border="0"
                                style="height: auto; background: #ffffff; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;">
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:20px 40px 40px 40px; text-align: left;  font-family:'Poppins', -apple-system, BlinkMacSystemFont, Helvetica, Arial, sans-serif; color:#2e343b; font-size:13.5px; font-weight:300; letter-spacing:0.07em; line-height:2em;">
                                <strong>Hello Shruti,</strong>
                                <br><br>
                                You have been added as <strong>Manager/Client</strong>, by <strong>Ishan Gupta</strong>.
                                <br>
                                <br>
                                <!-- Button : BEGIN -->
                                <table role="presentation" aria-hidden="true" cellspacing="0" cellpadding="0" border="0"
                                align="center" style="margin: auto">
                                <tbody>
                                    Here are your login crdentials:
                                    <br>
                                Email: xyz@xyz.com, </br>
                            Password: 123456 </br></br>
                            <tr>
                                <td style="border-radius: 3px; background: #222222; text-align: center;"
                                class="button-td">
                                <a href="#"
                                style="background: #37c2ef; border: 15px solid #37c2ef; font-family: sans-serif; font-size: 13px; line-height: 1.1; text-align: center; text-decoration: none; display: block; border-radius: 3px; font-weight: bold;"
                                class="button-a">
                                <span style="color:#ffffff;" class="button-link">&nbsp;&nbsp;&nbsp;&nbsp;LOGIN TO YOUR ACCOUNT&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            </a>
                        </td>
                    </tr>
                    <br>
                    Below is the list of projects you have the access for:
                    <li>ABC -(abc.com) </li>
                    <li>ABC -(abc.com) </li>
                    <li>ABC -(abc.com) </li>
                    <li>ABC -(abc.com) </li>
                    
                </tbody>
            </table>
            <!-- Button : END -->
        </td>
    </tr>
</tbody>
</table>
</td>
</tr>
<!-- Email Body : END -->
@include('mails.includes.footer')