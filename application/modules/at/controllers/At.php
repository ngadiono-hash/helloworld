<?php defined('BASEPATH') OR exit('No direct script access allowed');

class At extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('At_model');
		$this->load->model('Common_model');
	}

	public function haha()
	{
		var_dump($_SESSION);
		$ip  = getIp();
		$agent = $_SERVER['HTTP_USER_AGENT'];
		$where = ['log_email' => 'naflafam@gmail.com', 'log_ip' => $ip, 'log_agent' => $agent];
		$error_pass = $this->Common_model->select_fields_where('login','log_time,log_att',$where,true);
		var_dump($error_pass);
		if ($error_pass['log_time'] + 10 >= time()) {
			echo "error";	
		}	else {
			echo "lanjut";
		}
	}

	public function notFound()
	{
		not_found();
	}

// ================ HOME
	public function index() // ok
	{
		$data['title'] = 'Selamat Datang di Hello World';
		$this->load->view('templates/mainHeader',$data);
		$this->load->view('index',$data);
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
			$this->Common_model->delete('user_cookie',['token' => $token]);
		}
		redirect('at/sign');
	}

// ================ LOGIN / REGISTER
	public function sign()
	{
		if ( startSession('sess_id') ) {
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
				$checkIn = $this->At_model->checkUserFb($user);
				if($checkIn){
					$direct = (startSession('reff_page')) ? base_url(getSession('reff_page')) : base_url('u');
					redirect($direct);
				}
			}
			$data['title'] = 'Masuk atau Daftar di Hello World';
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