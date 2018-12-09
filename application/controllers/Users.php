<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller
{
    public function __construct()
    {
      parent::__construct();

      // loading the users model

      //load the form validation library
      $this->load->library('form_validation');
    }

    public function login()
    {
        $validator = array('success' => false, 'message' => array());

        $validate_data = array(
            array(
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'required'
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required'
            )
        );

        $this->form_validation->set_rules($validate_data);
        $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if($this->form_validation->run() == true) {
          echo "ok";
        }
        else {
          echo validation_errors();
        }
    }
}
