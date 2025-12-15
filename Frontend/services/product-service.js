var ProductService = {

  getAll: function (callback) {
    $.ajax({
      url: Constants.PROJECT_BASE_URL + "products",
      type: "GET",
      success: callback,
      error: function () {
        alert("Failed to load products");
      }
    });
  },

  create: function (payload, callback) {
    $.ajax({
      url: Constants.PROJECT_BASE_URL + "products",
      type: "POST",
      data: JSON.stringify(payload),
      contentType: "application/json",
      success: callback,
      error: function () {
        alert("Only admins can create products");
      }
    });
  },

  delete: function (id, callback) {
    $.ajax({
      url: Constants.PROJECT_BASE_URL + "products/" + id,
      type: "DELETE",
      success: callback,
      error: function () {
        alert("Only admins can delete products");
      }
    });
  }
};
