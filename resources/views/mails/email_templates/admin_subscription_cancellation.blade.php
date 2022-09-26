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
            <td style="padding: 40px 40px 20px 40px; text-align: left; font-family:'Poppins', -apple-system, BlinkMacSystemFont, Helvetica, Arial, sans-serif; color:#2e343b; font-size:16px; font-weight:600; letter-spacing:0.07em; line-height:2em;">
                Hi Admin,
            </td>
        </tr>

        <tr>
            <td style="padding: 0 0 30px 0; text-align: center">
                <img src="{{URL::asset('/public/front/img/unsubscribe@2x.png')}}" aria-hidden="true"
                width="130"
                height="130" alt="alt_text"
                border="0"
                style="height: auto; background: #ffffff; font-family: sans-serif; font-size: 15px; line-height: 20px; color: #555555;">
            </td>
        </tr>

        <tr>
            <td style="padding:0 40px; text-align: left; font-family:'Poppins', -apple-system, BlinkMacSystemFont, Helvetica, Arial, sans-serif; color:#2e343b; font-size:13.5px; font-weight:300; letter-spacing:0.07em; line-height:2em;">
                Shruti has cancelled subscription.
                <br><br>
                Membership Level: Freelancer $39 per month

                Membership Level: Free
                <br><br>
                Subscription Id: sub_098765443455
                <br><br>

                <!-- client feedback section -->
                <h3 style="font-size: 18px; margin: 20px 0 20px 0;">Feedback</h3>

                <p style="font-size: 14px; font-weight: 600; margin: 0 0 10px 0;">What do  you think about Agencydashboard?</p>
                <div>
                    <label style="position: relative; margin: 0 30px 0 0; display: inline-block;">
                        <img src="{{URL::asset('public/vendor/internal-pages/images/selected-face1.png')}}" alt="face1" style="position: relative; z-index: 2; height: 37px; width: 37px;">
                    </label>
                    <label style="position: relative; margin: 0 30px 0 0; display: inline-block;">
                       
                        <img src="{{URL::asset('/public/vendor/internal-pages/images/face2.png')}}" alt="face2" style="position: relative; z-index: 2; height: 37px; width: 37px;">
                    </label>
                    <label style="position: relative; margin: 0 30px 0 0; display: inline-block;">
                       
                        <img src="{{URL::asset('/public/vendor/internal-pages/images/face3.png')}}" alt="face3" style="position: relative; z-index: 2; height: 37px; width: 37px;">
                    </label>
                    <label style="position: relative; margin: 0 30px 0 0; display: inline-block;">
                       
                        <img src="{{URL::asset('/public/vendor/internal-pages/images/face4.png')}}" alt="face4" style="position: relative; z-index: 2; height: 37px; width: 37px;">
                    </label>
                    <label style="position: relative; margin: 0 30px 0 0; display: inline-block;">
                       
                        <img src="{{URL::asset('/public/vendor/internal-pages/images/face5.png')}}" alt="face5" style="position: relative; z-index: 2; height: 37px; width: 37px;">
                    </label>
                </div>

                <p style="font-size: 14px; font-weight: 600; margin: 25px 0 0px 0;">Please share why you are canceling your subscription?</p>
                <p style="margin: 10px 0 0px 0;">test description</p>

                <p style="font-size: 14px; font-weight: 600; margin: 25px 0 0px 0;">Would you recommend Agencydashboard to your peers</p>                 
                <div style="margin: 10px 0 45px 0;">
                   Yes
                    </label>
                </div>
                <!-- client feedback section -->
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