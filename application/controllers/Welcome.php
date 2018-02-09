<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	 
	public function index()
	{
		$this->load->view('login');
	}

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

		   $this->db->insert('staff_details',$data);
	}

	public function home()
	{

		$this->load->view('home_view');
	}
	public function staff()
	{
		$this->load->view('staffs');
	}
	public function entry()
	{
		$d=$this->load->model('Humanrex');
		$this->load->view('entry',$d);

	}
}
