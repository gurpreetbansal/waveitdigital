@include('includes.viewkey.sa-breadcrumb')
<div class="tabs site-audit-breadcrum">
    <ul class="breadcrumb-list">
        @if(isset($sitepanel) && $sitepanel == 'saudit')
        <li class="breadcrumb-item"><a href="javascript:;" class="saSeoHome"><i aria-hidden="true" class="fa fa-home"></i></a></li>
        <li class="uk-active breadcrumb-item">Site Audit</li>
        @else
        <li class="breadcrumb-item"><a href="javascript:;" data-id="{{ @$auditTask->task_id }}" class="sa-auditHome"><i aria-hidden="true" class="fa fa-home"></i></a></li>
        @endif
    </ul>

    <div class="btn-group">
        
       <!--  <a href="{{ url('/download/sa/pdf/'. @$auditTask->task_id .'/audit') }}" target="_blank" data-type="audit" class="btn icon-btn color-red generate-pdf" uk-tooltip="title: Generate PDF File; pos: top-center"><img src="{{URL::asset('public/vendor/internal-pages/images/pdf-icon.png')}}"></a> -->
        
        @if(isset($sitepanel) && $sitepanel == 'saudit')
        <a href="javascript:;" id="ShareKey" data-id="{{ @$campaign_id }}" data-type="audit-key" data-share-key="{{ @$auditTask->task_id }}" class="btn icon-btn color-purple" uk-tooltip="title: Generate Shared Key; pos: top-center" aria-expanded="false" ><img src="{{ URL::asset('/public/vendor/internal-pages/images/share-key-icon.png') }}"></a>
        @endif

    </div>
</div>

<div class="audit-summery">
    <div class="audit-white-box mb-40">
		<!-- <div class="progress-loader" style="display:block;" > </div> -->
        <div class="elem-flex">
        	<div class="elem-start">
                <div class="circle_percent ajax-loader" style="display:block;"></div>
                <div class="score-for">
                    <h2 class="ajax-loader h-50"></h2>
                    <p class="ajax-loader h-20"></p>
                    <ul class="ajax-loader h-20"></ul>
                    <a class="btn ajax-loader h-39" style="width: 140px;"></a>
                    <a class="btn ajax-loader h-39" style="width: 140px;"></a>
                </div>
            </div>
            <div class="elem-end">
            	<article>
            		<ul>
	                    <li class="ajax-loader h-20"></li>
	                    <li class="ajax-loader h-20"></li>
	                    <li class="ajax-loader h-20"></li>
            		</ul>
	                <ul>
	                    <li class="ajax-loader h-20"></li>
                        <li class="ajax-loader h-20"></li>
	                </ul>
        		</article>
    		</div>
    	</div>
	</div>

    <div class="audit-white-box mb-40 pa-0">
	    <div class="audit-box-head">
	        <h2 class="ajax-loader h-33" style="max-width: 400px;"></h2>
	    </div>
	    <div class="audit-box-body">
	        <table>
	            <tbody>
	                <tr>
	                    <td><div class="ajax-loader h-20" style="max-width: 200px;"></div></td>
	                    <td><div class="ajax-loader h-20" style="max-width: 200px;"></div></td>
	            	</tr>
	            	<tr>
	                    <td><div class="ajax-loader h-20" style="max-width: 200px;"></div></td>
	                    <td><div class="ajax-loader h-20" style="max-width: 200px;"></div></td>
	            	</tr>
	        	</tbody>
	        </table>
	    </div>
	    <div class="audit-box-foot">
	        <a class="ajax-loader h-20" style="display: inline-block; width: 90px;"></a>
        </div>
    </div>

    <div class="audit-white-box pa-0" id="PageLevelIssues">
        <div class="audit-box-head">
            <h2 class="ajax-loader h-33" style="max-width: 400px;"></h2>
        </div>
        <div class="audit-box-body">
            <div class="audit-stats">
                <a class="ajax-loader h-107"></a>
                <a class="ajax-loader h-107"></a>
                <a class="ajax-loader h-107"></a>
            </div>
            <div class="audit-issues">
                <ul class="uk-subnav uk-subnav-pill" uk-switcher="connect: .auditIssuesContainer">
                    <li class="uk-active"><a href="#" aria-expanded="true" class="ajax-loader h-39"></a></li>
                    <li><a href="#" aria-expanded="false" class="ajax-loader h-39"></a></li>
                    <li><a href="#" aria-expanded="false" class="ajax-loader h-39"></a></li>
                    <li><a href="#" aria-expanded="false" class="ajax-loader h-39"></a></li>
                    <li><a href="#" aria-expanded="false" class="ajax-loader h-39"></a></li>
                </ul>
                <div class="content">
                    <p class="ajax-loader h-20"></p>
                </div>
				<div class="tab-content">
                	<div class="uk-switcher auditIssuesContainer" style="touch-action: pan-y pinch-zoom;">
                    	<div class="uk-active">
                        	<table>
                        		<tbody>
	                        		<tr>
	                            		<td><div class="ajax-loader h-33"></div></td>
                            		</tr>
                            		<tr>
	                            		<td><div class="ajax-loader h-33"></div></td>
                            		</tr>
                            		<tr>
	                            		<td><div class="ajax-loader h-33"></div></td>
                            		</tr>
                            		<tr>
	                            		<td><div class="ajax-loader h-33"></div></td>
                            		</tr>
                            		<tr>
	                            		<td><div class="ajax-loader h-33"></div></td>
                            		</tr>
                            		<tr>
	                            		<td><div class="ajax-loader h-33"></div></td>
                            		</tr>
                            		<tr>
	                            		<td><div class="ajax-loader h-33"></div></td>
                            		</tr>
                            		<tr>
	                            		<td><div class="ajax-loader h-33"></div></td>
                            		</tr>
                            		<tr>
	                            		<td><div class="ajax-loader h-33"></div></td>
                            		</tr>
                            		<tr>
	                            		<td><div class="ajax-loader h-33"></div></td>
	                                </tr>
	                            </tbody>
                        	</table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
