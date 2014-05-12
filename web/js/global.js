$(document).ready(function(){
    $(".masked_date").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    $("input[type='checkbox'], input[type='radio']").iCheck({
        checkboxClass: 'icheckbox_minimal',
        radioClass: 'iradio_minimal'
    });
});