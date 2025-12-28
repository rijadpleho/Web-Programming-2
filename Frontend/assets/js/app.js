$(document).ready(function () {

  $.ajaxSetup({
    beforeSend: function (xhr) {
      const token = localStorage.getItem("user_token");
      if (token) {
        xhr.setRequestHeader("Authentication", token);
      }
    }
  });

  const token = localStorage.getItem("user_token");
  if (token) {
    window.location.hash = "#login";
  }
});
