// Show loading overlay when ajax request starts
$(document).ajaxStart(function () {
  $(".loading-overlay").show();
});

// Hide loading overlay when ajax request completes
$(document).ajaxStop(function () {
  $(".loading-overlay").hide();
});

function searchFilter(page_num) {
  page_num = page_num ? page_num : 0;
  let keywords = $("#keywords").val();
  let myCheckboxes = new Array();
  $("input:checked").each(function () {
    myCheckboxes.push($(this).val());
  });
  console.log(keywords);
  $.ajax({
    type: "POST",
    url: "getData.php",
    data:
      "page=" + page_num + "&keywords=" + keywords + "&sortBy=" + myCheckboxes,
    beforeSend: function () {
      $(".loading-overlay").show();
    },
    success: function (html) {
      $("#postContent").html(html);
      $(".loading-overlay").fadeOut("slow");
    },
  });
}
