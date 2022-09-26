(function ($) {
    'use strict';

    // $(".sidebar nav ul.uk-nav-default:last-of-type .uk-nav-sub").mCustomScrollbar({
    //   axis: "y",
    //    advanced:{
    //       updateOnContentResize: true
    //   }
    // });

    var LiveKeywordTable = $("body").find(".LiveKeywordTable table"),
    LiveKeywordTableRow = LiveKeywordTable.find("tr"),
    iconsList = LiveKeywordTableRow.find(".icons-list"),
    downArrow = iconsList.find(".downArrow");

    $(window).on("load", function () {
        setTimeout(function(){
            $('.preloader-wrapper').css('display','none');
        },1500);
        $('.loader').fadeOut(100, function () {
            $(this).removeClass('loader');
            $('.elem-right').removeClass('ajax-loader');
            $('.elem-left').removeClass('ajax-loader');
            $('.header-nav').removeClass('ajax-loader');
        });
        $('.hiddenOnLoad').fadeIn(100, function () {
            $('div').removeClass("hiddenOnLoad");
        });

        // $('.ajax-loader').removeClass('ajax-loader');
    });

    // $(document).ready(function () {
    //     $(".top-organic-keyword-table .table-responsive").mCustomScrollbar({
    //         axis: "y",
    //         mouseWheel: {
    //             enable: false
    //         },
    //         contentTouchScroll: true,
    //         advanced: {
    //             releaseDraggableSelectors: "table tr td"
    //         }
    //     });
    //     $(".project-table-body").mCustomScrollbar({
    //         axis: "x",
    //         setLeft: "-100px",
    //         mouseWheel: {
    //             enable: false
    //         },
    //         contentTouchScroll: true,
    //         // advanced: {
    //         //   releaseDraggableSelectors: "table tr td"
    //         // }
    //     });
    //     setTimeout(function () {
    //         $(".project-table-body .mCSB_container, checkActivity .table-responsive .mCSB_container").css("left", 0);
    //     }, 2000);
    //     $(".notes-list").mCustomScrollbar({
    //         axis: "y",
    //     });
    // });

    LiveKeywordTableRow.each(function () {
        downArrow.on("click", function () {
            $(this).parent().toggleClass("active");
            $(this).find(".fa").toggleClass("fa-area-chart");
            $(this).find(".fa").toggleClass("fa-times");
        })
    });

    $(".file-group input[type=file]").change(function () {
        var names = [];
        for (var i = 0; i < $(this).get(0).files.length; ++i) {
            names.push($(this).get(0).files[i].name);
        }
        if ($(".file-group input[type=file]").val()) {
            $(".file-group .form-control").addClass("selected");
            $(".file-group .form-control span.fileName").html(names);
        } else {
            $(".file-group .form-control").removeClass("selected");
            $(".file-group .form-control span.fileName").html("Profile Image");
        }
    });

    // setTimeout(function () {
    //     var PageHeight = $("main").innerHeight();
    //     $("main").css("min-height", PageHeight);
    // }, 3000);

    // $(document).ready(function () {
    //     var lastScrollTop = 1;
    //     $(window).scroll(function () {
    //         var st = $(this).scrollTop();
    //         if (st < lastScrollTop) {
    //             var totalHeight = 0;
    //             $("main").children().each(function () {
    //                 totalHeight = $(this).outerHeight();
    //             });
    //             $("main").css("min-height", totalHeight);
    //         }
    //     })
    // })

    $(".circle_percent").each(function () {
        var $this = $(this),
        $dataV = $this.data("percent"),
        $dataDeg = $dataV * 3.6,
        $round = $this.find(".round_per");
        $round.css("transform", "rotate(" + parseInt($dataDeg + 180) + "deg)");
        $this.append('<div class="circle_inbox"><span class="percent_text"></span>of 100</div>');
        $this.prop('Counter', 0).animate({
            Counter: $dataV
        }, {
            duration: 2000,
            easing: 'swing',
            step: function (now) {
                $this.find(".percent_text").text(Math.ceil(now) + "");
            }
        });
        if ($dataV >= 51) {
            $round.css("transform", "rotate(" + 360 + "deg)");
            setTimeout(function () {
                $this.addClass("percent_more");
            }, 1000);
            setTimeout(function () {
                $round.css("transform", "rotate(" + parseInt($dataDeg + 180) + "deg)");
            }, 1000);
        }
    });


    $(".audit-box-body .table-collapseed, .audit-box-body .table-audit-collapseed").hide();

    $(document).on("click",".show-more-issues", function () {
        $(".audit-box-body .table-collapseed").slideToggle();
        $(".show-more-issues").toggleClass("open");
        var Text = $(this).find("span.t")
        if (Text.text() == "Show More") {
            Text.text("Show Less");
        } else {
            Text.text("Show More");
        }
    })

    $(document).on("click",".show-more-audit-issues", function () {
        $(".audit-box-body .table-audit-collapseed").slideToggle();
        $(".show-more-audit-issues").toggleClass("open");
        var Text = $(this).find("span.t")
        if (Text.text() == "Show More") {
            Text.text("Show Less");
        } else {
            Text.text("Show More");
        }
    })

    $(".toggleMenuBtn").on("click", function () {
        $("aside.sidebar").toggleClass("close");
        $(".viewkey-sidebar").toggleClass("open");
        $(".viewkey-output").toggleClass("open");
        $(".overlayLayer").toggleClass("active");
        $("body").toggleClass("fullWidth");
        $(this).toggleClass("active");
    });

    $(document).on('click',".overlayLayer, .viewkey-sidebar .sideDashboardView",function () {

        $(".viewkey-sidebar").removeClass("open");
        $(".viewkey-output").removeClass("open");
        $(".overlayLayer").removeClass("active");
        $(".toggleMenuBtn").removeClass("active");
    });

    $(window).on("load resize", function (e) {
        checkScreenSize();
        checkMobileScreenSize();
    });

    checkScreenSize();
    checkMobileScreenSize();

    function checkScreenSize() {
        var newWindowWidth = $(window).width();
        if (newWindowWidth < 1199.98) {
            $('body').addClass('fullWidth');
            $('aside.sidebar').addClass('close');
        } else {
            $('body').removeClass('fullWidth');
            $('aside.sidebar').removeClass('close');
        }
    }

    function checkMobileScreenSize() {
        var newWindowWidth = $(window).width();
        if (newWindowWidth < 991) {
            $('body').find('.main-data').removeAttr("uk-sortable");
        } else {
            $('body').find('.main-data').attr("uk-sortable", "handle:.white-box-handle");
        }
    }

    $(document).on("click", "[data-pd-popup-open]", function (e) {
        var targeted_popup_class = $(this).attr("data-pd-popup-open");
        $('[data-pd-popup="' + targeted_popup_class + '"]').fadeIn(100);
        $("body").addClass("popup-open");
        e.preventDefault();
    });

    $(document).on("click", "[data-pd-popup-close]", function (e) {
        $("body").removeClass("popup-open");
        var targeted_popup_class = $(this).attr("data-pd-popup-close");
        $('[data-pd-popup="' + targeted_popup_class + '"]').fadeOut(10);
        e.preventDefault();
    });

    // $(document).on("click", "#openSearch", function (e) {
    //     $(".searchBox").toggleClass("uk-open");
    // });

    //   $('.project-search.style2 input.campaign_search').focus(function () {
    //     $(this).parent().addClass('open');
    // });
    //  /* .blur(function () {
    //     $(this).parent().removeClass('open');
    // });*/

    $(".showOtherChart").on("click", function () {
        $(".mainChartBox").addClass("hideMe");
        $(".mainChartBox").removeClass("showMe");
        $(".smallChartBox").addClass("showMe");
    });

    $(".showMainChartBox").on("click", function () {
        $(".mainChartBox").removeClass("hideMe");
        $(".mainChartBox").addClass("showMe");
        $(".smallChartBox").addClass("hideMe");
        $(".smallChartBox").removeClass("showMe");
    });

    $(".form-group").each(function () {
        var Label = $(this).find("label");
        if (Label.length >= 1) {
            Label.parent().addClass("hasLabel");
        }
    });
    

    // $(document).find("#campaign-list > tbody > tr").each(function () {
    //   var actionBtn = $(this).find(".actionBtn");

    //   console.log(actionBtn);

    //   actionBtn.on("click", function () {

    //     var posX = actionBtn.offset().left,
    //     posY = actionBtn.offset().top;

    //     console.log(posX);
    //     console.log(posY);


    //     $("#ProjectActions").css({
    //       "left": posX,
    //       "top": posY
    //     });
    //   })
    // })

    //Avoid pinch zoom on iOS
    // document.addEventListener('touchmove', function (event) {
    //     if (event.scale !== 1) {
    //         event.preventDefault();
    //     }
    // }, false);
})(jQuery);


function moveScroll() {
    var scroll = $(window).scrollTop();
    var anchor_top = $("#campaign-list").offset().top;
    var anchor_bottom = $("#bottom_anchor").offset().top;
    if (scroll > anchor_top && scroll < anchor_bottom) {
        clone_table = $("#clone");
        if (clone_table.length == 0) {
            $("<table id='clone'></table>").insertAfter(".campaignList #mCSB_1_container #campaign-list");

            clone_table = $("#campaign-list thead").clone();
            $("#clone").css({
                position: 'fixed',
                'pointer-events': 'none',
                top: 0
            });
            $("#clone").width($("#campaign-list").width());

            $(".campaignList #mCSB_1_container #clone").append(clone_table);

            $("#clone").css({
                visibility: 'hidden'
            });

            $("#clone thead").css({
                visibility: 'visible', 'pointer-events': 'auto',
            });

            $("#clone tbody tr td").css({
                border: 'none'
            });

            $("#campaign-list thead tr th").each(function () {
                var colname = $(this).data('column_name');
                var Width = $(this).width() + 15;
                var len = $('#campaign-list thead tr th').length;
                $("#clone thead tr th[data-column_name = '" + colname + "']").css("width", Width);

            });
        }
    } else {
        $("#clone").remove();
    }
}

var currentUrl = window.location.pathname;
if (currentUrl === '/dashboard') {
    $(window).scroll(moveScroll);
}

$(document).on('click', '#reached_project_limit', function () {
    $('#showProjectReachedPopup').trigger('click');
    $('#showProjectReachedPopup').css('display', 'block');
    $('body').addClass('popup-open');
});



/*May 11*/
// $(document).on('click', '.notificationAlert', function (e) {
//   $.ajax({
//     type: 'POST',
//     url: BASE_URL + '/ajax_save_alert_time',
//     data: {
//       _token: $('meta[name="csrf-token"]').attr('content')
//     },
//     dataType: 'json',
//     success: function (response) {
//       console.log(response);
//     }
//   });
//   // window.location.href = BASE_URL + '/alerts';
//   window.open(BASE_URL + '/alerts', '_blank');

// });

//back-to-top
(function () {
    $(document).ready(function () {
        return $(window).scroll(function () {
            return $(window).scrollTop() > 200 ? $("#back-to-top").addClass("show") : $("#back-to-top").removeClass("show")
        }), $("#back-to-top").click(function () {
            return $("html,body").animate({
                scrollTop: 0
            },300);
        })
    })
}).call(this);

/*August 11*/

$(document).on('click', '.notificationAlert', function () {
    var request_id = $(this).attr('data-campaign-id');
    $.ajax({
        type: 'POST',
        url: BASE_URL + '/ajax_save_alert_time',
        data: { _token: $('meta[name="csrf-token"]').attr('content'), request_id },
        dataType: 'json',
        success: function (response) {
            $('#notification-badge-count span:nth-child(2)').remove();
        }
    });
});



$(document).on('click', '#campaign-notification', function (e) {
   // e.preventDefault();
   var request_id = $(this).attr('data-campaign-id');
   var host_url = $(this).attr('data-host-url');
   if (host_url !== '') {
    var detailsWindow;
    detailsWindow = window.open(BASE_URL + '/alerts', '_blank');
    detailsWindow.onload = function () {
        detailsWindow.document.getElementById('alerts_search').value = host_url;
        detailsWindow.document.getElementById("alerts-search-clear").style.display = 'block';
    }
} else {
    window.open(BASE_URL + '/alerts', '_blank');
}
});


if($(document).find('#myObserver').length == 1){
    var observer = new IntersectionObserver(function(entries) {
        // no intersection with screen
        if(entries[0].intersectionRatio === 0)
            document.querySelector(".floatingDiv").classList.add("sticky");
        // fully intersects with screen
        else if(entries[0].intersectionRatio === 1)
            document.querySelector(".floatingDiv").classList.remove("sticky");
    }, { threshold: [0,1] });

    observer.observe(document.querySelector("#myObserver"));
}


$(document).on('click','.reset-share-key-btn',function(e){
    var project_id = $('.project-id').val();
    reset_share_key(project_id);
});

function reset_share_key(project_id){
    $.ajax({
        type: 'GET',
        url: BASE_URL + '/reset_share_key',
        data: {project_id},
        dataType: 'json',
        success: function (data) {
            $('.copy_share_key_value').val(data['link']);
            $('#ShareKey').attr('data-share-key',data['encrypted_id']);
        }
    });
}


// $(".star-tooltip").hover(
//     function () {
//         $(this).addClass("is_visible");
//     },
//     function () {
//         $(this).removeClass("is_visible");
//     }
// );
// $(".bar-canvas-popup").hover(
//     function () {
//         $(this).addClass("show_graph");
//     },
//     function () {
//         $(this).removeClass("show_graph");
//     }
// );

// $(".keywordsTable").find("table tbody > tr").each(function () {
//     var actionStarBtn = $(this).find("td .uk-flex a.marked.active");
//     var actionBtnCanvas = $(this).find("td .bar-canvas");
//     var actionCanvasPopup = $(".bar-canvas-popup");
//     var table = $(".keywordsTable");

//     actionStarBtn.hover(function () {
//         // $('.star-tooltip').html('<div><span><a href="javascript:void(0)"><i class="fa fa-star"></i><span>Demo</span></a><a href="javascript:void(0)" class="remove-from-list"><span uk-icon="close"></span></a></span><span><a href="#"><i class="fa fa-star"></i>This is a test message</a><a href="javascript:void(0)" class="remove-from-list"><span uk-icon="close"></span></a></span><span><a href="#"><i class="fa fa-star"></i>Only three words allowed</a><a href="javascript:void(0)" class="remove-from-list"><span uk-icon="close"></span></a></span></div>');
//         $(".star-tooltip").toggleClass("is_visible");

//         var Left = actionStarBtn.offset().left - table.offset().left - 10;
//         var Top = actionStarBtn.offset().top - table.offset().top - 3;

//         $(".star-tooltip").css({
//             "top": Top,
//             "left": Left
//         });
//     });

//     actionBtnCanvas.hover(function () {   
//         $(".bar-canvas-popup").toggleClass("show_graph");

//         var Left = actionBtnCanvas.offset().left - table.offset().left - (actionCanvasPopup.width() / 2) + (actionBtnCanvas.width() / 2);
//         var Top = actionBtnCanvas.offset().top - table.offset().top - actionCanvasPopup.height() - (actionBtnCanvas.height() / 2);

//         $(".bar-canvas-popup").css({
//             "top": Top,
//             "left": Left
//         });
//     });
// });

// $(document).ready(function () {     
//     var keywordsTable = $(".keywordsTable .project-table-body");
//     var tableFooter = $(".keywordsTable .tableFooter");
//     var windowHeight = $(window).height();
//     var maxHeight = windowHeight - keywordsTable.offset().top - tableFooter.height() - 60;

//     console.log(maxHeight);

//     keywordsTable.css('max-height', 'calc(100vh - ' + maxHeight+ 'px)');
// });


// $(document).ready(function() {
//     $('#hidden-datepicker').datepicker({
//       numberOfMonths: 3,
//       showButtonPanel: true
//     });
// });

