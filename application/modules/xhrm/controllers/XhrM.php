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
	private function updateAttempt($now,$where)
	{
		$attempt = $this->Common_model->select_fields_where('login','log_time,log_att',$where,true);
		$exp = intval($attempt['log_time'] + 1800);
		if ($exp < $now) {
			$this->Common_model->update('login',['log_att' => 0, 'log_time' => $now],$where);
		} else {
			$this->db->set('log_att','`log_att`+1',FALSE);
			$this->db->set('log_time',$now);
			$this->db->where($where);
			$this->db->update('login');
		}
	}

	public function search_tutor() //
	{
		$result = [];
		$search = htmlspecialchars($this->input->post('request'));
		$clause = strpos($search,' ');
		$this->db->select(
			't1.snip_title AS title,t1.snip_slug AS slug,t1.snip_meta AS meta,t1.snip_content AS content,t1.snip_update AS update, t2._name AS level,t3._name AS category'
		);
		$this->db->from('tutors AS t1');
		$this->db->join('tutor_lev AS t2','t2._id = t1.snip_level');
		$this->db->join('tutor_cat AS t3','t3._id = t1.snip_category');
		if ($clause !== false) {
    	$exp = explode(' ',$search);
    	$this->db->like('t1.snip_key',trim($exp[0]),'before');
    	// $this->db->or_like('t1.snip_slug',trim($exp[0]),'before');
    	unset($exp[0]);
      foreach ($exp as $term){
        $this->db->or_like('t1.snip_key',trim($term),'before');
        // $this->db->or_like('t1.snip_slug',trim($term),'before');
      }
    } else {
      $this->db->like('t1.snip_key',$search,'before');
      // $this->db->or_like('t1.snip_slug',$search,'before');
    }
		$this->db->where(['t1.snip_bin' => 0, 't1.snip_publish' => 1]);
		$this->db->order_by('snip_update','desc');
		$query = $this->db->get();
		$all_search = $query->result_array();
		if (count($all_search) > 0) {
			foreach ($all_search as $k) {
				$rest[] = [
					'category' 	=> $k['category'],
					'update'    => date('d M Y',$k['update']),
					'level' 		=> $k['level'],
					'title' 		=> $k['title'],
					'slug' 			=> $k['slug'],
					'link' 			=> base_url('lesson/').$k['category'].'/'.$k['meta'],
					'content'   => read_more($k['content'],250)
				];
			}			
			$result['count'] = count($rest);
			$result['list'] = append_tutor($rest);
		} else {
			$result['count'] = 0;
			$result['list'] = [];
		}
		$result['keyword'] = $search;
		$result['db'] = $this->db->last_query();
		$this->output->set_content_type('aplication/json')->set_output(json_encode($result));
	}

	public function create_report() // OK
	{
		$ip 	= $this->input->post('ip');
		$code = $this->input->post('code');
		$page = $this->input->post('page');
		$detail = htmlspecialchars($this->input->post('detail',true));
		$check = $this->Common_model->count_record(
			'bug',
			'id',
			['sender' => $ip,'page' => $page,'code' => $code]
		);
		if ($check == 0){
			$data = [
				'page' => $page,
				'code' => $code,
				'sender' => $ip,
				'detail' => $detail,
				'created' => time(),
				'status' => 1
			];
			$this->Common_model->insert_record('bug',$data);
		}
	}

	public function add_view_snippet()
	{
		$page = $this->input->post('page');
		$count = $this->Common_model->select_spec('snip','code_view',['code_id' => $page]);
		$this->Common_model->update('snip',['code_view' => ($count + 1)],['code_id' => $page]);
	}

	public function load_more_comment() // ok
	{
		$limit = 5;
		$id = $this->input->post('id');
		$serial = $this->input->post('page');
		$countLimited = $this->Common_model->count_record('user_comment','id',['id_target' => $serial, 'created <' => $id]);
		$load = $this->Common_model->select_fields_where_join(
			'user_comment AS t1',
			't1.id,t1.message AS message,t1.created AS created,
			t2.u_id AS id_comm,t2.u_username AS name_comm,t2.u_image AS img_comm,
			t3.code_author AS author',
			[
				['table' => 'users AS t2', 'condition' => 't1.id_user = t2.u_id', 'type' => ''],
				['table' => 'snip AS t3', 'condition' => 't1.id_target = t3.code_id', 'type' => ''],
			],
			['t1.id_target' => $serial,'t1.created <' => $id],
			['t1.created','desc'],
			false,true,5
		);
		$load = append_comment($load);
		foreach ($load as $k => $b) { ?>
			<div class="row row-comment <?=$b['side']?>" id="<?=$b['created']?>">
				<div class="col-xs-12">
					<span class="action <?=$b['side-text']?>">
						<?php if ( startSession('sess_id') && $b['id_comm'] == getSession('sess_id')) { ?>
							<button class="btn btn-default btn-sm">edit</button>
							<a class="btn btn-default btn-sm delete-comment" data-href="<?=base_url('xhru/delete_comment/').$b['created']?>">hapus</a>
						<?php } ?>
					</span>
				</div>
				<div class="col-img <?=$b['side-img']?>">
					<img class="img-user-comm img-thumbnail" src="<?=base_url('assets/img/profile/').$b['img_comm']?>" alt="User Image">
				</div>
				<div class="col-text <?=$b['side-text']?>">
					<div class="direct-chat-text">
						<div class="direct-chat-info">
							<span class="fred"><a href="" class="base-link"><?=$b['name_comm']?></a></span>
							<span class="time-stamp"><?=$b['create']?></span>
						</div>
						<pre><?=$b['message']?></pre>
					</div>
				</div>
			</div>
		<?php } ?>
		<?php if ($countLimited > $limit) { ?>
			<div class="center" id="more">
				<button data-id="<?=$b['created']?>" class="btn-default btn">
					<img class="hide" src="<?=base_url('assets/img/feed/bars.svg')?>" height="35">
					<span>tampilkan lebih banyak komentar</span>
				</button>
			</div>
		<?php }
	}



// LOGIN REGISTER RESET
	public function set_login() // OK
	{
		$printResult = [];
		$this->form_validation->set_rules('key_email', 'Email', 'callback_validate_email');
		$this->form_validation->set_rules('key_pass', 'Password', 'callback_validate_pass');
		if ( $this->form_validation->run($this) == FALSE ) {
			$printResult = [
				'key_email'   => form_error('key_email','<p>','</p>'),
				'key_pass'    => form_error('key_pass','<p>','</p>')
			];
		} else {
			$post_email 		= trim(htmlspecialchars($this->input->post('key_email',true)));
			$post_remember 	= $this->input->post('remember');
			$userLogged = $this->getUserDataByEmail($post_email);
			$ip 		= getIp();
			$agent 	= $_SERVER['HTTP_USER_AGENT'];
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
					'ip'				=> $ip,
					'agent' 		=> $agent,
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
			$this->Common_model->delete('login',['log_email' => $userLogged['email']]);
			$refPage = (startSession('reff_page')) ? getSession('reff_page') : base_url('u');
			$printResult = [
				'status' => 1,
				'message' => "alertSuccess('blank',['kamu berhasil masuk','mohon tunggu sebentar',' '+imgLoad+' '],'".$refPage."')"
			];
			$this->session->unset_userdata('reff_page');
		}
		$this->output->set_content_type('aplication/json')->set_output(json_encode($printResult));
	}
	public function set_register() // OK
	{
		$result = [];
		$this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_numeric|max_length[16]|is_unique[users.u_username]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.u_email]');
		$this->form_validation->set_rules('pass_1', 'Password', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('pass_2', 'Password Konfirmasi', 'trim|required|matches[pass_1]');
		if ($this->form_validation->run($this) == FALSE) {
			$result = [
				'username'  => form_error('username','<p>','</p>'),
				'email'     => form_error('email','<p>','</p>'),
				'pass_1'    => form_error('pass_1','<p>','</p>'),
				'pass_2'    => form_error('pass_2','<p>','</p>')
			];
		} else {
			$post_email = $this->input->post('email',true);
			$post_user  = htmlspecialchars($this->input->post('username',true));
			$post_pass  = $this->input->post('pass_1');
			$token 			= sha1($post_email.$post_user.microtime());
			$user_token = [
				'email'   => $post_email,
				'token'   => $token,
				'created' => time()
			];
			$user_data = [
				'u_id'				=> date('mdHis',time()),
				'u_role'			=> 3,
				'u_username' 	=> $post_user,
				'u_email'			=> $post_email,
				'u_password'	=> password_hash($post_pass, PASSWORD_DEFAULT),
				'u_active'		=> 0,
				'u_register'	=> time(),
				'u_modified'  => time(),
				'u_image'			=> 'default.gif'
			];
			$toVerify = $this->_sendEmail('verify',$token,$post_email,$post_user);
			if($toVerify == 1) {
				$this->Create_model->insertToken($user_token);
				$this->Create_model->insertRegister($user_data);
				$result = [
					'status' => 1,
					'message' => "alertSuccess('ok',['akun berhasil dibuat','silahkan periksa inbox email untuk verifikasi akun','']);"
				];
			} else {
				$result = [
					'status' => 0,
					'message' => "alertBug('report','proses registrasi mengalami gangguan<br> silahkan coba beberapa saat lagi')"
				];
			}
		}
		$this->output->set_content_type('aplication/json')->set_output(json_encode($result));
	}
	public function set_pw_reset() // OK
	{
		$result = [];
		$this->form_validation->set_rules('reset_email', 'Email', 'callback_validate_reset');
		if ( $this->form_validation->run($this) == FALSE ) {
			$result = [
				'reset_email'   => form_error('reset_email','<p>','</p>')
			];
		} else {
			$post_reset = trim($this->input->post('reset_email',true));
			$token = sha1($post_reset.microtime());
			$user_token = [
				'email'   => $post_reset,
				'token'   => $token,
				'created' => time()
			];
			$cek = $this->Common_model->countTokenByEmail($post_reset);
			if ($cek < 1){
				$toReset = $this->_sendEmail('forgot',$token,$post_reset);
				if($toReset) {
					$this->Create_model->insertToken($user_token);
					$result['message'] = "alertSuccess('ok',['link reset password telah dikirim','silahkan periksa inbox email untuk proses selanjutnya',''])";
				} else {
					$result['message'] = "alertBug('report','proses reset password mengalami gangguan<br> silahkan coba beberapa saat lagi')";
				}
			} else {
				$result['message'] = "alertSuccess('ok',['link reset password telah dikirim','silahkan periksa inbox email untuk proses selanjutnya',''])";
			}
		}

		$this->output->set_content_type('aplication/json')->set_output(json_encode($result));
	}
	public function set_pw_change() // OK
	{
		$result = [];
		$this->form_validation->set_rules('pass_1', 'Password', 'trim|required|min_length[6]',
			array('min_length' => '{field} minimal terdiri dari 6 karakter')
		);
		$this->form_validation->set_rules('pass_2', 'Password Konfirmasi', 'trim|required|matches[pass_1]',
			array('matches' => '{field} tidak cocok')
		);
		$this->form_validation->set_message('required','{field} harus diisi');
		if ($this->form_validation->run() == FALSE) {
			$result = [
				'pass_1'    => form_error('pass_1','<p class="text-danger">','</p>'),
				'pass_2'    => form_error('pass_2','<p class="text-danger">','</p>')
			];
		} else {
			$post_pass 	= password_hash($this->input->post('pass_1'),PASSWORD_DEFAULT);
			$sess_email = getSession('reset_password');
			$this->Update_model->updatePassword($sess_email,$post_pass);
			$locate = base_url('at/sign');
			$result = [
				"message" => "alertSuccess('blank',['password berhasil diubah','mohon tunggu sebentar',' '+imgLoad+' '],'".$locate."')"
			];
			$this->Delete_model->deleteToken($sess_email);
			$this->session->unset_userdata('reset_password');
		}
		$this->output->set_content_type('aplication/json')->set_output(json_encode($result));
	}

// CALLBABCK
	public function validate_email() // OK
	{
		$post_email = trim(htmlspecialchars($this->input->post('key_email',true)));
		$cek_mail 	= $this->getUserDataByEmail($post_email);
		$now = time();
		$ip = getIp();
		$agent = $_SERVER['HTTP_USER_AGENT'];
		$where = ['log_email' => $cek_mail['email'], 'log_ip' => $ip, 'log_agent' => $agent];
		if(empty($post_email)){
			$this->form_validation->set_message('validate_email','Email harus diisi');
			return FALSE;
		} else {
			if (!filter_var($post_email,FILTER_VALIDATE_EMAIL)) {
				$this->form_validation->set_message('validate_email','Format Email tidak valid');
				return FALSE;
			} else {
				if($cek_mail['email'] == null){
					$this->form_validation->set_message('validate_email','Email ini tidak <b>terdaftar</b> di sistem kami');
					return FALSE;
				} else {
					if($cek_mail['active'] == 0){
						$this->form_validation->set_message('validate_email','Email ini belum <b>teraktivasi</b> di sistem kami');
						return FALSE;
					} else {
						$error_mail = $this->Common_model->select_fields_where(
							'login',
							'log_att AS attempt,log_time AS time',
							['log_email' => $cek_mail['email'], 'log_ip' => $ip, 'log_agent' => $agent],
							true
						);
						$end = $error_mail['time'] + 1800;
						if (($error_mail['attempt'] == 5) && ($now < $end)) {
							$diff 	= $end - $now;
							$hour 	= floor($diff/(3600));
							$minute = $diff - $hour * (3600);
							$minutes = floor($minute/60);
							if ($hour != 0) {
								$time = $hour.' jam '.$minutes.' menit ';
							} elseif ($minutes != 0) {
								$time = $minutes.' menit';
							} else {
								$time = ' beberapa detik ';
							}
							$this->form_validation->set_message('validate_email', '<b>Email ini terblokir untuk sementara.</b><br> Silahkan login kembali dalam waktu '.$time.' lagi<br> atau gunakan fitur Lupa Password');
							return FALSE;
						} elseif( ($error_mail['attempt'] == 5) && ($now > $end)) {
							$notif = [
								'user' 	=> $cek_mail['email'],
								'ip' 		=> $ip,
								'agent' => $agent,
								'created' => $now,
							];
							$create_notif = $this->Common_model->insert_record('user_secure',$notif);
							if ($create_notif) {
								$this->Common_model->update('notification',['security' => 1],['user' => $cek_mail['id']]);
								$this->Common_model->update('login',['log_att' => 0, 'log_time' => $now],$where);
							}
							return TRUE;
						}
					}
				}
			}
		}
	}
	public function validate_pass() // OK
	{
		$post_email = trim($this->input->post('key_email',true));
		$post_pass 	= trim($this->input->post('key_pass'));
		$cek_pass   = $this->getUserDataByEmail($post_email);
		$now = time();
		$ip  = getIp();
		$agent = $_SERVER['HTTP_USER_AGENT'];
		$where = ['log_email' => $cek_pass['email'], 'log_ip' => $ip, 'log_agent' => $agent];
		if (empty($post_pass)) {
			$this->form_validation->set_message('validate_pass', 'Password harus diisi');
			return FALSE;
		} else {
			if ($cek_pass['email']) {
				if (!password_verify($post_pass, $cek_pass['password'])) {
					$count = $this->Common_model->count_record('login','id',$where);
					if ($count == 0) {
						$this->Common_model->insert_record(
							'login',
							[
								'log_time' 	=> $now,
								'log_email' => $cek_pass['email'],
								'log_ip' 		=> $ip,
								'log_agent' => $agent,
								'log_att' 	=> 0
							]
						);
						$this->form_validation->set_message('validate_pass','<b>Password Salah</b>');
						return FALSE;
					}
					$attempt = $this->Common_model->select_fields_where('login','log_time,log_att',$where,true);
					if ( $attempt['log_att'] == 0 ) {
						$this->form_validation->set_message('validate_pass', '<b>Password Salah !</b>');
						$this->updateAttempt($now,$where);
						return FALSE;
					} elseif ( $attempt['log_att'] == 1 ) {
						$this->form_validation->set_message('validate_pass', '<b>Password masih Salah !</b>');
						$this->updateAttempt($now,$where);
						return FALSE;
					} elseif ( $attempt['log_att'] == 2 ) {
						$this->form_validation->set_message('validate_pass', '<b>Password masih Salah !</b> <br>Percobaan Login untuk yang kesekian kalinya dengan password yang salah');
						$this->updateAttempt($now,$where);
						return FALSE;
					} elseif ( $attempt['log_att'] == 3 ) {
						$this->form_validation->set_message('validate_pass', '<b>Password Salah</b> <br>Kesempatan sekali lagi untuk Login, gunakan dengan hati-hati');
						$this->updateAttempt($now,$where);
						return FALSE;
					} elseif ( $attempt['log_att'] == 4 ) {
						$this->form_validation->set_message('validate_pass', '');
						$this->updateAttempt($now,$where);
						return FALSE;
					}
				}
			}
		}
	}
	// public function validate_reset() // OK
	// {
	// 	$post_reset = trim($this->input->post('reset_email',true));
	// 	$user = $this->Common_model->getUserDataByEmail($post_reset);
	// 	if (empty($post_reset)) {
	// 		$this->form_validation->set_message('validate_reset', 'Email akun dibutuhkan');
	// 		return FALSE;
	// 	} else {
	// 		if (!filter_var($post_reset, FILTER_VALIDATE_EMAIL)) {
	// 			$this->form_validation->set_message('validate_reset', 'Format Email tidak valid');
	// 			return FALSE;
	// 		} else {
	// 			if($user['email'] == null){
	// 				$this->form_validation->set_message('validate_reset', 'Email ini tidak <b>terdaftar</b> di sistem kami');
	// 				return FALSE;
	// 			} else {
	// 				if($user['active'] == 0){
	// 					$this->form_validation->set_message('validate_reset', 'Email ini belum <b>teraktivasi</b> di sistem kami');
	// 					return FALSE;
	// 				} else {
	// 					$cek = $this->Common_model->countTokenByEmail($post_reset);
	// 					if ($cek == 1) {
	// 						$this->form_validation->set_message('validate_reset', 'Link Reset Password telah dikirim ke email ini.<br> Silahkan cek inbox email.');
	// 						return FALSE;
	// 					}
	// 				}
	// 			}
	// 		}
	// 	}
	// }

// SEND-EMAIL
	private function _sendEmail($type,$token,$email,$user='')
	{
		$config = [
			'protocol'  	=> 'smtp',
			'smtp_host' 	=> 'ssl://smtp.googlemail.com',
			'smtp_user' 	=> 'myhelloworld86@gmail.com',
			'smtp_pass' 	=> 'rosiatulmahmud4h',
			'smtp_timeout'=> 30,
			'smtp_port' 	=> 465,
			'mailtype'  	=> 'html',
			'charset'   	=> 'iso-8859-1',
			'newline'   	=> "\r\n",
			'wordwrap'  	=> TRUE,
			'validation' 	=> TRUE
		];
		$this->load->library('email');
		$this->email->initialize($config);
		$this->email->from('myhelloworld86@gmail.com', 'Hello World');
		$this->email->reply_to('no-reply@gmail.com', 'Hello World');
		$this->email->to($email);

		if ($type == 'verify') {
			$send_link = base_url().'at/verify/'.urldecode($token);
			$body = $this->load->view('templates/emailHeader','',true);
			$body .= '
			<h2 style="margin: 20px 0">Hai '.$user.', <br>terima kasih telah melakukan pendaftaran</h2>
			<p style="text-align: left;">Akunmu telah berhasil dibuat, tapi masih belum aktif dan belum bisa digunakan untuk login.</p>
			<p style="text-align: left;">Agar kamu bisa masuk ke akun yang baru dibuat, lakukan langkah verifikasi dengan meng-klik tautan di bawah ini.</p>
			<a style="font-family: Arial, Sans-serif" href="'.$send_link.'">'.$send_link.'</a>
			<p style="text-align: left; margin-top: 50px; font-size: 14px;">
			<strong>Note:</strong>
			<br> - Email ini hanya akan valid selama 2 x 24 jam sejak dikirimkannya.
			<br> - Segera lakukan verifikasi sebelum data yang kamu kirim dihapus oleh sistem.
			<br> - Mohon jangan membalas email ini.</p>';
			$body .= $this->load->view('templates/emailFooter','',true);
			$this->email->subject('Verifikasi Akun Hello World');
			$this->email->message($body);

		} elseif ($type == 'forgot' ) {
			$send_link = base_url().'at/reset/'.urldecode($token);
			$body = $this->load->view('templates/emailHeader','',true);
			$body .= '
			<h2 style="margin: 20px 0">Hai pemilik akun '.$email.'</h2>
			<p style="text-align: left;">Beberapa waktu yang lalu, kamu meminta untuk melakukan reset password untuk akun dengan alamat email '.$email.'.</p>
			<p style="text-align: left;">Langkah berikutnya untuk melanjutkan proses reset password ini adalah dengan meng-klik tautan di bawah ini.</p>
			<a style="font-family: Arial, Sans-serif" href="'.$send_link.'">'.$send_link.'</a>
			<p style="text-align: left; margin-top: 50px; font-size: 14px;">
			<strong>Note:</strong>
			<br> - Email ini hanya akan valid selama 2 x 24 jam sejak dikirimkannya.
			<br> - Segera lakukan verifikasi sebelum data yang kamu kirim dihapus oleh sistem.
			<br> - Mohon jangan membalas email ini.</p>';
			$body .= $this->load->view('templates/emailFooter','',true);
			$this->email->subject('Reset Password Akun Hello World');
			$this->email->message($body);
		}

		$temp = $this->email->send();
		if ($temp) {
			$temp_result = 1;
		} else {
			$temp_result = 0;
		}
		return $temp_result;
	}

// END OF FILE
}