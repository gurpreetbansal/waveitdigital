<input type="hidden" class="campaignID" value="{{$campaign_id}}">

@if(isset($keywords) && !empty($keywords))
@foreach($keywords as  $key=>$keyword)
<!-- 1 Data row -->
<tr class="<?php if($key%2==0){ echo 'odd';}else{ echo 'even';}?>">
	<td>{{$keyword->keywords}}</td>
	<td>{{$keyword->position}}</td>
	<td>{{$keyword->search_volume}}</td>
	<td>{{number_format($keyword->cpc,2)}}</td>
	<td>{{number_format($keyword->traffic,2)}}</td>
</tr>
@endforeach
@endif