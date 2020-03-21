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
		// select_where($table,$data,$where,$array=TRUE,$single=FALSE,$order='',$limit='')
		$query = $this->Common_model->select_where(
			'users',
			'u_id AS id,u_username AS username,u_email AS email,u_active AS active,u_register AS register,
			u_role AS role,u_password AS password,u_image AS image',
			['u_email' => $post_email],
			TRUE,TRUE
		);
		return $query;
	}

	public function search()
	{
		$term = trimChar_input('search');
		$term = substr($term,0,100);
		if (!empty($term)) {
			if (strlen($term) >= 4) {
				$this->db->from('materi');
				if (strpos($term,' ') !== false) {
					$search_exploded = filterSearchKeys($term);

					foreach($search_exploded as $key){
						// $this->db->like('les_title',strtolower($term));
						// $this->db->or_like('les_slug',strtolower($term));
						$this->db->or_like('les_key',strtolower($key));
					}
				} else {
						$this->db->like('les_key',strtolower($term));
				}
				$this->db->where('les_publish',1);
				$run = $this->db->get();
				$search_results = $run->num_rows();
				// bug($this->db->last_query());
				if ($search_results === 0) {
				  $result = [0,'Maaf, tidak ada hasil ditemukan untuk pencarian <br><b>"'.$term.'"</b>'];
				} else {
					$r = $run->result_array();
					foreach ($r as $key => $v) {
						$arr[$key] = [
							'title' => $v['les_title'],
							'slug' => $v['les_slug'],
							'keys' => explode(',',$v['les_key']),
							'link' => base_url().'lesson/docs/'.create_slug($v['les_slug'])
						];
					}
					$result = [1,'ditemukan '.$search_results.' hasil pencarian untuk keyword <br><b>"'.$term.'"</b>',$arr];
				}
				
			} else {
				$result = [0,"Maaf, keyword yang dibutuhkan minimal 4 karakter"];
			}
		} else {
			$result = [0,"Ketik Keyword dan tekan Enter untuk melakukan pencarian"];
		}
		echo json_encode($result);
	}

	public function adm()
	{
		$acc = trimChar_input('access');
		$access = $this->Common_model->select_specific('access','keyword',['id'=>1]);
		if (password_verify($acc,$access)) {
			$_SESSION['access'] = true;
			$result = [1,"please login to continue <i class='fa fa-spinner fa-spin'></i>","at/sign"];
		} else {
			$result = [0,'failed to access',null];
		}
		echo json_encode($result);
	}

	public function set_login() // OK
	{
		$this->form_validation->set_rules('key_email','Email','callback_validate_email');
		$this->form_validation->set_rules('key_pass','Password','callback_validate_pass');
		if ($this->form_validation->run($this) === FALSE) {
			$result = [
				'key_email' => form_error('key_email','<p class="text-warning">','</p>'),
				'key_pass'  => form_error('key_pass','<p class="text-warning">','</p>')
			];
		} else {
			$post_email 		= trimChar_input('key_email');
			$post_remember 	= $this->input->post('remember');
			$userLogged = $this->getUserDataByEmail($post_email);
			if ($post_remember == 1 ){
				// $year 	= 31536000;
				// $month	= 2592000;
				$week 	= 604800;
				// $day 		= 86400;
				$expired 	= time() + $week;
				$id 			= $userLogged['id'];
				$token 		= hash('sha256',$userLogged['email']);
				$data = [
					'email' 		=> $userLogged['email'],
					'token' 		=> $token,
					'expired' 	=> $expired
				];
				$check = $this->Common_model->check_exist('user_cookie',['email' => $post_email]);
				if ($check) {
					$this->Common_model->delete('user_cookie',['email' => $post_email]);
				}
				$exe = $this->Common_model->insert_record('user_cookie',$data);
				if ($exe) {
					setcookie('_no',$id,$expired,'/');
					setcookie('_lang',$token,$expired,'/');
				}
			}
			$user_session = [
				'sess_log'  => true,
				'sess_id'   => $userLogged['id'],
				'sess_role' => $userLogged['role']
			];
			$this->session->set_userdata($user_session);
			$direct = (startSession('reff')) ? getSession('reff') : 'a';
			$this->session->unset_userdata(['reff','access']);
			$result = [1,"Please Wait <i class='fa fa-spinner fa-spin'></i>",$direct];
		}

		echo json_encode($result);
	}

// CALLBABCK
	public function validate_email()
	{
		$post_email = trimChar_input('key_email');
		$cek_mail 	= $this->getUserDataByEmail($post_email);
		// $now = time();
		// $ip = getIp();
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