$(document).ready(function() {
    $('#navbarButton').click(function() {
        $(this).children('.far').toggleClass('rotated');
    });

    $('#editProfile').on( "click", function( event ) {
        $('.container').css("margin-top", "0px")
        $("input").attr("disabled", false)

        var labelOld = $("<label class='greytext mt-8' id='labelOld' for='labelOld'>Ancien mot de passe</label>\n");
        $('input#email').after(labelOld);
        var inputOld = $("<input name='passwordOld' id='passwordOld' type='password'>");
        $('label#labelOld').after(inputOld);

        var labelNew = $("<label class='greytext mt-8' id='labelNew' for='labelNew'>Nouveau mot de passe</label>\n");
        $('input#passwordOld').after(labelNew);
        var inputNew = $("<input name='passwordNew' id='passwordNew' type='password'>");
        $('label#labelNew').after(inputNew);

        var labelConfirm = $("<label class='greytext mt-8' id='labelConfirm' for='labelConfirm'>Confirmation du mot de passe</label>\n");
        $('input#passwordNew').after(labelConfirm);
        var inputConfirm = $("<input name='confirmNewPassowrd' id='confirmNewPassowrd' type='password'>");
        $('label#labelConfirm').after(inputConfirm);

        var cancelButton = $("<button class='btn btn-cancel mr-4' id='btncancel'>Annuler </button>");
        $('div#sectionButton').append(cancelButton);

        var submitButton = $("<button class='btn btn-submit' id='btncancel'>Confirmer </button>");
        $('button#btncancel').after(submitButton);

        $( this ).off( event );
    });
})

