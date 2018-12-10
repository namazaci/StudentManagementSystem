<?php

class Model_users extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
  }

  public function validate_username($username = null)
  {
      if($username) {
        $sql = "SELECT * FROM users WHERE username = ?";
        $query = $this->db->query($sql, array($username));
        $result = $query->row_array();
        return ($query->num_rows() === 1) ? true : false;
      }
      else {
          return false;
      }
  }

  public function login($username = null, $password = null)
  {
      if($username && $password) {
          $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
          $query = $this->db->query($sql, array($username, $password));
          $result = $query->row_array();

          return ($query->num_rows() === 1) ? $result['user_id'] : false;
      }
      else {
          return false;
      }
  }
}
