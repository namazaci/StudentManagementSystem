<ol class="breadcrumb">
  <li><a href="<?php echo base_url('dashboard') ?>">Home</a></li>
  <li class="active">Manage Teacher</li>
</ol>

  <div class="panel panel-default">
    <div class="panel-body">
      <fieldset>
        <legend>Manage Teacher</legend>


        <div id="messages"></div>

          <div class="pull pull-right">
            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#addTeacher" id="addTeacherModalBtn">
              <i class="glyphicon glyphicon-plus-sign"></i>Add Teacher
            </button>
          </div>

          <br /><br /><br />

          <table id="manageTeacherTable" class="table table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Age</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Action</th>
              </tr>
            </thead>
          </table>

      </fieldset>

  </div>
</div>

<!-- add teacher -->
<div class="modal fade" tabindex="-1" role="dialog" id="addTeacher">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

      <div class="modal-header">
       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       <h4 class="modal-title" id="myModalLabel">Add Teacher</h4>
     </div>

     <form class="form-horizontal" id="createTeacherForm" action="<?php echo base_url('teacher/create') ?>"
       enctype="multipart/form-data" method="post">

         <div class="modal-body">
           <div id="add-teacher-messages">

            <div class="row">
              <div class="col-md-12">
                <div class="col-md-6">

                  <div class="form-group">
                    <label for="fname" class="col-sm-4 control-label">First Name : </label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" />
                      </div>
                  </div>

                  <div class="form-group">
                    <label for="lname" class="col-sm-4 control-label">Last Name : </label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" />
                      </div>
                  </div>

                  <div class="form-group">
                    <label for="dob" class="col-sm-4 control-label">DOB : </label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="dob" name="dob" placeholder="DOB" />
                      </div>
                  </div>

                  <div class="form-group">
                    <label for="age" class="col-sm-4 control-label">Age : </label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="age" name="age" placeholder="Age" />
                      </div>
                  </div>

                  <div class="form-group">
                    <label for="contact" class="col-sm-4 control-label">Contact : </label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="contact" name="contact" placeholder="Contact" />
                      </div>
                  </div>

                  <div class="form-group">
                    <label for="email" class="col-sm-4 control-label">Email : </label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email" />
                      </div>
                  </div>

                  <div class="form-group">
                    <label for="address" class="col-sm-4 control-label">Address : </label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="address" name="address" placeholder="Address" />
                      </div>
                  </div>

                  <div class="form-group">
                    <label for="city" class="col-sm-4 control-label">City : </label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="city" name="city" placeholder="City" />
                      </div>
                  </div>

                  <div class="form-group">
                    <label for="country" class="col-sm-4 control-label">Country : </label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="country" name="country" placeholder="Country" />
                      </div>
                  </div>

                </div>
                <!-- col-md-6 -->

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="registerDate" class="col-sm-4 control-label">Register Date : </label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="registerDate" name="registerDate" placeholder="Register Date" />
                      </div>
                  </div>

                  <div class="form-group">
                    <label for="jobType" class="col-sm-4 control-label">Job Type : </label>
                      <div class="col-sm-8">
                        <select class="form-control" id="jobType" name="jobType">
                          <option value="">Select an option</option>
                          <option value="1">Full-time</option>
                          <option value="2">Part-time</option>
                        </select>
                      </div>
                  </div>

                  <div class="form-group">
                    <label for="photo" class="col-sm-4 control-label">Photo : </label>
                      <div class="col-sm-8">
                        <div id="kv-avatar-errors-1" class="center-block" style="max-width:500px; display:none;"></div>

                          <div class="kv-avatar center-block" style="width:100%">
                            <input type="file" id="photo" name="photo" class="file-loading" />
                          </div>


                      </div>
                  </div>
                </div>

              </div>
            </div>

           </div>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
           <button type="submit" class="btn btn-primary">Save changes</button>
         </div>
     </form>

    </div>
  </div>
</div>
