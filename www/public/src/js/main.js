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
    $("#navbarButton").click(function () {
        $(this).children(".far").toggleClass("rotated");
    });
    // Create date inputs
    // minDate = new DateTime($("#min"), {
    //     format: "MMMM Do YYYY",
    // });
    // maxDate = new DateTime($("#max"), {
    //     format: "MMMM Do YYYY",
    // });
    $("#bookingTable").DataTable({
        columnDefs: [
            { className: "dt-center", targets: "_all" },
            { targets: -1, data: null, defaultContent: "<a href=''><i class='fas fa-pen'></i></a><a href=''><i class='fas fa-times-circle'></i></a>" },
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

    $("#navbarButton").click(function () {
        $(".sidebar").toggleClass("small");
        $("#pseudo-element").toggleClass("pseudoSmall");
    });
});


