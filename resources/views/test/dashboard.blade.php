@extends('layouts.pdf_layout')
@section('content')
<input type="hidden" name="key" id="encriptkey" value="{{ $key }}">
<input type="hidden" class="campaignID" name="campaign_id" value="{{ $campaign_id }}">
<input type="hidden" class="campaign_id" name="campaign_id" value="{{ $campaign_id }}">
<input type="hidden" id="user_id" name="user_id" value="{{ $user_id }}">
@php
@$dashUsed = array_intersect($types,array_keys($all_dashboards));
@$dashDiff = array_diff(array_keys($all_dashboards),$types);
@$arrCombine = array_merge($dashUsed,$dashDiff);
@endphp
<!-- Project Tabs Content -->
<div class="tab-content ">
  <div class="uk-switcher projectNavContainer">
    <div  id="SEO" class="uk-active">
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
        </div>
      </div>


      @include('viewkey.pdf.seo_sections.search_console')
      @include('viewkey.pdf.seo_sections.organic_traffic_growth')
      @include('viewkey.pdf.seo_sections.organic_keyword_growth')
      @include('viewkey.pdf.seo_sections.live_keyword_tracking')
      @include('viewkey.pdf.seo_sections.backlink_profile')
     
      
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
    </div>
  </div>

  <div class="uk-switcher projectNavContainerSideBar">
  </div>
</div>
<!-- Project Tabs Content End -->
</div>
@endsection