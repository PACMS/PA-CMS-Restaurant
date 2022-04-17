// var minDate, maxDate;
// $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
//   var min = minDate.val();
//   var max = maxDate.val();
//   var date = new Date(data[4]);

//   if (
//       (min === null && max === null) ||
//       (min === null && date <= max) ||
//       (min <= date && max === null) ||
//       (min <= date && date <= max)
//   ) {
//       return true;
//   }
//   return false;
// });
$(document).ready(function () {
  $(
    "main.login section.login div.container-login form div.password-icon i#togglePassword"
  ).click(function (e) {
    console.log("show password");
    let input = $(
      "main.login section.login div.container-login form div.password-icon input#login-input-password"
    );
    const type = input.attr("type") === "password" ? "text" : "password";
    input.attr("type", type);
    console.log(type);
    e.target.classList.toggle("fa-eye-slash");
    console.log(e.target.classList);
  });

  $("#navbarButton").click(function () {
    $(this).children(".far").toggleClass("rotated");
    $(".sidebar").toggleClass("small");
    $("#pseudo-element").toggleClass("pseudoSmall");
  });
  // Create date inputs
  // minDate = new DateTime($("#min"), {
  //     format: "MMMM Do YYYY",
  // });
  // maxDate = new DateTime($("#max"), {
  //     format: "MMMM Do YYYY",
  // });

  $("#editProfile").on("click", function (event) {
    $(".container").css("margin-top", "0px");
    $("input").attr("disabled", false);

    var labelOld = $(
      "<label class='greytext mt-8' id='labelOld' for='labelOld'>Ancien mot de passe</label>\n"
    );
    $("input#email").after(labelOld);
    var inputOld = $(
      "<input name='passwordOld' id='passwordOld' type='password'>"
    );
    $("label#labelOld").after(inputOld);

    var labelNew = $(
      "<label class='greytext mt-8' id='labelNew' for='labelNew'>Nouveau mot de passe</label>\n"
    );
    $("input#passwordOld").after(labelNew);
    var inputNew = $(
      "<input name='passwordNew' id='passwordNew' type='password'>"
    );
    $("label#labelNew").after(inputNew);

    var labelConfirm = $(
      "<label class='greytext mt-8' id='labelConfirm' for='labelConfirm'>Confirmation du mot de passe</label>\n"
    );
    $("input#passwordNew").after(labelConfirm);
    var inputConfirm = $(
      "<input name='confirmNewPassowrd' id='confirmNewPassowrd' type='password'>"
    );
    $("label#labelConfirm").after(inputConfirm);

    var cancelButton = $(
      "<button class='btn btn-cancel mr-4' id='btncancel'>Annuler </button>"
    );
    $("div#sectionButton").append(cancelButton);

    var submitButton = $(
      "<button class='btn btn-submit' id='btncancel'>Confirmer </button>"
    );
    $("button#btncancel").after(submitButton);

    $(this).off(event);
  });

  $("#bookingTable").DataTable({
    columnDefs: [
      { className: "dt-center", targets: "_all" },
      {
        targets: -1,
        data: null,
        defaultContent:
          "<a href=''><i class='fas fa-pen'></i></a><a href=''><i class='fas fa-times-circle'></i></a>",
      },
    ],
    columns: [null, null, null, { type: "datetime" }, null, null, null],
    searching: false,
    paging: false,
    info: false,
  });
  // Refilter the table
  $("#min, #max").on("change", function () {
    table.draw();
  });
});
