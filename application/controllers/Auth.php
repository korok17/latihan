<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

	public function index()
	{
		$this->load->view('templates/auth_header.php');
		$this->load->view('auth/login.php');
		$this->load->view('templates/auth_footer.php');
    }
    
    public function registrasion()
    {

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email'); //|is_unique[user.email]
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password dont match!',
            'min_length' => 'Password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|min_length[3]|matches[password1]');

        if( $this->form_validation->run() == false ){
            $this->load->view('templates/auth_header.php');
            $this->load->view('auth/registrasion.php');
            $this->load->view('templates/auth_footer.php');
        } else {
            $data = [
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'images' => $this->input->post('ima'),
            ];
        }
    }
}