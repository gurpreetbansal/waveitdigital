<!doctype html>
<html  lang="en" class="no-js">
<head>
  <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Agency Dashboard: # 1 Reporting Platform for Digital Marketing Agencies</title>

  <link rel="shortcut icon" href="{{URL::asset('public/front/img/favicon.png')}}" sizes="32x32" type="image/x-icon">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" media="all">
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" media="all">
  
  <link rel="stylesheet" type="text/css" href="{{URL::asset('public/viewkey/css/pdfs.css')}}" media="all">

  <script src="https://code.jquery.com/jquery-2.2.4.min.js" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js" crossorigin="anonymous" ></script>
  <script src="{{URL::asset('public/vendor/internal-pages/js/bootstrap-select.js')}}"></script>

  <script src="{{URL::asset('public/vendor/internal-pages/js/clipboard.min.js')}}"></script>

  <script src="{{URL::asset('public/vendor/internal-pages/js/custom.js')}}"></script>

  <!--for chart.js-->
  <script src="{{URL::asset('public/vendor/scripts/moment.min.js')}}"></script>
  <script src="{{URL::asset('public/vendor/scripts/utils.js')}}"></script>
  <script src="{{URL::asset('public/vendor/internal-pages/js/Chart.min.js')}}"></script>
  <script src="{{URL::asset('public/vendor/scripts/chartjs-plugin-trendline.js?')}}"></script>


  <input type="hidden" class="base_url" value="<?php echo url('/');?>" />
</head>

<body>
  <main>
    <div class="pdf-face">
      <figure><img src="{{URL::asset('public/viewkey/images/first-page.png')}}"></figure>
      <div class="pdf-heading">
        <div class="logo">
          @if(@$data->project_logo <> null)
          <img src="{{URL::asset('public/storage/project_logo/').'/'.$data->id.'/'.$data->project_logo }}">
          @else
          <img src="{{URL::asset('public/front/img/logo.png')}}">
          @endif
        </div>
        <h2>{{@$type}} <small>{{ @$data->host_url}}</small></h2>
      </div>
    </div>
   
    @if(Request::is('pdf/audit/*'))
      @include('includes.vendor.audit-breadcrumb')
    @else
      @include('includes.viewkey.breadcrumb')
    @endif
   
    <input type="hidden" name="key" id="encriptkey" value="MjI3LXwtOTktfC0xNjU1OTY2NDM4">
    <input type="hidden" class="campaignID" name="campaign_id" value="227">
    <input type="hidden" class="campaign_id" name="campaign_id" value="227">
    <input type="hidden" id="user_id" name="user_id" value="99">

      @yield('content')
 
</main>

<script src="{{URL::asset('public/vendor/internal-pages/js/developerjs/campaign_detail.js')}}"></script>
<script src="{{URL::asset('public/vendor/internal-pages/js/developerjs/search_console.js')}}"></script>
<script src="{{URL::asset('public/vendor/internal-pages/js/developerjs/organic_keyword_growth.js')}}"></script>
<script src="{{URL::asset('public/vendor/internal-pages/js/developerjs/backlink_profile.js')}}"></script>
<script src="{{URL::asset('public/vendor/internal-pages/js/developerjs/goal_completion.js')}}"></script>
<script src="{{URL::asset('public/vendor/internal-pages/js/developerjs/ecommerce_goals.js')}}"></script>
<script src="{{URL::asset('public/viewkey/scripts/live_keyword_tracking.js')}}"></script>

<!-- ppc script -->
<!-- <script defer src="{{URL::asset('public/vendor/internal-pages/js/developerjs/ppc_summary.js')}}"></script>
<script defer src="{{URL::asset('public/vendor/internal-pages/js/developerjs/ppc_summary_graph.js')}}"></script>
<script defer src="{{URL::asset('public/vendor/internal-pages/js/developerjs/ppc_campaign.js')}}"></script>
<script defer src="{{URL::asset('public/vendor/internal-pages/js/developerjs/ppc_keyword.js')}}"></script>
<script defer src="{{URL::asset('public/vendor/internal-pages/js/developerjs/ppc_adsgroup.js')}}"></script>
<script defer src="{{URL::asset('public/vendor/internal-pages/js/developerjs/ppc_ads.js')}}"></script>
<script defer src="{{URL::asset('public/vendor/internal-pages/js/developerjs/ppc_performance_network.js')}}"></script>
<script defer src="{{URL::asset('public/vendor/internal-pages/js/developerjs/ppc_performance_device.js')}}"></script>
<script defer src="{{URL::asset('public/vendor/internal-pages/js/developerjs/ppc_performance_clickType.js')}}"></script>
<script defer src="{{URL::asset('public/vendor/internal-pages/js/developerjs/ppc_performance_adSlot.js')}}"></script>
<script defer src="{{URL::asset('public/vendor/internal-pages/js/developerjs/scrolls.js')}}"></script> -->
<!-- ppc script -->

<!--gmb script-->
<!-- <script defer src="{{URL::asset('public/vendor/internal-pages/js/developerjs/gmb.js')}}"></script> -->
<!--gmb script-->

<!-- <script  src="{{URL::asset('public/vendor/internal-pages/js/developerjs/audit-reports.js')}}"></script>
<script  src="{{URL::asset('public/vendor/internal-pages/js/developerjs/audit.js')}}"></script>
<script  src="{{URL::asset('public/vendor/internal-pages/js/developerjs/audit2.js')}}"></script> -->

</body>
</html>