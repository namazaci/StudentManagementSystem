<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller
{
		public function view($page = 'login')
		{
			if(!file_exists(APPPATH. 'views/'.$page.'.php')){
				show_404();
			}

			$data['title'] = ucfirst($page);

			$this->load->view($page, $data);
		}
}
