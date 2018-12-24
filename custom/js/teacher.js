var manageTeacherTable;
var base_url = $("#base_url").val();

$(document).ready(function() {
    manageTeacherTable = $("#manageTeacherTable").DataTable({
      'ajax' : base_url + 'teacher/fetchTeacherData',
      'order' : []
    });

    /*
    *-------------------------------------------------
    * click on the add teacher model button
    *-------------------------------------------------
    */
    $("#addTeacherModalBtn").unbind('click').bind('click', function() {
      $("#registerDate").calendarsPicker({
          dateFormat: 'yyyy-mm-dd'
      })
      $("#dob").calendarsPicker({
          dateFormat: 'yyyy-mm-dd'
      })

      $("#photo").fileinput({
          overwriteInitial: false,
          maxFileSize: 1500,
          showClose: false,
          showCaption: false,
          showBrowse: false,
          browseOnZoneClick: true,
          browseLabel: '',
          removeLabel: '',
          browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
          removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
          removeTitle: 'Cancel or reset changes',
          elErrorContainer: '#kv-avatar-errors-1',
          msgErrorClass: 'alert alert-block alert-danger',
          defaultPreviewContent: '<img src="'+base_url+ 'assets/images/default/default_avatar.png'  +'" alt="Your Avatar"> <h6 class="text-muted">Click to select></h6>',
          layoutTemplates: {main2: '{preview}{remove}{browse}'},
          allowedFileExtensions: ["jpg", "png", "gif"]
      });

      $("#createTeacherForm").unbind('submit').bind('submit', function() {
          var form = $(this);
          var formData = new FormData($(this)[0]);
          var url = form.attr('action');
          var type = form.attr('method');

          $.ajax({
              url: url,
              type: type,
              data: formData,
              dataType: 'json',
              cache: false,
              contentType: false,
              processData: false,
              async: false,
              success:function(response) {
                if(response.success == true) {
                  $("#add-teacher-messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                    response.messages +
                    '</div>');

                  manageTeacherTable.ajax.reload(null, false);
                  $(".form-group").removeClass('has-error').removeClass('has-success');
                  $(".text-danger").remove();
                  clearForm();
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


                      $('#message').html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                        response.messages +
                      '</div>');
                    }
                }
              }
          });

          return false;
      });

    });
});

function clearForm()
{
    $("input[type=text]").val('');
    $("select").val('');
    $(".fileinput-remove-button").click();
}
