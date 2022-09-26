<!--Search Console Row -->
<div class="white-box pa-0 mb-40" id="console_data" style="<?php if($dashboardtype->console_account_id == ''){ echo "display: none"; } else{ echo "display: block"; }?>">
	<div class="white-box-head">
		<!-- <span class="white-box-handle" uk-icon="icon: table"></span> -->
		<div class="left">
			<div class="loader h-33 half-px"></div>
			<div class="heading">
				<img src="{{URL::asset('public/vendor/internal-pages/images/search-console-img.png')}}">
				<div>
					<h2>Search Console
						<span uk-tooltip="title: This section shows clicks and impressions in Google Search Console for selected time period, It’s a great way to understand your website’s visibility in Google.; pos: top-left"
						class="fa fa-info-circle"></span>
					</h2>
					<p class="search_console_time"></p>
					<p class="search_console_range"></p>
				</div>
			</div>
		</div>
		<div class="right">
			<div class="loader h-33 half-px"></div>
			<div class="filter-list">
				<ul>
					<li>
						<a href="javascript:;" id="dateRange_console_section" class="btn icon-btn color-blue" uk-tooltip="title: Date Range; pos: top-center">
							<img src="{{URL::asset('/public/vendor/internal-pages/images/date-rance-calender-icon.png')}}">
						</a>
					</li>
					<li>
						<a href="javascript:;" data-request-id="{{@$campaign_id}}" id="refresh_search_console_section" class="btn icon-btn color-purple" uk-tooltip="title: Refresh Search Console data; pos: top-center" title="" aria-expanded="false">
							<img src="{{URL::asset('/public/vendor/internal-pages/images/refresh-icon.png')}}">
						</a>
					</li>
				</ul>
			</div>
		</div>

		   @include('includes.vendor.search_console_popup')
	</div>

	<div class="white-body-filter-list" style="display: none;">
		<div class="filter-list">
			<ul>
				<li>
					<button type="button" data-module="search_console" class="searchConsole <?php //if($selectedSearchConsole == 1){ echo 'active'; }?>" data-value="month">One Month</button>
				</li>
				<li>
					<button type="button" data-module="search_console" class="searchConsole <?php //if($selectedSearchConsole == 3){ echo 'active'; }?>" data-value="three">Three Month</button>
				</li>
				<li>
					<button type="button" data-module="search_console" class="searchConsole <?php //if($selectedSearchConsole == 6){ echo 'active'; }?>" data-value="six">Six Month</button>
				</li>
				<li>
					<button type="button" data-module="search_console" class="searchConsole <?php //if($selectedSearchConsole == 9){ echo 'active'; }?>" data-value="nine">Nine Month</button>
				</li>
				<li>
					<button type="button"data-module="search_console" class="searchConsole <?php //if($selectedSearchConsole == 12){ echo 'active'; }?>" data-value="year">One Year</button>
				</li>
				<li>
					<button type="button" data-module="search_console" class="searchConsole <?php //if($selectedSearchConsole == 24){ echo 'active'; }?>" data-value="twoyear">Two Year</button>
				</li>
			</ul>
		</div>
	</div>

	<div class="sConsole-compare">
		<div class="uk-grid-collapse uk-child-width-expand@s uk-grid">
		    <div class="single ajax-loader">
		        <h6>Total clicks</h6>
		        <ul>
		        	<li>
		        		<strong class="current_click">--</strong><span class="current_click_dates"></span>
		        	</li>
		        	<li class="show_previous_click">
		        		<strong class="previous_click">--</strong><span class="previous_click_dates"></span>
		        	</li>
		        </ul>
		    </div>
		    <div class="single ajax-loader">
		        <h6>Total impressions</h6>
		        <ul>
		        	<li>
		        		<strong class="current_impressions">--</strong><span class="current_impressions_dates"></span>
		        	</li>
		        	<li class="show_previous_impressions">
		        		<strong class="previous_impressions">--</strong><span class="previous_impressions_dates"></span>
		        	</li>
		        </ul>
		    </div>
		    <div class="single ajax-loader">
		        <h6>Average CTR</h6>
		        <ul>
		        	<li class="show_current_ctr">
		        		<strong><span class="current_ctr">--</span></strong><span class="current_ctr_dates"></span>
		        	</li>
		        	<li class="show_previous_ctr">
		        		<strong><span class="previous_ctr">--</span></strong><span class="previous_ctr_dates"></span>
		        	</li>
		        </ul>
		    </div>
		    <div class="single ajax-loader">
		        <h6>Average position</h6>
		        <ul>
		        	<li class="show_current_position">
		        		<strong><span class="current_position">--</span></strong><span class="current_position_dates"></span>
		        	</li>
		        	<li class="show_previous_position">
		        		<strong><span class="previous_position">--</span></strong><span class="previous_position_dates"></span>
		        	</li>
		        </ul>
		    </div>
		</div>
	</div>

	<div class="white-box-body height-300 search-console-graph ajax-loader ">
		<canvas id="new-canvas-search-console" height="300"></canvas>
	</div>

	<div class="white-box pa-0">
		<div class="white-box-tab-head no-border">
			<ul class="console-nav-bar uk-subnav uk-subnav-pill ajax-loader" uk-switcher="connect: .searchConsoleNav; swiping: false">
				<li><a href="#">Queries</a></li>
				<li class="searchConsoleTabs" data-type="pages"><a href="#">Pages</a></li>
				<li class="searchConsoleTabs" data-type="countries"><a href="#">Countries</a></li>
			</ul>
		</div>
		<div class="white-box-body pa-0">
			<div class="uk-switcher searchConsoleNav">
				<div>
					<div class="table-responsive">
						<table class="style1 queries">
							<thead>
								<tr>
									<th class="ajax-loader">Query</th>
									<th class="ajax-loader">Clicks</th>
									<th class="ajax-loader">Impression</th>
									<th class="ajax-loader">CTR </th>
									<th class="ajax-loader">Average Position</th>
								</tr>
							</thead>
							<tbody class="query_table">
								<tr>
									<td class="ajax-loader">....</td>
									<td class="ajax-loader">....</td>
									<td class="ajax-loader">....</td>
									<td class="ajax-loader">....</td>
									<td class="ajax-loader">....</td>
								</tr>
								<tr>
									<td class="ajax-loader">....</td>
									<td class="ajax-loader">....</td>
									<td class="ajax-loader">....</td>
									<td class="ajax-loader">....</td>
									<td class="ajax-loader">....</td>
								</tr>
								<tr>
									<td class="ajax-loader">....</td>
									<td class="ajax-loader">....</td>
									<td class="ajax-loader">....</td>
									<td class="ajax-loader">....</td>
									<td class="ajax-loader">....</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<div>
					<div class="table-responsive">
						<table class="style1 pages">
							<thead>
								<tr>
									<th>Page</th>
									<th>Clicks</th>
									<th>Impression</th>
								</tr>
							</thead>
							<tbody class="pages_table"></tbody>
						</table>
					</div>
				</div>
				<div>
					<div class="table-responsive">
						<table class="style1 countries">
							<thead>
								<tr>
									<th>Country</th>
									<th>Clicks</th>
									<th>Impression </th>
									<th>CTR</th>
									<th>Average Position</th>
								</tr>
							</thead>
							<tbody class="country_table"></tbody>
						</table>
					</div>
				</div>
				<input type="hidden" class="sc_duration" value="3">
		     	<!--  <div>
			       	<div class="table-responsive">
			        	<table class="style1 devices">
			          		<thead>
			            		<tr>
			              			<th class="ajax-loader">Device</th>
			              			<th class="ajax-loader">Clicks</th>
			              			<th class="ajax-loader">Impression </th>
			              			<th class="ajax-loader">CTR</th>
			              			<th class="ajax-loader">Position</th>
			            		</tr>
			          		</thead>
			          		<tbody class="device_table"></tbody>
			        	</table>
			      	</div>
			  	</div> -->
			</div>
		</div>
	</div>
</div>
@if(Auth::user()->role_id !=4)
<div class="white-box mb-40 " id="console_add" style="<?php if($dashboardtype->console_account_id != ''){ echo "display: none"; } else{ echo "display: block"; } ?>">
	<div class="loader h-33 "></div>
	<div class="integration-list" >
		<article>
			<figure>
				<img src="{{URL::asset('public/vendor/internal-pages/images/google-search-console-img.png')}}">
			</figure>
			<div>
				<p>To get insights about SERP, keywords and build reports for your SEO dashboard.</p>
				<a href="#" class="btn btn-border blue-btn-border" data-pd-popup-open="CampaignDetailConsolePopup">Connect</a>
			</div>

		</article>
	</div>
</div>
@endif