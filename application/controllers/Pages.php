<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends MY_Controller
{
		public function view($page = 'login')
		{
			if(!file_exists(APPPATH. 'views/'.$page.'.php')){
				show_404();
			}

			$data['title'] = ucfirst($page);

			if($page == 'login') {
					$this->isLoggedIn();

			}
			else {
					$this->isNotLoggedIn();
			}

			$this->load->view($page, $data);
		}
}
