<div class="floatingDiv">
 	<div id="facebookHeading"></div>
</div>
<div class="single">
	<div class="head">
		<h2><img src="{{url('public/vendor/internal-pages/images/social-likes-icon.png')}}" alt> Likes</h2>
		<p class="social_range"></p>
	</div>
	<div class="grid-tab">
	    <div uk-grid class="uk-grid">
	        <div class="uk-width-1-4 ">
	    		<div class="white-box facebook_totallikes_loader">
	    			<h5><span>Total Likes<i uk-tooltip="title: It shows your page’s fan growth from the last week, month, or quarter. It allows you to see the number of likes you had recently" class="fa fa-info-circle" title="" aria-expanded="false"></i></span></h5>
	    			<div class="total-likes">
	    				<h6>
	    					<img src="{{url('public/vendor/internal-pages/images/social-likes-icon.png')}}" alt> 
	    					<span class="likes-count ajax-loader">0</span>
	    				</h6>
	    				<p class="likes-percent-loader ajax-loader">
	    					<i class="icon  likepercenticon"></i> 
	    					<span class="likes-percent"></span>
	    				</p>
	    			</div>
	    		</div>
	        </div>
	        <div class="uk-width-1-2 ">
	    		<div class="white-box">
	    			<h5><span>Audience Growth <i uk-tooltip="title: The bar chart shows the exact number of organic and paid likes in several previous months." class="fa fa-info-circle" title="" aria-expanded="false"></i></span></h5>
	                <div class="chart facebook_agelikes_loader ajax-loader">
	                	<canvas id="organicPaidFblikes"></canvas>
	                </div>
	    		</div>
	        </div>
	        
	       
	        <div class="uk-width-1-4">
	    		<div class="white-box ">
	    			<h5><span>Organic vs Paid Likes <i uk-tooltip="title: Hovering over the graph, you’ll know the number of paid and organic likes over the months at a particular date" class="fa fa-info-circle" title="" aria-expanded="false"></i></span></h5>
	                <div class="chart facebook_organicpaidlikes_loader ajax-loader">
	                	<div id="organicPaidFblikestotal" data-value="" class="donaught-total-text">
		    				<div>
		    					<p></p>
		    				</div>
		    			</div>
	                	<canvas id="organicPaidFblikesdonaught"></canvas>
	                </div>
	    		</div>
	        </div>
	         <div class="uk-width-1-4 ">
	    		<div class="white-box ">
	    			<h5><span>Gender<i uk-tooltip="title: This gives you an insight into the gender distribution of your targeted audience. Once you hover over the pie chart, you’ll get to know the exact number and percentage of both genders." class="fa fa-info-circle" title="" aria-expanded="false"></i></span></h5>
	                <div class="chart facebook_genderlikes_loader ajax-loader">
	                	<div id="fbgenderlikesDonaughttotal" data-value="" class="donaught-total-text">
		    				<div>
		    					<p></p>
		    				</div>
		    			</div>
	                	<canvas id="likesFbGender"></canvas>
	                </div>
	    		</div>
	        </div>

	        <div class="uk-width-3-4 ">
	    		<div class="white-box">

	    			<h5>
	    				<span>
	    					Age
	    					<i uk-tooltip="title: It shows the age distribution of your targeted audience. Current and previous, both the audience aspects will be displayed here" class="fa fa-info-circle" title="" aria-expanded="false"></i>
	    				</span>
	    			</h5>
	                <div class="chart facebook_organicpaidlikes_loader ajax-loader">
	                	<canvas id="likesFbGenderBar"></canvas>
	                </div> 
	    		</div>
	        </div>
	        
	        <div class="uk-width-1-3">
	    		<div class="white-box">
	            	<h5>
	            		<span>
	            			Top Countries
	    					<i uk-tooltip="title: It shows the top countries from where your major target audience comes and the exact number of people from each country as well." class="fa fa-info-circle" title="" aria-expanded="false"></i>
	        			</span>
	        		</h5>
	            	<div class="table-data ajax-loader">
	                    <table>
	                        <tbody id="fbCountryLikesTable" class="stopScroll">
	                        	@for($i = 0; $i < 5; $i++)
	                                <tr>
	                                    <td class="ajax-loader">....</td>
	                                    <td class="ajax-loader">....</td>
	                                </tr>
	                            @endfor
	                        </tbody>
	                    </table>
	                </div>
	    		</div>
	        </div>
	        <div class="uk-width-1-3">
	    		<div class="white-box ">
	            	<h5>
	            		<span>
	            			Top Cities
	    					<i uk-tooltip="title: The cities where your audience is concentrated are depicted here. And, you’ll also get the number of people coming from each city." class="fa fa-info-circle" title="" aria-expanded="false"></i>
	        			</span>
	        		</h5>                                	
	                <div class="table-data ajax-loader">
	                    <table>
	                        <tbody id="fbCitiesLikesTable" class="stopScroll">
	                        	@for($i = 0; $i < 5; $i++)
	                                <tr>
	                                    <td class="ajax-loader">....</td>
	                                    <td class="ajax-loader">....</td>
	                                </tr>
	                            @endfor
	                        </tbody>
	                    </table>
	                </div>
	    		</div>
	        </div>
	        <div class="uk-width-1-3">
	    		<div class="white-box ">
	            	<h5>
	            		<span>
	            			Top Languages
	    					<i uk-tooltip="title: This aspect depicts the number of people who like your posts, speaking different languages." class="fa fa-info-circle" title="" aria-expanded="false"></i>
	        			</span>
	        		</h5>
	                <div class="table-data ajax-loader">
	                    <table>
	                        <tbody id="fbLanguageLikesTable" class="stopScroll">
	                        	@for($i = 0; $i < 5; $i++)
	                                <tr>
	                                    <td class="ajax-loader">....</td>
	                                    <td class="ajax-loader">....</td>
	                                </tr>
	                            @endfor
	                        </tbody>
	                    </table>
	                </div>
	    		</div>
	        </div>
	    </div>
	</div>
</div>