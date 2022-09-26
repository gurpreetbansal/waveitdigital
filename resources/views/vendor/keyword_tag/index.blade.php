<div class="form-group m-height">
  @if(isset($keyword_tags) && count($keyword_tags) > 0)
  <label>Select Tags</label>
  @else
  <label>No tags to display</label>
  @endif
  <div class="checkbox-group" id="tag_listing">
    @if(isset($keyword_tags) && !empty($keyword_tags))
    @foreach($keyword_tags as $key_tag=>$value_tag)
    <label>
      <input type="checkbox" id="{{$value_tag->id}}" data-request-id="{{$value_tag->request_id}}">
      <span class="custom-checkbox"></span>
      {{$value_tag->tag}}
    </label>
    @endforeach
    @endif
  </div>
</div>
@if(isset($keyword_tags) && count($keyword_tags) > 0)
<div class="text-left btn-group start" id="apply_div">
  <input type="submit" class="btn blue-btn" value="Apply" id="apply_tag" disabled>
</div>
@else
<div class="text-left btn-group start" id="create_tag_div">
  <input type="submit" class="btn blue-btn" value="Create New tag" id="create_tag">
  <span id="display_type_tag">"name of the tag here..."</span>
</div>
@endif