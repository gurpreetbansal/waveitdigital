@extends('layouts.vendor_internal_pages')
@section('content')
<div class="sideAudit-page">
	<div class="white-box sa-audits">
		
		<div class="floating-elem">
			<span class="layer1"><img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/particle-layer1.png"></span>
			<span class="layer2"><img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/particle-layer2.png"></span>
			<span class="layer3"><img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/particle-layer3.png"></span>
			<span class="layer4"><img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/particle-layer4.png"></span>
			<span class="layer5"><img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/particle-layer5.png"></span>
			<span class="layer6"><img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/particle-layer6.png"></span>
			<span class="layer7"><img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/particle-layer7.png"></span>
			<span class="layer8"><img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/particle-layer8.png"></span>
			<span class="layer9"><img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/particle-layer9.png"></span>
			<span class="layer10"><img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/particle-layer10.png"></span>
		</div>
		<div class="inner">
			<h1>SEO Checker for Fast & Complete <br>Website Audit</h1>
			<p>Get a detailed SEO report with a personalized checklist on how to improve your <br>website and get to the top of Google.</p>
			<form >
				<div class="form-group audit-form">
					<div class="fieldInput">
						<input type="text" class="form-control run-site-audit" placeholder="Enter your domain" value="" name="domain-name">
					</div>
					<button type="button" class="btn blue-btn run-audit">Analyze Website</button>
				</div>
			</form>
		</div>
		
	</div>
	<div class="sa-audit-overview" style="display:none;" ></div>
	<div class="sa-audit-pages" style="display:none;" ></div>
	<div class="sa-audit-details" style="display:none;" ></div>
		
	
</div>
@endsection