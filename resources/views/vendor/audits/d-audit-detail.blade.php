@extends('layouts.vendor_internal_pages')
@section('content')

<div class="sAudit-section">
	<div class="inner">
		<ul class="breadcrumb-list">
		    <li class="breadcrumb-item">
		    	<a href="#">Home</a>
		    </li>
		    <li class="breadcrumb-item">
		    	<a href="#">Reports</a>
		    </li>
		    <li class="uk-active breadcrumb-item">Report</li>
		</ul>
		
		<div class="sAudit-title">
			<h1>cbdmovers.com.au</h1>
			<div class="right-icons">
				<nav class="btn-group">
					<div class="uk-inline">
						<button class="btn icon-btn" type="button">
							<span uk-icon="more"></span>
						</button>
						<div uk-dropdown="mode: click">
							<nav>
								<a href="javascript:void(0)"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
								<a href="javascript:void(0)"><i class="fa fa-eye" aria-hidden="true"></i> View</a>
								<a href="javascript:void(0)"><i class="fa fa-external-link" aria-hidden="true"></i> Open</a>
								<hr>
								<a href="javascript:void(0)" class="text-danger"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
							</nav>
						</div>
					</div>
					<a href="javascript:;" class="btn icon-btn" uk-tooltip="title: Refresh; pos: top-center">
						<span uk-icon="refresh"></span>
					</a>
					<a href="javascript:;" class="btn icon-btn" uk-tooltip="title: Print; pos: top-center">
						<span uk-icon="print"></span>
					</a>
				</nav>				
			</div>
		</div>

		<nav class="sAudit-nav">
			<a href="#Overview">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12,8h5.33a1.34,1.34,0,1,0,0-2.67H12A1.34,1.34,0,0,0,12,8Zm0,5.33h5.33a1.33,1.33,0,1,0,0-2.66H12a1.33,1.33,0,0,0,0,2.66Zm0,5.34h5.33a1.34,1.34,0,1,0,0-2.67H12a1.34,1.34,0,0,0,0,2.67ZM5.33,5.33H8V8H5.33Zm0,5.34H8v2.66H5.33Zm0,5.33H8v2.67H5.33Z"></path><path d="M21.33,0H2.67A2.68,2.68,0,0,0,0,2.67V21.33A2.68,2.68,0,0,0,2.67,24H21.33A2.68,2.68,0,0,0,24,21.33V2.67A2.68,2.68,0,0,0,21.33,0Zm0,21.33H2.67V2.67H21.33Z"></path></svg>
				<span>Overview</span>
			</a>
			<a href="#SEO">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17.49 17.49"><path d="M12.5,11h-.79l-.28-.27a6.51,6.51,0,1,0-.7.7l.27.28v.79l5,5L17.49,16Zm-6,0A4.5,4.5,0,1,1,11,6.5,4.49,4.49,0,0,1,6.5,11Z"></path></svg>
				<span>SEO</span>
				<span class="ibadge badge-danger">2</span>
				<span class="ibadge badge-warning">1</span>
			</a>
			<a href="#">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19.97 15.96"><path d="M18.35,4.53,17.12,6.38A8,8,0,0,1,16.9,14H3A8,8,0,0,1,13.55,2.81L15.4,1.58A10,10,0,0,0,1.32,15,2,2,0,0,0,3,16H16.89a2,2,0,0,0,1.74-1,10,10,0,0,0-.27-10.44Z"></path><path d="M8.56,11.37a2,2,0,0,0,2.83,0h0l5.66-8.49L8.56,8.54a2,2,0,0,0,0,2.83Z"></path></svg>
				<span>Performance</span>
				<span class="ibadge badge-danger">1</span>
				<span class="ibadge badge-warning">1</span>
				<span class="ibadge badge-secondary">1</span>
			</a>
			<a href="#">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 20"><path d="M6.5,11H4V8H6.5V5.5h3V8H12v3H9.5v2.5h-3ZM8,0,0,3V9.09C0,14.14,3.41,18.85,8,20c4.59-1.15,8-5.86,8-10.91V3Zm6,9.09a9.34,9.34,0,0,1-6,8.83A9.33,9.33,0,0,1,2,9.09V4.39L8,2.14l6,2.25Z"></path></svg>
				<span>Security</span>
				<span class="ibadge badge-secondary">1</span>
			</a>
			<a href="#">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19 19.08"><path d="M13.56,6.56,9.85.48a1,1,0,0,0-1.7,0L4.43,6.56a1,1,0,0,0,.85,1.52h7.43A1,1,0,0,0,13.56,6.56Zm-6.5-.48L9,2.92l1.93,3.16Z"></path><path d="M19,14.58a4.5,4.5,0,1,0-4.5,4.5A4.49,4.49,0,0,0,19,14.58Zm-4.5,2.5a2.5,2.5,0,1,1,2.5-2.5A2.5,2.5,0,0,1,14.5,17.08Z"></path><path d="M7,10.58H1a1,1,0,0,0-1,1v6a1,1,0,0,0,1,1H7a1,1,0,0,0,1-1v-6A1,1,0,0,0,7,10.58Zm-1,6H2v-4H6Z"></path></svg>
				<span>Miscellaneous</span>
				<span class="ibadge badge-warning">1</span>
				<span class="ibadge badge-secondary">1</span>
			</a>
		</nav>

		<div id="Overview" class="white-box overviewBox p-0">
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
					<h5>About CBD Movers – Top Movers and Removalists Company in Australia - CBD Movers™-Call 1300 223 668 Now</h5>
					<p>CBD Movers™ started as a local removalists company from Melbourne in the early spring of 2009. Within 10 years the organization had completed its 100000 moves with its operations focused in Melbourne, Sydney, Canberra, Adelaide, Perth, Brisbane, Gold Coast, New Castle. In short CBD Movers made its presence felt within the entire Australian region within</p>
					<p><a href="https://www.cbdmovers.com.au/aboutus/" rel="nofollow" target="_blank">https://www.cbdmovers.com.au/aboutus/</a></p>
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

		<div id="SEO" class="white-box sAudit-detail p-0">
			<div class="white-box-head">
				<h5>SEO</h5>
			</div>
			<div class="white-box-body p-0">
				<ul class="uk-accordion" uk-accordion="multiple: true">
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
		                <a class="uk-accordion-title" href="#" uk-tooltip="title: More; pos: top-center">
		                	<span uk-icon="info"></span>
		                </a>
    					<div class="uk-accordion-content">
    						<div class="inner-content">
	    						<p>The title tag is the HTML element that specifies the title of the webpage. The title tag is displayed at the top of your browser, in the search results, as well as in the bookmarks bar.</p>
	    						<hr>
	    						<p>Learn more <a href="#">Google <span uk-icon="arrow-right"></span></a></p>
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
		                <a class="uk-accordion-title" href="#" uk-tooltip="title: More; pos: top-center">
		                	<span uk-icon="info"></span>
		                </a>
    					<div class="uk-accordion-content">
    						<div class="inner-content">
	    						<p>The meta description is an HTML tag that provides a short and accurate summary of the webpage. The meta description is used by search engines to identify a webpage's topic and provide relevant search results.</p>
	    						<hr>
	    						<p>Learn more <a href="#">Google <span uk-icon="arrow-right"></span></a></p>
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
		                    	<ul class="inner-accordion uk-accordion" uk-accordion="multiple: true">
									<li>
				                    	<a class="uk-accordion-title" href="#">
						                	H1 <span class="count-badge badge-secondary">1</span>
						                </a>
				    					<div class="uk-accordion-content">
	    									<div class="inner-content">
					    						<ul>
					    							<li>About CBD Movers – Top Movers and Removalists Company in Australia</li>
					    						</ul>
					    					</div>
				    					</div>
				    				</li>
									<li>
				                    	<a class="uk-accordion-title" href="#">
						                	H2 <span class="count-badge badge-secondary">5</span>
						                </a>
				    					<div class="uk-accordion-content">
	    									<div class="inner-content">
					    						<ul>
					    							<li>Vision</li>
													<li>Mission</li>
													<li>Statement</li>
													<li>Contribution to society</li>
													<li>CBD Movers Making Moving Easy and Efficient</li>
					    						</ul>
					    					</div>
				    					</div>
				    				</li>
									<li>
				                    	<a class="uk-accordion-title" href="#">
						                	H3 <span class="count-badge badge-secondary">3</span>
						                </a>
				    					<div class="uk-accordion-content">
	    									<div class="inner-content">
					    						<ul>
					    							<li>Attributes That Make CBD Movers the Best Removalists</li>
													<li>Get Your Free Quote</li>
													<li>Popular Posts</li>
					    						</ul>
					    					</div>
				    					</div>
				    				</li>
									<li>
				                    	<a class="uk-accordion-title" href="#">
						                	H4 <span class="count-badge badge-secondary">4</span>
						                </a>
				    					<div class="uk-accordion-content">
	    									<div class="inner-content">
					    						<ul>
					    							<li>Company</li>
													<li>Local Removals</li>
													<li>Get Your Free Quote</li>
													<li>Request Call Back</li>
					    						</ul>
					    					</div>
				    					</div>
				    				</li>
									<li>
				                    	<a class="uk-accordion-title" href="#">
						                	H5 <span class="count-badge badge-secondary">9</span>
						                </a>
				    					<div class="uk-accordion-content">
					    					<div class="inner-content">
					    						<ul>
					    							<li>Epping VIC 3076</li>
													<li>Last-Minute Move: Here’s How to Make it Stress-free</li>
													<li>Residential Vs. Commercial Moves – 4 Key Differences Elaborated</li>
													<li>A Quick Guide To Moving Plants Safely</li>
													<li>11 Incredible Tips For Organizations To Move Hassle-Free</li>
													<li>Post-Move Checklist: 10 Things You Must Do After The Movers Leave</li>
													<li>9 Budget-Friendly Moving Tips For College Students</li>
													<li>9 Essential Moving Tips For Seniors</li>
													<li>Local Moving vs. Long Distance Moving: What’s The Difference?</li>
					    						</ul>
					    					</div>
				    					</div>
				    				</li>
									<li>
				                    	<a class="uk-accordion-title" href="#">
						                	H6 <span class="count-badge badge-secondary">2</span>
						                </a>
				    					<div class="uk-accordion-content">
	    									<div class="inner-content">
					    						<ul>
					    							<li><a href="#">CORONAVIRUS COVID-19 | REMOVALISTS ESSENTIAL SERVICES UPDATES CLICK HERE</a></li>
													<li>COVID-19 INFECTION CONTROL TRAINING CERTIFICATE</li>
					    						</ul>
					    					</div>
				    					</div>
				    				</li>
				    			</ul>
		                    </div>
		                </div>
		                <a class="uk-accordion-title" href="#" uk-tooltip="title: More; pos: top-center">
		                	<span uk-icon="info"></span>
		                </a>
    					<div class="uk-accordion-content">
    						<div class="inner-content">
	    						<p>The h tags represents the headings of the webpage. The h1 tag is the most important h tag, and describes the main topic of the page, while the rest of the tags describe the sub-topics of the webpage.</p>
	    						<hr>
	    						<p>Learn more <a href="#">Google <span uk-icon="arrow-right"></span></a></p>
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
		                <a class="uk-accordion-title" href="#" uk-tooltip="title: More; pos: top-center">
		                	<span uk-icon="info"></span>
		                </a>
    					<div class="uk-accordion-content">
    						<div class="inner-content">
	    						<p>The webpage's content should contain relevant keywords that can also be found in the title of the webpage.</p>
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
		                <a class="uk-accordion-title" href="#" uk-tooltip="title: More; pos: top-center">
		                	<span uk-icon="info"></span>
		                </a>
    					<div class="uk-accordion-content">
    						<div class="inner-content">
	    						<p>The alt attribute specifies an alternate text for an image, if the image cannot be displayed. The alt attribute is also useful for search engines to identify the subject of the image, and helps screen readers describe the image.</p>
	    						<hr>
	    						<p>Learn more <a href="#">Google <span uk-icon="arrow-right"></span></a></p>
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
		                <a class="uk-accordion-title" href="#" uk-tooltip="title: More; pos: top-center">
		                	<span uk-icon="info"></span>
		                </a>
    					<div class="uk-accordion-content">
    						<div class="inner-content">
	    						<p>The SEO friendly URLs are URLs that contain relevant keywords with the webpage's topic, and contain no special characters besides slashes and dashes.</p>
	    						<hr>
	    						<p>Learn more <a href="#">Google <span uk-icon="arrow-right"></span></a></p>
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
		                <a class="uk-accordion-title" href="#" uk-tooltip="title: More; pos: top-center">
		                	<span uk-icon="info"></span>
		                </a>
    					<div class="uk-accordion-content">
    						<div class="inner-content">
	    						<p>The 404 webpage status inform the users and the search engines that a page is missing.</p>
	    						<hr>
	    						<p>Learn more <a href="#">Google <span uk-icon="arrow-right"></span></a></p>
	    					</div>
    					</div>
		            </li>
		        </ul>
			</div>
		</div>
	</div>
</div>

@endsection