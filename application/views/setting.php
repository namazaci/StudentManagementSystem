<ol class="breadcrumb">
  <li><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
  <li class="active">Manage Settings</li>
</ol>

<div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">Manage Settings</div>
        <div class="panel-body">
          <div class="col-md-12">
            <div id="update-profile-message">

            </div>
          </div>

          <div class="col-md-6">
            <form id="updateProfileForm" action="<?php echo base_url('users/updateProfile') ?>" method="post">
              <fieldset>
                <legend>Manage Username</legend>

                <div class="form-group">
                  <label for="username">Username: </label>
                  <input type="text" name="username" id="username" class="form-control" placeholder="Username"
                  value="<?php echo $userdata['username'] ?>">
                </div>

                <div class="form-group">
                  <label for="fname">First Name: </label>
                  <input type="text" name="fname" id="fname" class="form-control" placeholder="First Name"
                  value="<?php echo $userdata['fname'] ?>">
                </div>

                <div class="form-group">
                  <label for="lname">Last Name: </label>
                  <input type="text" name="lname" id="lname" class="form-control" placeholder="Last Name"
                  value="<?php echo $userdata['lname'] ?>">
                </div>

                <div class="form-group">
                  <label for="email">Email: </label>
                  <input type="text" name="email" id="email" class="form-control" placeholder="Email"
                  value="<?php echo $userdata['email'] ?>">
                </div>

                <button type="submit" class="btn btn-primary">Save Changes</button>

              </fieldset>
            </form>
          </div>

          <div class="col-md-6">
            <form id="changePasswordForm" action="<?php echo base_url('users/changePassword') ?>" method="post">
              <fieldset>
                <legend>Change Password</legend>

                <div class="form-group">
                  <label for="currentPassword">Current Password: </label>
                  <input type="password" name="currentPassword" id="currentPassword" class="form-control" placeholder="Current Password"
                  >
                </div>

                <div class="form-group">
                  <label for="newPassword">New Password: </label>
                  <input type="password" name="newPassword" id="newPassword" class="form-control" placeholder="New Password"
                  >
                </div>

                <div class="form-group">
                  <label for="confirmPassword">Confirm Password: </label>
                  <input type="password" name="confirmPassword" id="confirmPassword" class="form-control" placeholder="Confirm Password"
                  >
                </div>

                <button type="submit" class="btn btn-primary">Change Password</button>

              </fieldset>
            </form>
          </div>

        </div>
      </div>
        <!-- /panel -->
    </div>
    <!-- /col-md-12 -->
</div>
<!-- row -->

<script type="text/javascript">
$(document).ready(function() {
    $("#update-profile-message").unbind('submit').bind('submit', function() {
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
                  $('#update-profile-message').html('<div class="alert alert-success alert-dismissible" role="alert">'+
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                    response.messages +
                  '</div>');

                  $(".from-group").removeClass('has-error').removeClass('has-success');
                }
                else {
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
                }
        })

        return false;
    });
});

$(document).ready(function() {
    $("#changePasswordForm").unbind('submit').bind('submit', function() {
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
                  $('#update-profile-message').html('<div class="alert alert-success alert-dismissible" role="alert">'+
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                    response.messages +
                  '</div>');

                  $(".from-group").removeClass('has-error').removeClass('has-success');
                  $('.text-danger').remove();

                  $("#changePasswordForm")[0].reset();
                }
                else {
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
                }
        })

        return false;
    });
});

</script>
