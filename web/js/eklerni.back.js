function displayMessage(type, content) {
    var div = '<div class="alert alert-dismissable"> </div>';
    var button = '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
    $("#messages").append(
        $(div).addClass("alert-" + type).append(button).append(content)
    );
    $("#messages .alert").fadeIn();
}