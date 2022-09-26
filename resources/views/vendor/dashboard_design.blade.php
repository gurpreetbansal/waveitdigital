@extends('layouts.vendor_internal_pages')
@section('content')

<div class="campaign-hero mb-40">
	<div uk-grid class="uk-grid">
	  	<div class="uk-width-auto@m">
			<div class="white-box h-100 left-box">
				<div class="elem-start">
			   		<div class="circle-donut" style="width:200px;height:200px;">
		                <div class="circle_inbox">
	                        <span class="percent_text">91</span> of 100
		                </div>
		                <canvas id="siteAudit-chart-data" width="50" height="50"></canvas>
		            </div>
		            <div class="score-for">
		            	<p><small>Website score for</small></p>
		                <h2>420amanda.com</h2>
		                <ul>
		                    <li><i class="fa fa-map-marker" aria-hidden="true"></i> 159.65.142.104</li>
		                    <li>|</li>
		                    <li><i class="fa fa-lock" aria-hidden="true"></i>  enabled</li>
		                </ul>
		                <a href="javascript:;" class="btn btn-sm blue-btn">View Site Audit</a>
		            </div>
		        </div>
	            <div class="elem-end">
	                <ul>
	                    <li>
	                        <div><img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/pages-icon.png"> Crawled pages</div>
	                        <div>2/50</div>
	                    </li>
                    </ul>
	                <ul>
	                    <li>
	                        <div>
	                        	<img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/google-indexed-logo.png">
	                    		Google indexed pages
	                    	</div>
	                        <div>2</div>
	                   	</li>
	                    <li>
	                        <div>
	                        	<img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/google-safe-icon.png">
	                        	Google safe browsing
	                        </div>
	                        <div>
	                            Site is safe
	                        </div>
	                    </li>
	                </ul>
        		</div>
			</div>
		</div>
	  	<div class="uk-width-expand@l right-box">
	     	<div uk-grid class="uk-grid">
	        	<div class="uk-width-1-3@xl uk-width-1-3@l uk-width-1-3@m uk-width-1-2@s">
	           		<div class="white-box">
	              		<div class="single">
  							<h6>
  								<big>108</big>
  								<cite class="green">
									<img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/up-stats-arrow.png" alt="">
  									<span>32</span>
  									Since Start
  								</cite>
  							</h6>
  							<p>Organic Keywords <span uk-tooltip="title: This section shows growth in organic keywords month after month, however we check this total number of keywords you are ranking for on weekly basis and same can be seen in graph.; pos: top-left" class="fa fa-info-circle" title="" aria-expanded="true"></span></p>
		                  	<div class="chart">
								<img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/graph-shape.png" alt="">
		                  	</div>
	              		</div>
	           		</div>
	        	</div>
	        	<div class="uk-width-1-3@xl uk-width-1-3@l uk-width-1-3@m uk-width-1-2@s">
	           		<div class="white-box">
	              		<div class="single">
  							<h6>
  								<big>138</big>
  								<cite class="red">
									<img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/down-stats-arrow.png" alt="">
  									<span>32</span>
  									Since Start
  								</cite>
  							</h6>
  							<p>Organic Visitors <span uk-tooltip="title: This section shows total number of organic visits to your website in selected time period.; pos: top-left" class="fa fa-info-circle" title="" aria-expanded="false"></span></p>
		                  	<div class="chart">
								<img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/graph-shape.png" alt="">
		                  	</div>
	              		</div>
	           		</div>
	        	</div>
	        	<div class="uk-width-1-3@xl uk-width-1-3@l uk-width-1-3@m uk-width-1-2@s">
	           		<div class="white-box">
	              		<div class="single">
  							<h6>
  								<big>108</big>
  								<cite class="green">
									<img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/up-stats-arrow.png" alt="">
  									<span>32</span>
  									Since Start
  								</cite>
  							</h6>
  							<p>Page Authority <span uk-tooltip="title: This section shows Page authority trend.; pos: top-left" class="fa fa-info-circle" title="" aria-expanded="false"></span></p>
		                  	<div class="chart">
								<img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/graph-shape.png" alt="">
		                  	</div>
	              		</div>
	           		</div>
	        	</div>
	        	<div class="uk-width-1-3@xl uk-width-1-3@l uk-width-1-3@m uk-width-1-2@s">
	           		<div class="white-box">
	              		<div class="single">
  							<h6>
  								<big>118</big>
  								<cite class="green">
									<img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/up-stats-arrow.png" alt="">
  									<span>32</span>
  									Since Start
  								</cite>
  							</h6>
  							<p>Referring Domains <span uk-tooltip="title: This section shows growth in referring domains month after month, however we check the total number of referring domains on weekly basis and same can be seen in graph. ; pos: top-left" class="fa fa-info-circle" title="" aria-expanded="true"></span></p>
		                  	<div class="chart">
								<img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/graph-shape.png" alt="">
		                  	</div>
	              		</div>
	           		</div>
	        	</div>
	        	<div class="uk-width-1-3@xl uk-width-1-3@l uk-width-1-3@m uk-width-1-2@s">
	           		<div class="white-box">
	              		<div class="single">
  							<h6>
  								<big>108</big>
  								<cite class="green">
									<img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/up-stats-arrow.png" alt="">
  									<span>32</span>
  									Since Start
  								</cite>
  							</h6>
  							<p>Google Goals <span uk-tooltip="title: This section shows goal completion from Google Analytics in selected time period. ; pos: top-left" class="fa fa-info-circle" title="" aria-expanded="false"></span></p>
		                  	<div class="chart">
								<img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/graph-shape.png" alt="">		                     	
		                  	</div>
	              		</div>
	           		</div>
	        	</div>
	        	<div class="uk-width-1-3@xl uk-width-1-3@l uk-width-1-3@m uk-width-1-2@s">
	           		<div class="white-box">
	              		<div class="single">
  							<h6>
  								<big>11</big>
  								<cite class="green">
									<img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/up-stats-arrow.png" alt="">
  									<span>32</span>
  									Since Start
  								</cite>
  							</h6>
  							<p>Domain Authority <span uk-tooltip="title: This section shows Domain authority trend.; pos: top-left" class="fa fa-info-circle" title="" aria-expanded="false"></span></p>
		                  	<div class="chart">
								<img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/graph-shape.png" alt="">		                     	
		                  	</div>
	              		</div>
	           		</div>
	        	</div>
	     	</div>
	  	</div>
	</div>
</div>

@endsection