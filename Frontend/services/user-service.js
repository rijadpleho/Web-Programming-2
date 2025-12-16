var UserService = {

  init: function () {
    const token = localStorage.getItem("user_token");

    if (!token) {
      window.location.hash = "#login";
      return;
    }

    this.generateMenuItems();
  },

  initLogin: function () {
    $("#loginForm").off("submit").on("submit", function (e) {
      e.preventDefault();

      const payload = {
        email: $("#loginEmail").val(),
        password: $("#loginPassword").val()
      };

      UserService.login(payload);
    });
  },

  login: function (payload) {
    $.ajax({
      url: "http://localhost/RijadPleho/Web-Programming-2/Backend/auth/login",
      type: "POST",
      data: JSON.stringify(payload),
      contentType: "application/json",
      dataType: "json",

      success: function (response) {
        if (!response || !response.data || !response.data.token) {
          alert("Login failed");
          return;
        }

        localStorage.setItem("user_token", response.data.token);
        window.location.hash = "#home";
      },

      error: function () {
        alert("Invalid email or password");
      }
    });
  },

  logout: function () {
    localStorage.removeItem("user_token");
    window.location.hash = "#login";
  },

  initRegister: function () {
    $("#registerForm").off("submit").on("submit", function (e) {
      e.preventDefault();

      const payload = {
        email: $("#regEmail").val(),
        password: $("#regPassword").val()
      };

      console.log("REGISTER PAYLOAD:", payload);

      UserService.register(payload);
    });
  },

  register: function (payload) {
    $.ajax({
      url: "http://localhost/RijadPleho/Web-Programming-2/Backend/auth/register",
      type: "POST",
      data: JSON.stringify(payload),
      contentType: "application/json",
      dataType: "json",

      success: function () {
        alert("Registration successful! Please log in.");
        window.location.hash = "#login";
      },

      error: function (xhr) {
        alert(xhr.responseText || "Registration failed");
      }
    });
  },

  isAdmin: function () {
    const token = localStorage.getItem("user_token");
    if (!token) return false;

    const payload = JSON.parse(atob(token.split(".")[1]));
    return payload.user.role === "admin";
  },

  generateMenuItems: function () {
    const token = localStorage.getItem("user_token");
    const payload = JSON.parse(atob(token.split(".")[1]));

    let nav = `
      <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
      <li class="nav-item"><a class="nav-link" href="#products">Products</a></li>
    `;

    let main = `
      <section id="home"></section>
      <section id="products"></section>
    `;

    if (payload.user.role === "admin") {
      nav += `<li class="nav-item"><a class="nav-link" href="#admin">Admin</a></li>`;
      main += `<section id="admin"></section>`;
    }

    nav += `
      <li class="nav-item">
        <a class="nav-link text-danger" href="#" onclick="UserService.logout()">Logout</a>
      </li>
    `;

    $("#tabs").html(nav);
    $("#spapp").html(main);
  }
};
