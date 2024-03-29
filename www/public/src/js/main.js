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
  //show password login page
  $(
    "main.login section.login div.container-login form div.password-icon i#togglePassword"
  ).click(function (e) {
    let input = $(
      "main.login section.login div.container-login form div.password-icon input#login-input-password"
    );
    const type = input.attr("type") === "password" ? "text" : "password";
    input.attr("type", type);
    e.target.classList.toggle("fa-eye-slash");
  });

  //test password strength register page
  $(document).on("keyup", "form#formRegister input#pwdRegister", function (e) {
    let success = new RegExp(`^(?=.{8,}$)(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$`);
    let danger = new RegExp(`^[a-z]+$`);
    let warning = new RegExp(`^[a-zA-Z]+$`);
    if (e.target.value.length === 0) {
      $("form#formRegister div.progress-bar")
        .removeClass("progress-bar-success")
        .removeClass("progress-bar-danger")
        .removeClass("progress-bar-warning");
    }
    if (success.test(e.target.value)) {
      $("form#formRegister div.progress-bar")
        .addClass("progress-bar-success")
        .removeClass("progress-bar-danger")
        .removeClass("progress-bar-warning");
    } else if (danger.test(e.target.value)) {
      $("form#formRegister div.progress-bar")
        .addClass("progress-bar-danger")
        .removeClass("progress-bar-success")
        .removeClass("progress-bar-warning");
    } else if (warning.test(e.target.value)) {
      $("form#formRegister div.progress-bar")
        .addClass("progress-bar-warning")
        .removeClass("progress-bar-success")
        .removeClass("progress-bar-danger");
    }
  });

  //test compare password register page
  $(document).on(
    "keyup",
    "form#formRegister input#pwdConfirmRegister",
    function (e) {
      let input_to_compare = $("form#formRegister input#pwdRegister").val();
      if (e.target.value === input_to_compare) {
        $("form#formRegister div.progress-bar").addClass(
          "progress-bar-success"
        );
      } else {
        $("form#formRegister div.progress-bar")
          .removeClass("progress-bar-success")
          .addClass("progress-bar-danger-confirm");
      }
    }
  );
  //display progress bar password
  $(document).on(
    "focusin",
    "form#formRegister input#pwdRegister",
    function (e) {
      if (!$("div.progress-bar").length) {
        $("form#formRegister input#pwdConfirmRegister").after(`
          <div class="progress-bar">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
          </div>`);
      }
    }
  );

  //display progress bar confirm password
  $(document).on(
    "focusin",
    "form#formRegister input#pwdConfirmRegister",
    function (e) {
      if (!$("div.progress-bar").length) {
        $("form#formRegister input#pwdConfirmRegister").after(`
          <div class="progress-bar">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
          </div>`);
      }
    }
  );

  //hide progress-bar password
  $(document).on("blur", "form#formRegister input#pwdRegister", function (e) {
    $("form#formRegister div.progress-bar").remove();
  });

  //hide progress-bar confirm password
  $(document).on(
    "blur",
    "form#formRegister input#pwdConfirmRegister",
    function (e) {
      $("form#formRegister div.progress-bar").remove();
    }
  );
  //get Info on password hover
  $("form#formRegister label[for='password']")
    .mouseenter(function () {
      $("form#formRegister i#info-password-register").after(`
      <span id="info-password">Votre mot de passe doit faire au minimum 8 caractères avec une majuscule et un chiffre</span>
    `);
    })
    .mouseleave(function () {
      $("span#info-password").remove();
    });

  //wrap parent for input mail with icon
  $("form#formLostPassword input#emailLogin").wrap(
    `<div class="forgetPassword-icon"></div>`
  );

  //add icon in input mail
  $("form#formLostPassword input#emailLogin").after(
    `<i class="fas fa-envelope"></i>`
  );
  //select choice with password
  $(
    "section.container-forgetPassword div#passwordChoice h3#withPassword"
  ).click(function (e) {
    $(
      "section.container-forgetPassword div#passwordChoice h3#withoutPassword"
    ).removeClass("active");
    $("section.container-forgetPassword p#without-pwd").removeClass("active");
    $("section.container-forgetPassword p#with-pwd").addClass("active");
    $("section.container-forgetPassword form input#inputPasswordChoice").val(
      "true"
    );
    e.target.classList.add("active");
  });
  //select choice without password
  $(
    "section.container-forgetPassword div#passwordChoice h3#withoutPassword"
  ).click(function (e) {
    $(
      "section.container-forgetPassword div#passwordChoice h3#withPassword"
    ).removeClass("active");
    $("section.container-forgetPassword p#with-pwd").removeClass("active");
    $("section.container-forgetPassword p#without-pwd").addClass("active");
    $("section.container-forgetPassword form input#inputPasswordChoice").val(
      "false"
    );
    e.target.classList.add("active");
  });

  //Carte Part
  $("main#meals div.modal > form").append("<p class='close'>close</p>");

  $("main#meals div.modal > form > p.close").click(function (e) {
    $("div.modal").hide();
  });

  $("header#meals article#Add button#addCategorie").click(function (e) {
    console.log("click");
    $("main#meals div.modal.addCategorie").toggle();
  });

  $("button#addMeal").click(function (e) {
    $("div.modal.addMeal").toggle();
  });

  $("figure#editCategorie").click(function (e) {
    $(e.target.parentElement.children[1]).hide();
    $(e.target.parentElement.children[2]).hide();
    $(e.target.parentElement.children[0]).removeClass("hidden");
  });

  $("span#editMeal").click(function (e) {
    $(e.target.parentElement.parentElement.parentElement).hide();
    $(
      e.target.parentElement.parentElement.parentElement.parentElement
        .children[0]
    ).removeClass("hidden");
  });

  $("span#deleteMeal").click(function (e) {
    $.post("/restaurant/carte/meals/deleteMeal", {
      id: e.target.getAttribute("data-id-meal"),
    });
    location.reload();
  });

  $("span#deleteCategorie").click(function (e) {
    $.post("/restaurant/carte/meals/deleteCategorie", {
      id: e.target.getAttribute("data-id-categorie"),
    });
    location.reload();
  });

  $("span#deleteFood").click(function (e) {
    $.post("/restaurant/carte/meals/deleteFoods", {
      id: e.target.getAttribute("data-id-food"),
      id_meal: e.target.getAttribute("data-id-meal"),
    });
    location.reload();
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

  $("#alert-close").on("click", function (event) {
    $(".alert-window").css("visibility", "hidden");
  });

  $(function () {
    $('#formUpdateProfile input[type="submit"]').addClass("hidden");
  });
  $("#editProfile").on("click", function (event) {
    $("#formUpdateProfile input")
      .attr("disabled", false)
      .removeClass(["disabled", "hidden"]);
    $('#formUpdateProfile input[type="submit"]').removeClass("hidden");
    $("#btncancel").removeClass("hidden");
  });

  $("#btncancel").on("click", function (event) {
    $("#formUpdateProfile #lastnameUpdateProfile")
      .attr("disabled", true)
      .addClass("disabled");
    $("#formUpdateProfile #firstnameUpdateProfile")
      .attr("disabled", true)
      .addClass("disabled");
    $("#formUpdateProfile #emailUpdateProfile")
      .attr("disabled", true)
      .addClass("disabled");

    $("#formUpdateProfile #lastPwdUpdateProfile")
      .attr("disabled", true)
      .addClass("hidden");
    $("#formUpdateProfile #pwdUpdateProfile")
      .attr("disabled", true)
      .addClass("hidden");
    $("#formUpdateProfile #pwdConfirmUpdateProfile")
      .attr("disabled", true)
      .addClass("hidden");
    $('#formUpdateProfile input[type="submit"]').addClass("hidden");
    $("#btncancel").addClass("hidden");
  });

  $("#bookingTable").DataTable({
    columnDefs: [
      { className: "dt-center", targets: "_all" },
      {
        targets: -1,
        data: null,
        defaultContent:
          "<a href=''><i class='fas fa-check'></i></a><a href=''><i class='fas fa-pen'></i></a><a href=''><i class='fas fa-times-circle'></i></a>",
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
  if (!$.fn.DataTable.isDataTable("#bookingTable2")) {
    $("#bookingTable2").dataTable({
      language: {
        url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json",
      },
      columnDefs: [{ className: "dt-center", targets: "_all" }],
      order: [3, "desc"],
      columns: [
        null,
        null,
        null,
        { type: "date-eu" },
        null,
        null,
        null,
        null,
        null,
      ],

      searching: true,
      //paging: false,
      lengthMenu: [10, 20, 30, 40, 50],
      pageLength: 10,
      info: true,
    });
  }
  if (!$.fn.DataTable.isDataTable("#pageTable")) {
    $("#pageTable").dataTable({
      language: {
        url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json",
      },
      columnDefs: [{ className: "dt-center", targets: "_all" }],
      order: [1, "desc"],
      columns: [
        null,
        null,
        null,
        { type: "date-eu" },
        { type: "date-eu" },
        null,
      ],

      searching: true,
      info: true,
    });
  }

  if (!$.fn.DataTable.isDataTable("#logTable")) {
    $("#logTable").dataTable({
      language: {
        url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json",
      },
      columnDefs: [{ className: "dt-center", targets: "_all" }],
      order: [4, "desc"],
      columns: [null, null, null, null, { type: "date-eu" }],

      searching: true,
      info: true,
    });
  }

  if (!$.fn.DataTable.isDataTable("#bookingTable3")) {
    $("#bookingTable3").dataTable({
      language: {
        url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json",
      },
      columnDefs: [{ className: "dt-center", targets: "_all" }],
      order: [3, "desc"],
      columns: [null, null, null, { type: "date-eu" }, null, null, null, null],

      searching: true,
      //paging: false,
      lengthMenu: [10, 20, 30, 40, 50],
      pageLength: 10,
      info: true,
    });
  }

  if (!$.fn.DataTable.isDataTable("#usersTable")) {
    $("#usersTable").dataTable({
      language: {
        url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json",
      },
      columnDefs: [{ className: "dt-center", targets: "_all" }],
      order: [3, "desc"],
      columns: [
        null,
        null,
        null,
        null,
        null,
        null,
        { type: "date-eu" },
        { type: "date-eu" },
        null,
      ],

      searching: true,
      //paging: false,
      lengthMenu: [10, 20, 30, 40, 50],
      pageLength: 10,
      info: true,
    });
  }
  $("#usersTable tbody").on("click", "#updateUser", function () {
    var data = $("#usersTable").DataTable().row($(this).parents("tr")).data();
    window.location.href = "/user/update/" + data[0];
  });

  $("#usersTable tbody").on("click", "#deleteUser", function () {
    var data = $("#usersTable").DataTable().row($(this).parents("tr")).data();
    window.location.href = "/user/delete?id=" + data[0];
  });

  // Refilter the table
  $("#min, #max").on("change", function () {
    table.draw();
  });
});
