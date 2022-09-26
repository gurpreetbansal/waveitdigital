@extends('layouts.vendor_internal_pages')
@section('content')

<style type="text/css">
	div#projectdetailheader {
	    display: none;
	}
</style>

<div class="project-detail-body">
	<div class="keywords-page">
		<div class="white-box keywordSearchDetail">
			<div class="keywordSearch-inner">
				<div class="uk-flex">
					<h3>Keyword Explorer</h3>
					<nav class="btn-group">
						<a href="javascript:;" class="btn icon-btn color-blue" uk-tooltip="title: Search; pos: top-center" title="" aria-expanded="false">
							<span uk-icon="search"></span>
						</a>
						<a href="javascript:;" class="btn icon-btn color-orange" uk-tooltip="title: Lists; pos: top-center" title="" aria-expanded="false">
							<span uk-icon="list"></span>
						</a>
						<a href="javascript:;" class="btn icon-btn color-red" uk-tooltip="title: History; pos: top-center" title="" aria-expanded="false">
							<span uk-icon="history"></span>
						</a>
					</nav>
				</div>
				<ul class="uk-subnav uk-subnav-pill" uk-switcher="connect: .searchContainer">
				    <li>
				    	<a href="#searchKeyword">Search by keyword</a>
				    </li>
				    <li>
				    	<a href="#searchDomain">Search by domain</a>
				    </li>
				</ul>
				<ul class="uk-switcher searchContainer">
					<li id="searchKeyword">
						<form class="uk-flex">
							<div class="form-group">
								<span class="icon"><img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/keyword-seach-icon.png" alt=""></span>
								<input type="text" class="form-control" placeholder="Enter keyword" name="keyword">
							</div>
							<div class="form-group">
								<span class="icon"><img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/keyword-location-icon.png" alt=""></span>
								<select name="location" class="selectpicker">								
									<option>Anywhere</option>
									<option>Location 1</option>
									<option>Location 2</option>
									<option>Location 3</option>
									<option>Location 4</option>
								</select>
							</div>
							<div class="form-group">
								<span class="icon"><img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/keyword-language-icon.png" alt=""></span>
								<select name="language" class="selectpicker">								
									<option>Any Language</option>
									<option>Language 1</option>
									<option>Language 2</option>
									<option>Language 3</option>
									<option>Language 4</option>
								</select>
							</div>
							<div class="form-group">
								<button type="submit" class="btn blue-btn">Find keywords</button>
							</div>
						</form>
					</li>
					<li id="searchDomain">
						<form class="uk-flex">
							<div class="form-group">
								<span class="icon"><img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/keyword-seach-icon.png" alt=""></span>
								<input type="text" class="form-control" placeholder="Enter domain or URL" name="keyword">
							</div>
							<div class="form-group">
								<span class="icon"><img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/keyword-location-icon.png" alt=""></span>
								<select name="location" class="selectpicker">								
									<option>Anywhere</option>
									<option>Location 1</option>
									<option>Location 2</option>
									<option>Location 3</option>
									<option>Location 4</option>
								</select>
							</div>
							<div class="form-group">
								<button type="submit" class="btn blue-btn">Find keywords</button>
							</div>
						</form>
					</li>
				</ul>

				<div class="list-result" style="display: none;">
					<div class="uk-flex">
						<h3><i class="fa fa-star"></i> List: <strong>test seo</strong></h3>
						<div class="right">
							<div class="uk-inline">
							    <button class="btn" type="button"><i class="fa fa-cog"></i> Action <i class="fa fa-caret-down"></i></button>
							    <div uk-dropdown="mode: click">
							    	<nav>
							    		<a href="javascript:void(0)"><i class="fa fa-pencil"></i> Rename</a>
							    		<a href="javascript:void(0)"><i class="fa fa-trash"></i> Delete</a>
							    	</nav>
							    </div>
							</div>
						</div>
					</div>
					<div class="list-boxes">
						<div uk-grid>
						    <div class="uk-width-1-4@l">
						    	<div class="single">
						    		<h5>50,000</h5>
						    		<p>Search sum</p>
						    	</div>
						    </div>
						    <div class="uk-width-1-4@l">
						    	<div class="single">
						    		<h5>$32.57</h5>
						    		<p>Avg. CPC</p>
						    	</div>
						    </div>
						    <div class="uk-width-1-4@l">
						    	<div class="single">
						    		<h5>30</h5>
						    		<p>Avg. PPC</p>
						    	</div>
						    </div>
						    <div class="uk-width-1-4@l">
						    	<div class="single">
						    		<h5>50</h5>
						    		<p>Avg. KD</p>
						    	</div>
						    </div>
						</div>
					</div>
				</div>

				<div class="project-table-cover keywordsTable">
					<div class="project-table-body">
						<table>
							<thead>
								<tr>
									<th>
										<input class="uk-checkbox" type="checkbox">
									</th>
									<th class="sorting" data-sorting_type="asc">
										<span uk-icon="arrow-up"></span>
										<span uk-icon="arrow-down"></span>
										Keywords
									</th>
									<th class="sorting" data-sorting_type="asc">
										<span uk-icon="arrow-up"></span>
										<span uk-icon="arrow-down"></span>
										Trend
									</th>
									<th class="sorting" data-sorting_type="asc">
										<span uk-icon="arrow-up" ></span>
										<span uk-icon="arrow-down" ></span>
										Search
									</th>
									<th class="sorting" data-sorting_type="asc">
										<span uk-icon="arrow-up" ></span>
										<span uk-icon="arrow-down" ></span>
										<font>Top of page bid <small>( low range )</small></font>
									</th>
									<th class="sorting" data-sorting_type="asc">
										<span uk-icon="arrow-up" ></span>
										<span uk-icon="arrow-down" ></span>
										<font>Top of page bid <small>( high range )</small></font>
									</th>
									<th class="sorting" data-sorting_type="asc">
										<span uk-icon="arrow-up" ></span>
										<span uk-icon="arrow-down"></span>
										PPC
									</th>
									<th class="sorting" data-sorting_type="asc">
										<span uk-icon="arrow-up" ></span>
										<span uk-icon="arrow-down"></span>
										CI
									</th>
								</tr>
							</thead>
							<tbody>

								<tr class="empty-section" style="display: none;">
									<td colspan="8">
							        	<div class="inner">
								        	<h5>Sorry, no related keywords found</h5>
								        	<p>How about trying different seed keyword, location or language?</p>
								        </div>
									</td>
								</tr>

								<tr>
									<td>
										<input class="uk-checkbox" type="checkbox">
									</td>
									<td>
										<div class="uk-flex">
											<a href="javascript:void(0)" class="marked active">
												<i class="fa fa-star"></i>
											</a>
											<p class="keyword-name">
												seo agency
											</p>
											<a href="javascript:void(0)" class="copy">
												<i class="fa fa-clone"></i>
											</a>
										</div>
									</td>
									<td>
										<div class="bar-canvas">
											<img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/keyword-bars.png" alt="">
										</div>
									</td>
									<td>30,100</td>
									<td>$17.03</td>
									<td>$17.03</td>
									<td>31</td>
									<td>
										<span class="count low">46</span>
									</td>
								</tr>
								<tr>
									<td>
										<input class="uk-checkbox" type="checkbox">
									</td>
									<td>
										<div class="uk-flex">
											<a href="javascript:void(0)" class="marked active">
												<i class="fa fa-star"></i>
											</a>
											<p class="keyword-name">
												seo agency
											</p>
											<a href="javascript:void(0)" class="copy">
												<i class="fa fa-clone"></i>
											</a>
										</div>
									</td>
									<td>
										<div class="bar-canvas">
											<img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/keyword-bars.png" alt="">
										</div>
									</td>
									<td>30,100</td>
									<td>$17.03</td>
									<td>$17.03</td>
									<td>31</td>
									<td>
										<span class="count medium">46</span>
									</td>
								</tr>
								<tr>
									<td>
										<input class="uk-checkbox" type="checkbox">
									</td>
									<td>
										<div class="uk-flex">
											<a href="javascript:void(0)" class="marked active">
												<i class="fa fa-star"></i>
											</a>
											<p class="keyword-name">
												seo agency
											</p>
											<a href="javascript:void(0)" class="copy">
												<i class="fa fa-clone"></i>
											</a>
										</div>
									</td>
									<td>
										<div class="bar-canvas">
											<img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/keyword-bars.png" alt="">
										</div>
									</td>
									<td>30,100</td>
									<td>$17.03</td>
									<td>$17.03</td>
									<td>31</td>
									<td>
										<span class="count high">46</span>
									</td>
								</tr>								
								<tr class="active">
									<td>
										<input class="uk-checkbox" type="checkbox">
									</td>
									<td>
										<div class="uk-flex">
											<a href="javascript:void(0)" class="marked active">
												<i class="fa fa-star"></i>
											</a>
											<p class="keyword-name">
												seo agency
											</p>
											<a href="javascript:void(0)" class="copy">
												<i class="fa fa-clone"></i>
											</a>
										</div>
									</td>
									<td>
										<div class="bar-canvas">
											<img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/keyword-bars-colored.png" alt="">
										</div>
									</td>
									<td>30,100</td>
									<td>$17.03</td>
									<td>$17.03</td>
									<td>31</td>
									<td>
										<span class="count high">46</span>
									</td>
								</tr>								
								<tr class="disabled">
									<td>
										<input class="uk-checkbox" type="checkbox">
									</td>
									<td>
										<div class="uk-flex">
											<a href="javascript:void(0)" class="marked active">
												<i class="fa fa-star"></i>
											</a>
											<p class="keyword-name">
												seo agency
											</p>
											<a href="javascript:void(0)" class="copy">
												<i class="fa fa-clone"></i>
											</a>
										</div>
									</td>
									<td>
										<div class="bar-canvas">
											<img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/keyword-bars-nill.png" alt="">
										</div>
									</td>
									<td><span class="nill">N/A</span></td>
									<td><span class="nill">N/A</span></td>
									<td><span class="nill">N/A</span></td>
									<td><span class="nill">N/A</span></td>
									<td>
										<span class="count high">46</span>
									</td>
								</tr>
								<tr>
									<td>
										<input class="uk-checkbox" type="checkbox">
									</td>
									<td>
										<div class="uk-flex">
											<a href="javascript:void(0)" class="marked active">
												<i class="fa fa-star"></i>
											</a>
											<p class="keyword-name">
												seo agency
											</p>
											<a href="javascript:void(0)" class="copy">
												<i class="fa fa-clone"></i>
											</a>
										</div>
									</td>
									<td>
										<div class="bar-canvas">
											<img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/keyword-bars.png" alt="">
										</div>
									</td>
									<td>30,100</td>
									<td>$17.03</td>
									<td>$17.03</td>
									<td>31</td>
									<td>
										<span class="count low">46</span>
									</td>
								</tr>
								<tr>
									<td>
										<input class="uk-checkbox" type="checkbox">
									</td>
									<td>
										<div class="uk-flex">
											<a href="javascript:void(0)" class="marked">
												<i class="fa fa-star"></i>
											</a>
											<p class="keyword-name">
												seo agency
											</p>
											<a href="javascript:void(0)" class="copy">
												<i class="fa fa-clone"></i>
											</a>
										</div>
									</td>
									<td>
										<div class="bar-canvas">
											<img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/keyword-bars.png" alt="">
										</div>
									</td>
									<td>30,100</td>
									<td>$17.03</td>
									<td>$17.03</td>
									<td>31</td>
									<td>
										<span class="count medium">46</span>
									</td>
								</tr>
								<tr>
									<td>
										<input class="uk-checkbox" type="checkbox">
									</td>
									<td>
										<div class="uk-flex">
											<a href="javascript:void(0)" class="marked">
												<i class="fa fa-star"></i>
											</a>
											<p class="keyword-name">
												seo agency
											</p>
											<a href="javascript:void(0)" class="copy">
												<i class="fa fa-clone"></i>
											</a>
										</div>
									</td>
									<td>
										<div class="bar-canvas">
											<img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/keyword-bars.png" alt="">
										</div>
									</td>
									<td>30,100</td>
									<td>$17.03</td>
									<td>$17.03</td>
									<td>31</td>
									<td>
										<span class="count high">46</span>
									</td>
								</tr>
								<tr>
									<td>
										<input class="uk-checkbox" type="checkbox">
									</td>
									<td>
										<div class="uk-flex">
											<a href="javascript:void(0)" class="marked">
												<i class="fa fa-star"></i>
											</a>
											<p class="keyword-name">
												seo agency
											</p>
											<a href="javascript:void(0)" class="copy">
												<i class="fa fa-clone"></i>
											</a>
										</div>
									</td>
									<td>
										<div class="bar-canvas">
											<img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/keyword-bars.png" alt="">
										</div>
									</td>
									<td>30,100</td>
									<td>$17.03</td>
									<td>$17.03</td>
									<td>31</td>
									<td>
										<span class="count medium">46</span>
									</td>
								</tr>
								<tr>
									<td>
										<input class="uk-checkbox" type="checkbox">
									</td>
									<td>
										<div class="uk-flex">
											<a href="javascript:void(0)" class="marked">
												<i class="fa fa-star"></i>
											</a>
											<p class="keyword-name">
												seo agency
											</p>
											<a href="javascript:void(0)" class="copy">
												<i class="fa fa-clone"></i>
											</a>
										</div>
									</td>
									<td>
										<div class="bar-canvas">
											<img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/keyword-bars.png" alt="">
										</div>
									</td>
									<td>30,100</td>
									<td>$17.03</td>
									<td>$17.03</td>
									<td>31</td>
									<td>
										<span class="count high">46</span>
									</td>
								</tr>
								<tr>
									<td>
										<input class="uk-checkbox" type="checkbox">
									</td>
									<td>
										<div class="uk-flex">
											<a href="javascript:void(0)" class="marked">
												<i class="fa fa-star"></i>
											</a>
											<p class="keyword-name">
												seo agency
											</p>
											<a href="javascript:void(0)" class="copy">
												<i class="fa fa-clone"></i>
											</a>
										</div>
									</td>
									<td>
										<div class="bar-canvas">
											<img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/keyword-bars.png" alt="">
										</div>
									</td>
									<td>30,100</td>
									<td>$17.03</td>
									<td>$17.03</td>
									<td>31</td>
									<td>
										<span class="count medium">46</span>
									</td>
								</tr>
								<tr>
									<td>
										<input class="uk-checkbox" type="checkbox">
									</td>
									<td>
										<div class="uk-flex">
											<a href="javascript:void(0)" class="marked">
												<i class="fa fa-star"></i>
											</a>
											<p class="keyword-name">
												seo agency
											</p>
											<a href="javascript:void(0)" class="copy">
												<i class="fa fa-clone"></i>
											</a>
										</div>
									</td>
									<td>
										<div class="bar-canvas">
											<img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/keyword-bars.png" alt="">
										</div>
									</td>
									<td>30,100</td>
									<td>$17.03</td>
									<td>$17.03</td>
									<td>31</td>
									<td>
										<span class="count high">46</span>
									</td>
								</tr>
								<tr>
									<td>
										<input class="uk-checkbox" type="checkbox">
									</td>
									<td>
										<div class="uk-flex">
											<a href="javascript:void(0)" class="marked">
												<i class="fa fa-star"></i>
											</a>
											<p class="keyword-name">
												seo agency
											</p>
											<a href="javascript:void(0)" class="copy">
												<i class="fa fa-clone"></i>
											</a>
										</div>
									</td>
									<td>
										<div class="bar-canvas">
											<img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/keyword-bars.png" alt="">
										</div>
									</td>
									<td>30,100</td>
									<td>$17.03</td>
									<td>$17.03</td>
									<td>31</td>
									<td>
										<span class="count medium">46</span>
									</td>
								</tr>
								<tr>
									<td>
										<input class="uk-checkbox" type="checkbox">
									</td>
									<td>
										<div class="uk-flex">
											<a href="javascript:void(0)" class="marked">
												<i class="fa fa-star"></i>
											</a>
											<p class="keyword-name">
												seo agency
											</p>
											<a href="javascript:void(0)" class="copy">
												<i class="fa fa-clone"></i>
											</a>
										</div>
									</td>
									<td>
										<div class="bar-canvas">
											<img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/keyword-bars.png" alt="">
										</div>
									</td>
									<td>30,100</td>
									<td>$17.03</td>
									<td>$17.03</td>
									<td>31</td>
									<td>
										<span class="count high">46</span>
									</td>
								</tr>
								<tr>
									<td>
										<input class="uk-checkbox" type="checkbox">
									</td>
									<td>
										<div class="uk-flex">
											<a href="javascript:void(0)" class="marked">
												<i class="fa fa-star"></i>
											</a>
											<p class="keyword-name">
												seo agency
											</p>
											<a href="javascript:void(0)" class="copy">
												<i class="fa fa-clone"></i>
											</a>
										</div>
									</td>
									<td>
										<div class="bar-canvas">
											<img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/keyword-bars.png" alt="">
										</div>
									</td>
									<td>30,100</td>
									<td>$17.03</td>
									<td>$17.03</td>
									<td>31</td>
									<td>
										<span class="count medium">46</span>
									</td>
								</tr>
								<tr>
									<td>
										<input class="uk-checkbox" type="checkbox">
									</td>
									<td>
										<div class="uk-flex">
											<a href="javascript:void(0)" class="marked">
												<i class="fa fa-star"></i>
											</a>
											<p class="keyword-name">
												seo agency
											</p>
											<a href="javascript:void(0)" class="copy">
												<i class="fa fa-clone"></i>
											</a>
										</div>
									</td>
									<td>
										<div class="bar-canvas">
											<img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/keyword-bars.png" alt="">
										</div>
									</td>
									<td>30,100</td>
									<td>$17.03</td>
									<td>$17.03</td>
									<td>31</td>
									<td>
										<span class="count high">46</span>
									</td>
								</tr>
								<tr>
									<td>
										<input class="uk-checkbox" type="checkbox">
									</td>
									<td>
										<div class="uk-flex">
											<a href="javascript:void(0)" class="marked">
												<i class="fa fa-star"></i>
											</a>
											<p class="keyword-name">
												seo agency
											</p>
											<a href="javascript:void(0)" class="copy">
												<i class="fa fa-clone"></i>
											</a>
										</div>
									</td>
									<td>
										<div class="bar-canvas">
											<img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/keyword-bars.png" alt="">
										</div>
									</td>
									<td>30,100</td>
									<td>$17.03</td>
									<td>$17.03</td>
									<td>31</td>
									<td>
										<span class="count medium">46</span>
									</td>
								</tr>
								<tr>
									<td>
										<input class="uk-checkbox" type="checkbox">
									</td>
									<td>
										<div class="uk-flex">
											<a href="javascript:void(0)" class="marked">
												<i class="fa fa-star"></i>
											</a>
											<p class="keyword-name">
												seo agency
											</p>
											<a href="javascript:void(0)" class="copy">
												<i class="fa fa-clone"></i>
											</a>
										</div>
									</td>
									<td>
										<div class="bar-canvas">
											<img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/keyword-bars.png" alt="">
										</div>
									</td>
									<td>30,100</td>
									<td>$17.03</td>
									<td>$17.03</td>
									<td>31</td>
									<td>
										<span class="count high">46</span>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="star-tooltip">
						<div>
							<span>
								<a href="javascript:void(0)">
									<i class="fa fa-star"></i>
									<span>Demo</span>
								</a>
								<a href="javascript:void(0)" class="remove-from-list">
									<span uk-icon="close"></span>
								</a>
							</span>
							<span>
								<a href="#">
									<i class="fa fa-star"></i>
									This is a test message
								</a>
								<a href="javascript:void(0)" class="remove-from-list">
									<span uk-icon="close"></span>
								</a>
							</span>												
							<span>
								<a href="#">
									<i class="fa fa-star"></i>
									Only three words allowed
								</a>
								<a href="javascript:void(0)" class="remove-from-list">
									<span uk-icon="close"></span>
								</a>
							</span>
						</div>
					</div>					
					<div class="bar-canvas-popup">
						<div class="inner">
							<h6>seo agency</h6>
							<div class="canvas-graph">
								<img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/keyword-bar-canvas.jpg" alt="">
							</div>
						</div>
					</div>
					<div class="tableFooter">
						<div class="left">
							<strong>0/233</strong>
						</div>
						<div class="right">
							<a href="#add-keywords-list" class="btn" uk-toggle><i class="fa fa-star"></i> Add to list</a>
							<a href="javascript:void(0)" class="btn"><i class="fa fa-download"></i> Export <i class="fa fa-caret-down"></i></a>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>

<div id="add-keywords-list" class="keywordList-popup uk-flex-top" uk-modal>
	<div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical px-0">
		<div class="custom-scroll">
			<button class="uk-modal-close-default" type="button" uk-close></button>
			<h3><i class="fa fa-star"></i> Add keywords to a list</h3>
			<ul class="uk-subnav uk-subnav-pill" uk-switcher="connect: .listContainer">
			    <li>
			    	<a href="#existingList">Existing list</a>
			    </li>
			    <li>
			    	<a href="#newList">New list</a>
			    </li>
			</ul>
			<ul class="uk-switcher listContainer">
				<li id="existingList">					
			        <form class="searchBox">
						<div class="form-group gray-gradient">
							<span class="icon"><img src="https://imark.waveitdigital.com/public/vendor/internal-pages/images/keyword-seach-icon.png" alt=""></span>
							<input type="text" class="form-control" placeholder="Search for a list..." name="keyword">
						</div>
					</form>
					<ul class="list">
						<li class="active">
							<a href="javascript:void(0)">
								<h6>Keyword name</h6>
								<p><strong>25</strong> / 10,000</p>
							</a>
						</li>
						<li>
							<a href="javascript:void(0)">
								<h6>Keyword name</h6>
								<p><strong>25</strong> / 10,000</p>
							</a>
						</li>
						<li>
							<a href="javascript:void(0)">
								<h6>Keyword name</h6>
								<p><strong>25</strong> / 10,000</p>
							</a>
						</li>
						<li>
							<a href="javascript:void(0)">
								<h6>Keyword name</h6>
								<p><strong>25</strong> / 10,000</p>
							</a>
						</li>
						<li>
							<a href="javascript:void(0)">
								<h6>Keyword name</h6>
								<p><strong>25</strong> / 10,000</p>
							</a>
						</li>
						<li>
							<a href="javascript:void(0)">
								<h6>Keyword name</h6>
								<p><strong>25</strong> / 10,000</p>
							</a>
						</li>
						<li>
							<a href="javascript:void(0)">
								<h6>Keyword name</h6>
								<p><strong>25</strong> / 10,000</p>
							</a>
						</li>
						<li>
							<a href="javascript:void(0)">
								<h6>Keyword name</h6>
								<p><strong>25</strong> / 10,000</p>
							</a>
						</li>
						<li>
							<a href="javascript:void(0)">
								<h6>Keyword name</h6>
								<p><strong>25</strong> / 10,000</p>
							</a>
						</li>
						<li>
							<a href="javascript:void(0)">
								<h6>Keyword name</h6>
								<p><strong>25</strong> / 10,000</p>
							</a>
						</li>
					</ul>
					<button type="submit" class="btn blue-btn">Add keywords</button>
				</li>
				<li id="newList">
					<form action="/">
						<div class="searchBox">
							<div class="form-group">
								<input placeholder="e.g. Black coffee blog post 2020" required="" type="text">
							</div>
						</div>
						<button type="submit" class="btn blue-btn">Create list & Add keywords</button>
					</form>
				</li>
			</ul>
		</div>
	</div>
</div>

@endsection