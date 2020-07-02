<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Xhrm extends CI_Controller
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

	public function submit_Score()
	{
		sleep(2);
		$result = [];
		$label = trimChar_input('label');
		$score = trimChar_input('score');
		$user = trimChar_input('user');
		$check = $this->Common_model->check_exist('score',['user'=>$user,'level'=>$label]);
		if ($check) {
			$result = [0,'username '.$user.' telah terdaftar sebelumnya',null];
		} else {
			if ($score <= 0) {
				$result = [0,'maaf '.$user.', kami tidak bisa menerima score kamu',null];
			} else {
				$data = [
					'user' =>$user,
					'level' => $label,
					'score' => $score,
					'date' => time()
				];
				$this->Common_model->insert_record('score',$data);
				$result = [1,'terima kasih '.$user.' atas partisipasinya',null];
			}
		}
		echo json_encode($result);
	}

	public function check_user()
	{
		sleep(2);
		$user = trimChar_input('user');
		$label = trimChar_input('label');
		$this->form_validation->set_rules('user','Username','required|min_length[5]|max_length[20]|alpha_dash');
		if ($this->form_validation->run() == false) {
			$result = [false,'username invalid'];
		} else {
			$list = ['admin','username'];
			if (in_array($user,$list)) {
				$result = [false,'username tidak tersedia'];
			} else {
				$check = $this->Common_model->check_exist('score',['user'=>$user,'level'=>$label]);
				if ($check) {
					$result = [false,'username telah terdaftar'];
				} else {
					$result = [true,'username tersedia'];
				}
			}
		}
		echo json_encode($result);
	}

	public function get_quiz()
	{
		$level = $this->input->post('level');
		$myQuiz = $this->Common_model->select_join(
			'quiz AS A',
			'A.id,A.q_question,A.q_answer,B.les_title,C.description',
			[
				['table' => 'materi AS B','condition' => 'A.q_rel = B.les_id','type' => ''],
				['table' => 'level AS C','condition' => 'A.q_level = C.name','type' => '']
			],
			['q_level' => $level],true,false,
			'','les_order ASC'
		);
		$num = 1;
		foreach ($myQuiz as $k => $v) :
		$ans[$k] = explode(',',$v['q_answer']);
		?>
		<div class="card squence scale-in-center" style="display:none">
		  <div class="row text-center">
		  	<div class="col-lg-8">
		  		<div class="">
  				  <form class="quiz-form" data-name="<?=preg_replace('/^JavaScript /','JS ',$v['description'])?>">
  						<div class="card-header shadow btn-panel">
  							<h4 class="heading"><span class="category-active"></span> - soal ke <?=$num?> dari <span class="total"></span> soal</h4>
  			        <div class="time-progress"><div></div></div>
  						</div>
  						
  					  <div class="card-body wrapper-quest">
  				      <input type="hidden" name="id" value="<?=$v['id']?>">
  				      <div class="question shadow"><?=$v['q_question']?></div>
  				      <hr>
  				      <div class="row answer">
  				      <?php
  				        $cho = 1;
  				        $letter = ord('A');
  				        foreach ($ans[$k] as $kv => $vk) :
  				      ?>
  				        <div class="col-lg-8 offset-lg-2 wrap">
  				          <input type="radio" name="ch" id="<?= 'choice'.$num.$cho ?>" value="<?=$cho?>">
  				          <label title="<?=html_entity_decode($vk)?>" data-toggle="tooltip" for="<?='choice'.$num.$cho?>"><?='<b>'.chr($letter).'.</b> '.html_entity_decode($vk)?></label>
  				        </div>
  				      <?php
  				        $cho++;
  				        $letter++;
  				        endforeach;
  				      ?>
  				      </div>
  					  </div>
  				  </form>		  			
		  		</div>
		  	</div>
		  	<div class="col-lg-4">
		  		<div class="wrapper-setup stick">
			  		<div class="card-body">
			  			<div class="speech right">
			  				<h2 class="spent">detik</h2>
			  				<button type="button" class="btn btn-default scale-in-center next-slide" style="display: none;">Selanjutnya</button>
			  			</div>
			  			<img class="mt-5" src="<?=base_url('assets/img/emo/mikir.gif')?>">
			  		</div>
		  		</div>
		  	</div>
		  </div>
		</div> 
		<?php
		$num++;
		endforeach;
	}

	public function get_result()
	{
		// sleep(2);
		$score = 0;
		$post = $this->input->post('quest');
		foreach ($post as $k => $v) {
			$test[$k] = $this->Common_model->select_join(
				'quiz AS A',
				'B.les_title AS title,B.les_slug AS slug,B.les_level AS level,A.q_answer AS answer,A.q_correct AS correct,A.q_question AS question',
				[
					['table' => 'materi AS B', 'condition' => 'A.q_rel = B.les_id', 'type' => '']
				],
				['A.id'=>$v['id']],true,true);
			$true[$k] = explode(',',html_entity_decode($test[$k]['answer']));
			if (isset($v['ch'])) {
				if ($v['ch'] == $test[$k]['correct']) {
					$score++;
					$return = true;
				} else {
					$return = false;
				}
			} else {
				$return = false;
			}
			$result['evaluate'][$k] = [
				'question' => $test[$k]['question'],
				'correct' => $true[$k][$test[$k]['correct']-1],
				'yours' => (isset($v['ch'])) ? $true[$k][$v['ch']-1] : '...',
				'result' => $return,
				'rel' => base_url('js/docs/'.create_slug($test[$k]['slug'])),
				'title' => $test[$k]['title']
			];
		}
		
		$result['plain'] = [];
		$result['score'] = $score / count($post) * 100;
		$totalQuest = count($post);
		$plus = $score;
		$minus = $totalQuest - $plus;
		  if ($result['score'] == 100) {
		    $img = 'horray.gif';
		    $msg = 'hebat sekali kamu';
		  } else if ($result['score'] == 0) {
		  	$img = 'no.gif';
		  	$msg = 'tetap semangat yaa belajarnya';
		  } else if ($result['score'] >= 75) {
		    $img = 'ok.gif';
		    $msg = 'kamu punya bakat, tetap asah logikamu lagi';
		  } else if ($result['score'] >= 50) {
		    $img = 'mikir.gif';
		    $msg = 'lumayan bagus lah sejauh ini';
		  } else if ($result['score'] >= 25) {
		  	$img = 'hmm.gif';
		  	$msg = 'coba lebih serius dalam belajar';
		  } else {
		    $img = 'ouch.gif';
		    $msg = 'baca dokumentasi materi dengan lebih cermat';
		  }
			$result['plain'] = ['img' => $img,'msg' => $msg,'summary' => [$totalQuest,$plus,$minus]];

		echo json_encode($result);
	}

	public function search()
	{
		sleep(3);
		$term = trimChar_input('search');
		$term = substr($term,0,100);
		if (!empty($term)) {
			if (strlen($term) >= 3) {
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
							'level' => $v['les_level'],
							'keys' => explode(',',$v['les_key']),
							'link' => base_url().'js/docs/'.create_slug($v['les_slug'])
						];
					}
					$result = [1,'ditemukan '.$search_results.' hasil pencarian untuk keyword <br><b>"'.$term.'"</b>',$arr];
				}

			} else {
				$result = [0,"Maaf, keyword yang dibutuhkan minimal 3 karakter"];
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