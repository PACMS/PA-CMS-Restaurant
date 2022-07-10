$(document).ready(function () {
  $("button#answerComment").click(function (e) {
    $(e.target.parentNode.children[1]).removeClass("hidden");
    $(e.target).addClass("hidden");
  });
  $("form#replyComment button#cancel").click(function (e) {
    $(e.target.parentNode.parentNode.parentNode.children[0]).removeClass(
      "hidden"
    );

    $(e.target.parentNode.parentNode.parentNode.children[1]).addClass("hidden");
  });
});
