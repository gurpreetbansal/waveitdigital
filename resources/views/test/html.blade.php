@extends('layouts.design_pdf_layout')
@section('content')

@if($types <> null)

<div class="main-data-pdf" id="seoDashboard">
    <div class="mb-40">
        <div class="white-box-handle">
            
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
    @endif
</div>

@endsection