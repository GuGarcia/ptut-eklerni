function displayMessage(type, content) {
    var div = '<div class="alert alert-dismissable"> </div>';
    var button = '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
    $("#messages").prepend(
        $(div).addClass("alert-" + type).append(button).append(content)
    );
    var message = $($("#messages").children()[0]);
    console.log($(message).outerHeight());
    console.log($(message));

    $($("#messages .alert")[0]).css({
        "opacity": "0",
        "margin-top": -$(message).outerHeight()
    })
    $("#messages .alert").fadeIn("slow", function(){
        $(this).animate({"margin-top": "0px", "opacity": "1"}, 500)
    });
}