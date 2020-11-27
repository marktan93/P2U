
// show error 
function error($msg) {
    $('.error-msg').text($msg);
    $('.success-msg').slideUp('fast', function() {
        $('.error-msg').slideDown('fast').delay(5000).slideUp('fast');
    });
}

// show success
function success($msg) {
    $('.success-msg').text($msg);
    // force hide up before showing the message
    $('.error-msg').slideUp('fast', function() {
        $('.success-msg').slideDown('fast').delay(5000).slideUp('fast');
    });
}
