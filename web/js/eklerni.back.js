function displayMessage(type, content) {
    var div = '<div class="alert alert-dismissable" style="opacity: 0;margin-top: 30px"> </div>';
    var button = '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
    $("#messages").append(
        $(div).addClass("alert-" + type).append(button).append(content)
    );
    $("#messages .alert").fadeIn("slow", function(){$(this).animate({"margin-top": "0px", "opacity": "1"}, 500)});
}