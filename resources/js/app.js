$(document).ready(function() {
    $("form").submit(function (event) { 
        var $form = $(this);
        var $inputs = $form.find("input, select, button, textarea")
        var serializedData = $form.serialize();
        request = $.ajax({
            url: window.location.href,
            type: "post",
            data: serializedData
        });
        request.done(function (response, textStatus, jqXHR){
            // Log a message to the console
            console.log("Hooray, it worked!");
        });
        request.fail(function (jqXHR, textStatus, errorThrown){
            // Log the error to the console
            event.preventDefault();
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