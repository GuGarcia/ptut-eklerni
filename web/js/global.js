$(document).ready(function(){
    $(".masked_date").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});
    $("input[type='checkbox'], input[type='radio']").iCheck({
        checkboxClass: 'icheckbox_minimal',
        radioClass: 'iradio_minimal'
    });
});