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
		$query = $this->Common_model->select_where(
			'users',
			'u_id AS id,u_username AS username,u_email AS email,u_active AS active,u_register AS register,
			u_role AS role,u_password AS password,u_image AS image',
			['u_email' => $post_email],
			TRUE,TRUE
		);
		return $query;
	}

	public function check_user()
	{
		$this->form_validation->set_rules('user','Username','is_unique[score.user]|min_length[5]|max_length[20]|alpha_dash');
		if ($this->form_validation->run() == false) {
			$result = [false,'username tidak tersedia'];
		} else {
			$result = [true,'username tersedia'];
		}
		echo json_encode($result);
	}

	public function get_quiz()
	{
		$level = $this->input->post('level');
		$myQuiz = $this->Common_model->select_where(
			'quiz',
			'id,q_question,q_answer',
			['q_level' => $level, 'q_active' => 1]
		);
		$num = 1;
		foreach ($myQuiz as $k => $v) :
		$ans[$k] = explode(',',$v['q_answer']);
		?>
		<div class="card scale-in-center" style="display:none">
		  <div class="card-body">
		    <form class="quiz-form">
		      <div class="text-center btn-panel mb-3">
		        <button type="button" class="btn btn-danger">Soal Latihan #<?=$num?></button>
		        <button type="button" class="btn btn-default scale-in-center submit" style="display: none;">Selanjutnya</button>
		        <button type="button" class="btn btn-danger"><span class="spent">detik</span></button>
		      </div>
		      <input type="hidden" name="id" value="<?=$v['id']?>">
		      <div class="question"><?=$v['q_question']?></div>
		      <hr>
		      <div class="row answer">
		      <?php
		        $cho = 1;
		        $letter = ord('A');
		        foreach ($ans[$k] as $kv => $vk) :
		      ?>
		        <div class="col-md-6 wrap">
		          <input type="radio" name="ch" id="<?= 'choice'.$num.$cho ?>" value="<?=$cho?>">
		          <label for="<?='choice'.$num.$cho?>"><?='<b>'.chr($letter).'.</b> '.html_entity_decode($vk)?></label>
		        </div>
		      <?php
		        $cho++;
		        $letter++;
		        endforeach;
		      ?>
		      </div>
		    </form>
		  </div>
		</div> <?php
		$num++;
		endforeach;
	}

	public function get_result()
	{
		sleep(4);
		$score = 0;
		$post = $this->input->post('quest');
		foreach ($post as $k => $v) {
			$test[$k] = $this->Common_model->select_where('quiz','*',['id'=>$v['id']],true,true);
			$true[$k] = explode(',',html_entity_decode($test[$k]['q_answer']));
			if (isset($v['ch'])) {
				if ($v['ch'] == $test[$k]['q_correct']) {
					$score++;
					$return = true;
				} else {
					$return = false;
				}
			} else {
				$return = false;
			}
			$result['evaluate'][$k] = [
				'question' => $test[$k]['q_question'],
				'correct' => $true[$k][$test[$k]['q_correct']-1],
				'yours' => (isset($v['ch'])) ? $true[$k][$v['ch']-1] : null,
				'result' => $return
			];
		}
		$result['plain'] = [];
		$result['score'] = $score / count($post) * 100;
		  if ($result['score'] == 100) {
		    $img = 'horray.gif';
		    $h3 = 'baik sekali';
		    $h4 = 'semua soal berhasil dijawab dengan benar';
		  } else if ($result['score'] == 0) {
		  	$img = 'no.gif';
		  	$h3 = '...';
		  	$h4 = 'tidak ada soal yang dijawab dengan benar';
		  } else if ($result['score'] >= 75) {
		    $img = 'ok.gif';
		    $h3 = 'kamu punya bakat, tetap asah logikamu lagi';
		    $h4 = 'dari '.count($post).' soal, '.$score.' di antaranya berhasil dijawab dengan benar';
		  } else if ($result['score'] >= 50) {
		    $img = 'mikir.gif';
		    $h3 = 'lumayan bagus lah sejauh ini';
		    $h4 = 'kamu bisa menjawab '.$score.' soal dengan benar <br> dari '.count($post).' soal yang tersedia';
		  } else if ($result['score'] >= 25) {
		  	$img = 'hmm.gif';
		  	$h3 = 'coba lebih serius dalam belajar';
		  	$h4 = 'kamu hanya bisa menjawab '.$score.' soal dengan benar <br> dari '.count($post).' soal yang tersedia';
		  } else {
		    $img = 'ouch.gif';
		    $h3 = 'baca dokumentasi materi dengan lebih teliti';
		    $h4 = 'kamu hanya bisa menjawab '.$score.' soal dengan benar <br> dari '.count($post).' soal yang tersedia';
		  }
			$result['plain'] = ['img' => $img,'h3' => $h3,'h4' => $h4];

		echo json_encode($result);
	}

	// public function get_exercise()
	// {
	// 	$level = $this->input->post('level');
	// 	$sql = "SELECT A.id,les_title,q_question,q_answer
	// 					FROM quiz AS A
	// 					JOIN materi AS B ON B.les_id = A.q_rel
	// 					WHERE q_level = '".$level."'
	// 					GROUP BY q_rel
	// 					ORDER BY les_order ASC";
	// 	$result = $this->db->query($sql)->result_array();
	// 	echo json_encode($result);
	// }

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
						$this->db->or_like('les_key',strtolower($key));
					}
				} else {
						$this->db->like('les_key',strtolower($term));
				}
				$this->db->where('les_publish',1);
				$run = $this->db->get();
				$search_results = $run->num_rows();
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
				} else {
					$exec = $this->Common_model->insert_record('user_cookie',$data);
					if ($exec) {
						setcookie('_no',$id,$expired,'/');
						setcookie('_lang',$token,$expired,'/');
					}
				}
			}
			die();
			$user_session = [
				'sess_log'  => true,
				'sess_id'   => $userLogged['id'],
				'sess_role' => $userLogged['role']
			];
			// $this->session->set_userdata($user_session);
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