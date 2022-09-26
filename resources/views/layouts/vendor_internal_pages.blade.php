<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>Agency Dashboard: # 1 Reporting Platform for Digital Marketing Agencies</title>
  <meta name="description" content="Agency Dashboard offers valuable insights through SEO, Local, PPC, & Social dashboards for all your marketing channels under a single roof. Trusted by more than 500 agencies across the world.">
  <!-- <meta name="viewport"  content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no"> -->
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta http-equiv="content-language" content="en-us">

  <!-- Favicon -->
  <link rel="shortcut icon" href="{{URL::asset('public/front/img/favicon.png')}}" sizes="32x32" type="image/x-icon">

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- On Page Loading CSS -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600&display=swap">

  <link rel="stylesheet" href="{{URL::asset('public/vendor/internal-pages/css/main.css?v='.time())}}">
  <link rel="stylesheet" href="{{URL::asset('public/vendor/internal-pages/css/custom.css?v='.time())}}">
  <script>
  function openWidget() {
    FreshworksWidget('open');
  }

  window.fwSettings={
    'widget_id':84000000007
  };
  !function(){if("function"!=typeof window.FreshworksWidget){var n=function(){n.q.push(arguments)};n.q=[],window.FreshworksWidget=n}}()
</script>
<style type="text/css">#launcher-frame{display: none;}</style>
<script type='text/javascript' src='https://ind-widget.freshworks.com/widgets/84000000007.js' async defer></script>
 <script>
  window.onsetWidgetSettings = {
    customTrigger: true,
    page: 'agency-dashboard.onset.io'
  };

  (function (e, t) {
    e.onsetWidget = {};
    e.onsetWidget.on = function () {
      (e.onsetWidget.$ = e.onsetWidget.$ || []).push(arguments);
    };
    var c = t.getElementsByTagName('script')[0],
    i = t.createElement('script');
    i.async = true;
    i.src = 'https://widget.onset.io/widget.js';
    c.parentNode.insertBefore(i, c);
  })(window, document);
</script>
<input type="hidden" class="base_url" value="<?php echo url('/');?>" />
</head>

<body  onload="FreshworksWidget('hide');">
 @include('includes.vendor.sidebar')
 @if(Request::is('dashboard') || Request::is('dashboard/*'))
 <div class="preloader-wrapper">
  <img src="{{URL::asset('public/vendor/internal-pages/images/preloader.gif')}}" alt="loader">
</div>
@endif
@if(!Request::is('keyword-explorer'))
@include('includes.vendor.header')
@endif
<main>

  @if(! Request::is('dashboard') && ! Request::is('dashboard/*') && ! Request::is('archived-campaigns') && ! Request::is('profile-settings') && ! Request::is('auth-settings') && ! Request::is('add-new-project') && ! Request::is('alerts') && ! Request::is('shared-access') && ! Request::is('activity/categories/*') && ! Request::is('schedule-report') && ! Request::is('keyword-explorer') && ! Request::is('sa-design') && ! Request::is('sa/*') && ! Request::is('audit/*'))
  @include('includes.vendor.breadcrumb')
  @endif

  @if(Request::is('audit/*'))
 
  @include('includes.vendor.audit-breadcrumb')
  @endif
  @yield('content')

</main>


<!-- On Page Loading JS -->
<script src="{{URL::asset('public/vendor/internal-pages/js/bundle.min.js')}}"></script>

<script src="{{URL::asset('public/vendor/internal-pages/js/bootstrap-select.js')}}"></script>

<script src="{{URL::asset('public/vendor/internal-pages/js/clipboard.min.js')}}"></script>

<!-- <script src="{{URL::asset('public/vendor/internal-pages/js/stickyTable.js')}}"></script> -->

<script  src="{{URL::asset('public/vendor/internal-pages/js/custom.js?v='.time())}}"></script>

<!-- Page Loading JS -->
<link defer href="{{URL::asset('public/vendor/internal-pages/css/toastr.css')}}" rel="stylesheet" type="text/css" />

<script defer src="{{URL::asset('public/vendor/scripts/toastr.js')}}"></script>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>

<!-- datepicker -->
<!-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" type="text/css" />
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->

  <link rel="stylesheet" href="https://fengyuanchen.github.io/datepicker/css/datepicker.css" type="text/css" />
  <script src="https://fengyuanchen.github.io/datepicker/js/datepicker.js"></script>


  <!-- datepicker -->

  <!--for chart.js-->
  <script defer src="{{ URL::asset('/public/vendor/scripts/moment.min.js')}}"></script>
  <script defer src="{{ URL::asset('/public/vendor/scripts/utils.js')}}"></script>
  <script defer src="{{URL::asset('public/vendor/internal-pages/js/Chart.min.js')}}"></script>
  <script defer src="{{URL::asset('public/vendor/scripts/chartjs-plugin-trendline.js')}}"></script>

  <!--daterangepicker-->

  <script defer type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
  <link defer rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />



  <!-- <script defer type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAyfg5RfXsDreSKWq7-P-VjfW7d2-abe8c&libraries=places"></script> -->
  <script defer type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBb6I6tMP8wrCMkPoEHiPrRtn-klWDA9QA&libraries=places"></script>



  <!-- select2 -->
  <link defer href="{{URL::asset('public/vendor/css/select2.min.css')}}" rel="stylesheet"/>
  <script defer src="{{URL::asset('public/vendor/scripts/select2.min.js')}}" type="text/javascript"></script>
  <!-- select2 -->

  <!-- <script src="{{URL::asset('public/vendor/internal-pages/js/timepicker.js')}}"></script> -->
  <!-- ckeditor -->
  <!--developer js for search-->
  <script defer src="{{URL::asset('public/vendor/internal-pages/js/developerjs/sidebar.js?v='.time())}}"></script>
  @if(Request::is('dashboard') || Request::is('dashboard/*'))

  <!-- <link rel="stylesheet" type="text/css" href="//www.jqueryscript.net/demo/Bootstrap-4-Tag-Input-Plugin-jQuery/tagsinput.css"> -->
  <!-- <script type="text/javascript" src="//www.jqueryscript.net/demo/Bootstrap-4-Tag-Input-Plugin-jQuery/tagsinput.js"></script> -->
  <link defer href="{{URL::asset('public/vendor/internal-pages/css/tagsinput.css')}}" rel="stylesheet"/>
  <script defer src="{{URL::asset('public/vendor/internal-pages/js/tagsinput.js')}}"></script>
  <script defer src="{{URL::asset('public/vendor/internal-pages/js/developerjs/custom.js?v='.time())}}"></script>
  <script defer src="{{URL::asset('public/vendor/internal-pages/js/developerjs/activate_account.js?v='.time())}}"></script>
  @include('includes.vendor.dashboard_popup')
  @endif


  <script defer src="{{URL::asset('public/vendor/internal-pages/js/tinymce.min.js')}}"></script>

  @if(Request::is('archived-campaigns'))
  <script defer src="{{URL::asset('public/vendor/internal-pages/js/developerjs/archived_projects.js?v='.time())}}"></script>
  @endif

  @if(Request::is('campaign-detail/*') || Request::is('campaign-detail-design/*') || Request::is('extra-organic-keywords/*'))
  <script defer src="{{URL::asset('public/vendor/internal-pages/js/developerjs/campaign_notes.js?v='.time())}}"></script>
  <script defer src="{{URL::asset('public/vendor/internal-pages/js/developerjs/campaign_detail.js?v='.time())}}"></script>
  <script defer src="{{URL::asset('public/vendor/internal-pages/js/developerjs/organic_keyword_growth.js?v='.time())}}"></script>
  <script defer src="{{URL::asset('public/vendor/internal-pages/js/developerjs/backlink_profile.js?v='.time())}}"></script>
  <script defer src="{{URL::asset('public/vendor/internal-pages/js/developerjs/goal_completion.js?v='.time())}}"></script>
  <script defer src="{{URL::asset('public/vendor/internal-pages/js/developerjs/ecommerce_goals.js?v='.time())}}"></script>
  <script defer src="{{URL::asset('public/vendor/internal-pages/js/developerjs/live_keyword_tracking.js?v='.time())}}"></script>
  <script defer src="{{URL::asset('public/vendor/internal-pages/js/developerjs/search_console.js?v='.time())}}"></script>

  <script defer src="{{URL::asset('public/vendor/internal-pages/js/developerjs/ga4_campaign_detail.js?v='.time())}}"></script>
 


  <!-- ppc script -->
  <script defer src="{{URL::asset('public/vendor/internal-pages/js/developerjs/ppc_summary.js?v='.time())}}"></script>
  <script defer src="{{URL::asset('public/vendor/internal-pages/js/developerjs/ppc_summary_graph.js?v='.time())}}"></script>
  <script defer src="{{URL::asset('public/vendor/internal-pages/js/developerjs/ppc_campaign.js?v='.time())}}"></script>
  <script defer src="{{URL::asset('public/vendor/internal-pages/js/developerjs/ppc_keyword.js?v='.time())}}"></script>
  <script defer src="{{URL::asset('public/vendor/internal-pages/js/developerjs/ppc_adsgroup.js?v='.time())}}"></script>
  <script defer src="{{URL::asset('public/vendor/internal-pages/js/developerjs/ppc_ads.js?v='.time())}}"></script>
  <script defer src="{{URL::asset('public/vendor/internal-pages/js/developerjs/ppc_performance_network.js?v='.time())}}"></script>
  <script defer src="{{URL::asset('public/vendor/internal-pages/js/developerjs/ppc_performance_device.js?v='.time())}}"></script>
  <script defer src="{{URL::asset('public/vendor/internal-pages/js/developerjs/ppc_performance_clickType.js?v='.time())}}"></script>
  <script defer src="{{URL::asset('public/vendor/internal-pages/js/developerjs/ppc_performance_adSlot.js?v='.time())}}"></script>


  <script defer src="{{URL::asset('public/vendor/internal-pages/js/developerjs/gmb.js?v='.time())}}"></script>

  <script defer src="{{URL::asset('public/vendor/internal-pages/js/developerjs/activities.js?v='.time())}}"></script>
  <!-- ppc script -->

  @endif

  @if(Request::is('serp/*'))
  <script defer src="{{URL::asset('public/vendor/internal-pages/js/developerjs/campaign_detail.js?v='.time())}}"></script>
  <script defer src="{{URL::asset('public/vendor/internal-pages/js/developerjs/live_keyword_tracking.js?v='.time())}}"></script>
  @endif

  @if(Request::is('activities-details/*'))
  <script defer src="{{URL::asset('public/vendor/internal-pages/js/developerjs/campaign_detail.js?v='.time())}}"></script>
  <script defer src="{{URL::asset('public/vendor/internal-pages/js/developerjs/live_keyword_tracking.js?v='.time())}}"></script>
  <script defer src="{{URL::asset('public/vendor/internal-pages/js/developerjs/activities.js?v='.time())}}"></script>
  @endif

  @if(Request::is('activity/*'))
  <script defer src="{{URL::asset('public/vendor/internal-pages/js/developerjs/activities.js?v='.time())}}"></script>
  @endif


  @if(Request::is('profile-settings'))
  @include('includes.vendor.profile_popup')
  <script src="//parsleyjs.org/dist/parsley.js"></script>
  <script src="//js.stripe.com/v3/"></script>
  <script defer src="{{URL::asset('public/vendor/internal-pages/js/libphonenumber.min.js')}}"></script>
  <script defer src="{{URL::asset('public/vendor/internal-pages/js/developerjs/profile_settings.js?v='.time())}}"></script>
   <script defer src="{{URL::asset('public/vendor/internal-pages/js/developerjs/profile_plan.js?v='.time())}}"></script>
  @endif

  @if(Request::is('project-settings/*'))
  @include('includes.vendor.project_settings_popup')
  @include('includes.vendor.google_analytics_popup')
  <script defer src="{{URL::asset('public/vendor/internal-pages/js/libphonenumber.min.js')}}"></script>
  <script defer src="{{URL::asset('public/vendor/internal-pages/js/developerjs/project_settings.js?v='.time())}}"></script>
  @endif

  <!--developer js for search-->

  @if(!Request::is('add-new-project') && !Request::is('site-audit/*') && !Request::is('sa/audit') && !Request::is('audit/*'))
  @include('includes.vendor.popup_modals')
  @endif

  @if(Request::is('add-new-project'))
  <script defer src="{{URL::asset('public/vendor/internal-pages/js/developerjs/project_settings.js?v='.time())}}"></script>
  <script defer src="{{URL::asset('public/vendor/internal-pages/js/developerjs/add_new_project.js?v='.time())}}"></script>
  @include('includes.vendor.add_new_project_popup')
  @endif

  @if(Request::is('campaign-detail/*'))
  <script defer src="{{URL::asset('public/vendor/internal-pages/js/developerjs/project_settings.js?v='.time())}}"></script>
  <script defer src="{{URL::asset('public/vendor/internal-pages/js/developerjs/social_overview.js?v='.time())}}"></script>
  <script defer src="{{URL::asset('public/vendor/internal-pages/js/developerjs/social.js?v='.time())}}"></script>
  @include('includes.vendor.campaign_detail_popup')

  @endif

  @if(Request::is('shared-access'))
  <script defer src="{{URL::asset('public/vendor/internal-pages/js/developerjs/shared_access.js?v='.time())}}"></script>
  @include('includes.vendor.shared_access_popup')
  @endif

  @if(Request::is('alerts'))
  <script defer src="{{URL::asset('public/vendor/internal-pages/js/developerjs/alerts.js?v='.time())}}"></script>
  @endif

  @if(Request::is('schedule-report'))
  @include('includes.vendor.schedule_reports_popup')
  <script defer src="{{URL::asset('public/vendor/internal-pages/js/developerjs/schedule_reports.js?v='.time())}}"></script>
  @endif

  
  @if(Request::is('sa/audit') || Request::is('audit/*'))
    <!-- <script defer src="{{URL::asset('public/vendor/internal-pages/js/developerjs/site_audit.js?v='.time())}}"></script> -->
    <script defer src="{{URL::asset('public/vendor/internal-pages/js/developerjs/audit-reports.js?v='.time())}}"></script>
    @include('includes.vendor.audit_popup')
    @include('includes.vendor.popup_modals')
    
  
  @endif


  @if(!Request::is('sa/audit') && !Request::is('audit/*'))
    @include('includes.vendor.common_popup')
  @endif

  @if(Request::is('keyword-explorer') || Request::is('keyword-explorer/*'))
  <link defer href="{{URL::asset('public/vendor/internal-pages/css/tagsinput.css')}}" rel="stylesheet"/>
  <script defer src="{{URL::asset('public/vendor/internal-pages/js/tagsinput.js')}}"></script>
  <script defer src="{{URL::asset('public/vendor/internal-pages/js/developerjs/keyword_explorer.js?v='.time())}}"></script>
  @include('includes.vendor.keyword_explorer_popup')
  @endif




  <script defer src="{{URL::asset('public/vendor/internal-pages/js/developerjs/ga4.js?v='.time())}}"></script>
<script defer src="https://load.nootiz.com/74d192ea-162e-43b2-a7c8-065570acd0e7"></script>



@if(Request::is('social/*'))
  <!-- <script defer src="{{URL::asset('public/vendor/internal-pages/js/libphonenumber.min.js')}}"></script>
  <script defer src="{{URL::asset('public/vendor/internal-pages/js/developerjs/project_settings.js?v='.time())}}"></script> -->
  <script defer src="{{URL::asset('public/vendor/internal-pages/js/developerjs/social.js?v='.time())}}"></script>
@endif

@if(Request::is('facebookdevelopment/*'))
  <script defer src="{{URL::asset('public/vendor/internal-pages/js/developerjs/facebooktest.js?v='.time())}}"></script>
@endif

</body>
</html>