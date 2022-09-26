@extends('layouts.pdf_layout')
@section('content')

<div class="sAudit-section">
	<div id="Overview" class="white-box overviewBox">
		<div class="white-box-head">
			<h5>Overview</h5>
			<p uk-tooltip="title: 2022-03-16 07:10:00; pos: top-center">5 days ago</p>
		</div>
		<div class="white-box-body">
			<div class="left">
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 160 160" width="144" height="144">
                    <circle cx="80" cy="80" r="75" stroke="#ddd" stroke-width="5" fill="transparent"></circle>
                    <path d="M80,5A75,75,0,1,1,5,80,75,75,0,0,1,80,5" stroke-linecap="round" stroke-width="10" fill="transparent" stroke-dasharray="339,471"></path>
                </svg>
                <div class="overlayText">
                	<strong>72</strong> <span>100</span>
                </div>
			</div>
			<div class="right">
				<div class="score-for page2">
					<h1>10secondshots.com</h1>
					<h5>About CBD Movers – Top Movers and Removalists Company in Australia - CBD Movers™-Call 1300 223 668 Now</h5>
					<p>CBD Movers™ started as a local removalists company from Melbourne in the early spring of 2009. Within 10 years the organization had completed its 100000 moves with its operations focused in Melbourne, Sydney, Canberra, Adelaide, Perth, Brisbane, Gold Coast, New Castle. In short CBD Movers made its presence felt within the entire Australian region within</p>
					<p><a href="https://www.cbdmovers.com.au/aboutus/" rel="nofollow" target="_blank">https://www.cbdmovers.com.au/aboutus/</a></p>
				</div>
			</div>
		</div>
		<div class="white-box-foot">
			<div class="uk-child-width-expand@s uk-grid">
			    <div>
			        <div class="issuesSingle">
			        	<div class="uk-flex">
			        		<div class="issueName">
			        			<svg xmlns="http://www.w3.org/2000/svg" class="text-danger mr-2" viewBox="0 0 19.06 17.01"><path d="M2,17H17.06a2,2,0,0,0,1.73-3L11.26,1A2,2,0,0,0,7.8,1L.27,14A2,2,0,0,0,2,17Z"></path></svg>
			        			<p>3 high issues</p>
			        		</div>
			        		<p>10.0%</p>
			        	</div>
			        	<progress class="uk-progress bg-danger" value="10" max="100"></progress>
			        </div>
			    </div>
			    <div>
			        <div class="issuesSingle">
			        	<div class="uk-flex">
			        		<div class="issueName">
			        			<svg xmlns="http://www.w3.org/2000/svg" class="text-warning mr-2" viewBox="0 0 18 18"><path d="M0,3.6V14.4A3.61,3.61,0,0,0,3.6,18H14.4A3.61,3.61,0,0,0,18,14.4V3.6A3.61,3.61,0,0,0,14.4,0H3.6A3.61,3.61,0,0,0,0,3.6Z"></path></svg>
			        			<p>3 medium issues</p>
			        		</div>
			        		<p>10.0%</p>
			        	</div>
			        	<progress class="uk-progress bg-warning" value="10" max="100"></progress>
			        </div>
			    </div>
			    <div>
			        <div class="issuesSingle">
			        	<div class="uk-flex">
			        		<div class="issueName">
			        			<svg xmlns="http://www.w3.org/2000/svg" class="text-secondary mr-2" viewBox="0 0 20 20"><path d="M10,0A10,10,0,1,0,20,10,10,10,0,0,0,10,0Z"></path></svg>
			        			<p>3 low issues</p>
			        		</div>
			        		<p>10.0%</p>
			        	</div>
			        	<progress class="uk-progress bg-secondary" value="10" max="100"></progress>
			        </div>
			    </div>
			    <div>
			        <div class="issuesSingle">
			        	<div class="uk-flex">
			        		<div class="issueName">
			        			<p>21 tests passed</p>
			        		</div>
			        		<p>70.0%</p>
			        	</div>
			        	<progress class="uk-progress bg-success" value="70" max="100"></progress>
			        </div>
			    </div>
			</div>
		</div>
		<div class="white-box-foot">
			<div class="uk-child-width-expand@s uk-grid">
			    <div>
			        <div class="dataSingle">
	        			<svg xmlns="http://www.w3.org/2000/svg" class="fill-current width-4 height-4" viewBox="0 0 18 21"><path d="M12,0H6V2h6ZM8,13h2V7H8Zm8-6.61L17.45,5A11,11,0,0,0,16,3.56L14.62,5A9,9,0,1,0,16,6.39ZM9,19a7,7,0,1,1,7-7A7,7,0,0,1,9,19Z"></path></svg>
		        		<p uk-tooltip="title: Load time; pos: top-center">1.52 seconds</p>
			        </div>
			    </div>
			    <div>
			        <div class="dataSingle">
	        			<svg xmlns="http://www.w3.org/2000/svg" class="fill-current width-4 height-4" viewBox="0 0 20 19"><path d="M11,5.83A3,3,0,0,0,12.83,4H16l-3,7a3.28,3.28,0,0,0,3.5,3A3.28,3.28,0,0,0,20,11L17,4h2V2H12.83A3,3,0,0,0,7.17,2H1V4H3L0,11a3.28,3.28,0,0,0,3.5,3A3.28,3.28,0,0,0,7,11L4,4H7.17A3,3,0,0,0,9,5.83V17H0v2H20V17H11ZM18.37,11H14.63L16.5,6.64Zm-13,0H1.63L3.5,6.64ZM10,4a1,1,0,1,1,1-1A1,1,0,0,1,10,4Z"></path></svg>
		        		<p uk-tooltip="title: Page size; pos: top-center">63.19 kB</p>
			        </div>
			    </div>
			    <div>
			        <div class="dataSingle">
	        			<svg xmlns="http://www.w3.org/2000/svg" class="fill-current width-4 height-4" viewBox="0 0 18 18"><path d="M14,13,10,9V5.82a3,3,0,1,0-2,0V9L4,13H0v5H5V15l4-4.2L13,15V18h5V13Z"></path></svg>
		        		<p uk-tooltip="title: HTTP requests; pos: top-center">41 resources</p>
			        </div>
			    </div>
			    <div>
			        <div class="dataSingle">
	        			<svg xmlns="http://www.w3.org/2000/svg" class="fill-current width-4 height-4" viewBox="0 0 16 21"><path d="M14,7H13V5A5,5,0,0,0,3,5V7H2A2,2,0,0,0,0,9V19a2,2,0,0,0,2,2H14a2,2,0,0,0,2-2V9A2,2,0,0,0,14,7ZM5,5a3,3,0,0,1,6,0V7H5Zm9,14H2V9H14ZM8,16a2,2,0,1,0-2-2A2,2,0,0,0,8,16Z"></path></svg>
	        			<p uk-tooltip="title: HTTPS encryption; pos: top-center">Secure</p>
			        </div>
			    </div>
			</div>
		</div>
	</div>

	<div class="white-box sAudit-detail">
		<div class="white-box-head">
			<h5>SEO</h5>
		</div>
		<div class="white-box-body p-0">
			<ul>
				<li>
					<div class="uk-grid">
	                    <div class="uk-width-1-4">
	                    	<h5>
		                    	<svg xmlns="http://www.w3.org/2000/svg" class="text-danger" viewBox="0 0 19.06 17.01"><path d="M2,17H17.06a2,2,0,0,0,1.73-3L11.26,1A2,2,0,0,0,7.8,1L.27,14A2,2,0,0,0,2,17Z"></path></svg>
		                    	Title
		                    </h5>
	                    </div>
	                    <div class="uk-width-3-4 text-success">
	                    	<p>The title tag must be between 1 and 60 characters.</p>
	                    	<p><small>The current title has 102 characters.</small></p>
	                    </div>
	                </div>
	            </li>
				<li>
					<div class="uk-grid">
	                    <div class="uk-width-1-4">
	                    	<h5>
		                    	<svg xmlns="http://www.w3.org/2000/svg" class="text-success" viewBox="0 0 19.06 17.01"><path d="M2,17H17.06a2,2,0,0,0,1.73-3L11.26,1A2,2,0,0,0,7.8,1L.27,14A2,2,0,0,0,2,17Z"></path></svg>
		                    	Meta description
		                    </h5>
	                    </div>
	                    <div class="uk-width-3-4">
	                    	<p>The meta description tag is good.</p>
	                    	<p><small>CBD Movers™ started as a local removalists company from Melbourne in the early spring of 2009. Within 10 years the organization had completed its 100000 moves with its operations focused in Melbourne, Sydney, Canberra, Adelaide, Perth, Brisbane, Gold Coast, New Castle. In short CBD Movers made its presence felt within the entire Australian region within</small></p>
	                    </div>
	                </div>
	            </li>
				<li>
					<div class="uk-grid">
	                    <div class="uk-width-1-4">
	                    	<h5>
		                    	<svg xmlns="http://www.w3.org/2000/svg" class="text-success" viewBox="0 0 19.06 17.01"><path d="M2,17H17.06a2,2,0,0,0,1.73-3L11.26,1A2,2,0,0,0,7.8,1L.27,14A2,2,0,0,0,2,17Z"></path></svg>
		                    	Headings
		                    </h5>
	                    </div>
	                    <div class="uk-width-3-4">
	                    	<p>The headings are properly set.</p>
	                    	<ul class="inner-accordion">
								<li>
			                    	<a class="uk-accordion-title" href="#">
					                	H1 <span class="count-badge badge-secondary">1</span>
					                </a>
			    				</li>
								<li>
			                    	<a class="uk-accordion-title" href="#">
					                	H2 <span class="count-badge badge-secondary">5</span>
					                </a>
			    				</li>
								<li>
			                    	<a class="uk-accordion-title" href="#">
					                	H3 <span class="count-badge badge-secondary">3</span>
					                </a>
			    				</li>
								<li>
			                    	<a class="uk-accordion-title" href="#">
					                	H4 <span class="count-badge badge-secondary">4</span>
					                </a>
			    				</li>
								<li>
			                    	<a class="uk-accordion-title" href="#">
					                	H5 <span class="count-badge badge-secondary">9</span>
					                </a>
			    				</li>
								<li>
			                    	<a class="uk-accordion-title" href="#">
					                	H6 <span class="count-badge badge-secondary">2</span>
					                </a>
			    				</li>
			    			</ul>
	                    </div>
	                </div>
	            </li>
				<li>
					<div class="uk-grid">
	                    <div class="uk-width-1-4">
	                    	<h5>
		                    	<svg xmlns="http://www.w3.org/2000/svg" class="text-success" viewBox="0 0 19.06 17.01"><path d="M2,17H17.06a2,2,0,0,0,1.73-3L11.26,1A2,2,0,0,0,7.8,1L.27,14A2,2,0,0,0,2,17Z"></path></svg>
		                    	Content keywords
		                    </h5>
	                    </div>
	                    <div class="uk-width-3-4">
	                    	<p>The content has relevant keywords.</p>
	                    	<div class="badge-flex">
                                <span class="badge-success">about</span>
                                <span class="badge-success">cbd</span>
                                <span class="badge-success">movers</span>
                                <span class="badge-success">top</span>
                                <span class="badge-success">movers</span>
                                <span class="badge-success">and</span>
                                <span class="badge-success">removalists</span>
                                <span class="badge-success">company</span>
                                <span class="badge-success">in</span>
                                <span class="badge-success">australia</span>
                                <span class="badge-success">cbd</span>
                                <span class="badge-success">movers</span>
                                <span class="badge-success">call</span>
                                <span class="badge-success">1300</span>
                                <span class="badge-success">223</span>
                                <span class="badge-success">668</span>
                                <span class="badge-success">now</span>
                        	</div>
	                    </div>
	                </div>
	            </li>
				<li>
					<div class="uk-grid">
	                    <div class="uk-width-1-4">
	                    	<h5>
		                    	<svg xmlns="http://www.w3.org/2000/svg" class="text-success" viewBox="0 0 19.06 17.01"><path d="M2,17H17.06a2,2,0,0,0,1.73-3L11.26,1A2,2,0,0,0,7.8,1L.27,14A2,2,0,0,0,2,17Z"></path></svg>
		                    	Image keywords
		                    </h5>
	                    </div>
	                    <div class="uk-width-3-4">
	                    	<p>All images have alt attributes set.</p>
	                    </div>
	                </div>
	            </li>
	            <li>
					<div class="uk-grid">
	                    <div class="uk-width-1-4">
	                    	<h5>
		                    	<svg xmlns="http://www.w3.org/2000/svg" class="text-danger" viewBox="0 0 19.06 17.01"><path d="M2,17H17.06a2,2,0,0,0,1.73-3L11.26,1A2,2,0,0,0,7.8,1L.27,14A2,2,0,0,0,2,17Z"></path></svg>
		                    	SEO friendly URL
		                    </h5>
	                    </div>
	                    <div class="uk-width-3-4">
	                    	<p>The URL does not contain any relevant keywords.</p>
	                    	<p><small>https://www.cbdmovers.com.au/aboutus/</small></p>
	                    </div>
	                </div>
	            </li>
				<li>
					<div class="uk-grid">
	                    <div class="uk-width-1-4">
	                    	<h5>
		                    	<svg xmlns="http://www.w3.org/2000/svg" class="text-success" viewBox="0 0 19.06 17.01"><path d="M2,17H17.06a2,2,0,0,0,1.73-3L11.26,1A2,2,0,0,0,7.8,1L.27,14A2,2,0,0,0,2,17Z"></path></svg>
		                    	404 page
		                    </h5>
	                    </div>
	                    <div class="uk-width-3-4">
	                    	<p>The website has 404 error pages.</p>
	                    	<p><small><a href="#">https://www.cbdmovers.com.au/404-cea5fe117d76d054ea6e84518911576b</a></small></p>
	                    </div>
	                </div>
	            </li>
	        </ul>
		</div>
	</div>
</div>

@endsection