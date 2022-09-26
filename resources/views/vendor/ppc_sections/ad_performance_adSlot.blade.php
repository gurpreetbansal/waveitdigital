 <!-- Performance Ad Slot Row -->
 <div class="white-box pa-0 mb-40">
  <div class="white-box-head">
    <div class="left">
      <div class="heading">
        <img src="{{URL::asset('public/vendor/internal-pages/images/google-ads-icon.png')}}">
        <h2>Performance Ad Slots
          <span uk-tooltip="title:  It show how your ads are performing depending on the where they are being displayed.; pos: top-left" class="fa fa-info-circle"
          title="" aria-expanded="false"></span>
        </h2>
      </div>
    </div>
  </div>

  <div class="white-box-body">
    <div class="project-table-cover">
      <div class="project-table-head">
        <div class="project-entries ajax-loader">
          <label>Show
           <select id="performance_adSlot_limit">
            <option value="20">20</option>
            <option value="50">50</option>
            <option value="100">100</option>
          </select>
        entries</label>
      </div>
      <div class="project-search ajax-loader">
        <form>
          <input type="text" placeholder="Search..." class="performance-adSlot-search" onkeydown="return (event.keyCode!=13);">
          <div class="refresh-search-icon" id="refresh-performanceAdSlot-search"><span uk-icon="refresh"></span></div>
          <a href="javascript:;" class="performanceAdSlot-search-clear"><span class="clear-input performanceAdSlotClear" uk-icon="icon: close;"></span></a>
          <button type="submit" onclick="return false;"><span uk-icon="icon: search" class="uk-icon"></span></button>
        </form>
      </div>
    </div>

    <div class="project-table-body AdGroupsTable">
      <table id="performance-adSlot-list">
        <thead>
          <tr>
            <th class="ad_performance_adSlot_sorting ajax-loader" data-sorting_type="desc" data-column_name="ad_slot">
              <span uk-icon="arrow-up" class="uk-icon"></span>
              <span uk-icon="arrow-down" class="uk-icon"></span>
              Ad Slot
            </th>
            <th class="ad_performance_adSlot_sorting ajax-loader" data-sorting_type="desc" data-column_name="impressions">
              <span uk-icon="arrow-up" class="uk-icon"></span>
              <span uk-icon="arrow-down" class="uk-icon"></span>
              Impressions
            </th>
            <th  class="ad_performance_adSlot_sorting ajax-loader" data-sorting_type="desc" data-column_name="clicks">
              <span uk-icon="arrow-up" class="uk-icon"></span>
              <span uk-icon="arrow-down" class="uk-icon"></span>
              Clicks
            </th>
            <th  class="ad_performance_adSlot_sorting ajax-loader" data-sorting_type="desc" data-column_name="ctr">
              <span uk-icon="arrow-up" class="uk-icon"></span>
              <span uk-icon="arrow-down" class="uk-icon"></span>
              CTR
            </th>
            <th class="ad_performance_adSlot_sorting ajax-loader" data-sorting_type="desc" data-column_name="cost">
              <span uk-icon="arrow-up" class="uk-icon"></span>
              <span uk-icon="arrow-down" class="uk-icon"></span>
              Cost
              <span class="ads-currency">(USD)</span>
            </th>
            <th class="ad_performance_adSlot_sorting ajax-loader" data-sorting_type="desc" data-column_name="conversions">
              <span uk-icon="arrow-up" class="uk-icon"></span>
              <span uk-icon="arrow-down" class="uk-icon"></span>
              Conversions
            </th>
          </tr>
        </thead>
        <tbody>
          @for($i=1; $i<=5; $i++)
          <tr>
            <td class="ajax-loader">.....</td>
            <td class="ajax-loader">.....</td>
            <td class="ajax-loader">.....</td>
            <td class="ajax-loader">.....</td>
            <td class="ajax-loader">.....</td>
            <td class="ajax-loader">.....</td>
          </tr>
          @endfor
        </tbody>
      </table>
      <input type="hidden" id="hidden_performance_adSlot_limit" value="20">
      <input type="hidden" id="hidden_performance_adSlot_page" value="1">
      <input type="hidden" id="hidden_performance_adSlot_column_name" value="impressions">
      <input type="hidden" id="hidden_performance_adSlot_sort_type" value="desc">
    </div>

    <div class="project-table-foot" id="performance-adSlot-foot">

    </div>


  </div>
</div>

</div>
            <!-- Performance Ad Slot Row End -->