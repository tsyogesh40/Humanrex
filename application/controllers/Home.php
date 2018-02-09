<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
/*	public function index()
	{
		echo "Home Page";
		$this->load->view('home_view');
	}*/public function index()
  {
    $this->load->view('login');
  }

}
?>
