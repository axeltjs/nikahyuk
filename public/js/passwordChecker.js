$(function(){
    $('.warning-pass').hide();
    $('#new_password').on('keyup', function () {
        let pass2 = $('#new_password2').val();
        if ($(this).val() != pass2) {
            $('.btn-simpan').prop('disabled', true);
            $('.warning-pass').show(400);
        } else {
            $('.btn-simpan').prop('disabled', false);
            $('.warning-pass').hide(400);
        }
    });

    $('#new_password2').on('keyup', function () {
        let pass = $('#new_password').val();
        console.log(pass);
        if ($(this).val() != pass) {
            $('.btn-simpan').prop('disabled', true);
            $('.warning-pass').show(400);
        } else {
            $('.btn-simpan').prop('disabled', false);
            $('.warning-pass').hide(400);
        }
    });
});