<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teacher extends MY_Controller
{
  public function __construct()
  {
    parent::__construct();

    // loading the teacher model
    $this->load->model('model_teacher');
    // loading the form validation library
    $this->load->library('form_validation');
  }

  public function create()
  {
    $validator = array('success' => false, 'messages' => array());

    $validate_data = array(
        array(
            'field' => 'fname',
            'label' => 'First Name',
            'rules' => 'required'
        ),
        array(
            'field' => 'age',
            'label' => 'Age',
            'rules' => 'required'
        ),
        array(
            'field' => 'contact',
            'label' => 'Contact',
            'rules' => 'required'
        ),
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required'
        ),
        array(
            'field' => 'registerDate',
            'label' => 'Register Date',
            'rules' => 'required'
        ),
        array(
            'field' => 'jobType',
            'label' => 'Job Type',
            'rules' => 'required'
        )
    );

    $this->form_validation->set_rules($validate_data);
    $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

    if($this->form_validation->run() == true) {

      $imgUrl = $this->uploadImage();
      $create = $this->model_teacher->create($imgUrl);

      if($create) {

        $validator['success'] = true;
        $validator['messages'] = 'Successfully added';
      }
      else {
        $validator['success'] = false;
        $validator['messages'] = 'Incorrect username/password combination';
      }
    }
    else {
      $validator['success'] = false;
      foreach ($_POST as $key => $value) {
        $validator['messages'][$key] = form_error($key);
      }
    }

    echo json_encode($validator);
  }

  public function uploadImage()
  {
    $type = explode('-', $_FILES['photo']['name']);
    $type = $type[count($type) - 1];
    $url = 'assets/images/teachers/'.uniqid(rand()).'.'.$type;
    if(in_array($type, array('gif', 'jpg', 'jpeg', 'png', 'JPG', 'GIF', 'JPEG', 'PNG'))) {
      if(is_uploaded_file($FILES['photo']['tmp_name'])) {
        if(move_uploaded_file($_FILES['photo']['tmp_name'], $url)) {
          return $url;
        } else {
          return false;
        }
      }
    }
  }

  public function fetchTeacherData($teacherId = null)
  {
      if($teacherId) {
          $result = $this->model_teacher->fetchTeacherData($teacherId);
      }
      else{
        $teacherData = $this->model_teacher->fetchTeacherData();
        $result = array('data' => array());

        foreach ($teacherData as $key => $value) {

          $button = '
          <!-- Single button -->
          <div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Action <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
              <li><a type="button" data-toggle="modal" data-target="#updateTeacherModel" onclick="editTeacher('.$value['teacher_id'].')"> <i class="glyphicon glyphicon-edit"></i> Edit </a></li>
              <li><a type="button" data-toggle="modal" data-target="#removeTeacherModel" onclick="removeTeacher('.$value['teacher_id'].')"> <i class="glyphicon glyphicon-trash"></i> Remove </a></li>
            </ul>
          </div>
          ';

          $photo = '<img src="'.base_url().$value['image'].'" alt="Photo" class="img-circle candidate-photo"/>';

          $result['data'][$key] = array(
              $photo,
              $value['fname'] . ' ' . $value['lname'],
              $value['age'],
              $value['contact'],
              $value['email'],
              $button
          );
      }
    }

    echo json_encode($result);
  }
}
