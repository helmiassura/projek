<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ModelProduk');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('login');
		} else {
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$user = $this->Login_model->cek_login($username, $password);

			if ($user) {

				$this->session->set_userdata('username', $user->username);
				$this->session->set_userdata('is_logged_in', TRUE);

				redirect('dashboard');
			} else {
				$this->session->set_flashdata('error', 'Username atau Password salah.');
				redirect('login');
			}
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}
}
