<?php defined('BASEPATH') OR exit('No direct script access allowed');

class XhrM extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_send_ajax();
		$this->load->model('Common_model');
	}

	public function get_list_menu() // 
	{
		$result = [];
		$category = $this->input->post('request');
		$on_user = $this->input->post('user');
		if (!empty($on_user)) {
			// $app = $this->Common_model->xhrm_getProgress($on_user);
			$as = [];
			foreach ($app as $a) {
				$as[] = $a['id'];
			}
		}
		$all_category = $this->Common_model->select_fields_where(
			'tutor_lev',
			'_name AS Lname',
			['_cat' => $category]
		);
		foreach ($all_category as $l) {
			$result['cat'][] = $l['Lname'];
		}
		$all_category_by_cat = $this->Common_model->select_fields_where_join(
			'tutors AS t1',
			't1.snip_id AS id,t1.snip_title AS title,t1.snip_slug AS slug,t1.snip_meta AS meta,t2._name AS level,t3._name AS category',
			[
				['table' => 'tutor_lev AS t2', 'condition' => 't2._id = t1.snip_level', 'type' => ''],
				['table' => 'tutor_cat AS t3', 'condition' => 't3._id = t1.snip_category', 'type' => '']
			],
			['t1.snip_category' => $category, 't1.snip_bin' => 0, 't1.snip_publish' => 1],
			['t1.snip_order','asc']
		);
		foreach ($all_category_by_cat as $k) {
			$result['list'][] = [
				'category' 	=> $k['category'],
				'level' 		=> $k['level'],
				'title' 		=> $k['title'],
				'slug' 			=> $k['slug'],
				'link' 			=> base_url('lesson/').$k['category'].'/'.$k['meta']
			];
		}
		if (!empty($on_user)) {
			foreach ($all_category_by_cat as $k) {
				$result['list'][] = [
					'match' 		=> (in_array($k['id'], $as)) ? 1 : 0
				];
			}
		}
		$this->output->set_content_type('aplication/json')->set_output(json_encode($result));
	}
	public function create_report() // OK
	{
		$ip = $this->input->post('ip');
		$code = $this->input->post('code');
		$page = $this->input->post('page');
		$detail = htmlspecialchars($this->input->post('detail',true));
		$check = $this->Common_model->checkExist('bug',['sender' => $ip,'page' => $page,'code' => 'undefined']);
		if ($check == 0){
			$bug_data = [
				'page' => $page,
				'code' => $code,
				'sender' => $ip,
				'detail' => $detail,
				'created' => time(),
				'status' => 1
			];
			$this->Create_model->insertBug($bug_data);
		}
	}
	public function load_more_comment() // OK
	{
		$limit = 5;
		$id = $this->input->post('id');
		$page = $this->input->post('page');
		$countLimited = $this->Common_model->countCommentLimited($page,['created <' => $id]);
		$load = $this->Common_model->getCommentSnippet($page,$limit,['t1.created <' => $id]);
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
						<p><?=$b['message']?></p>
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
			$post_email 		= trim($this->input->post('key_email',true));
			$post_remember 	= $this->input->post('remember');
			$userLogged 		= $this->Common_model->getUserDataByEmail($post_email);
			$ip 		= getIp();
			$agent 	= $_SERVER['HTTP_USER_AGENT'];			
			if ($post_remember == 1 ){
				$defaultCookie 	= 31536000; // 1 year
				$now 						= time();
				$expired 				= $now + $defaultCookie;
				$token 					= sha1($ip.$expired.$userLogged['email'].microtime());
				$dataCookie = [
					'expired' 	=> $expired,
					'token' 		=> $token,
					'email' 		=> $userLogged['email'],
					'ip'				=> $ip,
					'agent' 		=> $agent,
				];
				$this->Create_model->insertCookie($dataCookie);
			}
			$user_session = [
				'sess_id'    => $userLogged['id'],
				'sess_role'  => $userLogged['role'],
				'sess_user'  => $userLogged['username'],
				'sess_reg'   => $userLogged['register'],
				'sess_image' => base_url('assets/img/profile/').$userLogged['image']
			];
			$this->session->set_userdata($user_session);
			$this->Delete_model->deleteAttempt($userLogged['email']);
			$refPage = (startSession('reff_page')) ? base_url(getSession('reff_page')) : base_url('u');
				$printResult = [
					'status' => 1,
					'message' => "alertSuccess('blank',['kamu berhasil masuk','mohon tunggu sebentar',' '+imgLoad+' '],'".$refPage."')"
				];
			$this->session->unset_userdata('reff_page');
			
		}
		$this->output->set_content_type('aplication/json')->set_output(json_encode($printResult));
	}
	// public function set_register() // OK
	// {
	// 	$result = [];
	// 	$this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_numeric|max_length[16]|is_unique[users.u_username]');
	// 	$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.u_email]');
	// 	$this->form_validation->set_rules('pass_1', 'Password', 'trim|required|min_length[6]');
	// 	$this->form_validation->set_rules('pass_2', 'Password Konfirmasi', 'trim|required|matches[pass_1]');
	// 	if ($this->form_validation->run($this) == FALSE) {
	// 		$result = [
	// 			'username'  => form_error('username','<p>','</p>'),
	// 			'email'     => form_error('email','<p>','</p>'),
	// 			'pass_1'    => form_error('pass_1','<p>','</p>'),
	// 			'pass_2'    => form_error('pass_2','<p>','</p>')
	// 		];
	// 	} else {
	// 		$post_email = $this->input->post('email',true);
	// 		$post_user  = htmlspecialchars($this->input->post('username',true));
	// 		$post_pass  = $this->input->post('pass_1');
	// 		$token 			= sha1($post_email.$post_user.microtime());
	// 		$user_token = [
	// 			'email'   => $post_email,
	// 			'token'   => $token,
	// 			'created' => time()
	// 		];
	// 		$user_data = [
	// 			'u_id'				=> date('mdHis',time()),
	// 			'u_role'			=> 3,
	// 			'u_username' 	=> $post_user,
	// 			'u_email'			=> $post_email,
	// 			'u_password'	=> password_hash($post_pass, PASSWORD_DEFAULT),
	// 			'u_active'		=> 0,
	// 			'u_register'	=> time(),
	// 			'u_modified'  => time(),
	// 			'u_image'			=> 'default.gif'
	// 		];
	// 			$toVerify = $this->_sendEmail('verify',$token,$post_email,$post_user);
	// 		if($toVerify == 1) {
	// 			$this->Create_model->insertToken($user_token);
	// 			$this->Create_model->insertRegister($user_data);
	// 			$result = [
	// 				'status' => 1,
	// 				'message' => "alertSuccess('ok',['akun berhasil dibuat','silahkan periksa inbox email untuk verifikasi akun','']);"
	// 			];
	// 		} else {
	// 			$result = [
	// 				'status' => 0,
	// 				'message' => "alertBug('report','proses registrasi mengalami gangguan<br> silahkan coba beberapa saat lagi')"
	// 			];
	// 		}
	// 	}
	// 	$this->output->set_content_type('aplication/json')->set_output(json_encode($result));
	// }
	// public function set_pw_reset() // OK
	// {
	// 	$result = [];
	// 	$this->form_validation->set_rules('reset_email', 'Email', 'callback_validate_reset');
	// 	if ( $this->form_validation->run($this) == FALSE ) {
	// 		$result = [
	// 			'reset_email'   => form_error('reset_email','<p>','</p>')
	// 		];
	// 	} else {
	// 		$post_reset = trim($this->input->post('reset_email',true));
	// 		$token = sha1($post_reset.microtime());
	// 		$user_token = [
	// 			'email'   => $post_reset,
	// 			'token'   => $token,
	// 			'created' => time()
	// 		];
	// 		$cek = $this->Common_model->countTokenByEmail($post_reset);
	// 		if ($cek < 1){
	// 			$toReset = $this->_sendEmail('forgot',$token,$post_reset);
	// 			if($toReset) {
	// 				$this->Create_model->insertToken($user_token);
	// 				$result['message'] = "alertSuccess('ok',['link reset password telah dikirim','silahkan periksa inbox email untuk proses selanjutnya',''])";
	// 			} else {
	// 				$result['message'] = "alertBug('report','proses reset password mengalami gangguan<br> silahkan coba beberapa saat lagi')";
	// 			}				
	// 		} else {
	// 			$result['message'] = "alertSuccess('ok',['link reset password telah dikirim','silahkan periksa inbox email untuk proses selanjutnya',''])";
	// 		}
	// 	}

	// 	$this->output->set_content_type('aplication/json')->set_output(json_encode($result));
	// }
	// public function set_pw_change() // OK
	// {
	// 	$result = [];
	// 	$this->form_validation->set_rules('pass_1', 'Password', 'trim|required|min_length[6]',
	// 				array('min_length' => '{field} minimal terdiri dari 6 karakter')
	// 			);
	// 	$this->form_validation->set_rules('pass_2', 'Password Konfirmasi', 'trim|required|matches[pass_1]',
	// 				array('matches' => '{field} tidak cocok')
	// 			);
	// 	$this->form_validation->set_message('required','{field} harus diisi');
	// 	if ($this->form_validation->run() == FALSE) {
	// 		$result = [
	// 			'pass_1'    => form_error('pass_1','<p class="text-danger">','</p>'),
	// 			'pass_2'    => form_error('pass_2','<p class="text-danger">','</p>')
	// 		];
	// 	} else {
	// 		$post_pass 	= password_hash($this->input->post('pass_1'),PASSWORD_DEFAULT);
	// 		$sess_email = getSession('reset_password');
	// 		$this->Update_model->updatePassword($sess_email,$post_pass);
	// 		$locate = base_url('at/sign');
	// 		$result = [
	// 			"message" => "alertSuccess('blank',['password berhasil diubah','mohon tunggu sebentar',' '+imgLoad+' '],'".$locate."')"
	// 		];
	// 		$this->Delete_model->deleteToken($sess_email);
	// 		$this->session->unset_userdata('reset_password');
	// 	}
	// 	$this->output->set_content_type('aplication/json')->set_output(json_encode($result));
	// }

// CALLBABCK
	public function validate_email() // OK
	{
		$post_email = trim($this->input->post('key_email',true));
		$cek_mail 	= $this->Common_model->getUserDataByEmail($post_email);		
		$now = time();
		$ip = getIp();
		$agent = $_SERVER['HTTP_USER_AGENT'];
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
						$error_mail = $this->Common_model->getAttempt($cek_mail['email'],$ip,$agent);
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
							$this->form_validation->set_message('validate_email', '<b>Email ini terblokir untuk sementara.</b><br> Silahkan login kembali dalam waktu '.$time.' lagi');
							return FALSE;
						} elseif( ($error_mail['attempt'] == 5) && ($now > $end)) {
							$notif = [
								'user' => $cek_mail['email'],
								'ip' => $ip,
								'agent' => $agent,
								'created' => $now,
							];
							$this->Create_model->insertNotifLogin($notif);
							$this->Update_model->updateNotif(['security' => 1],['user' => $cek_mail['id']]);
							$this->Update_model->updateResetAttempt($now,$cek_mail['email'],$ip,$agent);
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
		$cek_pass   = $this->Common_model->getUserDataByEmailActive($post_email);
		$now = time();
		$ip = getIp();
		$agent = $_SERVER['HTTP_USER_AGENT'];
		if (empty($post_pass)) {
			$this->form_validation->set_message('validate_pass', 'Password harus diisi');
			return FALSE;
		} else {
			if ($cek_pass['email']) {
				if (!password_verify($post_pass, $cek_pass['password'])) {
					$count = $this->Common_model->checkExist('login_attempt',['log_email'=>$cek_pass['email'],'log_ip'=>$ip,'log_agent'=>$agent]);					
					if ($count == 0) {
						$this->Create_model->insertAttempt($cek_pass['email']);
						$this->form_validation->set_message('validate_pass', '<b>Password Salah</b>');
						return FALSE;
					}
					$error_pass = $this->Common_model->getAttempt($cek_pass['email'],$ip,$agent);
					if ( $error_pass['attempt']  == 0 ) {
						$this->form_validation->set_message('validate_pass', '<b>Password Salah !</b>');
						$this->Update_model->updateAttempt($now,$cek_pass['email'],$ip,$agent);
						return FALSE;
					} elseif ( $error_pass['attempt'] == 1 ) {
						$this->form_validation->set_message('validate_pass', '<b>Password masih Salah !</b>');
						$this->Update_model->updateAttempt($now,$cek_pass['email'],$ip,$agent);
						return FALSE;
					} elseif ( $error_pass['attempt'] == 2 ) {
						$this->form_validation->set_message('validate_pass', '<b>Password masih Salah !</b> <br>Percobaan Login untuk yang kesekian kalinya dengan password yang salah');
						$this->Update_model->updateAttempt($now,$cek_pass['email'],$ip,$agent);
						return FALSE;
					} elseif ( $error_pass['attempt'] == 3 ) {
						$this->form_validation->set_message('validate_pass', '<b>Password Salah</b> <br>Kesempatan sekali lagi untuk Login, gunakan dengan hati-hati');
						$this->Update_model->updateAttempt($now,$cek_pass['email'],$ip,$agent);
						return FALSE;
					} elseif ( $error_pass['attempt'] == 4 ) {
						$this->form_validation->set_message('validate_pass', '');
						$this->Update_model->updateAttempt($now,$cek_pass['email'],$ip,$agent);
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