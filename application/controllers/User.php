<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class User extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->helper('security');
    $this->load->library('form_validation');
  }

  public function index()
  {
    $this->load->view('enrollform');

  }
//registration page
  public function login()
  {
    $this->load->view('login');
  }
  //user registration form
  public function register()
  {
    $db=$this->load->database();

        $data = array(
          'name' =>$this->input->post('name'),
          'staff_id'=>$this->input->post('staff_id'),
          'store_id'=>$this->input->post('store_id'),
          'finger_preference'=>$this->input->post('finger_pref'),
          'department'=>$this->input->post('dept'),
          'designation'=>$this->input->post('designation'),
          'cadre'=>$this->input->post('cadre'),
          'gender'=>$this->input->post('gender'),
          'phone'=>$this->input->post('phone'),
          'email'=>$this->input->post('email'),
          'DOJ'=>$this->input->post('doj')
          );
            print_r($data);
            //form validation
              //name vaidation
              $this->form_validation->set_rules('name', 'Username', 'required|trim|xss_clean');
              //staff vaidation
              $this->form_validation->set_rules('staff_id','staffid','required|trim|xss_clean');
              //Desigation vaidation
              $this->form_validation->set_rules('designation','designation','required|trim|xss_clean');
              //phone number validation
              $this->form_validation->set_rules('phone', 'phone_no', 'required|regex_match[/^[0-9]{10}$/]');
              //email validation
              $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
              //DOJ validation
              $this->form_validation->set_rules('doj', 'DOJ', 'required');


                if($this->form_validation->run()==TRUE)
                {
                      $this->db->insert('staff_details',$data);
                }
                else
                 {
                   redirect('user/login');
                  }

  }

}
?>
