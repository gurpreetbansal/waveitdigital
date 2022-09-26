@extends('layouts.pdf_layout')
@section('content')

<div class="sAudit-section">
	<div class="white-box overviewBox">
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
			<div class="right uk-flex">
				<div class="score-for">
					<p><small>Website score for</small></p>
	                <h2>10secondshots.com</h2>
	                <ul>
	                    <li><i class="fa fa-map-marker" aria-hidden="true"></i> 23.227.38.36</li>
	                    <li>|</li>
	                    <li><i class="fa fa-lock" aria-hidden="true"></i>  enabled</li>
	                </ul>
	            </div>
	            <div class="elem-end">
		            <article>
		                <ul>
		                    <li>
		                        <div>
		                        	<img src="https://waveitdigital.com/public/vendor/internal-pages/images/pages-icon.png" alt="pages-icon">
		                    		Crawled pages
		                    	</div>
		                        <div>38</div>
		                    </li>
                        </ul>
		                <ul>
		                    <li>
		                        <div>
		                        	<img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/google-indexed-logo.png">
		                        	Google indexed pages
		                        </div>
                                <div>38</div>
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
		            </article>
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
	</div>
	
	<div class="white-box pagesBox">
		<div class="white-box-head">
			<h5>Pages</h5>
		</div>
		<div class="white-box-body">
			<div class="auditTable">
                <table>
                	<thead>
                		<tr>
                			<th>URL</th>
                			<th>Result</th>
                			<th>Generated at</th>
                		</tr>
                	</thead>
                    <tbody>
                    	<tr>
                    		<td>
                    			<div class="link-flex">
                    				<a href="#" uk-tooltip="title: cbdmovers.com.au/aboutus/; pos: top-center">cbdmovers.com.au/aboutus/</a>
                    			</div>
                    		</td>
                    		<td>
                    			<div class="progress-flex">
                    				<progress class="uk-progress bg-warning" value="72" max="100"></progress>
                    				<p><strong>72</strong>/100</p>
                    				<div class="badge-result">
                    					<a href="javascript:void(0)" class="badge-warning">Decent</a>
                    				</div>
                    			</div>
                    		</td>
                    		<td><span uk-tooltip="title: 2022-03-16 07:10:00; pos: top-center">5 days ago</span>
                		</tr>
                    	<tr>
                    		<td>
                    			<div class="link-flex">
                    				<a href="#" uk-tooltip="title: cbdmovers.com.au/aboutus/; pos: top-center">cbdmovers.com.au/aboutus/</a>
                    			</div>
                    		</td>
                    		<td>
                    			<div class="progress-flex">
                    				<progress class="uk-progress bg-success" value="95" max="100"></progress>
                    				<p><strong>95</strong>/100</p>
                    				<div class="badge-result">
                    					<a href="javascript:void(0)" class="badge-success">Good</a>
                    				</div>
                    			</div>
                    		</td>
                    		<td><span uk-tooltip="title: 2022-03-16 07:10:00; pos: top-center">5 days ago</span>
                		</tr>
                    	<tr>
                    		<td>
                    			<div class="link-flex">
                    				<a href="#" uk-tooltip="title: cbdmovers.com.au/aboutus/; pos: top-center">cbdmovers.com.au/aboutus/</a>
                    			</div>
                    		</td>
                    		<td>
                    			<div class="progress-flex">
                    				<progress class="uk-progress bg-danger" value="25" max="100"></progress>
                    				<p><strong>25</strong>/100</p>
                    				<div class="badge-result">
                    					<a href="javascript:void(0)" class="badge-danger">Bad</a>
                    				</div>
                    			</div>
                    		</td>
                    		<td><span uk-tooltip="title: 2022-03-16 07:10:00; pos: top-center">5 days ago</span>
                		</tr>
                	</tbody>
                </table>
            </div>
		</div>
	</div>
</div>

@endsection