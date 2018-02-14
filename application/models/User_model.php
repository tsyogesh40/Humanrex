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
  //fetching attendence details
  public function staff_entry($staff_id)
  {
    $date= date('Y-m-d');
    $this->db->select('*');
    $this->db->from('temp_entry');
    $this->db->where('staff_id',$staff_id);
    $this->db->where('date',$date);
    if($res=$this->db->get())
    {
      return $res->row_array();
    }
    else {
      return false;
    }
  }
//update details in staffs page
public function update_details($datas,$staff_id)
{
  $pass=array('password'=>$datas['password']);
  $phone=array('phone'=>$datas['phone']);
  //updating phone no in staff details
  $this->db->where('staff_id',$staff_id);
  $this->db->update('staff_details',$phone);
  //updating password in user_credentails
  $this->db->where('staff_id',$staff_id);
  $this->db->update('user_credentials',$pass);
}
//select by date
public function select_id($date,$staff_id)
{
  $this->db->select('*');
  $this->db->from('temp_entry');
  $this->db->where('staff_id',$staff_id);
  $this->db->where('date',$date);
  if($res=$this->db->get())
  {
    return $res->result();
  }
  else {
    return false;
  }
}

//select by range
public function select_range($staff_id,$from,$to)
{
  //$this->db->query('select * from temp_entry where staff_id='.$staff_id.' and (date between '.$from.' and '.$to.')');
  $condition="date between"."'".$from."'"."and"."'".$to."'";
  $this->db->select('*');
  $this->db->from('temp_entry');
  $this->db->where('staff_id',$staff_id);
  $this->db->where($condition);
  if($history=$this->db->get())
  {
    return $history->result();
  }else {
    return false();
  }
}

  //login verify model
  public function fetch_details($staff_id)
  {
    $this->db->select('*');
    $this->db->from('staff_details');
    $this->db->where('staff_id',$staff_id);
    if($res=$this->db->get())
    {
      return $res->row_array();
    }
    else {
      return false;
    }
  }
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
