<div class="main-data-view" id="visibility" uk-sortable="handle:.white-box-handle">
	<!--Search Console Row -->
	<div class="white-box pa-0 mb-40" id="console_data_rank">
		  <div class="white-box-head">
		  <!-- <span class="white-box-handle" uk-icon="icon: table"></span> -->
		    <div class="left">
		      <div class="heading ajax-loader">
		        <img src="{{URL::asset('public/vendor/internal-pages/images/search-console-img.png')}}">
		        <h2>Search Console
		          <span uk-tooltip="title: This section shows clicks and impressions in Google Search Console for selected time period, It’s a great way to understand your website’s visibility in Google.; pos: top-left" class="fa fa-info-circle"></span></h2>
		        </div>
		      </div>
		      <div class="right">
		        <div class="filter-list ajax-loader">
		          <ul>
		            <li>
		              <button type="button" data-module="search_console" class="searchConsole_view <?php if($selected == 1){ echo 'active'; }?>" data-value="month">One Month</button>
		            </li>
		            <li>
		              <button type="button" data-module="search_console" class="searchConsole_view <?php if($selected == 3){ echo 'active'; }?>" data-value="three">Three Month</button>
		            </li>
		            <li>
		              <button type="button" data-module="search_console" class="searchConsole_view <?php if($selected == 6){ echo 'active'; }?>" data-value="six">Six Month</button>
		            </li>
		            <li>
		              <button type="button" data-module="search_console" class="searchConsole_view <?php if($selected == 9){ echo 'active'; }?>" data-value="nine">Nine Month</button>
		            </li>
		            <li>
		              <button type="button"data-module="search_console" class="searchConsole_view <?php if($selected == 12){ echo 'active'; }?>" data-value="year">One Year</button>
		            </li>
		            <li>
		              <button type="button" data-module="search_console" class="searchConsole_view <?php if($selected == 24){ echo 'active'; }?>" data-value="twoyear">Two Year</button>
		            </li>
		          </ul>
		        </div>
		      </div>
		    </div>

		    <div class="white-box-body height-300 search-console-graph ajax-loader">
		      <canvas id="new-canvas-search-console-rank" height="300"></canvas>
		    </div>

		    <div class="white-box pa-0 pSpace">
		      <div class="white-box-tab-head no-border">
		        <ul class="console-nav-bar uk-subnav uk-subnav-pill ajax-loader" uk-switcher="connect: .searchConsoleNav">
		          <li><a href="#">Queries</a></li>
		          <li><a href="#">Pages</a></li>
		          <li><a href="#">Countries</a></li>
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
		                    <th class="ajax-loader">Impression </th>
		                    <th class="ajax-loader">CTR </th>
		                    <th class="ajax-loader">Position </th>
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
		                  <th class="ajax-loader">Page</th>
		                  <th class="ajax-loader">Clicks</th>
		                  <th class="ajax-loader">Impression </th>
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
		                <th class="ajax-loader">Country</th>
		                <th class="ajax-loader">Clicks</th>
		                <th class="ajax-loader">Impression </th>
		                <th class="ajax-loader">CTR</th>
		                <th class="ajax-loader">Position</th>
		              </tr>
		            </thead>
		            <tbody class="country_table"></tbody>
		          </table>
		        </div>
		      </div>
		  </div>
			</div>
			</div>
	</div>

	<div class="white-box mb-40 " id="console_data_rank-view"> 
		<div class="integration-list">
			<article>
				<figure>
					<img src="{{URL::asset('public/vendor/internal-pages/images/search-console-img.png')}}">
				</figure>
				<div>
					<p>The Source is not active on your account.</p>
					<?php 
						if(isset($profile_data) && !empty($profile_data)){
							$email = $profile_data->ProfileInfo->email;
						}else{
							$email = $profile_data->UserInfo->email;
						}
					?>
					<a href="mailto: {{$email}}" class="btn btn-border blue-btn-border">Contact us</a>
				</div>
			</article>
		</div>
	</div>
</div>
    