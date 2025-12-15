$(document).ready(function () {

  $.ajaxSetup({
    beforeSend: function (xhr) {
      const token = localStorage.getItem("user_token");
      if (token) {
        xhr.setRequestHeader("Authentication", token);
      }
    }
  });

  var app = $.spapp({
    defaultView: "login",            
    templateDir: "Frontend/views/"
  });
  app.route({ view: "login", load: "login.html" });
  app.route({ view: "register", load: "register.html" });
  app.route({ view: "home", load: "home.html" });
  app.route({ view: "products", load: "products.html" });

  app.route({
    view: "admin",
    load: "admin.html",
    onReady: function () {
      if (!UserService.isAdmin()) {
        window.location.hash = "#home";
      }
    }
  });

  app.run();

  const token = localStorage.getItem("user_token");
  if (token) {
    window.location.hash = "#login";
  }
});
