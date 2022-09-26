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
   <!-- Top Summary Row End -->
      @include('vendor.seo_sections.search_console')
      @include('vendor.seo_sections.ott_ga4')
      @include('vendor.seo_sections.organic_keyword_growth')
      @include('vendor.seo_sections.live_keyword_tracking')
      @include('vendor.seo_sections.backlink_profile')
      @include('vendor.seo_sections.goal_completion_ga4')
      @include('vendor.seo_sections.activity')
</div>
@endif