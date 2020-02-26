<?php defined('BASEPATH') OR exit('No direct script access allowed');

class XhrM extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_send_ajax();
		$this->load->model('Common_model');
	}

	private function getUserDataByEmail($post_email)
	{
		$query = $this->Common_model->select_fields_where(
			'users',
			'
			u_id AS id,
			u_username AS username,
			u_email AS email,
			u_active AS active,
			u_register AS register,
			u_role AS role,
			u_password AS password,
			u_image AS image
			',
			['u_email' => $post_email],
			true
		);
		return $query;
	}

	public function set_login() // OK
	{
		$printResult = [];
		$this->form_validation->set_rules('key_email','Email','callback_validate_email');
		$this->form_validation->set_rules('key_pass','Password','callback_validate_pass');
		if ($this->form_validation->run($this) === FALSE) {
			$printResult = [
				'key_email'   => form_error('key_email','<p>','</p>'),
				'key_pass'    => form_error('key_pass','<p>','</p>')
			];
		} else {
			$post_email 		= trim(htmlspecialchars($this->input->post('key_email',true)));
			$post_remember 	= $this->input->post('remember');
			$userLogged = $this->getUserDataByEmail($post_email);
			$ip 		= getIp();
			if ($post_remember == 1 ){
				$defaultCookie 	= 31536000; // 1 year
				$now 						= time();
				$expired 				= $now + $defaultCookie;
				$token 					= sha1($ip.$expired.$userLogged['email'].microtime());
				$data = [
					'created' 	=> $now,
					'expired' 	=> $expired,
					'token' 		=> $token,
					'email' 		=> $userLogged['email'],
					'ip'				=> $ip
				];
				$this->Common_model->insert_record('user_cookie',$data);
				setcookie('c_user',$data['token'],$data['expired'],'/');
			}
			$user_session = [
				'sess_id'    => $userLogged['id'],
				'sess_role'  => $userLogged['role'],
				'sess_user'  => $userLogged['username'],
				'sess_reg'   => $userLogged['register'],
				'sess_image' => base_url('assets/img/profile/').$userLogged['image']
			];
			$this->session->set_userdata($user_session);
			$printResult = [
				'status' => 1,
				'message' => "alertSuccess('blank',['success','please wait',' '+imgLoad+' '], host + 'a')"
			];
		}
		$this->output->set_content_type('aplication/json')->set_output(json_encode($printResult));
	}

// CALLBABCK
	public function validate_email()
	{
		$post_email = trim(htmlspecialchars($this->input->post('key_email',true)));
		$cek_mail 	= $this->getUserDataByEmail($post_email);
		$now = time();
		$ip = getIp();
		if(empty($post_email)){
			$this->form_validation->set_message('validate_email','This field is required');
			return FALSE;
		} else {
			if (!filter_var($post_email,FILTER_VALIDATE_EMAIL)) {
				$this->form_validation->set_message('validate_email','Email format is not valid');
				return FALSE;
			} else {
				if($cek_mail['email'] == null){
					$this->form_validation->set_message('validate_email','This email is not registered');
					return FALSE;
				} else {
					if($cek_mail['active'] == 0){
						$this->form_validation->set_message('validate_email','This email is not activated');
						return FALSE;
					} else {
						return TRUE;
					}
				}
			}
		}
	}
	public function validate_pass()
	{
		$post_email = trim($this->input->post('key_email',true));
		$post_pass 	= trim($this->input->post('key_pass'));
		$cek_pass   = $this->getUserDataByEmail($post_email);
		if (empty($post_pass)) {
			$this->form_validation->set_message('validate_pass', 'This field is required');
			return FALSE;
		} else {
			if ($cek_pass['email']) {
				if (!password_verify($post_pass, $cek_pass['password'])) {
					$this->form_validation->set_message('validate_pass','Password did not match');
					return FALSE;
				} else {
					return TRUE;
				}
			}
		}
	}

// END OF FILE
}