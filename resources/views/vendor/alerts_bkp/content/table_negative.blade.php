@if(isset($alerts) && !empty($alerts) && ($alerts->total()  > 0))
@foreach($alerts as $key=>$value)
<tr <?php if($value->oneday_position < 0){ echo 'class="down-rank"';}elseif($value->oneday_position > 0){ echo 'class="up-rank"';}?>>
    <td>{{$value->calculate_time_span($value->updated_at)}}</td>
    <td><a href="{{url('/campaign-detail/'.$value->request_id)}}">{{$value->get_project_name($value->request_id)}}</a></td>
    <td><a href="{{$value->url_site}}" target="_blank"><?php if(strlen($value->url_site) > 20){ echo substr($value->url_site,0,20).'...';}else{ echo $value->url_site;}?></a></td>
    <td><img src="{{$value->get_flag_data($value->region)}}"> {{$value->keyword}}</td>
    <td> {{$value->sv}}</td>
    <td>{{$value->get_previous_rank($value->id,$value->request_id)}}</td>
    <td>{{$value->get_new_rank($value->id,$value->request_id)}} 
     <?php
        if($value->oneday_position < 0){ 
            echo '<i class="icon ion-arrow-down-a inline"></i>';
            echo str_replace('-','',$value->oneday_position);
        }elseif($value->oneday_position > 0){ 
            echo '<i class="icon ion-arrow-up-a inline"></i>';
            echo $value->oneday_position;
        }
        ?>
    </td>
</tr>
@endforeach
@else
<tr>
    <td colspan="7"><center>No keywords data</center></td>
</tr>
@endif