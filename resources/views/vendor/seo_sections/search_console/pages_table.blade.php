@if(isset($pages_data) && count($pages_data) > 0)
@foreach($pages_data as $value)
<tr>
	<td>{{$value['page']}}</td>
	<td>{{$value['clicks']}}</td>
	<td>{{$value['impressions']}}</td>
</tr>
@endforeach
@include('vendor.seo_sections.search_console.pages_pagination')
@else
<center><tr><td colspan="5">No page found</td></tr></center>
@endif