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
                    <strong>Hello {{@$name}},</strong>
                    <br><br>
                    Account details have been updated by <strong>{{$parent_name}}</strong>.
                    <br>
                    <br>
                    <!-- Button : BEGIN -->
                    <table role="presentation" aria-hidden="true" cellspacing="0" cellpadding="0" border="0"
                    align="center" style="margin: auto">
                    <tbody>
                        Below is the list of projects you have the access for:
                        @if(isset($projects) && !empty($projects))
                        @foreach($projects as $project)
                        <li><?php echo $project->domain_name .'('. $project->domain_url.')'; ?></li>
                        @endforeach
                        @endif
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