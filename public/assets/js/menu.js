$(document).ready(function () {
  //   $("#m1").click(function () {
  //     $("#m1").addClass("active");
  //   });
  //   $(".active").addClass("text-gray-800 dark:text-gray-100");
  //   $(".active").append(
  //     '<span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>'
  //   );

  $("#login-button").click(function () {
    selectTab("dashboard");
    localStorage.setItem("tab", "dashboard");
  });
  // show the section active
  $("li>a").click(function () {
    selectTab($(this).attr("id"));
    localStorage.setItem("tab", $(this).attr("id"));
  });

  // On load
  const loadedTab = localStorage.getItem("tab");
  if (loadedTab) {
    selectTab(loadedTab);
  }

  function selectTab(tabId) {
    console.log(tabId);
    $("#" + tabId).removeClass("active");
    $("#" + tabId).addClass("text-gray-800 dark:text-gray-100 active");
    $("#" + tabId).append(
      '<span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>'
    );
  }
});
