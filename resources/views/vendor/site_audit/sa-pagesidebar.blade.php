<h5 class="uk-text-medium">Filters</h5>
<div class="heading {{ $filter == '' ? 'active': ''  }}">
 <a href="{{ url('/audit-pages/'.$campaign_id) }}" > <span>All Pages</span> <span class="uk-float-right">{{ array_sum($errorsListing['critical']) + array_sum($errorsListing['warning']) + array_sum($errorsListing['notices']) }}</span> </a>
</div>
<?php $counterNotZero = $counterZero = 0; ?>
@foreach($errorsListing['critical'] as $key => $value)
@if($value > 0)
@if($counterNotZero == 0)
<ul class="all-pages-con">
    <li class="{{ $filter == 'critical' ? 'active': ''  }}" ><a href="javascript:;" class="light-red-bg p-1 saViewPages" data-id="{{ $campaign_id }}" data-filter="critical"><span class="uk-text-medium">All Criticals</span> <span class="no">{{ array_sum($errorsListing['critical']) }}</span></a></li>
    @endif         
    <li class="{{ $key == $filter ? 'active': ''  }}" > <a href="javascript:;" class="saViewPages" data-id="{{ $campaign_id }}" data-filter="{{ $key }}" > <span>{{ $auditLevel[$key] }}</span> <span class="no">{{ $value }}</span> </a></li>

    <?php $counterNotZero++; ?>
    @else

    @if($counterZero == 0)
</ul>
<ul uk-accordion class="accordion-all-criticals">
    <li>
        <div class="uk-accordion-content" style="display: none;">
            <ul class="all-pages-con">
                @endif            
                <li><span>{{ $auditLevel[$key] }}</span> <span class="no">{{ $value }}</span></li>
                <?php $counterZero++; ?>
                @endif
                @endforeach

            </ul>
        </div>
        <a class="uk-accordion-action accordion-all-criticals-title" href="javascript:;">Show zero criticals</a>
    </li>
</ul>

<?php $counterNotZero = $counterZero = 0; ?>
@foreach($errorsListing['warning'] as $key => $value)
@if($value > 0)
@if($counterNotZero == 0)
<ul class="all-pages-con">
    <li class="{{ $filter == 'warning' ? 'active': ''  }}" > <a href="javascript:;" class="light-orange-bg p-1 saViewPages"  data-id="{{ $campaign_id }}" data-filter="warning" > <span class="uk-text-medium">All Warnings</span> <span class="no">{{ array_sum($errorsListing['warning']) }}</span></a></li>
    @endif         
    <li class="{{ $key == $filter ? 'active': ''  }}" ><a href="javascript:;" class="saViewPages" data-id="{{ $campaign_id }}" data-filter="{{ $key }}" ><span>{{ $auditLevel[$key] }}</span> <span class="no">{{ $value }}</span></a></li>

    <?php $counterNotZero++; ?>
    @else

    @if($counterZero == 0)
</ul>
<ul uk-accordion class="accordion-all-warnings">
    <li>
        <div class="uk-accordion-content" style="display: none;">
            <ul class="all-pages-con">
                @endif            
                <li><span>{{ $auditLevel[$key] }}</span> <span class="no">{{ $value }}</span></li>
                <?php $counterZero++; ?>
                @endif


                @endforeach

            </ul>
        </div>
        <a class="uk-accordion-action accordion-all-warnings-title" href="javascript:;">Show zero warnings</a>
    </li>
</ul>

<?php $counterNotZero = $counterZero = 0; ?>
@foreach($errorsListing['notices'] as $key => $value)
@if($value > 0)
@if($counterNotZero == 0)
<ul class="all-pages-con">
    <li class="{{ $filter == 'notices' ? 'active': ''  }}" ><a href="javascript:;" class="light-blue-bg p-1 saViewPages" data-id="{{ $campaign_id }}" data-filter="notices" ><span class="uk-text-medium">All Notices</span> <span class="no">{{ array_sum($errorsListing['notices']) }}</span></a></li>
    @endif         
    <li class="{{ $key == $filter ? 'active': ''  }}" ><a href="javascript:;" class="saViewPages" data-id="{{ $campaign_id }}" data-filter="{{ $key }}" ><span>{{ $auditLevel[$key] }}</span> <span class="no">{{ $value }}</span></a></li>

    <?php $counterNotZero++; ?>
    @else

    @if($counterZero == 0)
</ul>
<ul uk-accordion class="accordion-all-notices">
    <li>
        <div class="uk-accordion-content" style="display: none;">
            <ul class="all-pages-con">
                @endif            
                <li><span>{{ $auditLevel[$key] }}</span> <span class="no">{{ $value }}</span></li>
                <?php $counterZero++; ?>
                @endif

                @endforeach
            </ul>
        </div>
        <a class="uk-accordion-action accordion-all-notices-title" href="javascript:;">Show zero notices</a>
    </li>
</ul>