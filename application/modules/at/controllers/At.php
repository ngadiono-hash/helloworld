<?php defined('BASEPATH') OR exit('No direct script access allowed');

class At extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Common_model');
	}

	public function notFound()
	{
		not_found();
	}

// ================ HOME
	public function index() // ok
	{
		$data['label'] = $this->Common_model->select_where('level','*','',TRUE,FALSE);
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
			$this->Common_model->delete('user_cookie',['token' => $token]);
		}
		redirect('at/sign');
	}

// ================ LOGIN / REGISTER
	public function sign()
	{
		reload_session();
		if ( startSession('sess_id') ) {
			redirect('at');
		} else {
			$data['title'] = 'Welcome Administrator';
			$this->load->view('templates/mainHeader',$data);
			$this->load->view('login',$data);
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
		$userReset 		 = $this->At_model->getUserDataByEmail($session_reset);
		$data['image'] = $userReset['image'];
		$data['username'] = $userReset['username'];
		$data['email'] = $userReset['email'];
		$data['title'] = 'Ganti Password';
		$this->load->view('templates/mainHeader',$data);
		$this->load->view('change_password',$data);
		$this->load->view('templates/mainFooter',$data);
	}

// ================ VALIDATION REGISTER
	public function verify()
	{
		$get_token  = $this->uri->segment(3);
		if (!empty($get_token)) {
			$verify = $this->At_model->getTokenUrl($get_token);
			if ($verify['e'] && $verify['t']) {
				$user = $this->At_model->getUserDataByEmail($verify['e']);
				if ( $user['active'] == 0 ) {
					$exp_ver = 172800; // 2 day
					if ( time() - $verify['c'] < $exp_ver ) {
						$this->At_model->updateActivate($verify['e']);
						$this->At_model->deleteToken($verify['e']);
						$data['message'] = "alertSuccess('login',['selamat ".$user['username']." <br><br>verifikasi akun berhasil','silahkan menuju halaman login',''])";
					} else {
						$this->At_model->deleteToken($verify['e']);
						$this->At_model->deleteUser($verify['e']);
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
		$this->load->view('verification',$data);
	}

// ================ VALIDATION FORGOT
	public function reset()
	{
		$get_token  = $this->uri->segment(3);

		if (!empty($get_token)) {
			$reset = $this->At_model->getTokenUrl($get_token);
			if ($reset['e'] && $reset['t']) {
				$user = $this->At_model->getUserDataByEmail($reset['e']);
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
		$this->load->view('verification',$data);
	}	

// END OF FILE
}