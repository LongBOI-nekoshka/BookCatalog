$(document).ready(function() {
    $("form").submit(function (event) { 
        var $form = $(this);
        var $inputs = $form.find("input, select, button, textarea")
        var serializedData = $form.serialize();
        event.preventDefault();
        request = $.ajax({
            url: window.location.href+'login',
            type: "post",
            data: serializedData
        });
        request.done(function (response, textStatus, jqXHR){
            window.location.replace(window.location.href);
            // Log a message to the console
        });
        request.fail(function (jqXHR, textStatus, errorThrown){
            // Log the error to the console
            console.error(
                "The following error occurred: "+
                textStatus, errorThrown
            );
        });
        request.always(function () {
            // Reenable the inputs
            $inputs.prop("disabled", false);
        });
    })
})