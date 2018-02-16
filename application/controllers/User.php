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
    $this->load->model('user_model');
  }

  public function index()
  {
    $this->register();
  }
  public function enroll()
  {
    $this->load->view('enrollform');
  }
  //login page
  public function login()
  {
    $this->load->view('login');
  }

  public function logout()
  {
    $this->session->sess_destroy();
    $this->session->set_flashdata('logout_msg', 'Logout successfully!');
    $this->load->view('login');
  }
  //login verification
  public function login_verify()
  {
    $user_login=array(
      'name'=>$this->input->post('email'),
      'password'=>$this->input->post('pswd')
    );
    $result=$this->user_model->login($user_login['name'],$user_login['password']);
      if($result)
      {
        $role=$result['priority'];
        $this->session->set_userdata('name',$result['name']);
       $this->session->set_userdata('staff_id',$result['staff_id']);
//       $this->session->set_userdata('username',$result['username']);
       $this->session->set_userdata('priority',$result['priority']);
       $this->session->set_userdata('last_login',$result['last_login']);
        $this->session->set_userdata('email',$result['email']);
        if($role=='A')
        {
        //$this->load->view('admin/admin');
        redirect('user/admin_panel');
        //$this->session->set_flashdata('success_msg', 'Login Successful!');
        }
        else if($role=='S')
        {
        //redirect('user/staff_panel');
      //  $this->load->view('staffs/staffs');
        $this->staff_panel($result['staff_id']);
        //$this->session->set_flashdata('success_msg', 'Login Successful!');
        }
        else if($role=='H')
        {
          $this->hod_panel();
          //$this->session->set_flashdata('success_msg', 'Login Successful!');
        }
      }
      else {
        $this->session->set_flashdata('error_msg', 'Wrong Email or Password.');
        $this->load->view('login');
      }
  }

  //admin controller
  public function admin_panel()
  {
      $this->load->view('admin/admin');
  }

  //staff admin_panel
  public function staff_panel($staff_id)
  {
    $datas=$this->user_model->fetch_details($staff_id);
    $attendence=$this->user_model->staff_entry($staff_id);
    $details=array(
      'in_time'=>$attendence['in_time'],
      'out_time'=>$attendence['out_time'],
      'p_value'=>$attendence['p_value'],
      'status'=>$attendence['status'],
      'date'=>$attendence['date'],
      'phone'=>$datas['phone'],
      'staff_id'=>$datas['staff_id'],
      'designation'=>$datas['designation'],
      'email'=>$datas['email']
        );
    $this->load->view('staffs/staffs',$details);
  }

//update details in staff panel (password n phone number)
  public function update_details()
  {
      $input=array(
        'phone'=>$this->input->post('phone'),
        'password'=>$this->input->post('pwd')
      );
      $staff_id=$this->session->userdata('staff_id');
      $this->user_model->update_details($input,$staff_id);
      $this->session->set_flashdata('notify', 'Phone Number and password updated Successfully!.');
      //$this->staff_panel($staff_id);
      $this->login();
  }
  //select by ID
  public function select_by_id()
  {
    $date=$this->input->post('date');
    $staff_id=$this->session->userdata('staff_id');

      $data['history']=$this->user_model->select_id($date,$staff_id);
      $this->load->view('staffs/history',$data);
    //  print_r($data);
  }

  //select my reange
  public function select_by_range()
  {
    $from=$this->input->post('from_date');
    $to=$this->input->post('to_date');
    $staff_id=$this->session->userdata('staff_id');
    $data['history']=$this->user_model->select_range($staff_id,$from,$to);
    $this->load->view('staffs/history',$data);

  }
  //hod's panel
  public function hod_panel()
  {
    $this->load->view('hods/hod');
  }

  //user registration form
  public function register()
  {
    //$db=$this->load->database();

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

          $credentials=array(
            'name'=>$this->input->post('name'),
            'staff_id'=>$this->input->post('staff_id'),
            'password'=>$this->input->post('pswd'),
            'priority'=>$this->input->post('role'),
            'email'=>$this->input->post('email')
          );
            //print_r($data);
            //form validation
            $this->form_validation->set_error_delimiters('<div class="alert alert-primary">', '</div>');
              //name validation
              $this->form_validation->set_rules('name', 'Username', 'required|trim|xss_clean');
              //staff validation
              $this->form_validation->set_rules('staff_id','staffid','required|trim|xss_clean');
              //store_id validation
              $this->form_validation->set_rules('store_id','storeid','required|trim|xss_clean');
              //Desigation validation
              $this->form_validation->set_rules('designation','designation','required|trim|xss_clean');
              //password validation
              $this->form_validation->set_rules('pswd','password','required|min_length[4]|max_length[20]|trim|xss_clean');
              //phone number validation
              $this->form_validation->set_rules('phone', 'phone_no', 'required|regex_match[/^[0-9]{10}$/]');
              //email validation
              $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
              //DOJ validation
              $this->form_validation->set_rules('doj', 'DOJ', 'required');

              //checking for existing staff_id
            $id_check=$this->user_model->staff_id_check($data['email']);


                if($this->form_validation->run()==TRUE)
                {
                    if($id_check)
                    {
                      $this->user_model->staff_register($data);
                      $this->user_model->user_credentials($credentials);
                      $this->session->set_flashdata('success_msg', 'Registered successfully.Now login to your account.');

                      redirect('user/login');
                    }
                    else{
                      echo 'Id exists';
                    }
                }
                else
                 {
                   $this->session->set_flashdata('error_msg', 'Error occured! Please try again!!');
                   $this->load->view('enrollform');
                  }
  }

}
?>
