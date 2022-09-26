@if(isset($summaryAuditPages['results'][$name]))
<li>
	<div class="uk-grid">
        <div class="uk-width-1-4">
        	<h5>
            	@include('vendor.audits.partials.status')
                {{ __('Character set') }}
            </h5>
        </div>
        <div class="uk-width-3-4">
        	@if($summaryAuditPages['results'][$name]['passed'])
        		<p>{{ __('The webpage has a charset value set.') }}</p>
                        <p><code>{{ $summaryAuditPages['results'][$name]['value'] }}</code></p>
                        
        	@else
        		@foreach($summaryAuditPages['results'][$name]['errors'] as $error => $details)
        		 @if($error == 'missing')
                               <p> {{ __('The webpage does not have a charset declared.') }} </p>
                        @endif
        		@endforeach
        	@endif
            	
        </div>
    </div>
</li>
@endif