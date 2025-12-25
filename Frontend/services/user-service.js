var UserService = {

  initLogin: function () {
  $("#loginForm").validate({
    rules: {
      email: {
        required: true,
        email: true
      },
      password: {
        required: true,
        minlength: 6
      }
    },
    messages: {
      email: {
        required: "Email is required",
        email: "Enter a valid email"
      },
      password: {
        required: "Password is required",
        minlength: "Minimum 6 characters"
      }
    },
    submitHandler: function (form) {
      const payload = {
        email: $("#loginEmail").val(),
        password: $("#loginPassword").val()
      };
      UserService.login(payload);
    }
  });
},
  login: function (payload) {
    $.blockUI({ message: "<h4>Logging in...</h4>" });

    $.ajax({
      url: "http://localhost/RijadPleho/Web-Programming-2/Backend/auth/login",
      type: "POST",
      contentType: "application/json",
      data: JSON.stringify(payload),
      success: function (response) {
        localStorage.setItem("user_token", response.data.token);
        $.unblockUI();
        window.location.hash = "#home";
      },
      error: function (xhr) {
        $.unblockUI();
        alert(xhr.responseText || "Invalid email or password");
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
