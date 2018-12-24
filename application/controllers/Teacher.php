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
}
