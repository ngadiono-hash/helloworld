<?php defined('BASEPATH') OR exit('No direct script access allowed');

class At extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Common');
	}

	// private function linkLevels()
	// {
	// 	$all = $this->Common->select_where('level','name,names,description');
	// 	foreach ($all as $key) {
	// 		$a[] = [
	// 			'link' => base_url('js/files/').create_slug($key['description']),
	// 			'title' => $key['description']
	// 		];
	// 	}
	// 	return $a;
	// }

// ================ HOME
	public function index() // ok
	{
		// $data['navigation'] = $this->linkLevels();
		$data['label'] = $this->Common->select_where('level','*','',TRUE,FALSE);
		$data['title'] = 'Selamat Datang di My Note';
		$this->load->view('templates/mainHeader',$data);
		$this->load->view('index',$data);
		$this->load->view('templates/mainFooter',$data);
	}

// ================ LOGOUT
	public function logout()
	{
		$this->facebook->destroy_session();
		session_destroy();
		if ( isset($_COOKIE['_no']) ) {
			$token = $_COOKIE['_lang'];
			delete_cookie('_no');
			delete_cookie('_lang');
			$this->Common->delete('user_cookie',['token' => $token]);
		}
		redirect('at/sign');
	}

// ================ LOGIN / REGISTER
	public function sign()
	{
		reload_session();
		// $data['navigation'] = $this->linkLevels();
		if ( startSession('sess_id') ) {
			redirect('at');
		} else {
			$data['title'] = 'Authenticate';
			$this->load->view('templates/mainHeader',$data);
			$this->load->view('login',$data);
			$this->load->view('templates/mainFooter',$data);
		}
	}

// END OF FILE
}