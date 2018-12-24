<?php

class Model_teacher extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }

  public function create($img_url)
  {
    if($img_url == '') {
      $img_url = 'assets/images/default/default_avatar.png';
    }

    $insert_data = array(
      'register_date' => $this->input->post('registerDate'),
      'fname' => $this->input->post('fname'),
      'lname' => $this->input->post('lname'),
      'image' => $img_url,
      'date_of_birth' => $this->input->post('dob'),
      'age' => $this->input->post('age'),
      'contact' => $this->input->post('contact'),
      'email' => $this->input->post('email'),
      'address' => $this->input->post('address'),
      'city' => $this->input->post('city'),
      'country' => $this->input->post('country'),
      'job_type' => $this->input->post('jobType'),
    );

    $status = $this->db->insert('teachers', $insert_data);
    return ($status == true) ? true : false;
  }

  public function fetchTeacherData($teacherId = null)
  {
      if($teacherId) {
        $sql = "SELECT * FROM teachers WHERE teacher_id = ?";
        $query = $this->db->query($sql, array($teacherId));
        $result = $query->row_array();
        return $result;
      }

      $sql = "SELECT * FROM teachers";
      $query = $this->db->query($sql);
      $result = $query->result_array();
      return $result;
  }
}
