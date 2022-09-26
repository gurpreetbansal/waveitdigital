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

<div class="tab-content ">
    <div class="uk-switcher projectNavContainer">
        <div  id="Social" class="uk-active">
          @include('viewkey.pdf.social-dashboard')  
      </div>
  </div>

  <div class="uk-switcher projectNavContainerSideBar">
  </div>
</div>



@endsection