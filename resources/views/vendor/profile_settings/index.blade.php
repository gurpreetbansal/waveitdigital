@extends('layouts.vendor_internal_pages')
@section('content')
<div class="setting-container">
	<input type="hidden" class="stripe_key" value="{{\config('app.STRIPE_KEY')}}">
	<!-- <div class="loader h-300"></div> -->
	<div class="white-box pa-0 mb-40">
		<div class="white-box-body">
			<ul class="uk-subnav uk-subnav-pill" uk-switcher="connect: .profileSettingNav" id="profile-section-list">
				<li id="profile-account-li">
					<a href="#" class="ajax-loader">
						<figure><img src="{{URL::asset('public/vendor/internal-pages/images/account-icon.png')}}"></figure>
						Profile
					</a>
				</li>
				<!-- @if(Auth::user()->user_type == 0)
				<li>
					<a href="#" class="ajax-loader">
						<figure><img src="{{URL::asset('public/vendor/internal-pages/images/white-label.png')}}"></figure>
						White Label
					</a>
				</li>
				@endif -->
				<li>
					<a href="#" class="ajax-loader">
						<figure><img src="{{URL::asset('public/vendor/internal-pages/images/lock-icon.png')}}"></figure>
						Change password
					</a>
				</li>
				@if(Auth::user()->role_id ==2)
				<li id="profile-plan-li">
					<a href="#" class="ajax-loader">
						<figure><img src="{{URL::asset('public/vendor/internal-pages/images/package-icon.png')}}"></figure>
						Plan
					</a>
				</li>
				<li>
					<a href="#" class="ajax-loader">
						<figure><img src="{{URL::asset('public/vendor/internal-pages/images/billing-icon.png')}}"></figure>
						Invoices
					</a>
				</li>
				@if(Auth::user()->user_type == 0 && $purchase_mode == 1)
				<li id="profile-billing">
					<a href="#" class="ajax-loader">
						<figure><img src="{{URL::asset('public/vendor/internal-pages/images/billing-card-icon.png')}}"></figure>
						Billing
					</a>
				</li>
				@endif
				<li>
					<a href="#" class="ajax-loader">
						<figure><img src="{{URL::asset('public/vendor/internal-pages/images/system-preference.png')}}"></figure>
						System Preferences
					</a>
				</li>
				@endif
			</ul>
			<div class="uk-switcher profileSettingNav">
				<!-- Profile Tab -->
				<div id="account-profile-div">
					<div class=" account-form-box"  id="account-form-id">
						<div class="account-form-box-head">
							<figure><img src="{{URL::asset('public/vendor/internal-pages/images/account-icon.png')}}"></figure>
							Profile
							<div class="profileSetting-progress-loader progress-loader"></div>
						</div>
						<div class="account-form-box-body">
							<form id="profileSettingForm" enctype="multipart/form-data">
								@csrf
								<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
								<div class="field-group center">
									<div class="form-group file-group">
										<label>Profile Image</label>
										<label class="custom-file-label">
											<input type="file" name="profile_image" id="profile_image" accept="image/png,image/jpg,image/jpeg" class="profileAccount">
											<div class="custom-file form-control <?php if($user->profile_image != '' || $user->profile_image != null){ echo 'selected';}?>" id="custom-profile-file-div">
												<span uk-icon="icon:  upload"></span>
												<span uk-icon="icon:  pencil" class="edit"></span>
												<span id="fileName" class="fileName">Profile Image</span>
												<span>Choose a file or drag it here.</span>
												<div class="uploaded-file" >
													@if(isset($user->profile_image) && !empty($user->profile_image))
													<img id="profile_image_preview_container" src="{{ $user->profile_image }}" alt="profile-img" >
													@else
													<img id="profile_image_preview_container"  alt="profile-img" >
													@endif
												</div>
											</div>
										</label>
									</div>
									<div class="elem-right text-right">
										<?php if($user->profile_image <> '' || $user->profile_image <> null){?>
											<input type="button" class="btn btn-sm blue-btn" value="Remove" id="remove-profile-picture" data-id="{{$user->id}}"  >
										<?php }else{?>
											<input type="button" class="btn btn-sm blue-btn" value="Remove" id="remove-profile-picture" data-id="{{$user->id}}"  disabled>
										<?php } ?>
										<span class="errorStyle error"><p id="profile-logo-error"></p></span>
									</div>

								</div>

								<div class="form-row">
									<div class="form-group">
										<label>Name</label>
										<span class="icon"><img src="{{URL::asset('public/vendor/internal-pages/images/account-icon.png')}}"></span>
										<input type="text" class="form-control profile_name profileAccount" placeholder="Name" value="{{@$user->name}}" name="name">
										<span class="errorStyle"><p id="profileErrorName"></p></span>
									</div>
									<div class="form-group">
										<label>Email Address</label>
										<span class="icon"><img src="{{URL::asset('public/vendor/internal-pages/images/mail-icon.png')}}"></span>
										<input type="text" class="form-control profileAccount" placeholder="Email" value="{{@$user->email}}" disabled>
									</div>
									@if(Auth::user()->role_id == 2)
									<div class="form-group">
										<label>Vanity URL</label>
										<span class="icon"><img src="{{URL::asset('public/vendor/internal-pages/images/website-icon.png')}}"></span>
										<input type="text" class="form-control change_company_name profileAccount vanity-url-field" placeholder="Vanity Url" value="{{@$user->company_name}}" name="company_name"  maxlength="15" onkeypress="return IsAlphaNumeric(event);" ondrop="return false;"  onpaste="return false;" onkeyup="this.value=removeSpaces(this.value);">
										<span class="vanity-url-span">https://</span>
										<span class="vanity-url-span">.agencydashboard.io</span>
										<span class="errorStyle"><p id="ProfileErrorCompany"></p></span>
										<span id="lblErrorCompanyAlpha"  class="errorStyle" style="display: none;">* Special Characters not allowed</span>
									</div>
									@endif
									<div class="form-group">
										<label>Phone Number</label>
										<span class="icon"><img src="{{URL::asset('public/vendor/internal-pages/images/phone-icon.png')}}"></span>
										<input type="number" class="form-control profile_phone profileAccount" placeholder="Phone" value="{{@$user->phone}}" name="phone" maxLength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
										<span class="errorStyle"><p id="ProfileErrorPhone"></p></span>
									</div>
									<div class="form-group">
										<label>Address</label>
										<span class="icon"><img src="{{URL::asset('public/vendor/internal-pages/images/location-icon.png')}}"></span>
										<input type="text" class="form-control profile_address_line_1 profileAccount" placeholder="Address Line 1" value="{{@$user->UserAddress->address_line_1}}" name="address_line_1">
										<span class="errorStyle"><p id="ProfileErrorAddress1"></p></span>
									</div>
									<div class="form-group">
										<label>Address Line 2</label>
										<span class="icon"><img src="{{URL::asset('public/vendor/internal-pages/images/location-icon.png')}}"></span>
										<input type="text" class="form-control profileAccount" placeholder="Address Line 2" value="{{@$user->UserAddress->address_line_2}}" name="address_line_2">
									</div>
									<div class="form-group">
										<label>City</label>
										<span class="icon"><img src="{{URL::asset('public/vendor/internal-pages/images/city-icon.png')}}"></span>
										<input type="text" class="form-control profile_city profileAccount" placeholder="City" value="{{@$user->UserAddress->city}}" name="city">
										<span class="errorStyle"><p id="ProfileErrorCity"></p></span>
									</div>
									<div class="form-group dropdown">
										<label>Country</label>
										<select name="country" class="selectpicker profileAccount" data-live-search="true" disabled>
											@if(isset($countries))
											@foreach($countries as $country)
											<option value="{{$country->id}}" {{$country->id==@$user->UserAddress->country?'selected':''}}>{{$country->countries_name}}</option>
											@endforeach
											@endif
										</select>
									</div>

									<div class="form-group">
										<label>Zip</label>
										<span class="icon"><img src="{{URL::asset('public/vendor/internal-pages/images/zip-icon.png')}}"></span>
										<input type="text" class="form-control profile_zip profileAccount" placeholder="Zip" value="{{@$user->UserAddress->zip}}" name="zip">
										<span class="errorStyle"><p id="ProfileErrorZip"></p></span>
									</div>
								</div>
								<input type="hidden" class="ErrorCount" value="0">

								<div class="uk-text-right">
									<button type="submit" id="save_profile_settings" class="btn blue-btn">Update</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<!-- Profile Tab End -->
				<!-- white Label -->
				<!-- @if(Auth::user()->user_type == 0)
				<div>
					<div class="account-form-box">
						<div class="account-form-box-head">
							<figure><img src="{{URL::asset('public/vendor/internal-pages/images/white-label.png')}}"></figure>
							White Label
							<div class="AgencyWhiteLabelSettings-progress-loader progress-loader"></div>
						</div>
						<div class="account-form-box-body">
							<form id="agency_white_label" enctype="multipart/form-data">
								@csrf
								<div class="field-group center"  id="whiteLabel-logo-div">
									<div class="form-group file-group">
										<label>Agency Logo</label>
										<label class="custom-file-label">
											<input type="file" name="white_label_logo" id="agency_logo" name="logo" accept="image/png,image/jpg,image/jpeg" class="whiteLabelSettings">
											<div class="custom-file form-control <?php if(isset($profile_info) && (isset($profile_info->agency_logo) && !empty($profile_info->agency_logo))){echo 'selected';}?>"  id="custom-file-agency-div">
												<span uk-icon="icon:  upload"></span>
												<span uk-icon="icon:  pencil" class="edit"></span>
												<span class="fileName">Agency Logo</span>
												<span>Choose a file or drag it here.</span>
												<div class="uploaded-file" id="img-project-logo">
													@if(isset($profile_info->agency_logo) && !empty($profile_info->agency_logo))
													<img id="agency_image_preview_container" src="{{$profile_info->agency_logo($user_id,$profile_info->agency_logo)}}" alt="logo-img" >
													@else
													<img id="agency_image_preview_container"  alt="logo-img" >
													@endif
												</div>
											</div>
										</label>

									</div>

									<div class="elem-right text-right">
										<?php if(isset($profile_info) && ($profile_info->agency_logo <> '' || $profile_info->agency_logo <> null)){?>
											<input type="button" class="btn btn-sm blue-btn" value="Remove" id="remove-agency-logo" data-id="{{$user_id}}"  >
										<?php }else{?>
											<input type="button" class="btn btn-sm blue-btn" value="Remove" id="remove-agency-logo" data-id="{{$user_id}}"  disabled>
										<?php } ?>
										<span class="errorStyle error"><p id="agency-logo-error"></p></span>
									</div>
								</div>

								<div class="form-row">
									<div class="form-group">
										<label>Agency Name</label>
										<span class="icon">
											<img src="{{URL::asset('public/vendor/internal-pages/images/company-icon.png')}}">
										</span>
										<input type="text" class="form-control white_label_agency_name whiteLabelSettings" placeholder="Agency Name" value="{{@$profile_info->agency_name}}" name="agency_name" >
										<span class="errorStyle"><p id="whiteLabel_AgencyName_error"></p></span>
									</div>

									<div class="form-group">
										<label>Agency Owner Name</label>
										<span class="icon">
											<img src="{{URL::asset('public/vendor/internal-pages/images/account-icon.png')}}">
										</span>
										<input type="text" class="form-control white_label_agency_client whiteLabelSettings" placeholder="Agency Owner Name" value="{{@$profile_info->agency_client}}" name="agency_client" >
										<span class="errorStyle"><p id="whiteLabel_agencyClient_error"></p></span>
									</div>

									<div class="form-group">
										<label>Agency Phone</label>   
										<span class="icon"><img src="{{URL::asset('public/vendor/internal-pages/images/phone-icon.png')}}"></span>                                            
										<div class="agency-flex">
											<select class="selectpicker" data-live-search="true" id="country_code" title="-Select-" name="country_code">
												@foreach($countries as $key=>$value)
												<option value="{{$value->id}}" data-country-id="{{$value->country_code}}" {{$value->id == @$profile_info->country_code  ? 'selected' : ''}}>+{{$value->country_code .'('. $value->short_code.')'}}</option>
												@endforeach
											</select>
											<input type="hidden"  class="country-code-val" value="{{@$profile_info->country_code_val}}">
											<input type="number" class="form-control white_label_phone whiteLabelSettings" placeholder="Agency Phone" value="{{@$profile_info->contact_no}}" name="contact_no">
										</div>
										<span class="errorStyle"><p id="whiteLabel_phone_error"></p></span>
									</div>

									<div class="form-group">
										<label>Agency Email</label>
										<span class="icon">
											<img src="{{URL::asset('public/vendor/internal-pages/images/mail-icon.png')}}">
										</span>
										<input type="text" class="form-control white_label_email whiteLabelSettings" name="email" placeholder="Agency Email" value="{{@$profile_info->email}}" >
										<span class="errorStyle"><p id="whiteLabel_email_error"></p></span>
									</div>
								</div>
								<div class="uk-text-right">
									<button type="submit" class="btn blue-btn" id="update_agency_white_label">Update</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				@endif -->
				<!-- white Label end -->
				<!-- Change password Tab -->
				<div>
					<div class="account-form-box">
						<div class="account-form-box-head">
							<figure><img src="{{URL::asset('public/vendor/internal-pages/images/lock-icon.png')}}"></figure>
							Change password
						</div>
						<div class="account-form-box-body">

							<div id="AllErrors" style="display: none;"></div>
							<form id="form_change_password">
								@csrf
								<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
								<div class="form-row">
									<div class="form-group">
										<label>Current Password</label>
										<span class="icon">
											<img src="{{URL::asset('public/vendor/internal-pages/images/lock-icon.png')}}">
										</span>
										<input type="password" class="form-control current_password profilePassword" placeholder="Current Password" name="current_password">
										<span class="errorStyle"><p id="ChangePasswordErrorCurrent"></p></span>
										<img src="{{URL::asset('public/vendor/internal-pages/images/refresh-add-icon.gif')}}"  class="refresh-icon current-pwd-refresh" style="display: none;">
										<span uk-icon="check" class="current-pwd-check green input-validation-icon" style="display: none;"></span>
										<span uk-icon="close" class="current-pwd-cross red input-validation-icon" style="display: none;"></span>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group">
										<label>New Password</label>
										<span class="icon">
											<img src="{{URL::asset('public/vendor/internal-pages/images/lock-icon.png')}}">
										</span>
										<input type="password" class="form-control new_password profilePassword" placeholder="New Password" name="new_password">
										<span class="errorStyle"><p id="ChangePasswordErrorNew"></p></span>
										<img src="{{URL::asset('public/vendor/internal-pages/images/refresh-add-icon.gif')}}"  class="refresh-icon new-pwd-refresh" style="display: none;">
										<span uk-icon="check" class="new-pwd-check green input-validation-icon" style="display: none;"></span>
										<span uk-icon="close" class="new-pwd-cross red input-validation-icon" style="display: none;"></span>
									</div>
									<div class="form-group">
										<label>Confirm Password</label>
										<span class="icon">
											<img src="{{URL::asset('public/vendor/internal-pages/images/lock-icon.png')}}">
										</span>
										<input type="password" class="form-control confirm_password profilePassword" placeholder="Confirm Password" name="confirm_password">
										<span class="errorStyle"><p id="ChangePasswordErrorConfirm"></p></span>
										<img src="{{URL::asset('public/vendor/internal-pages/images/refresh-add-icon.gif')}}"  class="refresh-icon confirm-pwd-refresh" style="display: none;">
										<span uk-icon="check" class="confirm-pwd-check green input-validation-icon" style="display: none;"></span>
										<span uk-icon="close" class="confirm-pwd-cross red input-validation-icon" style="display: none;"></span>
									</div>
								</div>
								<input type="hidden" class="ErrorCountPassword" value="0">
								<div class="uk-text-right">
									<button type="button" id="store_change_password" class="btn blue-btn">Save</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<!-- Change password Tab End -->
				@if(Auth::user()->role_id ==2)
				<!-- Package Tab -->
				<div id="plan_div">
					<div class="account-form-box" id="plan-section">
						<div class="account-form-box-head">
							<figure><img src="{{URL::asset('public/vendor/internal-pages/images/package-icon.png')}}"></figure>
							Plan
							@if($user->subscription_status == 1)
								@if(isset($package_info) && !empty($package_info) && date($package_info->trial_ends_at) >= date('Y-m-d H:i:s') && $package_info->stripe_status=='active')
								(Active)
								@elseif(isset($package_info) && !empty($package_info) && date($package_info->trial_ends_at) >= date('Y-m-d H:i:s') && $package_info->stripe_status=='trialing')
								(Free Trial)
								@endif
							@elseif($user->subscription_status == 0 && $user->subscription_ends_at <=  date('Y-m-d H:i:s'))
							(Expired)
							@endif
						</div>
						<div class="account-form-box-body pa-0">
							<div class="package-table">
								<input type="hidden" class="purchase-mode" value="{{@$user->purchase_mode}}" />
								<table>
									<tr>
										<td>Your Plan</td>
										<td>
											<?php
											if(isset($user_package) && !empty($user_package)){
												if($user_package->subscription_type == '1 year' || $user_package->subscription_type == 'year'){
													echo $user_package->package->name .' ('.$currency.number_format($user_package->price/12).'/month)';
												}elseif($user_package->subscription_type == '1 month' || $user_package->subscription_type == 'month'){
													echo $user_package->package->name .' ('.$currency.number_format($user_package->price).'/month)';
												}else{
													echo $user_package->package->name;
												}
											}
											?>
										</td>
									</tr>
									<tr>
										
										<td>Valid Till</td>
										<td>@if(Auth::user()->user_type==1) Lifetime @else @if(isset($package_info) && !empty($package_info) && isset($package_info->current_period_end)){{date('M d, Y',strtotime($package_info->current_period_end))}} @else - @endif @endif</td>
									</tr>
									<tr>
										@if($user->subscription_status == 0  && $user->subscription_ends_at <=  date('Y-m-d H:i:s'))
										<td>
											<p>Your plan has expired, upgrade to continue.</p>
										</td>
										@elseif($user->subscription_status == 0 && $user->subscription_ends_at >=  date('Y-m-d H:i:s'))
										<td>
											<p>Your plan has been cancelled, upgrade to continue.</p>
										</td>
										@endif

										<td @if($user->subscription_status==1) colspan="2" @endif>
											@if($user->subscription_status==1)
											<!-- <input type="button"  data-id="{{Auth::user()->id}}" class="btn blue-btn renewPlan" value="Change Plan" data-value="upgrade"> -->
											<a href="javascript:;" data-id="{{Auth::user()->id}}" uk-toggle="target: #renew-plan" type="button" id="plan_button">
												<input type="button" class="btn blue-btn" value="Change Plan">
											</a>
											<a href="javascript:;" class="cancel_subscription" data-id="{{Auth::user()->id}}" uk-toggle="target: #cancel-feedback" type="button">
												<input type="button" class="btn btn-border red-btn-border" value="Cancel">
											</a>
											@else
											<!-- <input type="button"  data-id="{{Auth::user()->id}}" class="btn blue-btn renewPlan" value="Renew" data-value="renew"> -->
											<a href="javascript:;" data-id="{{Auth::user()->id}}" uk-toggle="target: #renew-plan" type="button" id="plan_button">
												<input type="button" class="btn blue-btn" value="Renew">
											</a>
											@endif
										</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
				<!-- Package Tab End -->

				<!-- invoices Tab -->
				<div>
					<div class="account-form-box">
						<div class="account-form-box-head">
							<figure><img src="{{URL::asset('public/vendor/internal-pages/images/billing-icon.png')}}"></figure>
							Invoices
							@if($purchase_mode == 1)
							<a href="{{url('/download-excel/'.$user_id)}}" target="_blank" class="btn btn-sm green-btn">
								<img src="{{URL::asset('public/vendor/internal-pages/images/excel-icon.png')}}"> Download
							</a>
							@elseif($purchase_mode == 2)
							<a href="{{url('/stripe-download-excel/'.$user->email)}}" target="_blank" class="btn btn-sm green-btn">
								<img src="{{URL::asset('public/vendor/internal-pages/images/excel-icon.png')}}"> Download
							</a>
							@endif
						</div>
						<div class="account-form-box-body pa-0">
							<div class="billing-table project-table-cover">
								<div class="project-table-body">
									<table>
										<thead>
											<tr>
												<th>
													Date
												</th>
												<th>
													Invoice ID
												</th>
												<th>
													Price
												</th>
												<th>
													Status
												</th>
												<th>
													Action
												</th>
											</tr>
										</thead>
										<tbody>
											@if(isset($invoices) && !empty($invoices) && count($invoices) > 0)
											@if($purchase_mode == 1)
											@foreach($invoices as $invoice_data)
											@foreach($invoice_data->data as $invoice)
											<tr>
												<td>{{date('d M Y',$invoice->created)}} </td>
												<td>{{$invoice->number}}</td>
												<td>${{number_format($invoice->amount_paid/100) .'/'.$invoice->lines->data[0]->plan->interval}}</td>
												<td>{{ucfirst($invoice->status)}}</td>
												<td><a href="{{url('/download-invoice/'.$invoice->id)}}" target="_blank" class="btn btn-sm btn-border red-btn-border"><img src="{{URL::asset('public/vendor/internal-pages/images/pdf-icon.png')}}"> Download</a></td>
											</tr>
											
											@endforeach
											@endforeach
											@elseif($purchase_mode == 2)
											@foreach($invoices as $invoice)
											<tr>
												<td>{{date('d M Y',strtotime($invoice->invoice_created_date))}} </td>
												<td>{{$invoice->invoice_number}}</td>
												<td>₹
													<?php 
													if($invoice->invoice_interval == '1 year'){
														echo number_format($invoice->amount_paid).'/year';
													}elseif($invoice->invoice_interval == '1 month'){
														echo number_format($invoice->amount_paid).'/month';
													}
													?> </td>
												<td>{{ucfirst($invoice->invoice_status)}}</td>
												@if($invoice->invoice_status == 'paid')
												<td><a href="{{url('/stripe-download-invoice/'.$invoice->id)}}" target="_blank" class="btn btn-sm btn-border red-btn-border"><img src="{{URL::asset('public/vendor/internal-pages/images/pdf-icon.png')}}">Download</a></td>
												@else
												<td><a href="{{$invoice->hosted_invoice_url}}" target="_blank" class="btn btn-sm blue-btn">Pay</a></td>
												@endif
											</tr>

											@endforeach
											@endif
											@else
											<tr><td colspan="5"><center>No Invoice Found</center></td></tr>
											@endif
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- invoices Tab End -->
				<!-- Billing Card Tab -->
				@if(Auth::user()->user_type == 0 && $purchase_mode == 1)
				<div>
					<div class="account-form-box">
						<div class="current-cardBox">
							<div class="account-form-box-head">
								<figure><img src="{{URL::asset('public/vendor/internal-pages/images/billing-card-icon.png')}}"></figure>
								Current Card
							</div>
							<div class="account-form-box-body">
								<div class="savedcard-box">
									<div class="single">
										<a href="javascript:void(0)"><span uk-icon="pencil"></span></a>
										<figure><img src="{{URL::asset('public/vendor/internal-pages/images/american-express-logo.jpg')}}"></figure>
										<p><span>American Express</span> <strong>**** 2003</strong></p>
									</div>
								</div>
							</div>
						</div>
						<div class="update-cardBox" style="display: none;">
							<div class="account-form-box-head">
								<figure><img src="{{URL::asset('public/vendor/internal-pages/images/billing-card-icon.png')}}"></figure>
								Update Card Details
							</div>
							<div class="account-form-box-body" id="billing-card-section">

								<form id="card-details-update">
									<input type="hidden" class="user_id" value="{{Auth::user()->id}}">
									<input type="hidden" class="stripe_key" value="{{\config('app.STRIPE_KEY')}}">
									<div class="form-group">
										<div id="card-element" class="form-control"></div>
										<span class="errorStyle"><p id="card-errors"></p></span>
									</div>
									<div class="uk-text-right">
										<button id="card-details-button" class="btn blue-btn">Update</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				@endif
				<!-- Billing Tab End -->
				<!-- System Prefernce tab -->
				<div>
					<div class="account-form-box">
						<div class="account-form-box-head">
							<figure><img src="{{URL::asset('public/vendor/internal-pages/images/system-preference.png')}}"></figure>
							System Preferences
						</div>
						<div class="account-form-box-body">
							<form id="form_system_preference">
								@csrf
								<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
								<div class="form-row">
									<div class="form-group">
										<label>Mail Delivery</label>
										<label><input class="uk-radio" type="radio" checked name="email_delivery" value="{{\config('app.mail')}}"> Send emails from {{\config('app.mail')}}</label>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group">
										<label>Receive replies on</label>
										<span class="icon"><img src="{{URL::asset('public/vendor/internal-pages/images/mail-icon.png')}}"></span>
										<input type="text" class="form-control email_reply_to" name="email_reply_to" value="<?php if(!empty($system_setting) && isset($system_setting->email_reply_to)){ echo $system_setting->email_reply_to; }else{ echo \config('app.mail');}?>" />
										<span class="errorStyle"><p id="ReplyToErrorName"></p></span>
									</div>
								</div>
								<div class="uk-text-right">
									<button type="submit" id="update_system_preference" class="btn blue-btn">Save</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<!-- System Prefernce tab -->
				@endif
			</div>
		</div>
	</div>
</div>
@endsection