<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller
{
    public function __construct()
    {
      parent::__construct();

      // loading the users model
      $this->load->model('model_users');

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
                'rules' => 'required|callback_validate_username'
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
          $username = $this->input->post('username');
          $password = $this->input->post('password');

          $login = $this->model_users->login($username, $password);

          if($login) {

            $this->load->library('session');

            $user_data = array(
                'id' => $login,
                'logged_in' => true
            );

            $this->session->set_userdata($user_data);

            $validator['success'] = true;
            $validator['messages'] = 'dashboard';
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

    public function validate_username()
    {
        $validate = $this->model_users->validate_username($this->input->post('username'));

        if($validate == true) {
            return true;
        }
        else {
            $this->form_validation->set_message('validate_username', 'The {field} does not exist');
            return false;
        }
    }

    public function logout()
    {
        $this->load->library('session');
        $this->session->sess_destroy();
        redirect('login', 'refresh');
    }
}