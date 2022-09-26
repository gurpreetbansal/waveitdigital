<div class="tabs-animation">
	<div class="row widget-row">
		<div class="col-sm-12 col-md-6 col-xl-3">
			<div class="card  widget-chart">
				<div class="widget-chart-content">
					<div class="icon-wrapper rounded campaign-ranking">
						<img src="{{URL::asset('/public/vendor/images/OrganicKeywordsArrow.png')}}">
					</div>

					<div class="widget-numbers GoogleRanking">
						<span><?php echo $metrixOverview['metricValuesItem']['QUERIES_DIRECT']['value']; ?></span>
					</div>
					<div class="widget-subheading fsize-1 pt-2 opacity-10 text-warning font-weight-bold">
					Customers who find your listing searching for your business name or address</div>
					<div class="widget-description opacity-8">
						<span class="pr-1">
							<i class="fa "></i>
							<span class="pl-1 googleRankPosition"></span>
						</span>
						Direct
					</div>
				</div>
				<div class="widget-chart-wrapper">
					<div id="dashboard-sparklines-simple-2" style="min-height: 120px;"></div>
				</div>
			</div>
		</div>
		<div class="col-sm-12 col-md-6 col-xl-3">
			<div class="card  widget-chart">
				<div class="widget-chart-content">
					<div class="icon-wrapper rounded campaign-ranking">
						<img src="{{URL::asset('/public/vendor/images/report-google-analytics-icon.png')}}">
					</div>
					<div class="widget-numbers"><span class="GoogleOrganicVisitors"><?php echo $metrixOverview['metricValuesItem']['QUERIES_INDIRECT']['value']; ?></span></div>
					<div class="widget-subheading fsize-1 pt-2 opacity-10 text-danger font-weight-bold">
						Customers who find your listing searching for a category, product, or service
					</div>
					<div class="widget-description opacity-8">
						Discovery
						<span class=" pl-1">
							<i class="fa "></i>
							<span class="pl-1 GoogleTraffic_growth"></span>
						</span>
					</div>
				</div>
				<div class="widget-chart-wrapper">
					<div id="dashboard-sparklines-simple-1" style="min-height: 120px;"></div>
				</div>
			</div>
		</div>
		<div class="col-sm-12 col-md-6 col-xl-3">
			<div class="card  widget-chart">
				<div class="widget-chart-content">
					<div class="icon-wrapper rounded campaign-ranking">
						<img src="{{URL::asset('/public/vendor/images/backlink-icon.png')}}">
					</div>
					<div class="widget-numbers backlinks_total"><span><?php echo $metrixOverview['metricValuesItem']['QUERIES_CHAIN']['value']; ?></span></div>
					<div class="widget-subheading fsize-1 pt-2 opacity-10 text-info font-weight-bold">Customers who find your listing searching for a brand related to your business</div>
					<div class="widget-description opacity-8">
						Branded
						<span class=" pl-1">
							<i class="fa "></i>
							<span class="pl-1 backlinks_avg"></span>
						</span>
					</div>
				</div>
				<div class="widget-chart-wrapper">
					<div id="dashboard-sparklines-simple-3" style="min-height: 120px;"></div>
				</div>
			</div>
		</div>
		<div class="col-sm-12 col-md-6 col-xl-3">
			<div class="card  widget-chart">
				<div class="widget-chart-content">
					<div class="icon-wrapper rounded campaign-ranking">
						<img src="{{URL::asset('/public/vendor/images/ReportGoogleAnaLyticsGoals.png')}}">
					</div>
					<div class="widget-numbers analyticsTotalGoal"><span><?php echo $metrixOverview['metricValuesItem']['VIEWS_SEARCH']['value']; ?></span></div>
					<div class="widget-subheading fsize-1 pt-2 opacity-10 text-warning font-weight-bold">
					Where customers view your business on Google</div>
					<div class="widget-description opacity-8">
						Listing on Search
						<span class=" pl-1">
							<i class="fa "></i>
							<span class="pl-1 analyticsgoalResult"></span>
						</span>
					</div>
				</div>
				<div class="widget-chart-wrapper">
					<div id="dashboard-sparklines-4" style="min-height: 120px;"></div>
				</div>
			</div>
		</div>
		<div class="col-sm-12 col-md-6 col-xl-3">
			<div class="card  widget-chart">
				<div class="widget-chart-content">
					<div class="icon-wrapper rounded campaign-ranking">
						<img src="{{URL::asset('/public/vendor/images/ReportGoogleAnaLyticsGoals.png')}}">
					</div>
					<div class="widget-numbers analyticsTotalGoal"><span><?php echo $metrixOverview['metricValuesItem']['VIEWS_MAPS']['value']; ?></span></div>
					<div class="widget-subheading fsize-1 pt-2 opacity-10 text-warning font-weight-bold">
					Where customers view your business on Google Map</div>
					<div class="widget-description opacity-8">
						Listing on Map
						<span class=" pl-1">
							<i class="fa "></i>
							<span class="pl-1 analyticsgoalResult"></span>
						</span>
					</div>
				</div>
				<div class="widget-chart-wrapper">
					<div id="dashboard-sparklines-4" style="min-height: 120px;"></div>
				</div>
			</div>
		</div>

		<div class="col-sm-12 col-md-6 col-xl-3">
			<div class="card  widget-chart">
				<div class="widget-chart-content">
					<div class="icon-wrapper rounded campaign-ranking">
						<img src="{{URL::asset('/public/vendor/images/backlink-icon.png')}}">
					</div>
					<div class="widget-numbers backlinks_total"><span><?php echo $metrixOverview['metricValuesItem']['ACTIONS_WEBSITE']['value']; ?></span></div>
					<div class="widget-subheading fsize-1 pt-2 opacity-10 text-info font-weight-bold">Visit Your Website</div>
					<div class="widget-description opacity-8">
						Customer actions
						<span class=" pl-1">
							<i class="fa "></i>
							<span class="pl-1 backlinks_avg"></span>
						</span>
					</div>
				</div>
				<div class="widget-chart-wrapper">
					<div id="dashboard-sparklines-simple-3" style="min-height: 120px;"></div>
				</div>
			</div>
		</div>
		<div class="col-sm-12 col-md-6 col-xl-3">
			<div class="card  widget-chart">
				<div class="widget-chart-content">
					<div class="icon-wrapper rounded campaign-ranking">
						<img src="{{URL::asset('/public/vendor/images/ReportGoogleAnaLyticsGoals.png')}}">
					</div>
					<div class="widget-numbers analyticsTotalGoal"><span><?php echo $metrixOverview['metricValuesItem']['ACTIONS_DRIVING_DIRECTIONS']['value']; ?></span></div>
					<div class="widget-subheading fsize-1 pt-2 opacity-10 text-warning font-weight-bold">
					Request Directions</div>
					<div class="widget-description opacity-8">
						Customer actions
						<span class=" pl-1">
							<i class="fa "></i>
							<span class="pl-1 analyticsgoalResult"></span>
						</span>
					</div>
				</div>
				<div class="widget-chart-wrapper">
					<div id="dashboard-sparklines-4" style="min-height: 120px;"></div>
				</div>
			</div>
		</div>

		<div class="col-sm-12 col-md-6 col-xl-3">
			<div class="card  widget-chart">
				<div class="widget-chart-content">
					<div class="icon-wrapper rounded campaign-ranking">
						<img src="{{URL::asset('/public/vendor/images/OrganicKeywordsArrow.png')}}">
					</div>

					<div class="widget-numbers GoogleRanking">
						<span><?php echo $metrixOverview['metricValuesItem']['ACTIONS_PHONE']['value']; ?></span>
					</div>
					<div class="widget-subheading fsize-1 pt-2 opacity-10 text-warning font-weight-bold">
					The number of times the phone number was clicked</div>
					<div class="widget-description opacity-8">
						<span class="pr-1">
							<i class="fa "></i>
							<span class="pl-1 googleRankPosition"></span>
						</span>
						Photo Clicked
					</div>
				</div>
				<div class="widget-chart-wrapper">
					<div id="dashboard-sparklines-simple-2" style="min-height: 120px;"></div>
				</div>
			</div>
		</div>

	</div>
</div>

<div class="row">
    <div class="col-md-12 col-lg-6 col-xl-12">
        <div class="mb-3 card">
            <div class="card-header-tab card-header-tab-animation card-header">
                <div class="card-header-title extraOrganicKeywordSection">
                    <img src="{{URL::asset('/public/vendor/images/data-analytics.png')}}">
                    Customers view your business on Google
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered data-table" id="google_organic_keywords">
                        <thead>
                            <tr>
                                <th>Dates</th>
                                <th>Search Listing</th>
                                <th>Map Listing</th>
                            </tr>
                        </thead>
                        <tbody>
                        	<?php foreach($metrixGraphViewMap['search']['labels'] as $key => $values){  ?>
                        	<tr> 
                                <td><?php echo $values ?></td>
                                <td><?php echo $metrixGraphViewMap['search']['value'][$key] ?></td>
                                <td><?php echo $metrixGraphViewMap['views']['value'][$key] ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div> 


<div class="row">
    <div class="col-md-12 col-lg-6 col-xl-12">
        <div class="mb-3 card">
            <div class="card-header-tab card-header-tab-animation card-header">
                <div class="card-header-title extraOrganicKeywordSection">
                    <img src="{{URL::asset('/public/vendor/images/data-analytics.png')}}">
                    Customer actions
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered data-table" id="google_organic_keywords">
                        <thead>
                            <tr>
                                <th>Dates</th>
                                <th>Visit Your Website</th>
                                <th>Request Directions</th>
                                <th>Call You</th>
                            </tr>
                        </thead>
                        <tbody>
                        	<?php foreach($metrixGraphCustomerActions['website']['labels'] as $key => $values){  ?>
                        	<tr> 
                                <td><?php echo $values ?></td>
                                <td><?php echo $metrixGraphCustomerActions['website']['value'][$key] ?></td>
                                <td><?php echo $metrixGraphCustomerActions['directions']['value'][$key] ?></td>
                                <td><?php echo $metrixGraphCustomerActions['phone']['value'][$key] ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>