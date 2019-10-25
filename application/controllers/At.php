<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class At extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Create_model');
		$this->load->model('Read_model');
		$this->load->model('Update_model');
		$this->load->model('Delete_model');
		$this->load->library('Google');
	}

	public function haha()
	{
		echo "<form method='post'>";
		echo "<input type='hidden' name='csrf_token' value='".$this->security->get_csrf_hash()."'>";
		echo "<input type='text' name='test'>";
		echo "<input type='submit'>";
		echo "</form>";
		$this->form_validation->set_rules('test', 'Test', 'callback_validate_url');
		if($this->form_validation->run() == false){
			echo form_error('test','<p>','</p>');
		} else {
			$a = $this->input->post('test');
			// echo $a;
			// echo addcslashes($a);
			// echo "<br>". htmlspecialchars($this->input->post('test',true));
			// echo "<br>". htmlspecialchars_decode($this->input->post('test',true));
			echo "<pre><code>";
			echo "<br>". htmlentities($this->input->post('test'));
			echo "</code></pre>";		
		}

	}
	public function validate_url() {
		$url = $this->input->post('test');
		if (!filter_var($url, FILTER_VALIDATE_URL)) {
			$this->form_validation->set_message('validate_url','alamat URL tidak valid');
			return FALSE;
		} else {
			return TRUE;
		}
	}	
	public function notFound()
	{
		not_found();
	}

// ================ HOME
	public function index()
	{
		$getTyping = $this->Read_model->getTyping('1');
		$data['typing']	= change_host($getTyping);
		$data['title'] = 'Selamat Datang di Hello World';
		$this->load->view('templates/mainHeader',$data);
		$this->load->view('home/index',$data);
		$this->load->view('templates/mainFooter',$data);
	}

// ================ LOGOUT
	public function logout()
	{
		$this->facebook->destroy_session();
		session_destroy();
		if ( isset($_COOKIE['c_user']) ) {
			$token = $_COOKIE['c_user'];
			delete_cookie('c_user');  
			$this->Delete_model->deleteCookie($token);
		}
		redirect('at/sign');
	}

// ================ LOGIN / REGISTER PAGE
	public function sign()
	{
		if (startSession('sess_id')) {
			redirect(base_url());
		} else {
			$user = [];
			if($this->facebook->is_authenticated()){
				$fb = $this->facebook->request('get', '/me?fields=first_name,last_name,email,link,gender');
				$user['provider'] = 'facebook';
				$user['role']     = 3;
				$user['uid']      = date('mdHis',time());
				$user['username'] = !empty($fb['first_name']) && !empty($fb['last_name']) ? strtolower($fb['first_name']).' '.strtolower($fb['last_name']) : '';
				$user['email']    = !empty($fb['email']) ? $fb['email'] : '';
				$user['image']    = 'default.gif';
				$user['name']     = !empty($fb['first_name']) && !empty($fb['last_name']) ? $fb['first_name'] .' '. $fb['last_name'] : '';
				$user['gender']   = !empty($fb['gender']) ? $fb['gender'] : 'Laki-laki';
				$checkIn = $this->Read_model->checkUserFb($user);
				if($checkIn){
					$direct = (startSession('reff_page')) ? base_url(getSession('reff_page')) : base_url('u');
					redirect($direct);
				}
			}
			$data['title'] = 'Masuk atau Daftar di Hello World';
			$this->load->view('templates/mainHeader',$data);
			$this->load->view('home/login',$data);
			$this->load->view('templates/mainFooter',$data);
		}
	}


// ================ CHANGE PASSWORD
	public function change()
	{
		if(!startSession('reset_password')){
			redirect('at/sign');
		}
		$session_reset = getSession('reset_password');
		$userReset 		 = $this->Read_model->getUserDataByEmail($session_reset);
		$data['image'] = $userReset['image'];
		$data['username'] = $userReset['username'];
		$data['email'] = $userReset['email'];
		$data['title'] = 'Ganti Password';
		$this->load->view('templates/mainHeader',$data);
		$this->load->view('home/change_password',$data);
		$this->load->view('templates/mainFooter',$data);
	}

// ================ VALIDATION REGISTER
	public function verify()
	{
		$get_token  = $this->uri->segment(3);
		if (!empty($get_token)) {
			$verify = $this->Read_model->getTokenUrl($get_token);
			if ($verify['e'] && $verify['t']) {
				$user = $this->Read_model->getUserDataByEmail($verify['e']);
				if ( $user['active'] == 0 ) {
					$exp_ver = 172800; // 2 day
					if ( time() - $verify['c'] < $exp_ver ) {
						$this->Update_model->updateActivate($verify['e']);
						$this->Delete_model->deleteToken($verify['e']);
						$data['message'] = "alertSuccess('login',['selamat ".$user['username']." <br><br>verifikasi akun berhasil','silahkan menuju halaman login',''])";
					} else {
						$this->Delete_model->deleteToken($verify['e']);
						$this->Delete_model->deleteUser($verify['e']);
						$data['message'] = "alertDanger('login','sesi verifikasi sudah kedaluarsa <br> silahkan registrasi ulang')"; 
					}
				} else {
					$data['message'] = "alertDanger('home','akun ini sudah terverifikasi')";
				}
			} else {
				$data['message'] = "alertDanger('home','token verifikasi tidak valid')";
			}
		} else {
			$data['message'] = "alertDanger('home','Parameter tidak diketahui')";
		}
		$data['title'] = 'Verifikasi Akun';
		$this->load->view('templates/hello',$data);
	}

// ================ VALIDATION FORGOT
	public function reset()
	{
		$get_token  = $this->uri->segment(3);

		if (!empty($get_token)) {
			$reset = $this->Read_model->getTokenUrl($get_token);
			if ($reset['e'] && $reset['t']) {
				$user = $this->Read_model->getUserDataByEmail($reset['e']);
				if ($user['active'] == 1) {
					$this->session->set_userdata('reset_password',$reset['e']);
					$locate = base_url('at/change');
					$data['message'] = "alertSuccess('blank',['password berhasil direset','mohon tunggu sebentar',' '+imgLoad+' '],'".$locate."');";
				} else {
					$data['message'] = "alertDanger('home','akun ini belum terverifikasi')";
				}
			} else {
				$data['message'] = "alertDanger('home','token reset tidak valid')";
			}
		} else {
			$data['message'] = "alertDanger('home','Parameter tidak diketahui')";
		}
		$data['title'] = 'Reset Password';
		$this->load->view('templates/hello',$data);
	}	

// END OF FILE
}