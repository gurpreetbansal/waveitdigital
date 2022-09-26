@if($dashboardStatus == false)
<div id="seodash" class="main-data" uk-sortable="handle:.white-box-handle">
   <div class="white-box mb-40 ">
      <div class="integration-list" id="seo_add">
         <article>
            <figure>
               <img src="{{URL::asset('public/vendor/internal-pages/images/google-search-console-img.png')}}">
            </figure>
            <div>
               <p>To get insights about SERP, keywords and build reports for your SEO dashboard.</p>
               <a href="javascript:;" class="btn btn-border blue-btn-border dashboardActivate" data-type="SEO" data-id="{{ $campaign_id }}">Activate</a>
            </div>
         </article>
      </div>
   </div>
</div>
@else
<div id="seodash" class="main-data" uk-sortable="handle:.white-box-handle">
   <div id="myObserver"></div>
   <div class="floatingDiv" style="display: none;">
      <div id="searchconsoleHeading"></div>
      <div class="organicTrafficGrowthHeading"></div>
   </div>
   <!-- Top Summary Row -->
   <div class="campaign-hero mb-40"><div uk-grid class="uk-grid">@include('vendor.seo_sections.site_audit_overview')@include('vendor.seo_sections.graphs_overview')</div></div>

  <!--  <div uk-grid class="mb-40">
      @include('vendor.seo_sections.summary')
      <div class="uk-width-expand@l">
         <div uk-grid uk-sortable="handle:.WhiteBoxHandleSmallChartBox">
            <div class="uk-width-1-3@xl uk-width-1-3@l uk-width-1-3@m uk-width-1-2@s">
               <div class="white-box small-chart-box style-3">
                  <div class="small-chart-box-head">
                     <figure>
                        <div class="loader h-54"></div>
                        <img src="{{URL::asset('public/vendor/internal-pages/images/organic-keywords-img.png')}}">
                     </figure>
                     <h6 class="ok-total ajax-loader"><big class="organic-keyword-total">?? <cite class="organic_keywords"><span uk-icon="icon:"></span>?? <span class="dateFrom">Last 7 Days</span></cite></big></h6>
                  </div>
                  <div class="chart">
                     <div class="ok-graph ajax-loader loader-text h-60-chart"></div>
                     <canvas id="canvas-organic-keyword" height="145" width="335"></canvas>
                  </div>
                  <div class="small-chart-box-foot">
                     <p>Organic Keywords  <span uk-tooltip="title: This section shows growth in organic keywords month after month, however we check this total number of keywords you are ranking for on weekly basis and same can be seen in graph.; pos: top-left" class="fa fa-info-circle"></span></p>
                  </div>
               </div>
            </div>
            <div class="uk-width-1-3@xl uk-width-1-3@l uk-width-1-3@m uk-width-1-2@s">
               <div class="white-box small-chart-box style-3">
                  <div class="small-chart-box-head">
                  <figure>
                     <div class="loader  h-54"></div>
                     <img src="{{URL::asset('public/vendor/internal-pages/images/organic-visitors-img.png')}}">
                  </figure>

                  <h6 class="ov-total ajax-loader"><big class="organic-visitors-count">?? <cite class="organic_visitor_growth"><span uk-icon="icon: "></span>??<span class="dateFrom">Last 7 Days</span></cite></big> </h6>
                  </div>
                  <div class="chart">
                     <div class="ov-graph ajax-loader loader-text h-60-chart"></div>
                     <canvas id="canvas-organic-visitor" height="145" width="335"></canvas>
                  </div>
                  <div class="small-chart-box-foot">
                     <p>Organic Visitors <span
                     uk-tooltip="title: This section shows total number of organic visits to your website in selected time period.; pos: top-left"
                     class="fa fa-info-circle"></span></p>
                  </div>
               </div>
            </div>
            <div class="uk-width-1-3@xl uk-width-1-3@l uk-width-1-3@m uk-width-1-2@s">
               <div class="white-box small-chart-box style-3">
                  <div class="small-chart-box-head">
                     <figure>
                        <div class="loader  h-54"></div>
                        <img src="{{URL::asset('public/vendor/internal-pages/images/page-authority-img.png')}}">
                     </figure>

                     <h6 class="pa-stats ajax-loader"><big class="pa_stats">?? <cite class="pageAuthority_avg"><span uk-icon="icon:"></span>?? <span class="dateFrom">Last 30 Days</span></cite></big></h6>
                  </div>
                  <div class="chart">
                     <div class="page-authority ajax-loader loader-text h-60-chart"></div>
                      <canvas id="canvas-page-authority"  height="145" width="335"></canvas>
                  </div>
                  <div class="small-chart-box-foot">
                     <p>Page Authority <span  uk-tooltip="title: This section shows Page authority trend.; pos: top-left" class="fa fa-info-circle"></span></p>
                  </div>
               </div>
            </div>
            <div class="uk-width-1-3@xl uk-width-1-3@l uk-width-1-3@m uk-width-1-2@s">
               <div class="white-box small-chart-box style-3">
                  <div class="small-chart-box-head">
                     <figure>
                        <div class="loader  h-54"></div>
                        <img src="{{URL::asset('public/vendor/internal-pages/images/referring-domains-img.png')}}">
                     </figure>
                     <h6 class="rd-total ajax-loader"><big class="backlink_total">?? <cite class="backlink_avg"><span uk-icon="icon:"></span>?? <span class="dateFrom">Last 7 Days</span></cite></big></h6>
                  </div>
                  <div class="chart">
                     <div class="rd-graph ajax-loader loader-text h-60-chart"></div>
                     <canvas id="canvas-referring-domains"></canvas>
                  </div>
                  <div class="small-chart-box-foot">
                     <p>Referring Domains <span  uk-tooltip="title: This section shows growth in referring domains month after month, however we check the total number of referring domains on weekly basis and same can be seen in graph. ; pos: top-left" class="fa fa-info-circle"></span></p>
                  </div>
               </div>
            </div>
            <div class="uk-width-1-3@xl uk-width-1-3@l uk-width-1-3@m uk-width-1-2@s">
               <div class="white-box small-chart-box style-3">
                  <div class="small-chart-box-head">
                     <figure>
                        <div class="loader h-54"></div>
                        <img src="{{URL::asset('public/vendor/internal-pages/images/google-goals-img.png')}}">
                     </figure>

                     <h6 class="goalToal ajax-loader"><big class="Google-analytics-goal">?? <cite class="goal_result"><span uk-icon="icon: "></span>?? <span class="dateFrom">Last 7 Days</span></cite></big></h6>
                  </div>
                  <div class="chart">
                     <div class="gc-overview-organic ajax-loader loader-text h-60-chart"></div>
                     <canvas id="google-goal-completion-overview"></canvas>
                  </div>
                  <div class="small-chart-box-foot">
                     <p>Google Goals <span uk-tooltip="title: This section shows goal completion from Google Analytics in selected time period. ; pos: top-left" class="fa fa-info-circle"></span></p>
                  </div>
               </div>
            </div>
            <div class="uk-width-1-3@xl uk-width-1-3@l uk-width-1-3@m uk-width-1-2@s">
               <div class="white-box small-chart-box style-3">
                  <div class="small-chart-box-head">
                     <figure>
                        <div class="loader  h-54"></div>
                        <img src="{{URL::asset('public/vendor/internal-pages/images/page-authority-img.png')}}">

                     </figure>
                     <div class="loader  h-67"></div>
                         <h6 class="da-stats ajax-loader"><big class="da_stats">?? <cite class="domainAuthority_avg"><span uk-icon="icon:"></span>?? <span class="dateFrom">Last 30 Days</span></cite></big></h6>
                  </div>
                  <div class="chart">
                     <div class="domain_authority ajax-loader loader-text h-60-chart"></div>
                     <canvas id="canvas-domain-authority"></canvas>
                  </div>
                  <div class="small-chart-box-foot">
                     <p>Domain Authority <span  uk-tooltip="title: This section shows Domain authority trend.; pos: top-left" class="fa fa-info-circle"></span></p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div> -->
   <!-- Top Summary Row End -->
      @include('vendor.seo_sections.search_console')
      @include('vendor.seo_sections.organic_traffic_growth')
      @include('vendor.seo_sections.ott_ga4')
      @include('vendor.seo_sections.organic_keyword_growth')
      @include('vendor.seo_sections.live_keyword_tracking')
      @include('vendor.seo_sections.backlink_profile')
      @include('vendor.seo_sections.goal_completion')
      @include('vendor.seo_sections.ga4_goals')
      @include('vendor.seo_sections.activity')
      <!-- <div id="seo_second_section"></div>
      <div id="seo_third_section"></div> -->
</div>
@endif