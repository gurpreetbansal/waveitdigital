<div class="main-data-pdf" id="ppcDashboard" uk-sortable="handle:.white-box-handle">
	
	<input type="hidden" class="account_id" value="{{@$account_id}}">
	<input type="hidden" class="campaign_id" value="{{@$campaign_id}}">	
		@include('viewkey.pdf.ppc_sections.summary')
		@include('viewkey.pdf.ppc_sections.summary_chart')
		@include('viewkey.pdf.ppc_sections.performance_chart')
		@include('viewkey.pdf.ppc_sections.campaigns_list')
		@include('viewkey.pdf.ppc_sections.ad_groups_list')
		@include('viewkey.pdf.ppc_sections.keywords_list')
		@include('viewkey.pdf.ppc_sections.ads_list')
		@include('viewkey.pdf.ppc_sections.ad_performance_network')
		@include('viewkey.pdf.ppc_sections.ad_performance_device')
		@include('viewkey.pdf.ppc_sections.ad_performance_clickType')
		@include('viewkey.pdf.ppc_sections.ad_performance_adSlot')
</div>		