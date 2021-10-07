$(document).ready(function() {
    $("#form").submit(function (event) { 
        var $form = $(this);
        var $inputs = $form.find("input, select, button, textarea")
        var serializedData = $form.serialize();
        event.preventDefault();
        request = $.ajax({
            url: window.location.href+'createBook',
            type: "post",
            data: serializedData
        });
        // request.done(function (response, textStatus, jqXHR){
        //     // Log a message to the console
        //     console.log("Hooray, it worked!");
        // });
        // request.fail(function (jqXHR, textStatus, errorThrown){
        //     // Log the error to the console
        //     console.error(
        //         "The following error occurred: "+
        //         textStatus, errorThrown
        //     );
        // });
        // request.always(function () {
        //     // Reenable the inputs
        //     $inputs.prop("disabled", false);
        // });
    })
})