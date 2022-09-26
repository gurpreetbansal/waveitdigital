@extends('layouts.vendor_internal_pages')
@section('content')
<div class="main-data">
	@if($gtUser->gmb_id <> null)

	
	<!-- How customers search Row -->
	<div class="white-box pa-0 mb-40 white-box-handle">
		<div class="white-box-head">
		<div class="left">
			<div class="heading">
			<h2>How customers search for your business
				<span uk-tooltip="title: How customers search for your business - Summary Here...; pos: top-left"
				class="fa fa-info-circle"></span></h2>
			</div>
		</div>
		<div class="right">
			<div class="filter-list">
			<ul>
				<li>
				<button type="button" class="active">All</button>
				</li>
				<li>
				<button type="button">Last Week</button>
				</li>
				<li>
				<button type="button">One Month</button>
				</li>
				<li>
				<button type="button">Three Month</button>
				</li>
				<li>
				<button type="button">Six Month</button>
				</li>
				<li>
				<button type="button">Nine Month</button>
				</li>
				<li>
				<button type="button">One Year</button>
				</li>
				<li>
				<button type="button">Two Year</button>
				</li>
			</ul>
			</div>
		</div>
		</div>
		<div class="white-box-body">
		<div class="total-searches-box">
			<div class="elem-start">
			<img src="{{URL::asset('public/vendor/internal-pages/images/total-search-chart-dummy.png')}}">
			</div>
			<div class="elem-end">
			<ul>
				<li>
				<figure>
					<img src="{{URL::asset('public/vendor/internal-pages/images/green-pin-icon.png')}}">
				</figure>
				<h5>Direct</h5>
				<p>Customers who find your listing searching for your business name or address.</p>
				</li>
				<li>
				<figure>
					<img src="{{URL::asset('public/vendor/internal-pages/images/blue-search-icon.png')}}">
				</figure>
				<h5>Discovery</h5>
				<p>Customers who find your listing searching for a category, product, or service.</p>
				</li>
				<li>
				<figure>
					<img src="{{URL::asset('public/vendor/internal-pages/images/yellow-start-icon.png')}}">
				</figure>
				<h5>Branded</h5>
				<p>Customers who find your listing searching for a brand related to your business.</p>
				</li>
			</ul>
			</div>
		</div>
		</div>

	</div>
	<!-- How customers search Row End -->

	<!-- Where customers view your business Row -->
	<div class="white-box pa-0 mb-40 white-box-handle">
		<div class="white-box-head">
		<div class="left">
			<div class="heading">
			<h2>Where customers view your business on Google
				<span
				uk-tooltip="title: Where customers view your business on Google - Summary Here...; pos: top-left"
				class="fa fa-info-circle"></span></h2>
			</div>
		</div>
		<div class="right">
			<div class="filter-list">
			<ul>
				<li>
				<button type="button" class="active">All</button>
				</li>
				<li>
				<button type="button">Last Week</button>
				</li>
				<li>
				<button type="button">One Month</button>
				</li>
				<li>
				<button type="button">Three Month</button>
				</li>
				<li>
				<button type="button">Six Month</button>
				</li>
				<li>
				<button type="button">Nine Month</button>
				</li>
				<li>
				<button type="button">One Year</button>
				</li>
				<li>
				<button type="button">Two Year</button>
				</li>
			</ul>
			</div>
		</div>
		</div>
		<div class="white-box-body">
		<p>The Google services that customers use to find your business.</p>

		<div class="chart h-360">
			<img src="{{URL::asset('public/vendor/internal-pages/images/dummy-chart-img-gmb-1.png')}}">
		</div>
		</div>

	</div>
	<!-- Where customers view your business Row End -->

	<!-- Customer actions Row -->
	<div class="white-box pa-0 mb-40 white-box-handle">
		<div class="white-box-head">
		<div class="left">
			<div class="heading">
			<h2>Customer actions
				<span uk-tooltip="title: Customer actions - Summary Here...; pos: top-left"
				class="fa fa-info-circle"></span></h2>
			</div>
		</div>
		<div class="right">
			<div class="filter-list">
			<ul>
				<li>
				<button type="button" class="active">All</button>
				</li>
				<li>
				<button type="button">Last Week</button>
				</li>
				<li>
				<button type="button">One Month</button>
				</li>
				<li>
				<button type="button">Three Month</button>
				</li>
				<li>
				<button type="button">Six Month</button>
				</li>
				<li>
				<button type="button">Nine Month</button>
				</li>
				<li>
				<button type="button">One Year</button>
				</li>
				<li>
				<button type="button">Two Year</button>
				</li>
			</ul>
			</div>
		</div>
		</div>
		<div class="white-box-body">
		<p>The most common actions that customers take on your listing.</p>

		<div class="chart h-360">
			<img src="{{URL::asset('public/vendor/internal-pages/images/dummy-chart-img-gmb-2.png')}}">
		</div>
		</div>

	</div>
	<!-- Customer actions Row End -->

	<!-- Directions requests Row -->
	<div class="white-box pa-0 mb-40 white-box-handle">
		<div class="white-box-head">
		<div class="left">
			<div class="heading">
			<h2>Directions requests
				<span uk-tooltip="title: Customer actions - Summary Here...; pos: top-left"
				class="fa fa-info-circle"></span></h2>
			</div>
		</div>

		</div>
		<div class="white-box-body">
		<p>The areas where customers request directions to your business from.</p>

		<div class="direction-box">
			<div class="direction-box-list">
			<article>
				<h5>Wellington</h5>
				<p>11</p>
			</article>
			</div>
			<div class="direction-map-box">
			<iframe
				src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d99370.36297120778!2d-77.08461565053291!3d38.893709139480315!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89b7c6de5af6e45b%3A0xc2524522d4885d2a!2sWashington%2C%20DC%2C%20USA!5e0!3m2!1sen!2sin!4v1616671913885!5m2!1sen!2sin"
				style="border:0;" allowfullscreen="" loading="lazy"></iframe>
			</div>
		</div>

		</div>

	</div>
	<!-- Directions requests Row End -->

	<!-- Phone calls Row -->
	<div class="white-box pa-0 mb-40 white-box-handle">
		<div class="white-box-head">
		<div class="left">
			<div class="heading">
			<h2>Phone calls
				<span uk-tooltip="title: Customer actions - Summary Here...; pos: top-left"
				class="fa fa-info-circle"></span></h2>
			</div>
		</div>
		<div class="right">
			<div class="filter-list">
			<ul>
				<li>
				<button type="button" class="active">All</button>
				</li>
				<li>
				<button type="button">Last Week</button>
				</li>
				<li>
				<button type="button">One Month</button>
				</li>
				<li>
				<button type="button">Three Month</button>
				</li>
				<li>
				<button type="button">Six Month</button>
				</li>
				<li>
				<button type="button">Nine Month</button>
				</li>
				<li>
				<button type="button">One Year</button>
				</li>
				<li>
				<button type="button">Two Year</button>
				</li>
			</ul>
			</div>
		</div>
		</div>
		<div class="white-box-body">
		<p>When and how many times customers call your business.</p>

		<div class="chart h-360">
			<img src="{{URL::asset('public/vendor/internal-pages/images/dummy-chart-img-gmb-3.png')}}">
		</div>
		</div>

	</div>
	<!-- Phone calls Row End -->

	<!-- Popular times Row -->
	<div class="white-box pa-0 mb-40 white-box-handle">
		<div class="white-box-head">
		<div class="left">
			<div class="heading">
			<h2>Popular times
				<span uk-tooltip="title: Customer actions - Summary Here...; pos: top-left"
				class="fa fa-info-circle"></span></h2>
			</div>
		</div>

		</div>
		<div class="white-box-body">
		<div class="no-data">
			<p>Not enough data</p>
		</div>
		</div>

	</div>
	<!-- Popular times Row End -->

	<!-- Photo views Row -->
	<div class="white-box pa-0 mb-40 white-box-handle">
		<div class="white-box-head">
		<div class="left">
			<div class="heading">
			<h2>Photo views
				<span uk-tooltip="title: Customer actions - Summary Here...; pos: top-left"
				class="fa fa-info-circle"></span></h2>
			</div>
		</div>
		<div class="right">
			<div class="filter-list">
			<ul>
				<li>
				<button type="button" class="active">All</button>
				</li>
				<li>
				<button type="button">Last Week</button>
				</li>
				<li>
				<button type="button">One Month</button>
				</li>
				<li>
				<button type="button">Three Month</button>
				</li>
				<li>
				<button type="button">Six Month</button>
				</li>
				<li>
				<button type="button">Nine Month</button>
				</li>
				<li>
				<button type="button">One Year</button>
				</li>
				<li>
				<button type="button">Two Year</button>
				</li>
			</ul>
			</div>
		</div>
		</div>
		<div class="white-box-body">
		<p>The number of times your business photos have been viewed, compared to photos from other businesses.
		</p>

		<div class="chart h-360">
			<img src="{{URL::asset('public/vendor/internal-pages/images/dummy-chart-img-gmb-4.png')}}">
		</div>
		</div>

		<div class="white-box-foot">
		<p><img src="{{URL::asset('public/vendor/internal-pages/images/blue-camera-icon.png')}}"> Your photos receive 76.2% fewer views than similar
			businesses.</p>
		</div>

	</div>
	<!-- Photo views Row End -->

	<!-- Photo quantity Row -->
	<div class="white-box pa-0 mb-40 white-box-handle">
		<div class="white-box-head">
		<div class="left">
			<div class="heading">
			<h2>Photo quantity
				<span uk-tooltip="title: Customer actions - Summary Here...; pos: top-left"
				class="fa fa-info-circle"></span></h2>
			</div>
		</div>
		</div>
		<div class="white-box-body">
		<p>The number of photos that appear on your business, compared to photos from other businesses.</p>

		<div class="chart h-360">
			<img src="{{URL::asset('public/vendor/internal-pages/images/dummy-chart-img-gmb-5.png')}}">
		</div>
		</div>

	</div>
	<!-- Photo quantity Row End -->

	@else
	<div class="white-box mb-40 ">
		<!-- <div class="loader h-33 "></div> -->
		<div class="integration-list" >
			<article>
				<figure>
					<img src="{{URL::asset('public/vendor/internal-pages/images/gmb-img.png')}}">
				</figure>
				<div>
					<p>To get insights about SERP, keywords and build reports for your GMB dashboard.</p>
					<a href="javascript:;" class="btn btn-border blue-btn-border">Coming Soon</a>
				</div>

			</article>
		</div>
	</div>

	@endif
</div>
@endsection