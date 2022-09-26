<input type="hidden" class="campaign_id" value="{{@$campaign_id}}">
<div class="white-box pa-0 mb-40 space-top white-box-handle ecommerce-goal-div" id="ecom_analytics_data_goal" style="<?php if($connectivity['ua'] == false){ echo "display: none"; } else{ echo "display: block"; } ?>">
	<div class="box-boxshadow">
	    <div class="section-head">
	      <h4>E-commerce Overview</h4>
	      <hr />
	    </div>
	    <div class="chart mb-40 ajax-loader ecom-goal-completion-graph">
		    <canvas id="ecom-canvas-goal-completion" height="300"></canvas>
		</div>
	</div>
	<!-- <div class="ecommerce-goal-div"> -->
	<div class="white-box-body">
	    <div class="goal-completion-box">
	        <!-- Chart Box 1 -->
	        <div class="uk-width-1-1">
	            <h5>Ecommerce Conversion Rate</h5>
	            <div class="white-box small-chart-box ecom-chart-box">
	                <div class="small-chart-box-head">
	                    <figure><img src="{{URL::asset('public/vendor/internal-pages/images/organic-keywords-img.png')}}">
	                    </figure>
	                    <h6><big class="compare ajax-loader" id="ecom-conversionRate-users">0.00% </big> All Users<span
	                            class="fa fa-info-circle"></span></h6>
	                </div>
	                <div class="chart goal-completion-all-users-div">
	                    <div class="ecom_conversion ajax-loader loader-text h-60-chart"></div>
	                    <canvas id="ecom-conversion-rate-graph-users"></canvas>
	                </div>
	                <div class="small-chart-box-foot">
	                    <p class="ecom-conversion-rate-users-percentage ajax-loader ecom_conversion_percentage"></p>
	                </div>
	            </div>
	            <div class="white-box small-chart-box ecom-chart-box">
	                <div class="small-chart-box-head">
	                    <figure><img src="{{URL::asset('public/vendor/internal-pages/images/organic-keywords-img.png')}}">
	                    </figure>
	                    <h6><big class="compare ajax-loader" id="ecom-conversionRate-organic">0.00% </big> Organic Traffic
	                        <span class="fa fa-info-circle"></span></h6>
	                </div>
	                <div class="chart">
	                    <div class="ecom_conversionOrganic ajax-loader loader-text h-60-chart"></div>
	                    <canvas id="ecom-conversion-rate-graph-organic"></canvas>
	                </div>
	                <div class="small-chart-box-foot">
	                    <p class="ecom-conversion-rate-organic-percentage ajax-loader ecom_conversion_percentage_organic">
	                    </p>
	                </div>
	            </div>
	        </div>
	        <!-- Chart Box 1 End -->
	    </div>
	    <div class="goal-completion-box BreakBefore">
	        <!-- Chart Box 2 -->
	        <div class="uk-width-1-1">
	            <h5>Transactions</h5>
	            <div class="white-box small-chart-box  ecom-chart-box">
	                <div class="small-chart-box-head">
	                    <figure>
	                        <img src="{{URL::asset('public/vendor/internal-pages/images/organic-keywords-img.png')}}">
	                    </figure>
	                    <h6><big class="compare ajax-loader" id="ecom_transction_users">0000</big> All Users<span
	                            uk-tooltip="title: Organic Keywords Data Here...; pos: top-left"
	                            class="fa fa-info-circle"></span></h6>
	                </div>
	                <div class="chart">
	                    <div class="ecom_transactionUsers ajax-loader loader-text h-60-chart"></div>
	                    <canvas id="ecom-transaction-users"></canvas>
	                </div>
	                <div class="small-chart-box-foot">
	                    <p class="ecom-transaction-users-percentage ajax-loader ecom_transaction_percentage_users"></p>
	                </div>
	            </div>
	            <div class="white-box small-chart-box  ecom-chart-box">
	                <div class="small-chart-box-head">
	                    <figure>
	                        <img src="{{URL::asset('public/vendor/internal-pages/images/organic-keywords-img.png')}}">
	                    </figure>
	                    <h6><big class="compare ajax-loader" id="ecom_transction_organic">0000</big> Organic Traffic<span
	                            uk-tooltip="title: Organic Keywords Data Here...; pos: top-left"
	                            class="fa fa-info-circle"></span></h6>
	                </div>
	                <div class="chart">
	                    <div class="ecom_transactionOrganic ajax-loader loader-text h-60-chart"></div>
	                    <canvas id="ecom-transaction-organic"></canvas>
	                </div>
	                <div class="small-chart-box-foot">
	                    <p class="ecom-transaction-organic-percentage ajax-loader ecom_transaction_percentage_organic"></p>
	                </div>
	            </div>
	        </div>
	        <!-- Chart Box 2 End -->
	    </div>
	    <div class="goal-completion-box">
	        <!-- Chart Box 3 -->
	        <div class="uk-width-1-1">
	            <h5>Revenue</h5>
	            <div class="white-box small-chart-box  ecom-chart-box">
	                <div class="small-chart-box-head">
	                    <figure>
	                        <img src="{{URL::asset('public/vendor/internal-pages/images/organic-keywords-img.png')}}">
	                    </figure>
	                    <h6><big class="compare ajax-loader" id="ecom_revenue_users">0000</big> All Users<span
	                            uk-tooltip="title: Organic Keywords Data Here...; pos: top-left"
	                            class="fa fa-info-circle"></span></h6>
	                </div>
	                <div class="chart">
	                    <div class="ecom_RevenueUsers ajax-loader loader-text h-60-chart"></div>
	                    <canvas id="ecom-revenue-users"></canvas>
	                </div>
	                <div class="small-chart-box-foot">
	                    <p class="ecom-revenue-users-percentage ajax-loader ecom_revenue_users_percentage"></p>
	                </div>
	            </div>
	            <div class="white-box small-chart-box  ecom-chart-box">
	                <div class="small-chart-box-head">
	                    <figure>
	                        <img src="{{URL::asset('public/vendor/internal-pages/images/organic-keywords-img.png')}}">
	                    </figure>
	                    <h6><big class="compare ajax-loader" id="ecom_revenue_organic">0000</big> Organic Traffic<span
	                            uk-tooltip="title: Organic Keywords Data Here...; pos: top-left"
	                            class="fa fa-info-circle"></span></h6>
	                </div>
	                <div class="chart">
	                    <div class="ecom_RevenueOrganic ajax-loader loader-text h-60-chart"></div>
	                    <canvas id="ecom-revenue-organic"></canvas>
	                </div>
	                <div class="small-chart-box-foot">
	                    <p class="ecom-revenue-organic-percentage ajax-loader ecom_revenue_organic_percentage"></p>
	                </div>
	            </div>
	        </div>
	        <!-- Chart Box 3 End -->
	    </div>
	    <div class="goal-completion-box">
	        <!-- Chart Box 4 -->
	        <div class="uk-width-1-1">
	            <h5>Avg. Order Value</h5>
	            <div class="white-box small-chart-box  ecom-chart-box">
	                <div class="small-chart-box-head">
	                    <figure>
	                        <img src="{{URL::asset('public/vendor/internal-pages/images/organic-keywords-img.png')}}">
	                    </figure>
	                    <h6><big class="compare ajax-loader" id="ecom_avg_orderValue_users">0000</big> All Users<span
	                            uk-tooltip="title: Organic Keywords Data Here...; pos: top-left"
	                            class="fa fa-info-circle"></span></h6>
	                </div>
	                <div class="chart">
	                    <div class="ecom_avgorderValue_users ajax-loader loader-text h-60-chart"></div>
	                    <canvas id="ecom-orderValue-users"></canvas>
	                </div>
	                <div class="small-chart-box-foot">
	                    <p class="ecom-orderValue-users-percentage ajax-loader ecom_orderValue_users_percentage"></p>
	                </div>
	            </div>
	            <div class="white-box small-chart-box  ecom-chart-box">
	                <div class="small-chart-box-head">
	                    <figure>
	                        <img src="{{URL::asset('public/vendor/internal-pages/images/organic-keywords-img.png')}}">
	                    </figure>
	                    <h6><big class="compare ajax-loader" id="ecom_avg_orderValue_organic">0000</big>Organic Traffic<span
	                            uk-tooltip="title: Organic Keywords Data Here...; pos: top-left"
	                            class="fa fa-info-circle"></span></h6>
	                </div>
	                <div class="chart">
	                    <div class="ecom_avgorderValue_organic ajax-loader loader-text h-60-chart"></div>
	                    <canvas id="ecom-orderValue-organic"></canvas>
	                </div>
	                <div class="small-chart-box-foot">
	                    <p class="ecom-orderValue-organic-percentage ajax-loader ecom_orderValue_organic_percentage"></p>
	                </div>
	            </div>
	        </div>
	        <!-- Chart Box 4 End -->
	    </div>
	    <div class="goal-completion-tab mb-20 BreakBefore">
	        <div class="white-box-tab-head mb-20">
	            <ul class="uk-subnav uk-subnav-pill" uk-switcher="connect: .productTabContent">
	                <li><a href="#">Product</a></li>
	            </ul>
	        </div>
	        <div class="box-boxshadow">
		        <div class="white-box-body pa-0">
		            <div class="productTabContent">
		                <!-- <div> -->
		                    <div class="project-table-cover table-box">
		                        <div class="project-table-body ecomProductTable">
		                            <table id="ecom_product">
		                                <thead>
		                                    <tr>
		                                        <th>
		                                            Product
		                                        </th>
		                                        <th>
		                                            Product Revenue
		                                        </th>
		                                        <th>
		                                            % Product Revenue
		                                        </th>
		                                    </tr>
		                                </thead>
		                                <tbody>
		                                    @for($i=1; $i<=5; $i++) <tr>
		                                        <td class="ajax-loader"></td>
		                                        </tr>
		                                        @endfor
		                                </tbody>
		                            </table>
		                        </div>

		                        <div class="project-table-foot ecom_product-foot" id="ecom-product-foot">
		                            <div class="project-entries">
		                                <p>................</p>
		                            </div>
		                            <div class="pagination ecom-product">
		                                <ul class="pagination" role="navigation">
		                                    <li class="page-item disabled" aria-disabled="true" aria-label="« Previous">
		                                        <span class="page-link" aria-hidden="true">....</span>
		                                    </li>
		                                    <li class="page-item  active">
		                                        <a class="page-link" href="javascript:;">...</a>
		                                    </li>
		                                    <li class="page-item ">
		                                        <a class="page-link" href="javascript:;">...</a>
		                                    </li>
		                                    <li class="page-item">
		                                        <a class="page-link" href="javascript:;" rel="next"
		                                            aria-label="Next »">.....</a>
		                                    </li>
		                                </ul>
		                            </div>
		                        </div>

		                    </div>
		                <!-- </div> -->
		            </div>
		        </div>
		    </div>
	    </div>
	</div>
</div>