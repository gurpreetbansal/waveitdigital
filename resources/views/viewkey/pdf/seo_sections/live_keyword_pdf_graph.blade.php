<!--Live Keyword Tracking Row -->
<div class="white-box pa-0 mb-40">

   <div class="white-box-head">
    <div class="left">
      <div class="heading">
         <img src="{{URL::asset('public/vendor/internal-pages/images/live-keyword-tracking-img.png')}}">
         <div>
          <h2>Live Keyword Tracking </h2>
          <p class="keyword_time"></p>
       </div>
    </div>
 </div>

</div>

<div class="white-box-body">
   <div uk-grid class="mb-40">
      <div class="uk-width-1-3">
         <div class="white-box ex-small-chart-box">
            <div class="ex-small-chart-box-head">
               <h6 class=" keywords_up">{{ @$live_stats['lifetime'] }}</h6>
               <p><img src="{{URL::asset('public/vendor/internal-pages/images/keywords-up-img.png')}}"> Keywords Up</p>
            </div>
            <div class="ex-small-chart-box-foot">
               <p class="top-all-since">since start</p>
            </div>
         </div>
      </div>
      <div class="uk-width-1-3">
         <div class="white-box ex-small-chart-box">
            <div class="ex-small-chart-box-head">
               <h6 class=" top-three">
                  {{ $live_stats['three'] }}
                  <small>/{{ $live_stats['total'] }}</small>
               </h6>
               <p><img src="{{URL::asset('public/vendor/internal-pages/images/users-img.png')}}"> In Top 3</p>
            </div>
            <div class="ex-small-chart-box-foot">
               <p class="top-three-since"><strong>{{ $live_stats['since_three'] }}</strong> since start</p>
            </div>
         </div>
      </div>
      <div class="uk-width-1-3">
         <div class="white-box ex-small-chart-box">
            <div class="ex-small-chart-box-head">
               <h6 class=" top-ten">
                  {{ $live_stats['ten'] }}
                  <small>/{{ $live_stats['total'] }}</small>
               </h6>

               <p><img src="{{URL::asset('public/vendor/internal-pages/images/users-img.png')}}"> In Top 10</p>
            </div>
            <div class="ex-small-chart-box-foot">
               <p class="top-ten-since"><strong>{{ $live_stats['since_ten'] }}</strong> since start</p>
            </div>
         </div>
      </div>
      <div class="uk-width-1-3">
         <div class="white-box ex-small-chart-box">
            <div class="ex-small-chart-box-head">
               <h6 class=" top-twenty">
                  {{ $live_stats['twenty'] }}
                  <small>/{{ $live_stats['total'] }}</small>
               </h6>

               <p><img src="{{URL::asset('public/vendor/internal-pages/images/users-img.png')}}"> In Top 20</p>
            </div>
            <div class="ex-small-chart-box-foot">
               <p class="top-twenty-since"><i class="icon ion-arrow-up-a"></i><strong>{{ $live_stats['since_twenty'] }}</strong> since start</p>
            </div>
         </div>
      </div>
      <div class="uk-width-1-3">
         <div class="white-box ex-small-chart-box">
            <div class="ex-small-chart-box-head">
               <h6 class=" top-thirty">
                  {{ $live_stats['thirty'] }}
                  <small>/{{ $live_stats['total'] }}</small>
               </h6>
               <p><img src="{{URL::asset('public/vendor/internal-pages/images/users-img.png')}}"> In Top 30</p>
            </div>
            <div class="ex-small-chart-box-foot">
               <p class="top-thirty-since"><strong>{{ $live_stats['since_thirty'] }}</strong> since start</p>
            </div>
         </div>
      </div>
      <div class="uk-width-1-3">
         <div class="white-box ex-small-chart-box">
            <div class="ex-small-chart-box-head">
               <h6 class="top-hundred">
                  {{ $live_stats['hundred'] }}
                  <small>/{{ $live_stats['total'] }}</small>
               </h6>
               <p><img src="{{URL::asset('public/vendor/internal-pages/images/users-img.png')}}"> In Top 100</p>
            </div>
            <div class="ex-small-chart-box-foot">
               <p class="top-hundred-since"><strong>{{ $live_stats['since_hundred'] }}</strong> since start</p>
            </div>
         </div>
      </div>
   </div>
   <div class="project-table-cover">
      <div class="project-table-body LiveKeywordTable" id="LiveKeywordTableDiv">
         <table id="LiveKeywordTable_data">
            <thead>
               <tr>
                  <th class="liveKeyword_sorting" data-sorting_type="asc" data-column_name="keyword">
                     <span uk-icon="arrow-up"></span>
                     <span uk-icon="arrow-down"></span>
                     Keyword
                  </th>
                  @if(!in_array('start_rank',$table_settings))
                  <th class="liveKeyword_sorting" data-sorting_type="asc" data-column_name="start_ranking">
                     <span uk-icon="arrow-up"></span>
                     <span uk-icon="arrow-down"></span>
                     Start
                  </th>
                  @endif
                  @if(!in_array('page',$table_settings))
                  <th class="liveKeyword_sorting" data-sorting_type="asc" data-column_name="currentPosition">
                     <span uk-icon="arrow-up"></span>
                     <span uk-icon="arrow-down"></span>
                     <img src="{{URL::asset('public/vendor/internal-pages/images/google-icon.png')}}">
                     Page
                  </th>
                  @endif
                  @if(!in_array('google_rank',$table_settings))
                  <th class="liveKeyword_sorting" data-sorting_type="asc" data-column_name="currentPosition">
                     <span uk-icon="arrow-up"></span>
                     <span uk-icon="arrow-down"></span>
                     <img src="{{URL::asset('public/vendor/internal-pages/images/google-icon.png')}}">
                     Rank
                  </th>
                  @endif
                  @if(!in_array('oneday',$table_settings))
                  <th class="liveKeyword_sorting" data-sorting_type="asc" data-column_name="oneday_position">
                     <span uk-icon="arrow-up"></span>
                     <span uk-icon="arrow-down"></span>
                     1 Day
                  </th>
                  @endif
                  @if(!in_array('weekly',$table_settings))
                  <th class="liveKeyword_sorting" data-sorting_type="asc" data-column_name="one_week_ranking">
                     <span uk-icon="arrow-up"></span>
                     <span uk-icon="arrow-down"></span>
                     7 Days
                  </th>
                  @endif
                  @if(!in_array('monthly',$table_settings))
                  <th class="liveKeyword_sorting" data-sorting_type="asc" data-column_name="monthly_ranking">
                     <span uk-icon="arrow-up"></span>
                     <span uk-icon="arrow-down"></span>
                     30 Days
                  </th>
                  @endif
                  @if(!in_array('lifetime',$table_settings))
                  <th class="liveKeyword_sorting" data-sorting_type="asc" data-column_name="life_ranking">
                     <span uk-icon="arrow-up"></span>
                     <span uk-icon="arrow-down"></span>
                     Life
                  </th>
                  @endif
                  @if(!in_array('competition',$table_settings))
                  <th class="liveKeyword_sorting" data-sorting_type="asc" data-column_name="cmp">
                     <span uk-icon="arrow-up"></span>
                     <span uk-icon="arrow-down"></span>
                     Comp
                  </th>
                  @endif
                  @if(!in_array('sv',$table_settings))
                  <th class="liveKeyword_sorting" data-sorting_type="asc" data-column_name="sv">
                     <span uk-icon="arrow-up"></span>
                     <span uk-icon="arrow-down"></span>
                     S Vo
                  </th>
                  @endif
                  @if(!in_array('date',$table_settings))
                  <th class="liveKeyword_sorting" data-sorting_type="asc" data-column_name="created_at">
                     <span uk-icon="arrow-up"></span>
                     <span uk-icon="arrow-down"></span>
                     Date Added
                  </th>
                  @endif
                  @if(!in_array('url',$table_settings))
                  <th class="liveKeyword_sorting" data-sorting_type="asc" data-column_name="result_url">
                     <span uk-icon="arrow-up"></span>
                     <span uk-icon="arrow-down"></span>
                     URL
                  </th>
                  @endif
               </tr>
            </thead>
            <tbody>
             @if(isset($live_keywords) && !empty($live_keywords) && count($live_keywords) > 0)
             @foreach($live_keywords as $key=>$value)
             <?php
             if($value->currentPosition  < 100){
               $pageNo = $value->currentPosition/10;
               if($pageNo <= 1){
                  $pages = 1;
               }elseif($pageNo <= 2){
                  $pages = 2;
               }elseif($pageNo <= 3){
                  $pages = 3;
               }elseif($pageNo <= 4){
                  $pages = 4;
               }elseif($pageNo <= 5){
                  $pages = 5;
               }elseif($pageNo <= 6){
                  $pages = 6;
               }elseif($pageNo <= 7){
                  $pages = 7;
               }elseif($pageNo <= 8){
                  $pages = 8;
               }elseif($pageNo <= 9){
                  $pages = 9;
               }elseif($pageNo <= 10){
                  $pages = 10;
               }else{
                  $pages = 10;
               }
            }else{
               $pages = 10;
            }

            $img = $value->get_flag_data($value->region);

            ?>

            <tr class="<?php if($key%2 == 0){ echo 'even';}else{ echo 'odd';} if($value->is_favorite == 1){ echo ' active';}?>">
               <td>
                  <div class="flex">
                     <i class="fa fa-star"></i>
                     @if(!empty($img))
                     <figure class="keyword-flag-icon" uk-tooltip="title: {{$value->region}}; pos: top-left">
                        <img src="{{$img}}">
                     </figure>
                     @endif
                     <figure class="location-icon" uk-tooltip="title: {{$value->canonical}}; pos: top-left">
                        <img src="{{URL::asset('public/vendor/internal-pages/images/location-icon.png')}}">
                     </figure>
                     <h6 uk-tooltip="title: {{$value->keyword}}; pos: top-left"><a href="javascript:;">{{$value->keyword}}</a>
                     </h6>
                     <div class="icons-list fixed">
                        @if($role_id != 4)
                        @if($value->is_favorite == 1)
                        <a href="javascript:;" class="mark_favorite" uk-tooltip="title:Unfavorite this keyword; pos: top-center" data-id="{{$value->id}}" data-request_id="{{$value->request_id}}">
                           <i class="fa fa-star"></i>
                        </a>
                        @else
                        <a href="javascript:;" class="mark_favorite" uk-tooltip="title:Favorite this keyword; pos: top-center" data-id="{{$value->id}}" data-request_id="{{$value->request_id}}">
                           <i class="fa fa-star-o"></i>
                        </a>
                        @endif
                        @endif
                        <a href="javascript:;" class="downArrow chart-icon" uk-tooltip="title:Show Historical Chart; pos: top-center"
                        data-toggle="collapse" data-target=".chartRow{{$key+1}}" data-id="{{$value->id}}" data-request_id="{{$value->request_id}}"data-row_id="{{$key+1}}"><i class="fa fa-area-chart"></i></a>
                        <a href="{{$value->result_se_check_url}}" uk-tooltip="title:See the keyword in search results; pos: top-center" target="_blank">
                           <i class="fa fa-search"></i>
                        </a>
                     </div>
                  </div>
               </td>
               @if(!in_array('start_rank',$table_settings))
               <td class="<?php if($value->startPosition >= 100){ echo 'grey';}?>" data-id="{{$value->id}}" data-value="<?php if($value->startPosition > 100){ echo '>100';}else{ echo $value->startPosition; } ?>" >
                  @if($value->startPosition != null && $value->startPosition < 100)
                  {{$value->startPosition}}
                  @else
                  {{'>100'}}
                  @endif
               </td>
               @endif
               @if(!in_array('page',$table_settings))<td class="<?php if($pages > 10){ echo 'grey';}?>">{{$pages}}</td>@endif
               @if(!in_array('google_rank',$table_settings))
               <td class="<?php if($value->currentPosition >= 100){ echo 'grey';}?>">
                  @if($value->get_position_type($value->request_id,$value->id) == '1')
                  <i class="icon ion-flag" uk-tooltip="title:Local Pack; pos: top-center"></i>
                  @elseif($value->get_position_type($value->request_id,$value->id) == '2')
                  <i class="icon ion-android-bookmark" uk-tooltip="title:Featured Snippet; pos: top-center"></i>
                  @endif
                  @if($value->currentPosition != null && $value->currentPosition < 100)
                  {{$value->currentPosition}}
                  @else
                  {{'>100'}}
                  @endif
               </td>
               @endif
               @if(!in_array('oneday',$table_settings))
               <td>
                  @if($value->oneDayPostion != null && $value->oneDayPostion > 0)
                  <i class="icon ion-arrow-up-a"></i>
                  {{$value->oneDayPostion}}
                  @elseif($value->oneDayPostion != null && $value->oneDayPostion < 0)
                  <i class="icon ion-arrow-down-a"></i>
                  {{trim($value->oneDayPostion,'-')}}
                  @else
                  {{'-'}}
                  @endif
               </td>
               @endif
               @if(!in_array('oneday',$table_settings))
               <td>
                  @if($value->weekPostion != null && $value->weekPostion > 0)
                  <i class="icon ion-arrow-up-a"></i>
                  {{$value->weekPostion}}
                  @elseif($value->weekPostion != null && $value->weekPostion < 0)
                  <i class="icon ion-arrow-down-a"></i>
                  {{trim($value->weekPostion,'-')}}
                  @else
                  {{'-'}}
                  @endif
               </td>
               @endif
               @if(!in_array('monthly',$table_settings))
               <td>
                  @if($value->monthPostion != null && $value->monthPostion > 0)
                  <i class="icon ion-arrow-up-a"></i>
                  {{$value->monthPostion}}
                  @elseif($value->monthPostion != null && $value->monthPostion < 0)
                  <i class="icon ion-arrow-down-a"></i>
                  {{trim($value->monthPostion,'-')}}
                  @else
                  {{'-'}}
                  @endif
               </td>
               @endif
               @if(!in_array('lifetime',$table_settings))
               <td>
                @if($value->lifeTime != null && $value->lifeTime > 0)
                <i class="icon ion-arrow-up-a"></i>
                {{$value->lifeTime}}
                @elseif($value->lifeTime != null && $value->lifeTime < 0)
                <i class="icon ion-arrow-down-a"></i>
                {{trim($value->lifeTime,'-')}}
                @else
                {{'-'}}
                @endif
             </td>
             @endif
             @if(!in_array('competition',$table_settings))<td>{{number_format((float)$value->cmp, 2, '.', '')}}</td>@endif
             @if(!in_array('sv',$table_settings))<td>{{$value->sv}}</td>@endif
             @if(!in_array('date',$table_settings))<td>{{date('d-M-Y', strtotime($value->created_at))}}</td>@endif
             @if(!in_array('url',$table_settings))<td><a href="{{$value->result_url}}" target="_blank">{{parse_url($value->result_url,PHP_URL_PATH)}}</a></td>@endif
          </tr>

          @endforeach

          @else
          <tr><td>No Records found</td></tr>
          @endif
       </tbody>
    </table>
 </div>

 <input type="hidden" name="hidden_page_liveKeyword" id="hidden_page_liveKeyword" value="1" />
 <input type="hidden" name="hidden_column_name_liveKeyword" id="hidden_column_name_liveKeyword" value="currentPosition" />
 <input type="hidden" name="hidden_sort_type_liveKeyword" id="hidden_sort_type_liveKeyword" value="asc" />
 <input type="hidden" name="limit_liveKeyword" id="limit_liveKeyword" value="200" />



 <div class="keyword_graph_section">
   @if(isset($live_keywords) && !empty($live_keywords) && count($live_keywords) > 0)
   @foreach($live_keywords as $l_key=>$l_value)
   <div class="pdf-graph-section {{($l_key%3===0)?'page-break noBreakBefore':''}}">
      <p class="campaign_name">{{$l_value->keyword.' ('.$l_value->region.')'}}</p>
      <div class="graph_keyword">
         <?php 
         $row_id = $l_key+1;
         $data = App\KeywordSearch::live_keyword_chart_data($l_value->request_id,$l_value->id,'-90 days');
         ?>

         <canvas id="pdf_graph{{$row_id}}" height="220"></canvas>
         <script>
            var color = Chart.helpers.color;

            var KeywordconfigChart<?php echo $row_id;?> = {
              type: 'line',
              data: {
                datasets: [
                {
                  label: '',
                  yAxisID: 'lineId',
                  backgroundColor: color(window.chartColors.orange).alpha(1.5).rgbString(),
                  borderColor: window.chartColors.orange,
                  data:[],
                  pointRadius: 4,
                  fill: false,
                  lineTension: 0,
                  borderWidth: 1
               }
               ]
            },
            options: {
             maintainAspectRatio:false,
             scales: {
               xAxes: [{
                 type: 'time',
                 distribution: 'series',
                 offset: true,
                 ticks: {
                   major: {
                     enabled: true,
                  },
                  source: 'data',
                  autoSkip: true,
                  autoSkipPadding: 30,
                  maxRotation: 0,
                  sampleSize: 30
               }

            }],
            yAxes: [
            {
              id: 'lineId',
              gridLines: {
                drawBorder: false
             },
             scaleLabel: {
                display: true,
                labelString: 'Rank'
             },
             ticks: {
                beginAtZero: false,
                reverse:true,
                suggestedMin: 0,
          // suggestedMax: 100,
          maxTicksLimit:4
       },
       position:'left'
    }
    ]
 },
 tooltips: {
   intersect: false,
   mode: 'index',
   callbacks: {
     label: function(tooltipItem, myData) {
       var label = myData.datasets[tooltipItem.datasetIndex].label || '';
       if (label) {
         label += ': ';
      }
      label += parseFloat(tooltipItem.value).toFixed(2);
      return label;
   },
   labelTextColor: function(context) {
    return '#000';
 }
},
backgroundColor:'rgb(255, 255, 255)',
titleFontColor:'#000'

},
legend:{
   display:false
}
}
};
if (window.myLineKeywordChart<?php echo $row_id;?>) {
   window.myLineKeywordChart<?php echo $row_id;?>.destroy();
}

var ctxs = document.getElementById('pdf_graph<?php echo $row_id;?>').getContext('2d');
window.myLineKeywordChart<?php echo $row_id;?> = new Chart(ctxs, KeywordconfigChart<?php echo $row_id;?>);

KeywordconfigChart<?php echo $row_id;?>.data.datasets[0].data = <?php echo json_encode($data["keyword"]);?>;
window.myLineKeywordChart<?php echo $row_id;?>.update();
</script>

</div>
</div>
@if($l_key===19) @break;@endif
@endforeach
@endif
</div>
</div>
</div>





</div>