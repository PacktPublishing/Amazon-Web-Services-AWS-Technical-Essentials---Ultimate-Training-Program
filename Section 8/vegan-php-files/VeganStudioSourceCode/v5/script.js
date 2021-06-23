$(document).ready(function () {
  $("#submit-contest").on("click", function () {
    var name = $("#name").val();
    var email = $("#email").val();
    var recipe_name = $("#recipe_name").val();
    var ingredients = $("#ingredients").val();
    var method = $("#method").val();
    var region = $("#region").val();

    var form = new FormData();

    form.append("name", name);
    form.append("email", email);
    form.append("recipe_name", recipe_name);
    form.append("ingredients", ingredients);
    form.append("method", method);
    form.append("region", region);
    form.append("action", "contest");

    var settings = {
      async: true,
      crossDomain: true,
      url: "/v4/action.php",
      method: "POST",
      headers: {
        "cache-control": "no-cache",
        "postman-token": "ffd8155a-836b-fa50-3257-bca97d8fb95a",
      },
      processData: false,
      contentType: false,
      mimeType: "multipart/form-data",
      data: form,
    };

    $.ajax(settings).done(function (response) {
      console.log(response);
    });
  });
});
