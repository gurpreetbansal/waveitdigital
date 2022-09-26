@extends('layouts.vendor_internal_pages')
@section('content')
<input type="hidden" value="{{ $filter }}" class="filter">
<div class="tabs site-audit-breadcrum">
    <div class="loader h-48 half"></div>
    <ul class="breadcrumb-list">
        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}"><i aria-hidden="true" class="fa fa-home"></i></a>
        </li>
        <li class="breadcrumb-item"><a href="{{url('/campaign-detail/'.$campaign_id)}}">{{$project_detail->host_url}}</a></li>

        <li class="breadcrumb-item"><a href="{{url('/site-audit/'.$campaign_id)}}">Site Audit</a></li>
        <li class="uk-active breadcrumb-item">Issues</li>
    </ul>
    <div class="btn-group">
        
        <!-- <a href="#" class="btn icon-btn color-red" uk-tooltip="title: Generate PDF File; pos: top-center"><img src="{{ URL::asset('/public/vendor/internal-pages/images/pdf-icon.png') }}"></a> -->
        
        <a href="{{ url('/download/pdf/'.@$keyenc.'/audit') }}" target="_blank" data-type="audit" class="btn icon-btn color-red generate-pdf" uk-tooltip="title: Generate PDF File; pos: top-center"><img src="{{URL::asset('public/vendor/internal-pages/images/pdf-icon.png')}}"></a>

        <a target="_blank" href="{{url('/project-settings/'.$campaign_id)}}" class="btn icon-btn color-blue" uk-tooltip="title:Project Setting; pos: top-center"><img src="{{ URL::asset('/public/vendor/internal-pages/images/setting-icon.png') }} "></a>
        
        <a href="javascript:;" id="ShareKey" data-id="{{ $campaign_id }}" data-share-key="{{$project_detail->share_key}}" class="btn icon-btn color-purple" uk-tooltip="title: Generate Shared Key; pos: top-center" aria-expanded="false" ><img src="{{ URL::asset('/public/vendor/internal-pages/images/share-key-icon.png') }}"></a>

    </div>
</div>

<div class="project-detail-body audit-page-list">
    <div class="uk-grid site-audit">
        <div class="uk-width-4-5@m">
            <div class="white-box box-audit p-0">
                <div class="white-box head-box">
                    <div class="uk-grid">
                        <div class="uk-width-1-1@s">
                            <div class="heading mb-0 ajax-loader">
                                <h2 class="mb-10 errors-types">{{ 'All criticals' }} <small></small> </h2>
                                <h5 class="mb-0 mt-5 url errors-description">All Urls with critical errors.</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="audit-content page-list-bar">
                    <div class="audit-content-inner">
                        <div class="uk-grid">
                            <div class="ajax-loader h-50" style="min-width: 40%;"></div>
                            <div class="uk-margin-auto-left ajax-loader h-50" style="min-width: 20%;"></div>
                        </div>
                        <div class="links mt-4" style="display: flex;">Links:
                            <a href="#" class="ajax-loader h-27" style="min-width: 100px;"><span></span></a>
                            <a href="#" class="ajax-loader h-27" style="min-width: 100px;"><span></span></a>
                            <a href="#" class="ajax-loader h-27" style="min-width: 100px;"><span></span></a>
                        </div>
                        <div class="color-messages mt-3" style="display: flex;">
                            <span class="ajax-loader h-27" style="flex: 1;"><a></a></span>
                            <span class="ajax-loader h-27" style="flex: 1;"><a></a></span>
                            <span class="ajax-loader h-27" style="flex: 1;"><a></a></span>
                            <span class="ajax-loader h-27" style="flex: 1;"><a></a></span>
                        </div>
                    </div>
                    <div class="audit-content-inner">
                        <div class="uk-grid">
                            <div class="ajax-loader h-50" style="min-width: 40%;"></div>
                            <div class="uk-margin-auto-left ajax-loader h-50" style="min-width: 20%;"></div>
                        </div>
                        <div class="links mt-4" style="display: flex;">Links:
                            <a href="#" class="ajax-loader h-27" style="min-width: 100px;"><span></span></a>
                            <a href="#" class="ajax-loader h-27" style="min-width: 100px;"><span></span></a>
                            <a href="#" class="ajax-loader h-27" style="min-width: 100px;"><span></span></a>
                        </div>
                        <div class="color-messages mt-3" style="display: flex;">
                            <span class="ajax-loader h-27" style="flex: 1;"><a></a></span>
                            <span class="ajax-loader h-27" style="flex: 1;"><a></a></span>
                            <span class="ajax-loader h-27" style="flex: 1;"><a></a></span>
                            <span class="ajax-loader h-27" style="flex: 1;"><a></a></span>
                        </div>
                    </div>
                    <div class="audit-content-inner">
                        <div class="uk-grid">
                            <div class="ajax-loader h-50" style="min-width: 40%;"></div>
                            <div class="uk-margin-auto-left ajax-loader h-50" style="min-width: 20%;"></div>
                        </div>
                        <div class="links mt-4" style="display: flex;">Links:
                            <a href="#" class="ajax-loader h-27" style="min-width: 100px;"><span></span></a>
                            <a href="#" class="ajax-loader h-27" style="min-width: 100px;"><span></span></a>
                            <a href="#" class="ajax-loader h-27" style="min-width: 100px;"><span></span></a>
                        </div>
                        <div class="color-messages mt-3" style="display: flex;">
                            <span class="ajax-loader h-27" style="flex: 1;"><a></a></span>
                            <span class="ajax-loader h-27" style="flex: 1;"><a></a></span>
                            <span class="ajax-loader h-27" style="flex: 1;"><a></a></span>
                            <span class="ajax-loader h-27" style="flex: 1;"><a></a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="uk-width-1-5@m filters page-right-bar">
            <h5 class="uk-text-medium ajax-loader h-33"></h5>
            <div class="heading">
                <a class="ajax-loader h-27" style="width: calc(100% - 20px);display: inline-block;"></a>
            </div>
            <ul class="all-pages-con">
                <li class="ajax-loader h-20"></li>
                <li class="ajax-loader h-20"></li>
                <li class="ajax-loader h-20"></li>
                <li class="ajax-loader h-20"></li>
                <li class="ajax-loader h-20"></li>
                <li class="ajax-loader h-20"></li>
            </ul>
            <div class="heading mt-5">
                <div class="ajax-loader h-27"></div>
            </div>
            <ul class="all-pages-con">
                <li class="ajax-loader h-20"></li>
                <li class="ajax-loader h-20"></li>
                <li class="ajax-loader h-20"></li>
                <li class="ajax-loader h-20"></li>
                <li class="ajax-loader h-20"></li>
                <li class="ajax-loader h-20"></li>
            </ul>
        </div>
    </div>
</div>
@endsection