<?php

class Accounting extends MY_Controller
{
  public function __construct()
  {
    parent::__construct();

    $this->isNotLoggedIn();

    //loading the teacher model
    $this->load->model('model_student');
    //loading the classes model
    //loading the section model
    // accounting
    $this->load->model('model_accounting');

    //loading the form validation library
    $this->load->library('form_validation');
  }
