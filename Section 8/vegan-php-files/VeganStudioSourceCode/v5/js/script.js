$(document).ready(function () {
  //Load data
  loadContest();
  //send data
});
function loadContest() {
  var settings = {
    async: true,
    crossDomain: true,
    url: "/action.php?action=contest",
    method: "GET",
    dataType: "JSON",
    headers: {
      "content-type": "application/json",
      "cache-control": "no-cache",
    },
  };
  $("#contest-items").html("");
  $.ajax(settings).done(function (response) {
    // console.log(response);
    $.map(response, function (row, index) {
      // console.log(row);
      $template =
        '<section class="contest-wrap clearfix">' +
        '<ul class="clearfix"><li>NAME:<b>' +
        row.name +
        "</b></li><li>REGION:<b>" +
        row.region +
        "</b></li><li>RECIPE NAME:<b>" +
        row.recipe_name +
        "</b></li></ul>" +
        '<aside class="col">' +
        "<h3>INGREDIENTS</h3>" +
        "<p>" +
        row.ingredients +
        "</p>" +
        "</aside>" +
        '<aside class="col">' +
        "<h3>METHOD</h3>" +
        "<p>" +
        row.method +
        "</p>" +
        "</aside>" +
        "</section>";

      $("#contest-items").append($template);
    });
  });
}

function submitForm(e) {
  var validForm = $("#contest-form")[0].checkValidity();
  // e.preventDefault();
  // console.log(validForm);
  var name = $("#name").val();
  var email = $("#email").val();
  var recipe_name = $("#recipe_name").val();
  var ingredients = $("#ingredients").val();
  var method = $("#method").val();
  var region = $("#region").val();

  $("#name,#email,#recipe_name,#ingredients,#method,#region").val("");

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
    url: "/action.php",
    method: "POST",
    headers: {
      "cache-control": "no-cache",
      "postman-token": "ffd8155a-836b-fa50-3257-bca97d8fb95a",
    },
    processData: false,
    contentType: false,
    mimeType: "multipart/form-data",
    data: form,
    dataType: "JSON",
  };

  $.ajax(settings).done(function (response) {
    // console.log(response);
    $("#name,#email,#recipe_name,#ingredients,#method,#region").val("");
    showalert(
      response.message,
      response.status === "error" ? danger : response.status
    );
    loadContest();
  });
}

function showalert(message, alerttype) {
  $("#alert_placeholder").append(
    '<div id="alertdiv" class="alert alert-' +
      alerttype +
      '" role="alert"><a class="close" data-dismiss="alert">×</a><span>' +
      message +
      "</span></div>"
  );

  setTimeout(function () {
    // this will automatically close the alert and remove this if the users doesnt close it in 5 secs
    $("#alertdiv").remove();
  }, 5000);
}
