@extends('layouts.sa-view_key_layout')
@section('content')

<input type="hidden" name="key" id="task_id" value="{{ $task_id }}">


    <!-- Project Tabs Content -->
    <div class="tab-content ">
        <div class="projectNavContainer">
       
            <div  class="sa-audit-overview">
              @include('vendor.site_audit.sa-audit-overview')
            </div>
            
            <div class="sa-audit-pages"></div>
            <div class="sa-audit-details"></div>
          
        </div>

        <div class="uk-switcher projectNavContainerSideBar">
        </div>
    </div>
    <!-- Project Tabs Content End -->
</div>
@endsection