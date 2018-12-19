<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends MY_Controller
{
		public function view($page = 'login')
		{
			if(!file_exists(APPPATH. 'views/'.$page.'.php')){
				show_404();
			}

			if($page == 'setting') {
				$this->load->model('model_users');
				$this->load->library('session');
				$userId = $this->session->userdata('id');
				$data['userdata'] = $this->model_users->fetchUserData($userId);
			}

			$data['title'] = ucfirst($page);

			if($page == 'login') {
					$this->isLoggedIn();
					$this->load->view($page, $data);
			}
			else {
					$this->isNotLoggedIn();

					$this->load->view('templates/header', $data);
					$this->load->view($page, $data);
					$this->load->view('templates/footer', $data);
			}
		}
}
