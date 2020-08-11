<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Xhrm extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_send_ajax();
		$this->load->model('Common');
	}

	private function getUserDataByEmail($post_email)
	{
		$query = $this->Common->select_where(
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
		$ctg = trimChar_input('ctg');
		$score = trimChar_input('score');
		$usr = trimChar_input('user');

	}

	public function boarding()
	{
		$boards = $this->Common->select_where('boards','*','',true,false,['score DESC','spent ASC']);
		$ax = [];
		$bx = [];
		$cx = [];
		foreach ($boards as $board => $b) {
			if ($b['level'] == 'a') {
				array_push($ax,['rank' => count($ax) + 1,'name'=>$b['user'],'score'=>$b['score'],'spent'=>$b['spent'],'date'=>$b['date']]);
			} elseif ($b['level'] == 'b') {
				array_push($bx,['rank' => count($bx) + 1,'name'=>$b['user'],'score'=>$b['score'],'spent'=>$b['spent'],'date'=>$b['date']]);
			} elseif ($b['level'] == 'c') {
				array_push($cx,['rank' => count($cx) + 1,'name'=>$b['user'],'score'=>$b['score'],'spent'=>$b['spent'],'date'=>$b['date']]);
			}
		}
		$xx = [
			'beginner' => [
				'da' => $ax
			],
			'medium' => [
				'da' => $bx
			],
			'advance' => [
				'da' => $cx
			]
		];
		echo json_encode($xx);
	}

	public function get_user()
	{
		sleep(1);
		$usr = trimChar_input('usr');
		$ctg = trimChar_input('ctg');
		$this->form_validation->set_rules('usr','usrnm','required|min_length[1]|max_length[20]|alpha_dash');
		if ($this->form_validation->run() == false) {
			$result = [false,'<span class="text-danger">username invalid</span>'];
		} else {
			$list = ['admin','username'];
			if (in_array($usr,$list)) {
				$result = [false,'<span class="text-primary">username tidak tersedia</span>'];
			} else {
				$check = $this->Common->check_exist('boards',['user'=>$usr,'level'=>$ctg]);
				if ($check) {
					$result = [false,'<span class="text-primary">username telah terdaftar</span>'];
				} else {
					$result = [true,'<span class="text-success">username tersedia</span>'];
				}
			}
		}
		echo json_encode($result);
	}

	public function get_quiz()
	{
		$level = $this->input->post('ctg');
		$myQuiz = $this->Common->select_where('quiz','id,q_question,q_answer',['q_level'=>$level],true,false,'rand()');
		$num = 1;
		foreach ($myQuiz as $k => $v) :
		$ans[$k] = explode(',',$v['q_answer']);
		?>
		<div class="card squence scale-in-center" style="display:none">
		  <div class="row text-center">
		  	<div class="col-lg-8">
				  <form class="squence-form">
						<div class="card-header shadow btn-panel">
							<h4 class="heading"><span class="quiz-category"></span> - soal ke <?=$num?> dari <span class="quiz-total"></span> soal</h4>
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
		  	<div class="col-lg-4">
		  		<div class="wrapper-setup stick">
			  		<div class="card-body">
			  			<div class="speech right">
			  				<h2 class="remaining my-2">detik</h2>
			  				<button type="button" class="btn btn-default scale-in-center next-slide my-4" style="display: none;">Lanjut</button>
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

	// public function my()
	// {
	// 	$name = trimChar_input('n');
	// 	$time = trimChar_input('t');
	// 	$level = trimChar_input('l');
	// 	// bug($_POST);
	// 	$s = $this->Common->update('boards',['date'=>$time],['user'=>$name,'level'=>$level]);
	// 	echo json_encode($s);
	// }

	// public function my()
	// {
	// 	$usr = trimChar_input('nama');
	// 	$ctg = trimChar_input('level');
	// 	$float = trimChar_input('skor');
	// 	$spent = trimChar_input('waktu');
	// 	$date = trimChar_input('daftar');
	// 	$data = ['user'=>$usr,'level'=>$ctg,'score'=>$float,'spent'=>$spent];

	// 	$all = $this->Common->select_where('boards','score',['level'=>$ctg]);
		
	// 	$allScore = array_column( $all, 'score' );
	// 	$lowestScore = $this->Common->select_where('boards','spent',['level'=>$ctg,'score'=>min($allScore)]); // skor terkecil
	// 	$longestTime = max(array_column( $lowestScore, 'spent' ));
	// 	$where = ['level'=>$ctg,'score <='=>$float,'spent'=>$longestTime];
	// 	$exec = $this->Common->update('boards',$data,$where);
	// 	if ($exec) {
	// 		$track = 'selamat '.$usr.', skormu masuk di leaderboard';
	// 	} else {
	// 		$track = 'skormu belum mampu bersaing di leaderboard';
	// 	}

	// 	// generating output
	//   if ($float == 100) {
	//     $msg = "tak perlu diragukan lagi...<br>".$usr.", you're master of JavaScript";
	//     $img = 'horray.gif';
	//   } else if ($float >= 75) { // 99 . 75
	//     $msg = "kamu punya bakat,<br>tetaplah asah logikamu, ".$usr."";
	//     $img = 'ok.gif';
	//   } else if ($float >= 50) { // 74 . 50
	//     $msg = 'hmm... gimana yaa...<br> lumayan deh buat hari ini';
	//     $img = 'ups.gif';
	//   } else if ($float >= 25) { // 49 . 25
	//   	$msg = 'hei '.$usr.'<br>serius ini ?! kok hanya '.$plus.' yang benar';
	//   	$img = 'duh.gif';
	//   } else if ($float <= 24) { // 24 . 1
	//   	$msg = 'aduh... '.$usr.'<br> ayo lebih serius lagi belajarnya';
	//   	$img = 'ouch.gif';
	//   }
	//   $bind['result'] = ['img' => $img,'msg' => $msg,'rest' => [
	//   		'score' => $float,
	//   		'true' => $plus,
	//   		'false' => $minus,
	//   		'spent' => $spent,
	//   		'fire' => $track
	//   	]
	//   ];
	//   echo json_encode($bind);
	// }

	public function get_result()
	{
		sleep(1);
		$usr = trimChar_input('usr');
		$ctg = trimChar_input('ctg');
		$float = trimChar_input('skor');
		$spent = trimChar_input('dur');
		$date = trimChar_input('date');
		$post = $this->input->post('quest');
		$plus = 0;

		// checking answer
		foreach ($post as $k => $v) {
			$test[$k] = $this->Common->select_join(
				'quiz AS A',
				'
				B.les_title AS title,B.les_slug AS slug,B.les_level AS level,
				A.q_answer AS answer,A.q_correct AS correct,A.q_question AS question
				',
				[
					['table' => 'materi AS B', 'condition' => 'A.q_rel = B.les_id', 'type' => '']
				],
				['A.id'=>$v['id']],true,true);
			$true[$k] = explode(',',html_entity_decode($test[$k]['answer']));
			if (isset($v['ch'])) {
				if ($v['ch'] == $test[$k]['correct']) {
					$plus++;
					$return = true;
				} else {
					$return = false;
				}
			} else {
				$return = false;
			}
			$bind['evaluate'][$k] = [
				'q' => $test[$k]['question'],
				'c' => $true[$k][$test[$k]['correct']-1],
				'y' => (isset($v['ch'])) ? $true[$k][$v['ch']-1] : '...',
				'r' => $return,
				'l' => base_url('js/docs/'.create_slug($test[$k]['slug'])),
				't' => $test[$k]['title']
			];
		}

		// making score
		$totalQuest = count($post);
		$float = round(($plus / $totalQuest * 100),2);
		$minus = $totalQuest - $plus;

		// bind to db
		$all = $this->Common->select_where('boards','score',['level'=>$ctg]);
		// bug($all);
		$allScore = array_column( $all, 'score' );
		$lowestScore = $this->Common->select_where('boards','spent',['level'=>$ctg,'score'=>min($allScore)]); // skor terkecil
		$longestTime = max(array_column( $lowestScore, 'spent' ));
		$data = ['user'=>$usr,'level'=>$ctg,'score'=>$float,'spent'=>$spent,'date'=>$date];
		$where = ['level'=>$ctg,'score <='=>$float,'spent'=>$longestTime];
		$exec = $this->Common->update('boards',$data,$where);
		if ($exec) {
			$track = 'selamat '.$usr.', skormu masuk di leaderboard';
		} else {
			$track = 'skormu belum mampu bersaing di leaderboard';
		}

		// generating output
	  if ($float == 100) {
	    $msg = "tak perlu diragukan lagi...<br>".$usr.", you're master of JavaScript";
	    $img = 'horray.gif';
	  } else if ($float >= 75) { // 99 . 75
	    $msg = "kamu punya bakat,<br>tetaplah asah logikamu, ".$usr."";
	    $img = 'ok.gif';
	  } else if ($float >= 50) { // 74 . 50
	    $msg = 'hmm... gimana yaa...<br> lumayan deh buat hari ini';
	    $img = 'ups.gif';
	  } else if ($float >= 25) { // 49 . 25
	  	$msg = 'hei '.$usr.'<br>serius ini ?! kok cuma '.$plus.' aja yang benar';
	  	$img = 'duh.gif';
	  } else if ($float <= 24) { // 24 . 1
	  	$msg = 'aduh... '.$usr.'<br> ayo lebih serius lagi belajarnya';
	  	$img = 'ouch.gif';
	  }
	  $bind['result'] = ['img' => $img,'msg' => $msg,'rest' => [
	  		'score' => $float,
	  		'true' => $plus,
	  		'false' => $minus,
	  		'spent' => $spent,
	  		'fire' => $track
	  	]
	  ];
	  echo json_encode($bind);
	}

	public function search()
	{
		sleep(1);
		$term = trimChar_input('search');
		$term = substr($term,0,100);
		$min = 3;
		if (!empty($term)) {
			if (strlen($term) >= $min) {
				$run = $this->Common->search_materi($term);
				$search_results = $run->num_rows();
				if ($search_results === 0) {
				  $result = [0,'tidak ada hasil ditemukan untuk pencarian <br><b class="heading">"'.$term.'"</b>'];
				} else {
					$r = $run->result_array();
					foreach ($r as $key => $v) {
						$arr[$key] = [
							'title' => $v['les_title'],
							'slug' => $v['les_slug'],
							'level' => $v['description'],
							'keys' => explode(',',$v['les_key']),
							'link' => base_url().'js/docs/'.create_slug($v['les_slug'])
						];
					}
					$result = [1,'ditemukan '.$search_results.' hasil pencarian untuk keyword <br><b class="heading">"'.$term.'"</b>',$arr];
				}

			} else {
				$result = [0,"keyword yang dibutuhkan minimal ".$min." karakter"];
			}
		} else {
			$result = [0,"ketik Keyword dan tekan Enter untuk melakukan pencarian"];
		}
		echo json_encode($result);
	}

	public function adm()
	{
		$acc = trimChar_input('access');
		$access = $this->Common->select_specific('access','keyword',['id'=>1]);
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
				$check = $this->Common->check_exist('user_cookie',['email' => $post_email]);
				if ($check) {
					$this->Common->delete('user_cookie',['email' => $post_email]);
				} else {
					$exec = $this->Common->insert_record('user_cookie',$data);
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