var BASE_URL = $('.base_url').val();

function IsAlphaNumeric(e) {
  var keyCode = e.keyCode == 0 ? e.charCode : e.keyCode;
  var ret = ((keyCode >= 48 && keyCode <= 57) || (keyCode >= 65 && keyCode <= 90) || (keyCode >= 97 && keyCode <=122) || (keyCode == 32));
  document.getElementById("lblErrorCompanyAlpha").style.display = ret ? "none" : "inline";
  return ret;
}
function removeSpaces(string){
 return string.split(' ').join('');
}

$(document).ready(function(){
    $('.setting-container').find('.uk-subnav').find('.ajax-loader').removeClass('ajax-loader');
    $('#account-profile-div').find('.ajax-loader').removeClass('ajax-loader');
});

//alert for confirmation without saving data 
function onbeforeunload(){
    window.addEventListener('beforeunload', (event) => {
        event.preventDefault();
        event.returnValue = '';
    });
}

/*account section start*/
$(document).on('keyup change','.profileAccount',function(e){
    e.preventDefault();
    onbeforeunload();
});

$(document).on("submit","#profileSettingForm", function(e){
    e.preventDefault();
    var  phoneNum = $('.profile_phone').val();

    if($('.profile_name').val() == ''){
        $('.profile_name').addClass('error');
        $('#profileErrorName').parent().css('display','block');
        document.getElementById('profileErrorName').innerHTML = 'Field is required.';
    }else{
        $('.profile_name').removeClass('error');
        $('#profileErrorName').parent().css('display','none');
        document.getElementById('profileErrorName').innerHTML = '';
    }

    if($('.change_company_name').val() == ''){
        $('.change_company_name').addClass('error');
        $('#ProfileErrorCompany').parent().css('display','block');
        document.getElementById('ProfileErrorCompany').innerHTML = 'Field is required.';
    }else{
        $('.change_company_name').removeClass('error');
        $('#ProfileErrorCompany').parent().css('display','none');
        document.getElementById('ProfileErrorCompany').innerHTML = '';
    }

    if($('.profile_phone').val() == ''){
        $('.profile_phone').addClass('error');
        $('#ProfileErrorPhone').parent().css('display','block');
        document.getElementById('ProfileErrorPhone').innerHTML = 'Field is required.';
    }else if(phoneNum.match(/\d/g).length !== 10) { 
        $('.profile_phone').addClass('error');
        $('#ProfileErrorPhone').parent().css('display','block');
        document.getElementById('ProfileErrorPhone').innerHTML = 'Not a valid number.';
    } else{
        $('.profile_phone').removeClass('error');
        $('#ProfileErrorPhone').parent().css('display','none');
        document.getElementById('ProfileErrorPhone').innerHTML = '';
    }

    if($('.profile_address_line_1').val() == ''){
        $('.profile_address_line_1').addClass('error');
        $('#ProfileErrorAddress1').parent().css('display','block');
        document.getElementById('ProfileErrorAddress1').innerHTML = 'Field is required.';
    }else{
        $('.profile_address_line_1').removeClass('error');
        $('#ProfileErrorAddress1').parent().css('display','none');
        document.getElementById('ProfileErrorAddress1').innerHTML = '';
    }

    if($('.profile_city').val() == ''){
        $('.profile_city').addClass('error');
        $('#ProfileErrorCity').parent().css('display','block');
        document.getElementById('ProfileErrorCity').innerHTML = 'Field is required.';
    }else{
        $('.profile_city').removeClass('error');
        $('#ProfileErrorCity').parent().css('display','none');
        document.getElementById('ProfileErrorCity').innerHTML = '';
    }

    if($('.profile_zip').val() == ''){
        $('.profile_zip').addClass('error');
        $('#ProfileErrorZip').parent().css('display','block');
        document.getElementById('ProfileErrorZip').innerHTML = 'Field is required.';
    }else{
        $('.profile_zip').removeClass('error');
        $('#ProfileErrorZip').parent().css('display','none');
        document.getElementById('ProfileErrorZip').innerHTML = '';
    }

    if(($('.profile_name').val() !== '') && ($('.change_company_name').val() !== '') && ($('.profile_phone').val() !== '') && ($('.profile_address_line_1').val() !== '') && ($('.profile_city').val() !== '') && ($('.profile_zip').val() !== '') && !$('#custom-profile-file-div').attr('style')){
        $('#save_profile_settings').attr('disabled',true);
        $('.profileSetting-progress-loader').css('display','block');
        var data = new FormData(this);

        $.ajax({
            type: 'POST',
            data: data,
            url:BASE_URL +'/updateprofilesettings',
            contentType: false, 
            processData: false, 
            cache: false, 
            dataType:'json',
            success: function (response){
                $('#save_profile_settings').attr('disabled',false);
                $('#ProfileErrorCompany').html('');
                if(response['status'] == 0){
                    $('.change_company_name').addClass('error');
                    $('#ProfileErrorCompany').parent().css('display','block');
                    document.getElementById('ProfileErrorCompany').innerHTML = response['message'];
                } 
                if(response['status'] == 1){
                    $('#remove-profile-picture').removeAttr('disabled','disabled');
                   // $("#account-profile-div").load(location.href+" #account-profile-div>*","");
                   $("#header-detail-li").load(location.href+" #header-detail-li>*","");
                   $('#account-form-id').removeClass('ajax-loader');
                   $('#ProfileErrorCompany').html('');
                   Command: toastr["success"](response['message']);
                   if(response['company_status'] == 1){
                    window.location.href = response['link'];
                }
            } 
            if(response['status'] == 2){
                Command: toastr["error"](response['message']);
            }


            if(response['status'] == 3){
                if(response['message']['phone']){
                    $('.profile_phone').addClass('error');
                    $('#ProfileErrorPhone').parent().css('display','block');
                    document.getElementById('ProfileErrorPhone').innerHTML = response['message']['phone'];
                }
            } 


            $('.profileSetting-progress-loader').addClass('complete');
            setTimeout(function(){
              $('.profileSetting-progress-loader').css('display','none');
              $('.profileSetting-progress-loader').removeClass('complete');
          }, 500);
        }
    });
    }

});

$(document).on('change','#profile_image',function(){
    var reader = new FileReader();
    if(this.files.length == 1){
        if(this.files[0].type.match('image.*')){
            reader.onload = (e) => { 
                $('#profile_image_preview_container').attr('src', e.target.result); 
            };
            $('#custom-profile-file-div').addClass('selected');
            reader.readAsDataURL(this.files[0]); 
            $('#custom-profile-file-div').removeAttr("style");
            $('#profile-logo-error').parent().css('display','none');
            document.getElementById('profile-logo-error').innerHTML = '';
        }else{
            $('#custom-profile-file-div').removeClass('selected');
            $('#custom-profile-file-div').css('border-color','red');
            $('#profile_image_preview_container').removeAttr('src'); 
            $('#profile-logo-error').parent().css('display','block');
            document.getElementById('profile-logo-error').innerHTML = 'The field must be a file of type: jpg, jpeg, png';
        }
    }
});


$(document).on('keyup','.change_company_name',function(e){
    e.preventDefault();
    var companyname = $(this).val();
    var company_name = companyname.split(' ').join('');

    $.ajax({
        url: BASE_URL + '/check_company_name',
        type: 'POST',
        data: {company_name,_token:$('meta[name="csrf-token"]').attr('content')},
        success: function (response) {
            if (response.trim() == 'taken') {
                $('.change_company_name').addClass('error');
                $('#ProfileErrorCompany').parent().css('display','block');
                document.getElementById('ProfileErrorCompany').innerHTML = 'Company Name already taken';
            }
            else{
                $('.change_company_name').removeClass('error');
                $('#ProfileErrorCompany').parent().css('display','none');
                document.getElementById('ProfileErrorCompany').innerHTML = '';
            }
        }
    });
});

function phonenumber(inputtxt)
{
  var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
  if(!inputtxt.match(phoneno))
  {
    $('.profile_phone').addClass('error');
    $('#ProfileErrorPhone').parent().css('display','block');
    document.getElementById('ProfileErrorPhone').innerHTML = 'Not a valid Phone Number.';
}
else
{
    $('.profile_phone').removeClass('error');
    $('#ProfileErrorPhone').parent().css('display','none');
    document.getElementById('ProfileErrorPhone').innerHTML = '';
}
}

$(document).on('click','#remove-profile-picture',function(e){
    e.preventDefault();
    if (!confirm("Are you sure you want to remove profile picture?")) {
        return false;
    }
    $('.profileSetting-progress-loader').css('display','block');
    $.ajax({
        type:'POST',
        url:BASE_URL+'/ajax_remove_profile_picture',
        data:{profile_image:$('#profile_image_preview_container').attr('src'),user_id:$(this).attr('data-id'),_token:$('meta[name="csrf-token"]').attr('content')},
        dataType:'json',
        success:function(response){
            if(response['status'] == 1){

                $("#account-profile-div").load(location.href+" #account-profile-div>*","");
                $("#header-detail-li").load(location.href+" #header-detail-li>*","");
                $('.profileSetting-progress-loader').addClass('complete');
                Command: toastr["success"](response['message']);
            }

            if(response['status'] == 0){
                Command: toastr["error"](response['message']);
            }

            setTimeout(function(){
              $('.profileSetting-progress-loader').css('display','none');
              $('.profileSetting-progress-loader').removeClass('complete');
          }, 500);
        }
    });
});

/*account section end*/

/*change password*/
$(document).on('keyup','.profilePassword',function(e){
    e.preventDefault();
    onbeforeunload();
});

$(document).on('click','#store_change_password',function(e){

    e.preventDefault();
    var current_password = $('.current_password').val();
    var new_password = $('.new_password').val();
    var confirm_password = $('.confirm_password').val();
    
    if(current_password == ''){
        $('.current_password').addClass('error');
        $('#ChangePasswordErrorCurrent').parent().css('display','block');
        document.getElementById('ChangePasswordErrorCurrent').innerHTML = 'Field is required';
    }else{
        $('.current_password').removeClass('error');
        $('#ChangePasswordErrorCurrent').parent().css('display','none');
        document.getElementById('ChangePasswordErrorCurrent').innerHTML = '';
    }

    if(new_password == ''){
        $('.new_password').addClass('error');
        $('#ChangePasswordErrorNew').parent().css('display','block');
        document.getElementById('ChangePasswordErrorNew').innerHTML = 'Field is required';
    }else{
        $('.new_password').removeClass('error');
        $('#ChangePasswordErrorNew').parent().css('display','none');
        document.getElementById('ChangePasswordErrorNew').innerHTML = '';
    }

    if(confirm_password == ''){
        $('.confirm_password').addClass('error');
        $('#ChangePasswordErrorConfirm').parent().css('display','block');
        document.getElementById('ChangePasswordErrorConfirm').innerHTML = 'Field is required';
    }else{
        $('.confirm_password').removeClass('error');
        $('#ChangePasswordErrorConfirm').parent().css('display','none');
        document.getElementById('ChangePasswordErrorConfirm').innerHTML = '';
    }

    if(current_password != '' && new_password != '' && confirm_password != ''){

        $('#store_change_password').attr('disabled',true);

        var form_data = $('#form_change_password').serialize();

        $.ajax({
            type:'POST',
            url:BASE_URL + '/update_change_password',
            data:form_data,
            dataType:'json',
            success:function(response){
                $('#store_change_password').attr('disabled',false);
                if(response['status'] == 0){
                    if(response['message']['current_password']){
                        $('.current_password').addClass('error');
                        $('#ChangePasswordErrorCurrent').parent().css('display','block');
                        document.getElementById('ChangePasswordErrorCurrent').innerHTML = response['message']['current_password'];
                    }

                    if(response['message']['confirm_password']){
                        $('.profilePassword').addClass('error');
                        $('#ChangePasswordErrorConfirm').parent().css('display','block');
                        document.getElementById('ChangePasswordErrorConfirm').innerHTML = response['message']['confirm_password'];
                    }
                }

                if(response['status'] == 1){
                    $('#form_change_password')[0].reset();
                    Command: toastr["success"](response['message']);
                    return false;
                }
            }
        });
    }

});

/*change password end*/


/*plan section*/
// $(document).on('click','.cancel_subscription',function(e){
//     e.preventDefault();
//     if($(this).data('id') != ''){
//         $('#cancel-feedback').trigger('click');
//         // if (!confirm("Are you sure you want to cancel the subscription ? It won't be undone.")) {
//         //     return false;
//         // } 

//         // $('.cancel_subscription').attr('disabled','disabled');

//         // $.ajax({
//         //     type:'POST',
//         //     data:{user_id:$(this).data('id'),_token:$('meta[name="csrf-token"]').attr('content')},
//         //     dataType:'json',
//         //     url:BASE_URL + '/cancel_subscription',
//         //     success:function(response){
//         //         if(response['status'] == 1){
//         //             $("#plan_div").load(location.href + " #plan-section");
//         //             Command: toastr["success"](response['message']);
//         //             return false;
//         //         }
//         //         if(response['status'] == 0){
//         //             Command: toastr["error"](response['message']);
//         //             return false;
//         //         }
//         //     }
//         // });
//     }else{
//         Command: toastr["error"]('Error!! Please try again.');
//         return false;
//     }
// });

$(document).on('click','.renewPlan',function(e){
    e.preventDefault();
    window.location.href = BASE_URL +'/price#comparePlans';
});
/*plan section*/



/*billing card details*/
window.ParsleyConfig = {
    errorsWrapper: '<div></div>',
    errorTemplate: '<div class="alert alert-danger parsley" role="alert"></div>',
    errorClass: 'has-error',
    successClass: 'has-success'
};

if($('#card-element').length){
var style = {
    base: {
        color: '#32325d',
        lineHeight: '18px',
        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
        fontSmoothing: 'antialiased',
        fontSize: '16px',
        '::placeholder': {
            color: '#aab7c4'
        }
    },
    invalid: {
        color: '#fa755a',
        iconColor: '#fa755a'
    }
};

const stripe = Stripe($('.stripe_key').val(), {locale: 'en'});
const elements = stripe.elements();
const card = elements.create('card', {style: style, hidePostalCode: true});
card.mount('#card-element');
card.on('change', function (event) {
    var displayError = document.getElementById('card-errors');
    if (event.error) {
       // displayError.textContent = event.error.message;
       $('#card-element').addClass('error');
       $('#card-errors').parent().css('display','block');
       document.getElementById('card-errors').innerHTML = event.error.message;

   } else {
       // displayError.textContent = '';
       $('#card-element').removeClass('error');
       $('#card-errors').parent().css('display','none');
       document.getElementById('card-errors').innerHTML = '';
   }
});


// Handle form submission.
var form = document.getElementById('card-details-update');
form.addEventListener('submit', function (event) {
    event.preventDefault();
    stripe.createToken(card).then(function (result) {
        $('#card-details-button').attr('disabled','disabled');

        if (result.error) {
            $('#card-details-button').removeAttr('disabled');
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = result.error.message;

            $('#card-element').addClass('error');
            $('#card-errors').parent().css('display','block');
            document.getElementById('card-errors').innerHTML = result.error.message;


        } else {
            stripeTokenHandler(result.token);
            $('#card-element').removeClass('error');
            $('#card-errors').parent().css('display','none');
            document.getElementById('card-errors').innerHTML = '';
        }
    });
});

}

// Submit the form with the token ID.
function stripeTokenHandler(token) {
    var form = document.getElementById('card-details-update');
    var hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'stripeToken');
    hiddenInput.setAttribute('value', token.id);
    form.appendChild(hiddenInput);
    updateCardDetails();
}


function updateCardDetails(){
   var data = $('#card-details-update').serialize();
   $.ajax({
    type:'POST',
    url:BASE_URL+'/ajax_update_stripe_card_details',
    dataType:'json',
    data: {stripeToken:$("input[name=stripeToken]").val(),_token:$('meta[name="csrf-token"]').attr('content'),user_id:$('.user_id').val()},         
    success:function(response){
        if(response['status'] == 'success'){
            Command: toastr["success"](response['message']);
           // card.clear();
       }

       if(response['status'] == 'error'){
        Command: toastr["error"](response['message']);
    }       

    $('#card-details-button').removeAttr('disabled'); 
}
});
}
/*billing card details*/

/*system preference*/
$(document).on("submit","#form_system_preference", function(e){
 e.preventDefault();

 if($('.email_reply_to').val() == ''){
    $('.email_reply_to').addClass('error');
    $('#ReplyToErrorName').parent().css('display','block');
    document.getElementById('ReplyToErrorName').innerHTML = 'Field is required.';
}else{
    $('.email_reply_to').removeClass('error');
    $('#ReplyToErrorName').parent().css('display','none');
    document.getElementById('ReplyToErrorName').innerHTML = '';
}


if(($('.email_reply_to').val() !== '')){
    $('#update_system_preference').attr('disabled',true);
    var data = new FormData(this);
    $.ajax({
        type: 'POST',
        data: data,
        url:BASE_URL +'/update_user_system_preference',
        contentType: false, 
        processData: false, 
        cache: false, 
        dataType:'json',
        success: function (response){
            $('#update_system_preference').attr('disabled',false);
            $('#ReplyToErrorName').html('');
            if(response['status'] == 1){
                Command: toastr["success"](response['message']);
            }

            if(response['status'] == 0){
             Command: toastr["error"](response['message']);
         }       
     }
 });
}
});

$(document).on('keyup', '.current_password',function (e) {
    e.preventDefault();
    if($(this).val()!=''){
        $('.current-pwd-refresh').css('display','block');
        $('.current-pwd-cross , .current-pwd-check').css('display','none');
        if($(this).val().length <= 6 || $(this).val().length >=15){
            $('.current-pwd-cross').css('display','block');
            $('.current-pwd-check').css('display','none');
            $('.current_password').addClass('error');
            $('#ChangePasswordErrorCurrent').parent().css('display','block');
            document.getElementById('ChangePasswordErrorCurrent').innerHTML = 'Must be between 6 to 15 characters.';
        }else{
            $.ajax({
                type:'GET',
                url:BASE_URL+'/ajax_check_current_password',
                dataType:'json',
                data:{current_password:$(this).val()},
                success:function(response){
                    $('.current-pwd-refresh').css('display','none'); 
                    $('.current-pwd-cross , .current-pwd-check').css('display','none');
                    if(response['status'] == 'error'){
                        $('.current-pwd-cross').css('display','block');
                        $('.current-pwd-check').css('display','none');
                        $('.current_password').addClass('error');
                        $('#ChangePasswordErrorCurrent').parent().css('display','block');
                        document.getElementById('ChangePasswordErrorCurrent').innerHTML = response['message'];
                    }else{
                        $('.current-pwd-check').css('display','block');
                        $('.current-pwd-cross').css('display','none');
                        $('.current_password').removeClass('error');
                        $('#ChangePasswordErrorCurrent').parent().css('display','none');
                        document.getElementById('ChangePasswordErrorCurrent').innerHTML = '';
                    }
                }
            });
        }
    }
});

$(document).on('keyup', '.new_password',function (e) {
    e.preventDefault();
    if($(this).val()!=''){
        $('.new-pwd-refresh').css('display','block');
        $('.new-pwd-cross , .new-pwd-check').css('display','none');
        if($(this).val().length < 6 || $(this).val().length >=15){
            $('.new-pwd-cross').css('display','block');
            $('.new-pwd-check').css('display','none');
            $('.new_password').addClass('error');
            $('#ChangePasswordErrorNew').parent().css('display','block');
            document.getElementById('ChangePasswordErrorNew').innerHTML = 'Must be between 6 to 15 characters.';
        }else{
            $('.new-pwd-refresh').css('display','none'); 
            $('.new-pwd-cross , .new-pwd-check').css('display','none');
            $('.new-pwd-cross').css('display','none');
            $('.new-pwd-check').css('display','block');
            $('.new_password').removeClass('error');
            $('#ChangePasswordErrorNew').parent().css('display','none');
            document.getElementById('ChangePasswordErrorNew').innerHTML = '';
        }
    }
});

$(document).on('keyup', '.confirm_password',function (e) {
    e.preventDefault();
    if($(this).val()!=''){
        $('.confirm-pwd-refresh').css('display','block');
        $('.confirm-pwd-cross , .new-pwd-check').css('display','none');
        $.ajax({
            type:'GET',
            url:BASE_URL+'/ajax_match_confirm_password',
            dataType:'json',
            data:{confirm_password:$(this).val(),new_password:$('.new_password').val()},
            success:function(response){
                $('.confirm-pwd-refresh').css('display','none'); 
                $('.confirm-pwd-cross , .confirm-pwd-check').css('display','none');
                if(response['status'] == 'error'){
                    $('.confirm-pwd-cross').css('display','block');
                    $('.confirm-pwd-check').css('display','none');
                    $('.new_password').addClass('error');
                    $('.confirm_password').addClass('error');
                    $('#ChangePasswordErrorConfirm').parent().css('display','block');
                    document.getElementById('ChangePasswordErrorConfirm').innerHTML = response['message']['confirm_password'];
                }else{
                    $('.confirm-pwd-check').css('display','block');
                    $('.confirm-pwd-cross').css('display','none');
                    $('.new_password').removeClass('error');
                    $('.confirm_password').removeClass('error');
                    $('#ChangePasswordErrorConfirm').parent().css('display','none');
                    document.getElementById('ChangePasswordErrorConfirm').innerHTML = '';
                }
            }
        });      
    }
});

/*white label*/

$(document).on("submit","#agency_white_label", function(e){
    e.preventDefault();
    var company_name = $('.white_label_agency_name').val();
    var client_name = $('.white_label_agency_client').val();
    var email = $('.white_label_email').val();
    var phone = $('.white_label_phone').val();
    var country_code = $('.country-code-val').val();
    var final_phone = '+'+country_code+phone;
    
    if(company_name == ''){
        $('.white_label_agency_name').addClass('error');
        $('#whiteLabel_AgencyName_error').parent().css('display','block');
        document.getElementById('whiteLabel_AgencyName_error').innerHTML = 'Field is required';
    }else{
        $('.white_label_agency_name').removeClass('error');
        $('#whiteLabel_AgencyName_error').parent().css('display','none');
        document.getElementById('whiteLabel_AgencyName_error').innerHTML = '';
    }

    if(client_name == ''){
        $('.white_label_agency_client').addClass('error');
        $('#whiteLabel_agencyClient_error').parent().css('display','block');
        document.getElementById('whiteLabel_agencyClient_error').innerHTML = 'Field is required';
    }else{
        $('.white_label_agency_client').removeClass('error');
        $('#whiteLabel_agencyClient_error').parent().css('display','none');
        document.getElementById('whiteLabel_agencyClient_error').innerHTML = '';
    }

    if(phone == ''){
        $('.white_label_phone').addClass('error');
        $('#country_code').parent().addClass('error');
        $('#whiteLabel_phone_error').parent().css('display','block');
        document.getElementById('whiteLabel_phone_error').innerHTML = 'Field is required';
    }else if(final_phone !== ''){
        console.log(country_code);
        if(country_code == '' || country_code == undefined){
            $('.white_label_phone').addClass('error');
            $('#country_code').parent().addClass('error');
            $('#whiteLabel_phone_error').parent().css('display','block');
            document.getElementById('whiteLabel_phone_error').innerHTML = 'Country code is required';
        }else if(phone == ''){
            $('.white_label_phone').addClass('error');
            $('#country_code').parent().addClass('error');
            $('#whiteLabel_phone_error').parent().css('display','block');
            document.getElementById('whiteLabel_phone_error').innerHTML = 'Field is required';
        }else{
            if(isValidNumber(final_phone) == true){
                $('.white_label_phone').removeClass('error');
                $('#country_code').parent().removeClass('error');
                $('#whiteLabel_phone_error').parent().css('display','none');
                document.getElementById('whiteLabel_phone_error').innerHTML = '';
            }else if(isValidNumber(final_phone) == false){
                $('.white_label_phone').addClass('error');
                $('#country_code').parent().addClass('error');
                $('#whiteLabel_phone_error').parent().css('display','block');
                document.getElementById('whiteLabel_phone_error').innerHTML = 'Invalid number';
            }else{
                $('.white_label_phone').addClass('error');
                $('#country_code').parent().addClass('error');
                $('#whiteLabel_phone_error').parent().css('display','block');
                document.getElementById('whiteLabel_phone_error').innerHTML = 'Invalid number';
            }
        }
    }
    else {
        $('.white_label_phone').removeClass('error');
        $('#country_code').parent().removeClass('error');
        $('#whiteLabel_phone_error').parent().css('display','none');
        document.getElementById('whiteLabel_phone_error').innerHTML = '';
    }

    if(email == ''){
        $('.white_label_email').addClass('error');
        $('#whiteLabel_email_error').parent().css('display','block');
        document.getElementById('whiteLabel_email_error').innerHTML = 'Field is required';
    } else if (ValidateEmail(email)) {
        if(ValidateEmail(email) == 'error'){
            $('.white_label_email').addClass('error');
            $('#whiteLabel_email_error').parent().css('display','block');
            document.getElementById('whiteLabel_email_error').innerHTML = 'Not a valid email';
        }else if(ValidateEmail(email) == 'success'){
            $('.white_label_email').removeClass('error');
            $('#whiteLabel_email_error').parent().css('display','none');
            document.getElementById('whiteLabel_email_error').innerHTML = '';
        }
    } else{
        $('.white_label_email').removeClass('error');
        $('#whiteLabel_email_error').parent().css('display','none');
        document.getElementById('whiteLabel_email_error').innerHTML = '';
    }

    if(company_name != '' &&  client_name != '' && phone != '' && email!=''){
        if(!$('.white_label_agency_name').hasClass('error') && !$('.white_label_agency_client').hasClass('error') && !$('.white_label_phone').hasClass('error') && !$('.white_label_email').hasClass('error') && !$('#custom-file-agency-div').attr('style')){
            $('#update_agency_white_label').attr('disabled','disabled');
            $('.AgencyWhiteLabelSettings-progress-loader').css('display','block');
            $.ajax({
                url:BASE_URL + '/ajax_update_agency_white_label',
                type:'POST',
                cache: false,
                contentType: false,
                processData: false,
                data: new FormData(this),
                dataType:'json', 
                success:function(response){
                    $('#update_agency_white_label').removeAttr('disabled','disabled');
                    if(response['status'] == 0) {
                        Command: toastr["error"]('Please try again getting error');
                    }

                    if (response['status'] == 1) {
                        $('#custom-file-agency-div').addClass('selected');
                        $("#agency-contact-info_div").load(location.href + " #agency-contact-info");
                        $("#whiteLabel-agency-logo-div").load(location.href+" #whiteLabel-agency-logo-div>*","");
                        Command: toastr["success"]('Your detail updated successfully');
                    }

                    if (response['status'] == 2) {
                        if(response['message']['white_label_logo']){
                            $('#custom-file-agency-div').css('border-color','red');
                            $('#agency_image_preview_container').removeAttr('src'); 
                            $('#agency-logo-error').parent().css('display','block');
                            document.getElementById('agency-logo-error').innerHTML = ['message']['white_label_logo'];
                        }
                    }

                    if (response['status'] == 3) {
                        $('#custom-file-agency-div').css('border-color','red');
                        $('#agency-logo-error').parent().css('display','block');
                        document.getElementById('agency-logo-error').innerHTML = response['message'];
                    }

                    $('.AgencyWhiteLabelSettings-progress-loader').addClass('complete');
                    setTimeout(function(){
                        $('.AgencyWhiteLabelSettings-progress-loader').css('display','none');
                        $('.AgencyWhiteLabelSettings-progress-loader').removeClass('complete');
                    }, 500);

                }
            });
        }
    }
});

function ValidateEmail(email) {
    var expr = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (!expr.test(email)) {
        return 'error';
    }else{
        return 'success';
    }
}

function isValidNumber(number) {
    return new libphonenumber.parsePhoneNumber(number).isValid();
}

$('#country_code').on("changed.bs.select", function() {
    var dataTypeAttribute = $('option:selected', this).attr("data-country-id");
    $('.country-code-val').val(dataTypeAttribute);
});

$(document).on('change','#agency_logo',function(){
    var reader = new FileReader();
    if(this.files.length == 1){
        if(this.files[0].type.match('image.*')){
            reader.onload = (e) => { 
                $('#agency_image_preview_container').attr('src', e.target.result); 
            };
            reader.readAsDataURL(this.files[0]); 
            $('#custom-file-agency-div').addClass('selected');
            $('#custom-file-agency-div').removeAttr("style");
            $('#agency-logo-error').parent().css('display','none');
            document.getElementById('agency-logo-error').innerHTML = '';
        }else{
            $('#custom-file-agency-div').removeClass('selected');
            $('#custom-file-agency-div').css('border-color','red');
            $('#agency_image_preview_container').removeAttr('src'); 
            $('#agency-logo-error').parent().css('display','block');
            document.getElementById('agency-logo-error').innerHTML = 'The field must be a file of type: jpg, jpeg, png';
        }
    }
});

$(document).on('click','#remove-agency-logo',function(e){
    e.preventDefault();
    if (!confirm("Are you sure you want to remove agency logo?")) {
        return false;
    }
    $('.AgencyWhiteLabelSettings-progress-loader').css('display','block');
    $.ajax({
        type:'POST',
        url:BASE_URL+'/ajax_remove_agency_logo',
        data:{agency_logo:$('#agency_image_preview_container').attr('src'),project_id:$(this).attr('data-id'),_token:$('meta[name="csrf-token"]').attr('content')},
        dataType:'json',
        success:function(response){
            if(response['status'] == 1){
                $("#whiteLabel-logo-div").load(location.href+" #whiteLabel-logo-div>*","");
                $('.AgencyWhiteLabelSettings-progress-loader').addClass('complete');
                Command: toastr["success"](response['message']);
            }

            if(response['status'] == 0){
                Command: toastr["error"](response['message']);
            }

            setTimeout(function(){
                $('.AgencyWhiteLabelSettings-progress-loader').css('display','none');
                $('.AgencyWhiteLabelSettings-progress-loader').removeClass('complete');
            }, 500);
        }
    });
});



/*Feedback rating*/
// $(document).on('click', '.interface-rating > .star',function(){
//     $('.interface-rating > .star').addClass('selected');
//     var count = $(this).attr('name'); 
//     for (var i=0; i<count-1; i++){        
//         $('.interface-rating > .star').eq(i).removeClass('selected');
//     }
//     $('.interface-rating-value').val((5-i));
//     $('#interface_rating').removeClass('error');
// });

// $(document).on('click', '.features-rating > .star',function(){
//     $('.features-rating > .star').addClass('selected');
//     var count = $(this).attr('name'); 
//     for (var i=0; i<count-1; i++){        
//         $('.features-rating > .star').eq(i).removeClass('selected');
//     }
//     $('.features-rating-value').val((5-i));
//     $('#feature_rating').removeClass('error');
// });

// $(document).on('click', '.user-friendly-rating > .star',function(){
//     $('.user-friendly-rating > .star').addClass('selected');
//     var count = $(this).attr('name'); 
//     for (var i=0; i<count-1; i++){        
//         $('.user-friendly-rating > .star').eq(i).removeClass('selected');
//     }
//     $('.user-friendly-rating-value').val((5-i));
//     $('#user_friendly_rating').removeClass('error');
// });

// $(document).on('change','input[type=radio][name=cancel_reason]',function() {
//     // if(this.value == 4){
//     //     $('.other-text').removeClass('uk-hidden');
//     // }else{
//     //     $('.other-text').addClass('uk-hidden');
//     // }
//     $('#cancel_type').removeClass('error');
// });

// $(document).on('click','#submit-feedback-button',function(){
//     var u_id = $('.cancel_subscription').data('id');
//     var interface = $('.interface-rating-value').val();
//     var features = $('.features-rating-value').val();
//     var user_friendly = $('.user-friendly-rating-value').val();
//     var cancel_type = $('input[name=cancel_reason]:checked').val();
//     var reason = $('.other-text').val();
//     if(cancel_type == 4 && reason == ''){
//         $('.other-text').addClass('error');
//         return false;
//     }else{
//         $('.other-text').removeClass('error');        
//     }

//     if(interface !== '0' && features !== '0' && user_friendly !== '0' && (cancel_type !== 'undefined' && cancel_type !== undefined)){
//         $('#cancel_type').removeClass('error');
//         $('#interface_rating').removeClass('error');
//         $('#feature_rating').removeClass('error');
//         $('#user_friendly_rating').removeClass('error');

//         $.ajax({
//             type:'POST',
//             data:{user_id:u_id,_token:$('meta[name="csrf-token"]').attr('content'),interface,features,user_friendly,cancel_type,reason},
//             dataType:'json',
//             url:BASE_URL + '/cancel_subscription',
//             success:function(response){
//                 if(response['status'] == 1){
//                     $("#plan_div").load(location.href + " #plan-section");
//                     Command: toastr["success"](response['message']);
//                     return false;
//                 }
//                 if(response['status'] == 0){
//                     Command: toastr["error"](response['message']);
//                     return false;
//                 }
//             }
//         });

//     }else{
//        if(cancel_type == undefined){
//             $('#cancel_type').addClass('error');
//         }else{
//             $('#cancel_type').removeClass('error');
//         }

//         if(interface == '0'){
//             $('#interface_rating').addClass('error');
//         }else{
//             $('#interface_rating').removeClass('error');
//         }

//         if(features == '0'){
//             $('#feature_rating').addClass('error');
//         }else{
//             $('#feature_rating').removeClass('error');
//         }

//         if(user_friendly == '0'){
//             $('#user_friendly_rating').addClass('error');
//         }else{
//             $('#user_friendly_rating').removeClass('error');
//         }
//     }
// });


$(document).on('click','#submit-feedback-button',function(){
    var u_id = $('.cancel_subscription').data('id');
    var overall_rating = $('input[name=overall_rating]:checked').val();
    var recommend = $('input[name=recommend]:checked').val();
    var description = $('.description').val();

    if(description !== '' && recommend !== undefined && overall_rating !== undefined){
        $('.description').removeClass('error');
        $('.recommend').removeClass('error');
        $('.overall_rating').removeClass('error');

        $.ajax({
            type:'POST',
            data:{user_id:u_id,_token:$('meta[name="csrf-token"]').attr('content'),overall_rating,recommend,description},
            dataType:'json',
            url:BASE_URL + '/cancel_subscription',
            success:function(response){
                if(response['status'] == 1){
                    $('#cancel-feedback').removeClass('uk-open');
                    $('#feedbackForm')[0].reset();
                    $("#plan_div").load(location.href + " #plan-section");
                    Command: toastr["success"](response['message']);
                    return false;
                }

                if(response['status'] == 0){
                    Command: toastr["error"](response['message']);
                    return false;
                }
            }
        });

    }else{
     if(recommend == undefined){
        $('.recommend').addClass('error');
    }else{
        $('.recommend').removeClass('error');
    }

    if(overall_rating == undefined){
        $('.overall_rating').addClass('error');
    }else{
        $('.overall_rating').removeClass('error');
    }

    if(description == ''){
        $('.description').addClass('error');
    }else{
        $('.description').removeClass('error');
    }
}
});


$(document).on('click','#cancel-feedback-button',function(){
    $('#feedbackForm')[0].reset();
    $('#close-feedback-button').trigger('click');
});