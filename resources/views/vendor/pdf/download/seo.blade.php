@extends('layouts.html2pdf_layout')
@section('content')

<div class="project-detail-body" id="SEO">
	<div class="seo-pdf main-data-pdf" >

		<!-- Site Audit -->
		<div class="single">
			<div class="box-boxshadow">
				<div class="campaign-hero">
					<div class="left-box">
						<div class="elem-start">
							<div class="circle-donut ajax-loader" style="width:200px;height:200px;">
								<div class="circle_inbox">
									<span class="percent_text">0</span> of 100
								</div>
								<canvas id="detail-siteAudit-chart-data" width="50" height="50"></canvas>
							</div>
							<div class="score-for">
								<p><small>Website score for</small></p>
								<h2 class="ajax-loader audit-domain-name">.........</h2>
								<ul>
									<li class="ajax-loader audit-ip-address"><i class="fa fa-map-marker"></i>.........</li>
									<li>|</li>
									<li class="ajax-loader audit-ssl-status"><i class="fa fa-lock"></i>  ..........</li>
								</ul>
								<a href="{{ @$sa_link}}" class="btn btn-sm blue-btn">Site Audit</a>
							</div>
						</div>
						<div class="elem-end">
							<ul>
								<li>
									<div><img src="{{URL::asset('public/vendor/internal-pages/images/pages-icon.png')}}" alt="pages-icon"> Crawled pages</div>
									<div class="ajax-loader crawled-pages">......</div>
								</li>
							</ul>
							<ul>
								<li>
									<div>
										<img src="{{URL::asset('public/vendor/internal-pages/images/google-indexed-logo.png')}}" alt="google-indexed-logo">
										Google indexed pages
									</div/>
									<div class="ajax-loader audit-indexed-pages">....</div>
								</li>
								<li>
									<div>
										<img src="{{URL::asset('public/vendor/internal-pages/images/google-safe-icon.png')}}" alt="google-safe-icon">
										Google safe browsing
									</div>
									<div class="ajax-loader audit-site-status">...........</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Overview Section -->
		<div class="single">
			<div class="box-boxshadow">
				<div class="section-head">
			        <h4>Overview Graphs : Summary &amp; Comparison</h4>
			        <hr>
			        <ul class="list-style">
			            <li>
			              	<strong><img src="{{URL::asset('public/vendor/internal-pages/images/check-icon.png')}}" alt="">Organic Keywords:</strong> 
			              	This section shows growth in organic keywords month after month
			            </li>
			            <li>
			              	<strong><img src="{{URL::asset('public/vendor/internal-pages/images/check-icon.png')}}" alt="">Organic Visitors:</strong> 
			              	This section shows total number of organic visits to your website in selected time period
			            </li>
			            <li>
			              	<strong><img src="{{URL::asset('public/vendor/internal-pages/images/check-icon.png')}}" alt="">Page Authority:</strong> 
			              	This section shows Page authority trend
			            </li>
			            <li>
			              	<strong><img src="{{URL::asset('public/vendor/internal-pages/images/check-icon.png')}}" alt="">Referring Domains:</strong> 
			              	This section shows growth in referring domains month after month
			            </li>
			            <li>
			             	<strong><img src="{{URL::asset('public/vendor/internal-pages/images/check-icon.png')}}" alt="">Google Goals:</strong> 
			              	This section shows goal completion from Google Analytics in selected time period
			            </li>
			            <li>
			              	<strong><img src="{{URL::asset('public/vendor/internal-pages/images/check-icon.png')}}" alt="">Domain Authority:</strong> 
			              	This section shows Domain authority trend
			            </li>
			        </ul>
			    </div>
		    </div>
		</div>

		<!-- Overview Section Boxes -->
		<div class="single">
			<div class="row row-cols-3 g-4">
				<div class="col">
					<div class="small-chart-box">
						<div class="single">
							<h6 class="ok-total">
								<big class="organic-keyword-total">5177</big>
								<cite class="organic_keywords green"><img src="{{URL::asset('public/vendor/internal-pages/images/up-stats-arrow.png')}}" alt="up-stats-arrow"><span>4017</span>Since Start</cite>
							</h6>
							<p>Organic Keywords</p>
							<div class="chart ok-graph">
								<canvas id="canvas-organic-keyword"></canvas>
							</div>
						</div>
					</div>
				</div>
				<div class="col">
					<div class="small-chart-box">
						<div class="single">
							<h6 class="ok-total">
								<big class="organic-keyword-total">5177</big>
								<cite class="organic_keywords green"><img src="{{URL::asset('public/vendor/internal-pages/images/up-stats-arrow.png')}}" alt="up-stats-arrow"><span>4017</span>Since Start</cite>
							</h6>
							<p>Organic Visitors </p>
							<div class="chart ov-graph">
								<canvas id="canvas-organic-visitor"></canvas>
							</div>
						</div>
					</div>
				</div>
				<div class="col">
					<div class="small-chart-box">
						<div class="single">
							<h6 class="ok-total">
								<big class="organic-keyword-total">5177</big>
								<cite class="organic_keywords green"><img src="{{URL::asset('public/vendor/internal-pages/images/up-stats-arrow.png')}}" alt="up-stats-arrow"><span>4017</span>Since Start</cite>
							</h6>
							<p>Page Authority</p>
							<div class="chart page-authority">
								<canvas id="canvas-page-authority"></canvas>
							</div>
						</div>
					</div>
				</div>
				<div class="col">
					<div class="small-chart-box">
						<div class="single">
							<h6 class="ok-total">
								<big class="organic-keyword-total">5177</big>
								<cite class="organic_keywords green"><img src="{{URL::asset('public/vendor/internal-pages/images/up-stats-arrow.png')}}" alt="up-stats-arrow"><span>4017</span>Since Start</cite>
							</h6>
							<p>Referring Domains</p>
							<div class="chart rd-graph">
								<canvas id="canvas-referring-domains"></canvas>
							</div>
						</div>
					</div>
				</div>
				<div class="col">
					<div class="small-chart-box">
						<div class="single">
							<h6 class="ok-total">
								<big class="organic-keyword-total">5177</big>
								<cite class="organic_keywords green"><img src="{{URL::asset('public/vendor/internal-pages/images/up-stats-arrow.png')}}" alt="up-stats-arrow"><span>4017</span>Since Start</cite>
							</h6>
							<p>Google Goals</p>
							<div class="chart gc-overview-organic">
								<canvas id="google-goal-completion-overview"></canvas>	
							</div>
						</div>
					</div>
				</div>
				<div class="col">
					<div class="small-chart-box">
						<div class="single">
							<h6 class="ok-total">
								<big class="organic-keyword-total">5177</big>
								<cite class="organic_keywords green"><img src="{{URL::asset('public/vendor/internal-pages/images/up-stats-arrow.png')}}" alt="up-stats-arrow"><span>4017</span>Since Start</cite>
							</h6>
							<p>Domain Authority</p>
							<div class="chart domain_authority">
			            		<canvas id="canvas-domain-authority"></canvas>                  	
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Keyword Visibility -->
		<div class="single">
			<div class="box-boxshadow">
			    <div class="section-head">
			        <h4>
			        	<figure>
			            	<img src="{{URL::asset('public/vendor/internal-pages/images/search-console-img.png')}}">
			            </figure>
			            Keyword Visibility
			            <font>Last Updated: 6 hours ago (Jul 06, 2022)</font>
			        </h4>
			        <hr>
			        <p>
			            This section shows clicks and impressions in Google Search Console for selected time period, It’s a great way to understand your website’s visibility in Google.
			        </p>
			    </div>		    
			    <div class="sConsole-compare my-4">
			    	<div class="row row-cols-4 g-0">
			            <div class="single">
			                <h6>Total clicks</h6>
			                <ul>
			                    <li>
			                        <strong class="current_click">19.91K</strong>
			                        <span class="current_click_dates">2020/07/04 - 2022/07/03</span>
			                    </li>
			                </ul>
			            </div>
			            <div class="single">
			                <h6>Total impressions</h6>
			                <ul>
			                    <li>
			                        <strong class="current_impressions">3.23M</strong>
			                        <span class="current_impressions_dates">2020/07/04 - 2022/07/03</span>
			                    </li>
			                </ul>
			            </div>
			            <div class="single">
			                <h6>Average CTR</h6>
			                <ul>
			                    <li class="show_current_ctr">
			                        <strong><span class="current_ctr">0.43%</span></strong>
			                        <span class="current_ctr_dates">2020/07/04 - 2022/07/03</span>
			                    </li>
			                </ul>
			            </div>
			            <div class="single">
			                <h6>Average position</h6>
			                <ul>
			                    <li class="show_current_position">
			                        <strong><span class="current_position">33.99</span></strong>
			                        <span class="current_position_dates">2020/07/04 - 2022/07/03</span>
			                    </li>
			                </ul>
			            </div>
			        </div>
			    </div>
			    <div class="search-console-graph chart h-300">
			        <canvas id="new-canvas-search-console" height="300"></canvas>
			    </div>
			</div>
		</div>

		<!-- Queries -->
		<div class="single">
			<div class="box-boxshadow">
			    <div class="section-head mb-4">
			    	<h4>Queries</h4>
			    	<hr>
			        <p>
			        	<small><em><img src="{{URL::asset('public/vendor/internal-pages/images/info.png')}}"> Top 10 keywords which bring most traffic to your website.</em></small>
			        </p>
			    </div>            
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Query</th>
                                <th>Clicks</th>
                                <th>Impression</th>
                                <th>CTR</th>
                                <th>Average Position</th>
                            </tr>
                        </thead>
                        <tbody>
                        	<tr>
								<td>imark infotech</td>
								<td>4889</td>
								<td>16899</td>
								<td>0.29</td>
								<td>1.02</td>
							</tr>
							<tr>
								<td>imark</td>
								<td>1038</td>
								<td>12756</td>
								<td>0.08</td>
								<td>11.06</td>
							</tr>
							<tr>
								<td>imarkinfotech</td>
								<td>885</td>
								<td>1897</td>
								<td>0.47</td>
								<td>1.02</td>
							</tr>
							<tr>
								<td>i mark infotech</td>
								<td>609</td>
								<td>2818</td>
								<td>0.22</td>
								<td>1.06</td>
							</tr>
							<tr>
								<td>imark infotech pvt. ltd.</td>
								<td>288</td>
								<td>713</td>
								<td>0.40</td>
								<td>1.08</td>
							</tr>
							<tr>
								<td>imark infotech pvt ltd</td>
								<td>278</td>
								<td>1359</td>
								<td>0.20</td>
								<td>1.06</td>
							</tr>
							<tr>
								<td>imark infotech pvt. ltd</td>
								<td>273</td>
								<td>1010</td>
								<td>0.27</td>
								<td>1.08</td>
							</tr>
							<tr>
								<td>buy backlinks india</td>
								<td>204</td>
								<td>2962</td>
								<td>0.07</td>
								<td>1.67</td>
							</tr>
							<tr>
								<td>react native requirements</td>
								<td>164</td>
								<td>2702</td>
								<td>0.06</td>
								<td>5.98</td>
							</tr>
							<tr>
								<td>seo outsourcing india</td>
								<td>160</td>
								<td>11060</td>
								<td>0.01</td>
								<td>1.07</td>
							</tr>
						</tbody>
                    </table>
                </div>
	        </div>
		</div>

		<!-- Pages -->
		<div class="single">
			<div class="box-boxshadow">
			    <div class="section-head mb-4">
			    	<h4>Pages</h4>
			    	<hr>
			        <p>
			        	<small><em><img src="{{URL::asset('public/vendor/internal-pages/images/info.png')}}">  Top 10 pages of your website which gets the most clicks and impressions.</em></small>
			        </p>
			    </div>            
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Page</th>
                                <th>Clicks</th>
                                <th>Impression</th>
                            </tr>
                        </thead>
                        <tbody>
                        	<tr>
								<td>https://www.imarkinfotech.com/</td>
								<td>10433</td>
								<td>102715</td>
							</tr>
							<tr>
								<td>https://www.imarkinfotech.com/7-reasons-business-needs-mobile-app/</td>
								<td>2726</td>
								<td>64564</td>
							</tr>
							<tr>
								<td>https://www.imarkinfotech.com/everything-you-need-to-know-about-react-native-development/</td>
								<td>1897</td>
								<td>44633</td>
							</tr>
							<tr>
								<td>https://www.imarkinfotech.com/service/link-building/</td>
								<td>1458</td>
								<td>336528</td>
							</tr>
							<tr>
								<td>https://www.imarkinfotech.com/seo-outsourcing-india/</td>
								<td>978</td>
								<td>842190</td>
							</tr>
							<tr>
								<td>https://www.imarkinfotech.com/seo-company-india/</td>
								<td>447</td>
								<td>697178</td>
							</tr>
							<tr>
								<td>https://www.imarkinfotech.com/silo-structure-for-seo-quick-guide/</td>
								<td>312</td>
								<td>83131</td>
							</tr>
							<tr>
								<td>https://www.imarkinfotech.com/ppc-services-india/</td>
								<td>290</td>
								<td>343648</td>
							</tr>
							<tr>
								<td>https://www.imarkinfotech.com/works/snapsale/</td>
								<td>161</td>
								<td>12878</td>
							</tr>
							<tr>
								<td>https://www.imarkinfotech.com/contact/</td>
								<td>82</td>
								<td>31387</td>
							</tr>
							</tbody>
							                    </table>
                </div>
	        </div>
		</div>

		<!-- Countries -->
		<div class="single">
			<div class="box-boxshadow">
			    <div class="section-head mb-4">
			    	<h4>Countries</h4>
			    	<hr>
			        <p>
			        	<small><em><img src="{{URL::asset('public/vendor/internal-pages/images/info.png')}}"> Top 10 countries which brings most traffic to your website.</em></small>
			        </p>
			    </div>            
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Country</th>
                                <th>Clicks</th>
                                <th>Impression</th>
                                <th>CTR</th>
                                <th>Average Position</th>
                            </tr>
                        </thead>
                        <tbody class="country_table">
                        	<tr>
								<td>
									<img src="{{URL::asset('public/vendor/internal-pages/images/in.png')}}"> India
								</td>
								<td>14475</td>
								<td>531884</td>
								<td>0.03</td>
								<td>40.69</td>
							</tr>
							<tr>
								<td>
									<img src="{{URL::asset('public/vendor/internal-pages/images/us.png')}}"> United States
								</td>
								<td>1428</td>
								<td>538296</td>
								<td>0.00</td>
								<td>46.94</td>
							</tr>
							<tr>
								<td>
									<img src="{{URL::asset('public/vendor/internal-pages/images/gb.png')}}"> United Kingdom
								</td>
								<td>462</td>
								<td>65363</td>
								<td>0.01</td>
								<td>50.26</td>
							</tr>
							<tr>
								<td>
									<img src="{{URL::asset('public/vendor/internal-pages/images/au.png')}}"> Australia
								</td>
								<td>334</td>
								<td>27405</td>
								<td>0.01</td>
								<td>46.40</td>
							</tr>
							<tr>
								<td>
									<img src="{{URL::asset('public/vendor/internal-pages/images/pk.png')}}"> Pakistan
								</td>
								<td>297</td>
								<td>40191</td>
								<td>0.01</td>
								<td>49.24</td>
							</tr>
							<tr>
								<td>
									<img src="{{URL::asset('public/vendor/internal-pages/images/ca.png')}}"> Canada
								</td>
								<td>257</td>
								<td>34734</td>
								<td>0.01</td>
								<td>49.89</td>
							</tr>
							<tr>
								<td>
									<img src="{{URL::asset('public/vendor/internal-pages/images/ph.png')}}"> Philippines
								</td>
								<td>174</td>
								<td>71304</td>
								<td>0.00</td>
								<td>50.16</td>
							</tr>
							<tr>
								<td>
									<img src="{{URL::asset('public/vendor/internal-pages/images/my.png')}}"> Malaysia
								</td>
								<td>163</td>
								<td>70575</td>
								<td>0.00</td>
								<td>49.17</td>
							</tr>
							<tr>
								<td>
									<img src="{{URL::asset('public/vendor/internal-pages/images/id.png')}}"> Indonesia
								</td>
								<td>157</td>
								<td>141531</td>
								<td>0.00</td>
								<td>54.07</td>
							</tr>
							<tr>
								<td>
									<img src="{{URL::asset('public/vendor/internal-pages/images/ae.png')}}"> United Arab Emirates
								</td>
								<td>113</td>
								<td>14676</td>
								<td>0.01</td>
								<td>48.42</td>
							</tr>
						</tbody>
					</table>
                </div>
	        </div>
		</div>

		<!-- Organic Search : Traffic Growth -->
		<div class="single">
			<div class="box-boxshadow">
			    <div class="section-head">
			        <h4>
			            <figure>
			            	<img src="{{URL::asset('public/vendor/internal-pages/images/organic-traffic-growth-img.png')}}">
			            </figure>
			            Organic Search : Traffic Growth
			            <font class="analytics_time">Last Updated: 9 months ago (Sep 10, 2021)</font>
			        </h4>
			        <hr>
			        <p>
			            This section shows clicks and impressions in Google Search Console for selected time period, It’s a great
			            way to understand your website’s visibility in Google.
			        </p>
			        <ul class="list-style">
			            <li>
			            	<strong><img src="{{URL::asset('public/vendor/internal-pages/images/check-icon.png')}}" alt="">Session:</strong> 
			            	Total number of sessions on your website for the selected time period.
			            </li>
			            <li>
			            	<strong><img src="{{URL::asset('public/vendor/internal-pages/images/check-icon.png')}}" alt="">Users:</strong> 
			            	Total number of users coming to your website for the selected time period.
			            </li>
			            <li>
			            	<strong><img src="{{URL::asset('public/vendor/internal-pages/images/check-icon.png')}}" alt="">Pageviews:</strong> 
			            	Total number of pageviews by users for the selected time period.
	                    </li>
			        </ul>
			    </div>
		        <div class="row row-cols-3 gx-4 my-4">
		            <div class="col">
		                <div class="medium-chart-box">
		                    <div class="medium-chart-box-head">
		                        <h6> 
		                        	<i class="fa fa-arrow-up green"></i> 0%
		                        </h6>
		                        <p><img src="{{URL::asset('public/vendor/internal-pages/images/sessions-img.png')}}"> Sessions</p>
		                    </div>
		                    <div class="medium-chart-box-foot">
		                        <p>0 vs 0 Organic Traffic</p>
		                    </div>
		                </div>
		            </div>
		            <div class="col">
		                <div class="medium-chart-box">
		                    <div class="medium-chart-box-head">
		                        <h6>
		                        	<i class="fa fa-arrow-down red"></i> 0%
		                        </h6>
		                        <p><img src="{{URL::asset('public/vendor/internal-pages/images/users-img.png')}}"> Users</p>
		                    </div>
		                    <div class="medium-chart-box-foot">
		                        <p>0 vs 0 Organic Traffic</p>
		                    </div>
		                </div>
		            </div>
		            <div class="col">
		                <div class="medium-chart-box">
		                    <div class="medium-chart-box-head">
		                        <h6>
		                        	<i class="fa fa-arrow-down red"></i> 0%
		                    	</h6>
		                        <p><img src="{{URL::asset('public/vendor/internal-pages/images/pageviews-img.png')}}"> Pageviews</p>
		                    </div>
		                    <div class="medium-chart-box-foot">
		                        <p>0 vs 0 Organic Traffic</p>
		                    </div>
		                </div>
		            </div>
		        </div>
		       	<div class="traffic-growth-graph chart h-250">
			      	<canvas id="new-canvas-traffic-growth" height="250"></canvas>
			    </div>
			</div>
		</div>

		<!-- Organic Keyword Growth -->
		<div class="single">
			<div class="box-boxshadow">
			    <div class="section-head mb-4">
			        <h4>
			            <figure>
			            	<img src="{{URL::asset('public/vendor/internal-pages/images/organic-keywords-img.png')}}">
			            </figure> 
			            Organic Keyword Growth
			            <font class="organic_keyword_time">Last Updated: 3 months ago (Aug 05, 2021)</font>
			        </h4>
			        <hr>
			        <p>
			            The distribution of the domain's organic ranking over time. You can see how many keywords have rankings in Google's top 3, top 10, top 20, and top 100 organic search results.
			        </p>
			        <div class="row row-cols-2">
			          	<div class="col">
			            	<ul class="list-style">
			              		<li>
			              			<strong class="min-width"><img src="{{URL::asset('public/vendor/internal-pages/images/check-icon.png')}}" alt="">Top 3 Positions</strong> 
	              					<span class="organic_keyword_top3">107</span>
	              				</li>
			              		<li>
			              			<strong class="min-width"><img src="{{URL::asset('public/vendor/internal-pages/images/check-icon.png')}}" alt="">Position 4-10</strong> 
			              			<span class="organic_keyword_4_10">396</span>
			              		</li>
			              		<li>
			              			<strong class="min-width"><img src="{{URL::asset('public/vendor/internal-pages/images/check-icon.png')}}" alt="">Position 11-20</strong> 
			              			<span class="organic_keyword_11_20">608</span> 
			              		</li>
			            	</ul>
			          	</div>
			          	<div class="col">
			            	<ul class="list-style">
			              		<li>
			              			<strong class="min-width"><img src="{{URL::asset('public/vendor/internal-pages/images/check-icon.png')}}" alt="">Position 21-50</strong> 
			              			<span class="organic_keyword_21_50">1498</span>
			              		</li>
			              		<li>
		              				<strong class="min-width"><img src="{{URL::asset('public/vendor/internal-pages/images/check-icon.png')}}" alt="">Position 51-100</strong> 
		              				<span class="organic_keyword_51_100">2568</span>
		              			</li>
				              	<li>
					              	<strong class="min-width"><img src="{{URL::asset('public/vendor/internal-pages/images/check-icon.png')}}" alt="">Total Keywords</strong> 
					              	<span class="organic_keyword_total">5177</span>
				              	</li>
				            </ul>
			          	</div>
			        </div>
			    </div>
		        <div class="chart h-345">
		          	<canvas id="new-keywordsCanvas" width="50" height="40"></canvas>
		        </div>
		  	</div>
		</div>

		<!-- Top Organic Keywords -->
		<div class="single">
		  	<div class="box-boxshadow">
			  	<div class="section-head">
			      	<h4>
			          	<figure><img src="{{URL::asset('public/vendor/internal-pages/images/organic-keywords-img.png')}}"></figure>
			          	Top Organic Keywords : Top <small class="total_count">(678)</small> keywords your website is ranking for
			      	</h4>
			      	<hr />
			      	<p>
			          	<small><em><img src="{{URL::asset('public/vendor/internal-pages/images/info.png')}}"> By default, we show upto 700 keywords</em></small>
			      	</p>
			  	</div>
			    <div class="table-responsive my-4">
			        <table>
			          	<thead>
			            	<tr>
			              		<th>Keyword</th>
			              		<th>Pos.</th>
			              		<th>Volume </th>
			              		<th>CPC (USD)</th>
			              		<th>Traffic %</th>
			            	</tr>
			          	</thead>
		          		<tbody>
		          			<tr>
								<td>adelaide removalist companies</td>
								<td>1</td>
								<td>70</td>
								<td>12.45</td>
								<td>21.28</td>
							</tr>
		          			<tr>
								<td>adelaide removalist companies</td>
								<td>1</td>
								<td>70</td>
								<td>12.45</td>
								<td>21.28</td>
							</tr>
		          			<tr>
								<td>adelaide removalist companies</td>
								<td>1</td>
								<td>70</td>
								<td>12.45</td>
								<td>21.28</td>
							</tr>
		          			<tr>
								<td>adelaide removalist companies</td>
								<td>1</td>
								<td>70</td>
								<td>12.45</td>
								<td>21.28</td>
							</tr>
		          			<tr>
								<td>adelaide removalist companies</td>
								<td>1</td>
								<td>70</td>
								<td>12.45</td>
								<td>21.28</td>
							</tr>
		          			<tr>
								<td>adelaide removalist companies</td>
								<td>1</td>
								<td>70</td>
								<td>12.45</td>
								<td>21.28</td>
							</tr>
		          			<tr>
								<td>adelaide removalist companies</td>
								<td>1</td>
								<td>70</td>
								<td>12.45</td>
								<td>21.28</td>
							</tr>
		          			<tr>
								<td>adelaide removalist companies</td>
								<td>1</td>
								<td>70</td>
								<td>12.45</td>
								<td>21.28</td>
							</tr>
		          			<tr>
								<td>adelaide removalist companies</td>
								<td>1</td>
								<td>70</td>
								<td>12.45</td>
								<td>21.28</td>
							</tr>
		          			<tr>
								<td>adelaide removalist companies</td>
								<td>1</td>
								<td>70</td>
								<td>12.45</td>
								<td>21.28</td>
							</tr>
		          		</tbody>
			        </table>
		      	</div>
		      	<div class="text-center">
		      		<a href="https://waveitdigital.com/project-detail/NDE3LXwtOTktfC1vdzROTktHQ3hU" class="btn blue-btn">
		      			To view more Click here <i class="fa fa-external-link"></i>
		      		</a>
		      	</div>
		  	</div>
		</div>

		<!-- Position Tracking -->
		<div class="single">
		   	<div class="box-boxshadow">
		      	<div class="section-head mb-4">
		          	<h4>
		            	<figure><img src="{{URL::asset('public/vendor/internal-pages/images/live-keyword-tracking-img.png')}}"></figure> 
		            	Position Tracking: Top Ranking Changes (<span class="active_keywords_count">0 active keywords</span>)
		            	<font class="keyword_time"></font>
		         	</h4>
		         	<hr />
		         	<p>
		            	This report lists all keywords in the tracking campaign, the position of the domain(s) for these keywords in the Google top 100 and position changes in 1 day, 7 days, 30 days and lifetime.
		         	</p>
		         	<ul class="list-style">
		           		<li>
		           			<strong><img src="{{URL::asset('public/vendor/internal-pages/images/check-icon.png')}}" alt="">Keyword:</strong> 
		           			A Search term from the current tracking campaign
		           		</li>
			           	<li>
			           		<strong><img src="{{URL::asset('public/vendor/internal-pages/images/check-icon.png')}}" alt="">Start:</strong> 
			           		Position of the keywords on day 1 of the campaign
			           	</li>
			           	<li>
			           		<strong><img src="{{URL::asset('public/vendor/internal-pages/images/check-icon.png')}}" alt="">Google Page:</strong>
			           		Page number of the keyword in Google's SERP results
			           	</li>
			           	<li>
			           		<strong><img src="{{URL::asset('public/vendor/internal-pages/images/check-icon.png')}}" alt="">Google Rank:</strong>
			           		Current position of the keyword
			           	</li>
			           	<li>
			           		<strong><img src="{{URL::asset('public/vendor/internal-pages/images/check-icon.png')}}" alt="">1 Day Change:</strong>
			           		Position change of the keyword in the last 24 hours
			           	</li>
			           	<li>
			           		<strong><img src="{{URL::asset('public/vendor/internal-pages/images/check-icon.png')}}" alt="">7 Day Change:</strong>
			           		Position change of the keyword in last the 7 days
			           	</li>
			           	<li>
			           		<strong><img src="{{URL::asset('public/vendor/internal-pages/images/check-icon.png')}}" alt="">30 Day Change:</strong>
			           		Position change of the keyword in last the 30 days
			           	</li>
		           		<li>
		           			<strong><img src="{{URL::asset('public/vendor/internal-pages/images/check-icon.png')}}" alt="">LifeTime Change:</strong>
		           			Position change of the keyword since day 1 of the campaign
		           		</li>
		           		<li>
		           			<strong><img src="{{URL::asset('public/vendor/internal-pages/images/check-icon.png')}}" alt="">Competition:</strong>
		           			Total number of webpages ranking for the keyword in millions
		           		</li>
		           		<li>
		           			<strong><img src="{{URL::asset('public/vendor/internal-pages/images/check-icon.png')}}" alt="">Search Volume:</strong>
		           			Estimated monthly searches for the keyword
		           		</li>
		           		<li>
		           			<strong><img src="{{URL::asset('public/vendor/internal-pages/images/check-icon.png')}}" alt="">URL:</strong>
		           			Current ranking URL for the keyword
		           		</li>
		           	</ul>
	           	</div>
		      	<div class="row row-cols-3 gy-4">
		         	<div class="col">
		                <div class="medium-chart-box">
		                    <div class="medium-chart-box-head">
		                        <h6>223</h6>
								<p><img src="{{URL::asset('public/vendor/internal-pages/images/keywords-up-img.png')}}"> Keywords Up</p>
		                    </div>
		                    <div class="medium-chart-box-foot">
			                  	<p>since start</p>
		                    </div>
		                </div>
			         </div>
		         	<div class="col">
		                <div class="medium-chart-box">
		                    <div class="medium-chart-box-head">
		                        <h6 class="red">30<small>/279</small></h6>
								<p><img src="{{URL::asset('public/vendor/internal-pages/images/users-img.png')}}"> In Top 3</p>
		                    </div>
		                    <div class="medium-chart-box-foot">
			                  	<p><i class="fa fa-arrow-down"></i><strong>28</strong> since start</p>
		                    </div>
		                </div>
			         </div>
		         	<div class="col">
		                <div class="medium-chart-box">
		                    <div class="medium-chart-box-head">
		                        <h6 class="green">223</h6>
								<p><img src="{{URL::asset('public/vendor/internal-pages/images/users-img.png')}}"> In Top 10</p>
		                    </div>
		                    <div class="medium-chart-box-foot">
			                  	<p><i class="fa fa-arrow-up"></i><strong>28</strong> since start</p>
		                    </div>
		                </div>
			         </div>
		         	<div class="col">
		                <div class="medium-chart-box">
		                    <div class="medium-chart-box-head">
		                        <h6 class="green">223</h6>
								<p><img src="{{URL::asset('public/vendor/internal-pages/images/users-img.png')}}"> In Top 20</p>
		                    </div>
		                    <div class="medium-chart-box-foot">
			                  	<p><i class="fa fa-arrow-up"></i><strong>28</strong> since start</p>
		                    </div>
		                </div>
			         </div>
		         	<div class="col">
		                <div class="medium-chart-box">
		                    <div class="medium-chart-box-head">
		                        <h6 class="green">223</h6>
								<p><img src="{{URL::asset('public/vendor/internal-pages/images/users-img.png')}}"> In Top 30</p>
		                    </div>
		                    <div class="medium-chart-box-foot">
			                  	<p><i class="fa fa-arrow-up"></i><strong>28</strong> since start</p>
		                    </div>
		                </div>
			         </div>
		         	<div class="col">
		                <div class="medium-chart-box">
		                    <div class="medium-chart-box-head">
		                        <h6 class="green">223</h6>
								<p><img src="{{URL::asset('public/vendor/internal-pages/images/users-img.png')}}"> In Top 100</p>
		                    </div>
		                    <div class="medium-chart-box-foot">
			                  	<p><i class="fa fa-arrow-up"></i><strong>28</strong> since start</p>
		                    </div>
		                </div>
		            </div>
		      	</div>
	      	</div>
	   	</div>

		<!-- Keywords Table -->
	   	<div class="single">
	   		<div class="box-boxshadow">
			    <div class="table-responsive">
	               	<table class="live-keyword-table">
	                  	<thead>
	                     	<tr>
		                        <th>Keyword</th>
		                        <th>Start</th>
		                        <th><img src="{{URL::asset('public/vendor/internal-pages/images/google-icon.png')}}">Page</th>
		                        <th><img src="{{URL::asset('public/vendor/internal-pages/images/google-icon.png')}}">Rank</th>
		                        <th>1 <br>Day</th>
		                        <th>7 <br>Days</th>
		                        <th>30 <br>Days</th>
		                        <th>Life</th>
		                        <th>Comp</th>
		                        <th>S Vo</th>
		                        <th>Date Added</th>
		                        <th>URL</th>
	                    	</tr>
	                  	</thead>
	                  	<tbody>                                                            
		                  	<tr>
		                     	<td>
		                        	<div class="flex">
		                           		<figure class="keyword-flag-icon">
		                              		<img src="https://waveitdigital.com/public/flags/au.png">
		                           		</figure>
		                               	<p>cheap removalists perth</p>
		                         	</div>
		                      	</td>
		                      	<td class="grey">&gt;100</td>
		                      	<td>1</td>
		                      	<td>2</td>
		                      	<td>-</td>
		                      	<td>-</td>
		                      	<td>-</td>
		                      	<td><i class="icon fa fa-arrow-up"></i> 98</td>
		                      	<td>0.73</td>
		                      	<td>480</td>
		                      	<td>15-Apr-2021</td>
                                <td><a href="#" target="_blank"><i class="fa fa-external-link"></i></a></td>
		                    </tr>
		                    <tr>
                     			<td>
                        			<div class="flex">
                                      	<figure class="keyword-flag-icon">
                              				<img src="https://imark.agencydashboard.io/public/flags/au.png">
                           				</figure>
                                       <p>moving company melbourne</p>
                             		</div>
                              	</td>
                              	<td>33</td>
                              	<td>2</td>
                              	<td>17</td>
                              	<td><i class="icon fa fa-arrow-up"></i> 1</td>
                              	<td><i class="icon fa fa-arrow-up"></i> 1</td>
                              	<td><i class="icon fa fa-arrow-up"></i> 1</td>
                              	<td><i class="icon fa fa-arrow-up"></i> 16</td>
                              	<td>0.77</td>
                              	<td>1000</td>
                              	<td>15-Apr-2021</td>
                                <td><a href="#" target="_blank"><i class="fa fa-external-link"></i></a></td>
                          	</tr>
                          	<tr>
                          		<td>
                          			<div class="flex">
                          				<figure class="keyword-flag-icon">
                          					<img src="https://imark.agencydashboard.io/public/flags/au.png">
                          				</figure>
                                        <p>furniture removal melbourne</p>
                                    </div>
                                </td>
                                <td>68</td>
                                <td>2</td>
                                <td><i class="icon fa fa-flag"></i> 18</td>
                                <td><i class="icon fa fa-arrow-down"></i> 1</td>
                                <td><i class="icon fa fa-arrow-down"></i> 1</td>
                                <td><i class="icon fa fa-arrow-down"></i> 2</td>
                                <td><i class="icon fa fa-arrow-up"></i> 50</td>
                                <td>0.56</td>
                                <td>1300</td>
                                <td>15-Apr-2021</td>
                                <td><a href="#" target="_blank"><i class="fa fa-external-link"></i></a></td>
                          </tr>
		                </tbody>
	            	</table>
	        	</div>
	   		</div>
	   	</div>

	   	<!-- Backlink Profile -->
	   	<div class="single">
	 		<div class="box-boxshadow">
	 			<div class="section-head mb-4">
	 				<h4>
	 					<figure><img src="{{URL::asset('public/vendor/internal-pages/images/backlink-profile-img.png')}}"></figure>
	 					Backlink Profile
	 					<font class="backlink_profile_time">Last Updated: 10 months ago (Aug 09, 2021)</font>
					</h4>
					<hr />
	 				<p>
	 					<small><em><img src="{{URL::asset('public/vendor/internal-pages/images/info.png')}}"> Overview of referring domains of the website</em></small>
	 				</p>
	 				<p>This graph shows how the number of domain backlinks has changed. The info on the graph is updated once a week only when there is new data.</p>
	 			</div>
	 			<div class="chart h-230">
	 				<canvas id="chart-referring-domains"></canvas>
	 			</div>
				<div class="section-head mt-5 mb-4">
					<h4>Summary</h4>
					<hr />
					<p>The general information about link profile: referring domains and subdomains, referring IP's, referring links,follow/unfollow links, Social Media links, Number of Text Backlinks, Image
					Bcklinks, Referring redirects.</p>
				</div>
				<div class="row row-cols-2">
					<div class="col">
						<div class="box-boxshadow h-100">
	 						<table>
	 							<tbody>
	 								<tr>
	 									<td>Referring Domains</td>
	 									<td>1169</td>
	 								</tr>
	 								<tr>
	 									<td>Referring sub-domains</td>
	 									<td>45</td>
	 								</tr>
	 								<tr>
	 									<td>Referring Ips</td>
	 									<td>1096</td>
	 								</tr>
	 								<tr>
	 									<td>Referring Links</td>
	 									<td>8566</td>
	 								</tr>
	 								<tr>
	 									<td>NoFollow Links</td>
	 									<td>891</td>
	 								</tr>
	 								<tr>
	 									<td>DoFollow Links</td>
	 									<td>11081</td>
	 								</tr>
	 								<tr>
	 									<td>Facebook Links</td>
	 									<td>0</td>
	 								</tr>
	 							</tbody>
	 						</table>
	 					</div>
	 				</div>
	 				<div class="col">
	 					<div class="box-boxshadow h-100">
	 						<table>
	 							<tbody>
	 								<tr>
	 									<td>PInterest Links</td>
	 									<td>0</td>
	 								</tr>
	 								<tr>
	 									<td>LinkedIn Links</td>
	 									<td>0</td>
	 								</tr>
	 								<tr>
	 									<td>VK Links</td>
	 									<td>0</td>
	 								</tr>
	 								<tr>
	 									<td>Type Text</td>
	 									<td>11881</td>
	 								</tr>
	 								<tr>
	 									<td>Type Img</td>
	 									<td>86</td>
	 								</tr>
	 								<tr>
	 									<td>Type Redirect</td>
	 									<td>0</td>
	 								</tr>
	 							</tbody>
	 						</table>
	 					</div>
					</div>
	 			</div>
	 		</div>
	   	</div>

	   	<!-- New Backlinks -->
	   	<div class="single">
	   		<div class="box-boxshadow">
	 			<div class="section-head">
	 				<h4>
	 					<figure><img src="{{URL::asset('public/vendor/internal-pages/images/backlink-profile-img.png')}}"></figure>
	 					New Backlinks
	 				</h4>
	 				<hr>
	 				<p>
	 					<small><em><img src="{{URL::asset('public/vendor/internal-pages/images/info.png')}}"> Most recent backlinks discovered for the domain</em></small>
	 				</p>
	 			</div>
	 			<div class="table-responsive my-4">
					<table class="backlinks-table">
						<thead>
							<tr>
								<th>Source Page Title & Url | Target Page</th>
								<th>Link Type</th>
								<th>Anchor Text</th>
								<th>External Links</th>
								<th>First Seen</th>
								<th>Last Seen</th>
							</tr>
						</thead>
						<tbody>
							<tr>
							  	<td>
							    	<h6>Terry Mckenzie, Author at Fabrioberto - Page 4 of ...</h6>
							    	<p>
							    		<strong>Source:</strong>
								      	<cite>
								      		<a href="https://www.fabrioberto.com/author/terrymckenzie/page/4/" target="_blank">https://www.fabrioberto.com/author/terrymckenzie/p...</a>
								      	</cite>
							    	</p>
							    	<p>
							    		<strong>Target:</strong>
								      	<cite>
								      		<a href="https://www.cbdmovers.com.au/removals/removalists-doncaster/" target="_blank">https://www.cbdmovers.com.au/removals/removalists-...</a>
								      	</cite>
							    	</p>
							        <span class="follow-status">F</span>
						      	</td>
							  	<td>href</td>
							  	<td>movers in Doncaster</td>
							  	<td>14</td>
							  	<td>August 09, 2021</td>
							  	<td>August 09, 2021</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="text-center">
					<a href="https://waveitdigital.com/project-detail/NDE3LXwtOTktfC1vdzROTktHQ3hU" target="_blank" class="btn blue-btn">To view more Click here <i class="fa fa-external-link"></i></a>
				</div>
			</div>
	   	</div>

	   	<!-- Google Analytics Goals -->
	   	<div class="single">
		  	<div class="box-boxshadow">
			    <div class="section-head">
			      	<h4>
			        	<figure><img src="{{URL::asset('public/vendor/internal-pages/images/google-analytics-goal-completion-img.png')}}"></figure> 
			        	Google Analytics Goals
			        	<font class="analytics_time">Last Updated: 9 months ago (Sep 10, 2021)</font>
			      	</h4>
			      	<hr />
			      	<p>
			        	<small><em><img src="{{URL::asset('public/vendor/internal-pages/images/info.png')}}"> This section shows all goals setup in your Google Analytics account. General as well as Ecommerce</em></small>
			      	</p>
			    </div>
			    <div class="goal-completion-graph chart h-300">
			      	<canvas id="canvas-goal-completion"></canvas>
			    </div>
	  		</div>
		</div>

		<!-- Goal Completions -->
		<div class="single">
			<div class="section-head mb-3">
				<h4>Goal Completions</h4>
			</div>
			<div class="row row-cols-2 gx-4">
				<div class="col">
					<div class="small-chart-box goals-chart-box">
		                <div class="small-chart-box-head">
		                    <figure>
		                        <img src="https://waveitdigital.com/public/vendor/internal-pages/images/organic-keywords-img.png">
		                    </figure>
		                    <h6>
		                    	<big class="compare">0<span> <cite>vs</cite> 0</span></big>
		                    </h6>
		                    <p>All Users</p>
		                </div>
		                <div class="chart">
				            <canvas id="goal-completion-all-users-new"></canvas>
			          	</div>
		                <div class="small-chart-box-foot">
		                    <p><cite class="red"><i class="fa fa-arrow-down"></i> 0%</cite></p>
		                </div>
		            </div>
				</div>
				<div class="col">
					<div class="small-chart-box goals-chart-box">
		                <div class="small-chart-box-head">
		                    <figure>
		                        <img src="https://waveitdigital.com/public/vendor/internal-pages/images/organic-keywords-img.png">
		                    </figure>
		                    <h6>
		                    	<big class="compare">0<span> <cite>vs</cite> 0</span></big>
		                    </h6>
		                    <p>Organic Traffic</p>
		                </div>
		                <div class="chart">
		                    <canvas id="goal-completion-organic-new"></canvas>
		                </div>
		                <div class="small-chart-box-foot">
		                    <p><cite class="green"><i class="fa fa-arrow-up"></i> 0%</cite></p>
		                </div>
		            </div>
				</div>
			</div>
		</div>

		<!-- Goal Value -->
		<div class="single">
			<div class="section-head mb-3">
				<h4>Goal Value</h4>
			</div>
			<div class="row row-cols-2 gx-4">
				<div class="col">
					<div class="small-chart-box goals-chart-box">
		                <div class="small-chart-box-head">
		                    <figure>
		                        <img src="https://waveitdigital.com/public/vendor/internal-pages/images/organic-keywords-img.png">
		                    </figure>
		                    <h6>
		                    	<big class="compare">0<span> <cite>vs</cite> 0</span></big>
		                    </h6>
		                    <p>All Users</p>
		                </div>
		                <div class="chart">
		                    <canvas id="goal-value-all-users-new"></canvas>
		                </div>
		                <div class="small-chart-box-foot">
		                    <p><cite class="green"><i class="fa fa-arrow-up"></i> 0%</cite></p>
		                </div>
		            </div>
				</div>
				<div class="col">
					<div class="small-chart-box goals-chart-box">
		                <div class="small-chart-box-head">
		                    <figure>
		                        <img src="https://waveitdigital.com/public/vendor/internal-pages/images/organic-keywords-img.png">
		                    </figure>
		                    <h6>
		                    	<big class="compare">0<span> <cite>vs</cite> 0</span></big>
		                    </h6>
		                    <p>Organic Traffic</p>
		                </div>
		                <div class="chart">
		                    <canvas id="goal-value-organic-chart-new"></canvas>
		                </div>
		                <div class="small-chart-box-foot">
		                    <p><cite class="red"><i class="fa fa-arrow-down"></i> 0%</cite></p>
		                </div>
		            </div>
				</div>
			</div>
		</div>

		<!-- Goal Conversion Rate -->
		<div class="single">
			<div class="section-head mb-3">
				<h4>Goal Conversion Rate</h4>
			</div>
			<div class="row row-cols-2 gx-4">
				<div class="col">
					<div class="small-chart-box goals-chart-box">
		                <div class="small-chart-box-head">
		                    <figure>
		                        <img src="https://waveitdigital.com/public/vendor/internal-pages/images/organic-keywords-img.png">
		                    </figure>
		                    <h6>
		                    	<big class="compare">0.00%<span> <cite>vs</cite> 0.00%</span></big>
		                    </h6>
		                    <p>All Users</p>
		                </div>
		                <div class="chart">
		                    <canvas id="goal-conversion-all-users-new"></canvas>
		                </div>
		                <div class="small-chart-box-foot">
		                    <p><cite class="green"><i class="fa fa-arrow-up"></i> 0%</cite></p>
		                </div>
		            </div>
				</div>
				<div class="col">
					<div class="small-chart-box goals-chart-box">
		                <div class="small-chart-box-head">
		                    <figure>
		                        <img src="https://waveitdigital.com/public/vendor/internal-pages/images/organic-keywords-img.png">
		                    </figure>
		                    <h6>
		                    	<big class="compare">0.00%<span> <cite>vs</cite> 0.00%</span></big>
		                    </h6>
		                    <p>Organic Traffic</p>
		                </div>
		                <div class="chart">
		                    <canvas id="goal-conversion-all-users-new"></canvas>
		                </div>
		                <div class="small-chart-box-foot">
		                    <p><cite class="red"><i class="fa fa-arrow-down"></i> 0%</cite></p>
		                </div>
		            </div>
				</div>
			</div>
		</div>

		<!-- Total Abandonment Rate -->
		<div class="single">
			<div class="section-head mb-3">
				<h4>Total Abandonment Rate</h4>
			</div>
			<div class="row row-cols-2 gx-4">
				<div class="col">
					<div class="small-chart-box goals-chart-box">
		                <div class="small-chart-box-head">
		                    <figure>
		                        <img src="https://waveitdigital.com/public/vendor/internal-pages/images/organic-keywords-img.png">
		                    </figure>
		                    <h6>
		                    	<big class="compare">0.00%<span> <cite>vs</cite> 0.00%</span></big>
		                    </h6>
		                    <p>All Users</p>
		                </div>
		                <div class="chart">
		                    <canvas id="goal-abondon-all-users-new"></canvas>
		                </div>
		                <div class="small-chart-box-foot">
		                    <p><cite class="green"><i class="fa fa-arrow-up"></i> 0%</cite></p>
		                </div>
		            </div>
				</div>
				<div class="col">
					<div class="small-chart-box goals-chart-box">
		                <div class="small-chart-box-head">
		                    <figure>
		                        <img src="https://waveitdigital.com/public/vendor/internal-pages/images/organic-keywords-img.png">
		                    </figure>
		                    <h6>
		                    	<big class="compare">0.00%<span> <cite>vs</cite> 0.00%</span></big>
		                    </h6>
		                    <p>Organic Traffic</p>
		                </div>
		                <div class="chart">
		                    <canvas id="goal-abondonRate-organic-chart-new"></canvas>
		                </div>
		                <div class="small-chart-box-foot">
		                    <p><cite class="red"><i class="fa fa-arrow-down"></i> 0%</cite></p>
		                </div>
		            </div>
				</div>
			</div>
		</div>

		<!-- Goal Completion Location1 -->
		<div class="single">
		    <div class="section-head mb-3">
				<h6 class="bg">Goal Completion Location1</h6>
			</div>
		    <div class="box-boxshadow">
		    	<div class="table-responsive">
                    <table class="goals-location-table">
                        <thead>
                            <tr>
                                <th>Goal Completion Location</th>
                                <th>Goal Completions</th>
                                <th>% Goal Completions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="3">
                                    <h6>1 .<a href="javascript:;">/thanks-you/</a></h6>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <p><strong>Apr 11, 2022 - Jul 11, 2022</strong></p>
                                </td>
                            </tr>
                            <tr>
                                <td>All Users</td>
                                <td>454</td>
                                <td>
                                    <div class="flex">
                                        <div class="progress">
										  	<div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
                                        <p>0.00%</p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Organic Traffic</td>
                                <td>353</td>
                                <td>
                                    <div class="flex">
                                        <div class="progress">
										  	<div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
                                        <p>0.00%</p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <p><strong>Jan 10, 2022 - Apr 10, 2022</strong></p>
                                </td>
                            </tr>
                            <tr>
                                <td>All Users</td>
                                <td>550</td>
                                <td>
                                    <div class="flex">
                                        <div class="progress">
										  	<div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
                                        <p>0.00%</p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Organic Traffic</td>
                                <td>443</td>
                                <td>
                                    <div class="flex">
                                        <div class="progress">
										  	<div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
                                        <p>0.00%</p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <h6>2 .<a href="javascript:;">/</a></h6>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <p><strong>Apr 11, 2022 - Jul 11, 2022</strong></p>
                                </td>
                            </tr>
                            <tr>
                                <td>All Users</td>
                                <td>447</td>
                                <td>
                                    <div class="flex">
                                        <div class="progress">
										  	<div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
                                        <p>0.00%</p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Organic Traffic</td>
                                <td>219</td>
                                <td>
                                    <div class="flex">
                                        <div class="progress">
										  	<div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
                                        <p>0.00%</p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <p><strong>Jan 10, 2022 - Apr 10, 2022</strong></p>
                                </td>
                            </tr>

                            <tr>
                                <td>All Users</td>
                                <td>135</td>
                                <td>
                                    <div class="flex">
                                        <div class="progress">
										  	<div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
                                        <p>0.00%</p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Organic Traffic</td>
                                <td>62</td>
                                <td>
                                    <div class="flex">
                                        <div class="progress">
										  	<div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
                                        <p>0.00%</p>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
		        </div>
		    </div>
		</div>

		<!-- Source / Medium -->
		<div class="single">
		    <div class="section-head mb-3">
				<h6 class="bg">Source / Medium</h6>
			</div>
		    <div class="box-boxshadow">
		    	<div class="table-responsive">
                    <table class="goals-location-table">
                        <thead>
                            <tr>
                                <th>Source / Medium</th>
                                <th>Goal Completions</th>
                                <th>% Goal Completions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="3">
                                    <h6>1 .<a href="javascript:;">/thanks-you/</a></h6>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <p><strong>Apr 11, 2022 - Jul 11, 2022</strong></p>
                                </td>
                            </tr>
                            <tr>
                                <td>All Users</td>
                                <td>454</td>
                                <td>
                                    <div class="flex">
                                        <div class="progress">
										  	<div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
                                        <p>0.00%</p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Organic Traffic</td>
                                <td>353</td>
                                <td>
                                    <div class="flex">
                                        <div class="progress">
										  	<div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
                                        <p>0.00%</p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <p><strong>Jan 10, 2022 - Apr 10, 2022</strong></p>
                                </td>
                            </tr>
                            <tr>
                                <td>All Users</td>
                                <td>550</td>
                                <td>
                                    <div class="flex">
                                        <div class="progress">
										  	<div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
                                        <p>0.00%</p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Organic Traffic</td>
                                <td>443</td>
                                <td>
                                    <div class="flex">
                                        <div class="progress">
										  	<div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
                                        <p>0.00%</p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <h6>2 .<a href="javascript:;">/</a></h6>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <p><strong>Apr 11, 2022 - Jul 11, 2022</strong></p>
                                </td>
                            </tr>
                            <tr>
                                <td>All Users</td>
                                <td>447</td>
                                <td>
                                    <div class="flex">
                                        <div class="progress">
										  	<div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
                                        <p>0.00%</p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Organic Traffic</td>
                                <td>219</td>
                                <td>
                                    <div class="flex">
                                        <div class="progress">
										  	<div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
                                        <p>0.00%</p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <p><strong>Jan 10, 2022 - Apr 10, 2022</strong></p>
                                </td>
                            </tr>

                            <tr>
                                <td>All Users</td>
                                <td>135</td>
                                <td>
                                    <div class="flex">
                                        <div class="progress">
										  	<div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
                                        <p>0.00%</p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Organic Traffic</td>
                                <td>62</td>
                                <td>
                                    <div class="flex">
                                        <div class="progress">
										  	<div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
                                        <p>0.00%</p>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
		        </div>
		    </div>
		</div>

	</div>
</div>
@endsection