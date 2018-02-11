<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class User_model extends CI_model
{

  function __construct()
  {
    parent::__construct();
  }
  //login verify model
  public  function login($email,$pswd)
  {
      $this->db->select('*');
      $this->db->from('user_credentials');
      $this->db->where('email',$email);
      $this->db->where('password',$pswd);

      if($query=$this->db->get())
      {
        return $query->row_array();
      }
      else{
        return false;
      }
  }
  //inserting user credentials
  public function user_credentials($credentials)
  {
    $this->db->insert('user_credentials',$credentials);
  }

  //checking for existing staff id
  public function staff_id_check($staff_id)
  {
    $this->db->select('*');
    $this->db->from('staff_details');
    $this->db->where('staff_id',$staff_id);
    $query=$this->db->get();
    if($query->num_rows>0)
    {
      return false;
    }
    else {
      return true;
    }
  }

  //register new staff
  public function staff_register($data)
  {
    $res=$this->db->insert('staff_details',$data);

  }
}

?>
