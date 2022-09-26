@extends('layouts.vendor_internal_pages')
@section('content')
<input type="hidden" class="campaignID" value="{{$campaign_id}}">
<input type="hidden" class="user_id" value="{{$user_id}}">
<div class="white-box p-0 project-detail-body percent-loader">
	<div class="new-project-created-section">
		<figure>
			<img src="{{URL::asset('public/vendor/internal-pages/images/preloader.gif')}}" alt="loader">.
		</figure>
		<h3> It takes few minutes to get the data, <br>kindly bear with us. <br><span id="new-project-progressBar">0% of the data is collected.</span></h3>
	</div>
</div>
@endsection 