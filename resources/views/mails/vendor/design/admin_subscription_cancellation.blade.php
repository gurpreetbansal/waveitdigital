@include('mails.includes.header')

<!-- Email Body : BEGIN -->
<table role="presentation" aria-hidden="true" cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="max-width: 680px;" class="email-container">
	<tbody>
		<tr>
		    <td bgcolor="#ffffff">
		        <table role="presentation" aria-hidden="true" cellspacing="0" cellpadding="0" border="0"
		        width="100%">
			        <tbody>
			            <tr>
			                <td style="padding: 40px 40px 20px 40px; text-align: left; font-family:'Poppins', -apple-system, BlinkMacSystemFont, Helvetica, Arial, sans-serif; color:#2e343b; font-size:16px; font-weight:600; letter-spacing:0.07em; line-height:2em;">
			                    Hi Admin !
			                </td>
			            </tr>
			            <tr>
			                <td style="padding: 0 0 30px 0; text-align: center">
			                    <img src="{{URL::asset('/public/front/img/unsubscribe@2x.png')}}" aria-hidden="true" width="130" height="130" alt="alt_text" border="0" style="height: auto;">
			                </td>
			            </tr>
			            <tr>
			                <td style="padding:0 40px; text-align: left; font-family:'Poppins', -apple-system, BlinkMacSystemFont, Helvetica, Arial, sans-serif; color:#2e343b; font-size:14px; font-weight:400; letter-spacing:0.07em; line-height:1.4em;">
			                    Shruti Dhiman has cancelled subscription.
			                    <br><br>
			                    Membership Level: Freelancer (<i class="fa fa-rupee"></i> 2925 per month)
			                    <br><br>
			                    Subscription Id: xyzzzzz
			                    <br><br>

			                	<h3 style="font-size: 18px; margin: 20px 0 20px 0;">Feedback</h3>

			                    <p style="font-size: 14px; font-weight: 600; margin: 0 0 10px 0;">What do  you think about Agencydashboard?</p>
			                    <div>
		                            <label style="position: relative; margin: 0 30px 0 0; display: inline-block;">
		                                <span style="position: absolute; top: 4px; left: 4px; z-index: 1; width: 34px; height: 34px; background-color: #ffba44; border-radius: 50%;"></span>
		                                <img src="/public/vendor/internal-pages/images/face1.png" alt="face1" style="position: relative; z-index: 2; height: 37px; width: 37px;">
		                            </label>
		                            <label style="position: relative; margin: 0 30px 0 0; display: inline-block;">
		                                <img src="/public/vendor/internal-pages/images/face2.png" alt="face2" style="position: relative; z-index: 2; height: 37px; width: 37px;">
		                            </label>
		                            <label style="position: relative; margin: 0 30px 0 0; display: inline-block;">
		                                <img src="/public/vendor/internal-pages/images/face3.png" alt="face3" style="position: relative; z-index: 2; height: 37px; width: 37px;">
		                            </label>
		                            <label style="position: relative; margin: 0 30px 0 0; display: inline-block;">
		                                <img src="/public/vendor/internal-pages/images/face4.png" alt="face4" style="position: relative; z-index: 2; height: 37px; width: 37px;">
		                            </label>
		                            <label style="position: relative; margin: 0 30px 0 0; display: inline-block;">
		                                <img src="/public/vendor/internal-pages/images/face5.png" alt="face5" style="position: relative; z-index: 2; height: 37px; width: 37px;">
		                            </label>
		                        </div>

	                            <p style="font-size: 14px; font-weight: 600; margin: 25px 0 0px 0;">Please share why you are canceling your subscription?</p>
	                            <p style="margin: 10px 0 0px 0;">tests</p>

	                            <p style="font-size: 14px; font-weight: 600; margin: 25px 0 0px 0;">Would you recommend Agencydashboard to your peers</p>                 
	                            <div style="margin: 10px 0 45px 0;">
	                                Yes
	                            </div>
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