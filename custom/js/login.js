$(document).ready(function() {
    $("#loginForm").unbind('submit').bind('submit', function() {
        var form = $(this);
        var url = form.attr('action');
        var type = form.attr('method');

        $.ajax({
            url: url,
            type: type,
            data: form.serialize(),
            dataType: 'json',
            success:function(response) {
                if(response.success == true) {
                  window.location = response.messages;
                }
                else {
                    if(response.messages instanceof Object) {

                        $.each(response.messages, function(index, value) {
                            var key = $("#" + index);

                            key.closest('.form-group')
                            .removeClass('has-error')
                            .removeClass('has-success')
                            .addClass(value.length > 0 ? 'has-error' : 'has-success')
                            .find('.text-danger').remove();

                            key.after(value);
                        });
                    }
                    else {

                    }
                }
            }
        })

        return false;
    });
});
