@if($types <> null)
<div class="main-data-pdf" id="seoDashboard">
    <div uk-grid class="mb-40">
        <div class="uk-width-1-1 white-box-handle">
            <div class="box-boxshadow"><div class="campaign-hero">@include('viewkey.pdf.seo_sections.site_audit_overview')</div></div>
            <div class="box-boxshadow">
                <h4>Overview Graphs : Summary & Comparison</h4>
                <hr />
                <ul class="list-style">
                    <li>
                      <b class="uk-text-medium"><img src="{{URL::asset('public/vendor/internal-pages/images/check-icon.png')}}" alt=""> Organic Keywords:</b> 
                      This section shows growth in organic keywords month after month
                    </li>
                    <li>
                      <b class="uk-text-medium"><img src="{{URL::asset('public/vendor/internal-pages/images/check-icon.png')}}" alt=""> Organic Visitors:</b> 
                      This section shows total number of organic visits to your website in selected time period
                    </li>
                    <li>
                      <b class="uk-text-medium"><img src="{{URL::asset('public/vendor/internal-pages/images/check-icon.png')}}" alt=""> Page Authority:</b> 
                      This section shows Page authority trend
                    </li>
                    <li>
                      <b class="uk-text-medium"><img src="{{URL::asset('public/vendor/internal-pages/images/check-icon.png')}}" alt=""> Referring Domains:</b> 
                      This section shows growth in referring domains month after month
                    </li>
                    <li>
                      <b class="uk-text-medium"><img src="{{URL::asset('public/vendor/internal-pages/images/check-icon.png')}}" alt=""> Google Goals:</b> 
                      This section shows goal completion from Google Analytics in selected time period
                    </li>
                    <li>
                      <b class="uk-text-medium"><img src="{{URL::asset('public/vendor/internal-pages/images/check-icon.png')}}" alt=""> Domain Authority:</b> 
                      This section shows Domain authority trend
                    </li>
                </ul>
            </div>

            <div class="campaign-hero mb-40">@include('viewkey.pdf.seo_sections.graphs_overview')</div>
       <!--      <div uk-grid>
                <div class="uk-width-1-3">
                    <div class="white-box small-chart-box ">
                        <div class="small-chart-box-head">
                            <span class="WhiteBoxHandleSmallChartBox" uk-icon="icon: table"></span>
                            <figure>
                                <img
                                    src="{{URL::asset('public/vendor/internal-pages/images/organic-keywords-img.png')}}">
                            </figure>

                            <h6><big class="organic-keyword-total">0000</big> </h6>
                        </div>
                        <div class="chart">
                            <canvas id="canvas-organic-keyword"></canvas>
                        </div>
                        <div class="small-chart-box-foot oragnic_kwyword_foot">
                            <p class="ok-avg"> Organic Keywords</p>
                        </div>
                    </div>
                </div>
                <div class="uk-width-1-3">
                    <div class="white-box small-chart-box">
                        <div class="small-chart-box-head">
                            <figure>
                                <img
                                    src="{{URL::asset('public/vendor/internal-pages/images/organic-visitors-img.png')}}">
                            </figure>

                            <h6><big class="organic-visitors-count">0000</big></h6>
                        </div>
                        <div class="chart">
                            <canvas id="canvas-organic-visitor"></canvas>
                        </div>
                        <div class="small-chart-box-foot organic_visitors_foot">
                            <p class="ov-avg"> Organic Visitors</p>
                        </div>
                    </div>
                </div>
                <div class="uk-width-1-3">
                    <div class="white-box small-chart-box">
                        <div class="small-chart-box-head">
                            <figure>
                                <img
                                    src="{{URL::asset('public/vendor/internal-pages/images/page-authority-img.png')}}">
                            </figure>
                            <h6 class="pa-stats"><big class="pa_stats">{{@$moz_data->page_authority}}</big> </h6>
                        </div>
                        <div class="chart">

                            <canvas id="canvas-page-authority"></canvas>
                        </div>
                        <div class="small-chart-box-foot">
                            <p> Page Authority</p>
                        </div>
                    </div>
                </div>
                <div class="uk-width-1-3">
                    <div class="white-box small-chart-box">
                        <div class="small-chart-box-head">
                            <figure>
                                <img
                                    src="{{URL::asset('public/vendor/internal-pages/images/referring-domains-img.png')}}">
                            </figure>
                            <h6 class="rd-total"><big class="backlink_total">000</big> </h6>
                        </div>
                        <div class="chart">
                            <canvas id="canvas-referring-domains"></canvas>
                        </div>
                        <div class="small-chart-box-foot backlink_foot">
                            <p class="rd-avg"> Referring Domains</p>
                        </div>
                    </div>
                </div>
                <div class="uk-width-1-3">
                    <div class="white-box small-chart-box">
                        <div class="small-chart-box-head">
                            <figure>
                                <img
                                    src="{{URL::asset('public/vendor/internal-pages/images/google-goals-img.png')}}">
                            </figure>
                            <h6 class="goalToal"><big class="Google-analytics-goal">000</big> </h6>
                        </div>
                        <div class="chart">
                            <canvas id="google-goal-completion-overview"></canvas>
                        </div>
                        <div class="small-chart-box-foot google-analytics-goal-foot">
                            <p class="goal"> Google Goals</p>
                        </div>
                    </div>
                </div>
                <div class="uk-width-1-3">
                    <div class="white-box small-chart-box">
                        <div class="small-chart-box-head">
                            <figure>
                                <img
                                    src="{{URL::asset('public/vendor/internal-pages/images/page-authority-img.png')}}">
                            </figure>
                            <h6 class="da-stats"> <big class="da_stats">{{@$moz_data->domain_authority}}</big></h6>
                        </div>
                        <div class="chart">
                            <canvas id="canvas-domain-authority"></canvas>
                        </div>
                        <div class="small-chart-box-foot">
                            <p>Domain Authority</p>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- Top Small Chart Boxes End -->
        </div>
    </div>


    @include('viewkey.pdf.seo_sections.search_console')
    @include('viewkey.pdf.seo_sections.organic_traffic_growth')
    @include('viewkey.pdf.seo_sections.ott_ga4')
    @include('viewkey.pdf.seo_sections.organic_keyword_growth')
    @include('viewkey.pdf.seo_sections.live_keyword_tracking')
    @include('viewkey.pdf.seo_sections.backlink_profile')
    @include('viewkey.pdf.seo_sections.goal_completion')
    @include('viewkey.pdf.seo_sections.ecommerce_goals')
    @include('viewkey.pdf.seo_sections.ga4_goals')
    

    @else
    <div class="main-data-viewDeactive" uk-sortable="handle:.white-box-handle" id="seoDashboard">
        <div class="white-box mb-40 " id="seoDashboardDeactive">
            <div class="integration-list">
                <article>
                    <figure>
                        <img src="{{URL::asset('public/vendor/internal-pages/images/google-ads-img.png')}}">
                    </figure>
                    <div>
                        <p>The Source is not active on your acoount.</p>
                        <?php
      if(isset($profile_data->ProfileInfo->email)){
        $email = @$profile_data->ProfileInfo->email;
      }else{
        $email = @$profile_data->UserInfo->email;
      }
      ?>

                        <a href="mailto:{{ $email }}" class="btn btn-border blue-btn-border">Contact us</a>
                    </div>
                </article>
            </div>
        </div>
        @endif
    </div>