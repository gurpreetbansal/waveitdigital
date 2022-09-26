<aside class="sidebar">
    <div class="logo">
        <a href="{{ $profile_data <> null ? url('/project-detail/'.$profile_data->share_key) : '#' }}">
            <img src="{{URL::asset('public/front/img/logo.svg')}}" alt="Logo">
        </a>
    </div>

    <nav>
        <div class="uk-navbar-item">
            <form action="javascript:void(0)">
                <input type="text" placeholder="Search..." class="projects_autocomplete">
                <div class="refresh-search-icon" id="refresh-sidebar-search">
                    <span uk-icon="refresh"></span>
                </div>
                <a href="javascript:;" class="sidebar-search-clear"><span class="clear-input sidebarClear" uk-icon="icon: close;"></span></a>
                <button type="submit"><span uk-icon="icon:search"></span></button>
            </form>
        </div>
       
        @php
            @$key = array_search($summaryAudit->url, array_column($summaryAudit->pages->toArray(), 'url'));
        @endphp
        <ul class="uk-nav-default uk-nav-parent-icon" >
            <li class="uk-parent uk-open">
                <a uk-tooltip="title:{{ $summaryAudit->project }}; pos: top-left" href="{{ url('/audit/page/detail') }}/{{ $summaryAudit->share_key }}/{{ $summaryAudit->pages[$key]->id }}">
                    <figure><img src="{{URL::asset('public/vendor/internal-pages/images/project-icon.png')}}" alt="Projects"></figure> <span> {{ $summaryAudit->project }} </span>
                </a>

                <ul class="uk-nav-sub" id="defaultCampaignList">
                    @foreach($summaryAudit->pages as $key => $value)
                    @if(parse_url($value->url, PHP_URL_PATH) !== '/' && parse_url($value->url, PHP_URL_PATH) !== '')
                    <li uk-tooltip="title:{{ $value->url }}; pos: top-left" class="{{ $pageId == $value->id ? 'active' : '' }}">
                        <a href="{{ url('/audit/page/detail') }}/{{ $summaryAudit->share_key }}/{{ $value->id }}">{{ parse_url($value->url, PHP_URL_PATH) }}</a>
                    </li>
                    @endif
                    @endforeach
                </ul>
            </li>
        </ul>
    </nav>
</aside>