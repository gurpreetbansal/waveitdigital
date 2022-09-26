(function ($) {
  'use strict';

  var LiveKeywordTable = $("body").find(".LiveKeywordTable table"),
    LiveKeywordTableRow = LiveKeywordTable.find("tr"),
    iconsList = LiveKeywordTableRow.find(".icons-list"),
    downArrow = iconsList.find(".downArrow"),
    compareDateForm = $("body").find(".compare-date-form"),
    compareDateRangeBtn = $("body").find("#compareDateRangeBtn"),
    compareDateToggle = $("body").find("#compareDateToggle"),
    compareDateInput = $("body").find("#compareDateInput");
  // ShareKeyBtn = $("body").find("#ShareKey"),
  //   CloseShareKey = $("body").find(".close-share-key");

  $(window).on("load", function () {
    setTimeout(function () {
      $('.loader').fadeOut(600, function () {
        $(this).remove();
      });
      $('.hiddenOnLoad').fadeIn(600, function () {
        $('div').removeClass("hiddenOnLoad");
      });

    }, 1000);
  });

  $("#AddKeywordsBtn").on("click", function () {
    $("body").find(".add-keywords-popup").toggleClass("open");
  });

  $(document).on("click", function (e) {
    if ($(e.target).is(".add-keywords-popup .add-keywords-popup-inner, #AddKeywordsBtn, .add-keywords-popup .add-keywords-popup-inner *") === false) {
      $(".add-keywords-popup").removeClass("open");
    }
  });

  $(document).ready(function () {
    $(".top-organic-keyword-table .table-responsive").mCustomScrollbar({
      axis: "y"
    });
    $(".sidebar nav ul.uk-nav-default:last-of-type .uk-nav-sub").mCustomScrollbar({
      axis: "y"
    });
    $(".project-table-body").mCustomScrollbar({
      axis: "x",
      setLeft: "-100px"
    });

    setTimeout(function () {
      $(".project-table-body .mCSB_container").css("left", 0);
    }, 2000);
  });

  LiveKeywordTableRow.each(function () {
    downArrow.on("click", function () {
      $(this).parent().toggleClass("active");
      $(this).find(".fa").toggleClass("fa-area-chart");
      $(this).find(".fa").toggleClass("fa-times");
    })
  });

  // ShareKeyBtn.on("click", function () {
  //   $(".share-key-popup").addClass("open");
  // });

  // CloseShareKey.on("click", function () {
  //   $(".share-key-popup").removeClass("open");
  // })

  // new ClipboardJS('.btn.share-key-btn');

  // $(".share-key-btn").on("click", function () {
  //   $(this).val("Copied!")
  // })

  $(".file-group input[type=file]").change(function () {
    var names = [];
    for (var i = 0; i < $(this).get(0).files.length; ++i) {
      names.push($(this).get(0).files[i].name);
    }

    if ($(".file-group input[type=file]").val()) {
      $(".file-group .form-control").addClass("selected");
      $(".file-group .form-control span").html(names);
    } else {
      $(".file-group .form-control").removeClass("selected");
      $(".file-group .form-control span").html("Profile Image");
    }

  });

  compareDateRangeBtn.on("click", function () {
    $(this).toggleClass("active");
    compareDateForm.toggleClass("open");
  })

  compareDateToggle.on("click", function () {
    if ($(this).is(":checked")) {
      compareDateInput.show(300);
    } else {
      compareDateInput.hide(200);
    }
  });


  $("[data-pd-popup-open]").on("click", function (e) {
    var targeted_popup_class = $(this).attr("data-pd-popup-open");
    $('[data-pd-popup="' + targeted_popup_class + '"]').fadeIn(100);
    $("body").addClass("popup-open");
    e.preventDefault();
  });

  $("[data-pd-popup-close]").on("click", function (e) {
    var targeted_popup_class = $(this).attr("data-pd-popup-close");
    $('[data-pd-popup="' + targeted_popup_class + '"]').fadeOut(200);
    $("body").removeClass("popup-open");
    e.preventDefault();
  });

  //Avoid pinch zoom on iOS
  document.addEventListener('touchmove', function (event) {
    if (event.scale !== 1) {
      event.preventDefault();
    }
  }, false);
})(jQuery)