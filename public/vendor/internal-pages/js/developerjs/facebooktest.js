$(document).ready(function(){
	var BASE_URL = $('.base_url').val();
	var campaignId = $('.campaignID').val();
	getPageLikes();

	function getPageLikes(){
		$.ajax({
			type:'GET',
			url: '/ajax_get_facebook_totalLikes_test',
			data:{campaignId},
			success:function(response){
				if(response.status == 1){
					$('.likes-count').text(response.result.total_likes);
					$('.likes-percent').text(response.result.percent);
				}
			}
		});
	}


	
	/*DateRange Filter*/
	$(document).on("click","#facebook_dateRange", function (e) {
		$(".dateRange-popup").toggleClass("show");
		 setTimeout(function(){
		    var start_date = $('.facebook_start_date').val();
		    var end_date = $('.facebook_end_date').val();
		    var start = moment(start_date);
		    var end = moment(end_date);
		    var label = $('.facebook_current_label').val();

		    $('#facebook_current_range').daterangepicker({
		      minDays : 2,
		      startDate: start,
		      endDate: end,
		      alwaysShowCalendars:true,
		      autoApply:true,
		      minDate: moment().subtract(2, 'year').subtract(1, 'days'),
		      maxDate: new Date(),
		      ranges: {
		       'One Month': [moment().subtract(1, 'month').subtract(1, 'days'), moment().subtract(1, 'days')],
		       'Three Month': [moment().subtract(3, 'month').subtract(1, 'days'), moment().subtract(1, 'days')],
		       'Six Month': [moment().subtract(6, 'month').subtract(1, 'days'), moment().subtract(1, 'days')],
		       'Nine Month': [moment().subtract(9, 'month').subtract(1, 'days'), moment().subtract(1, 'days')],
		       'One Year': [moment().subtract(1, 'year').subtract(1, 'days'), moment().subtract(1, 'days')],
		       'Two Year': [moment().subtract(2, 'year').subtract(1, 'days'), moment().subtract(1, 'days')]
		     }
		   }, current_picker);
		    facebook_current_picker(start, end,label);
		},100);
	});


	function current_picker(start, end,label = null) { 
	  var new_start = start.format('YYYY-MM-DD');
	  var new_end = end.format('YYYY-MM-DD');
	  $('.facebook_start_date').val(new_start);
	  $('.facebook_end_date').val(new_end);
	  if(label !== null){
	    $('.facebook_current_label').val(label);
	  }else{
	    $('.facebook_current_label').val('');
	  }
	  $('#facebook_current_range p').html(new_start + ' - ' + new_end);
	  
	  // var days = date_diff_indays(new_start, new_end);
	  // $('.comparison_days').val(days);
	  // if($('#sc_comparison').val() === 'previous_period'){
	  //   var prev_start_date = getdate(new_start, (days-1));
	  //   var prev_end_date = getdate(new_start, -1);
	  //   var prev_days = date_diff_indays(prev_start_date, prev_end_date);
	  //   $('.sc_prev_start_date').val(prev_start_date);
	  //   $('.sc_prev_end_date').val(prev_end_date);
	  //   $('.prev_comparison_days').val(prev_days);
	  //   initialisePreviousCalendar(prev_start_date,prev_end_date);
	  // }else if($('#sc_comparison').val() === 'previous_year'){
	    // console.log('new_start '+new_start);
	    // console.log('new_end '+new_end);
	    // var prev_sd = createPreviousYear(new_start);
	    // var prev_ed = createPreviousYear(new_end);
	    // $('.sc_prev_start_date').val(prev_sd);
	    // $('.sc_prev_end_date').val(prev_ed);
	    // initialisePreviousCalendar(prev_sd,prev_ed);
	  // }
	}


	function initialisePreviousCalendar(prev_start,prev_end){
	  previous_picker(prev_start, prev_end);
	}


	function date_diff_indays(date1, date2) {
	  var x = new Date(date1);
	  var y = new Date(date2);
	  return diffInDays = Math.floor((x - y) / (1000 * 60 * 60 * 24));
	}

});


