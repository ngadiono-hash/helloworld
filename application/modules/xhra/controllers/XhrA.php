<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class XhrA extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_send_ajax();
		$this->load->model('Common_model');
	}

	public function read_lesson($param)
	{
		echo $this->Common_model->Ignited_dt(
			'les_id,les_level,les_order,les_title,les_slug,les_content,les_length,les_key,les_publish,les_update',
			'materi',
			['les_level' => $param]
		);
	}

	public function read_quiz($param)
	{
		$content = $this->Common_model->Ignited_join(
			'les_id,les_title,quiz.id,q_order,q_level,q_question,q_answer,q_correct',
			'quiz',
			'materi',
			'quiz.q_rel = materi.les_id',
			null,
			['materi.les_level' => $param]
			
		);
		echo $content;
	}

	public function create_lesson()
	{
		$title = trimChar_input('title');
		$slug  = trimChar_input('slug');
		$label = trimChar_input('label');
		if (!$title) {
			$result = 'title field is required';
		} else {
			if(!$slug) {
				$result = 'slug field is required';
			} else {
				$id = create_rand($label);
				$check = $this->Common_model->check_exist('materi',['les_id'=>$id]);
				if ($check) {
					$id = create_rand($label);
				} else {
					$order = $this->Common_model->counting('materi',['les_level'=>$label]);
					$data = [
						'les_id'			 => $id,
					  'les_order'    => $order + 1,
					  'les_title'    => ucwords($title),
					  'les_slug'     => $slug,
					  'les_level'    => $label,
					  'les_upload'   => time(),
					  'les_update'   => time()
					];
					$exec = $this->Common_model->insert_record('materi',$data);
					$result = ($exec) ? [1,'success',null] : [0,'something error',null];
				}
			}
		}
		echo json_encode($result);
	}

	public function fetch_quiz()
	{
		$id = trimChar_input('id');
		$result = $this->Common_model->select_where('quiz','*',['id' => $id],true,true);
		echo json_encode($result);
	}

	public function create_quiz()
	{
		$id = $this->input->post('id');
		$rel = trimChar_input('rel');
		$label = trimChar_input('label');
		$question = preg_replace('/&nbsp;/',' ',$this->input->post('question'));
		$answer = htmlentities(trimChar_input('answer'));
		$lenghtA = explode(',',$answer);
		$lenghtA = in_array('',$lenghtA);
		$correct = trimChar_input('correct');
		
		if (strlen($rel) === 0 || strlen($question) === 0 || $lenghtA || strlen($correct) === 0) {
			$result = [0,'all input required',null];
		} else {
			if ($id == '') {
				$order = $this->Common_model->counting('quiz',['q_rel'=>$rel]);
				$data = [
					'q_order' => $order + 1,
					'q_rel' => $rel,
					'q_level' => $label,
					'q_question' => $question,
					'q_answer' => $answer,
					'q_correct' => $correct
				];
				$exec = $this->Common_model->insert_record('quiz',$data);
				$result = ($exec) ? [1,'add success',null] : [0,'something error',null];
			} else {
				$data = [
					'q_question' => $question,
					'q_answer' => $answer,
					'q_correct' => $correct
				];
				$exec = $this->Common_model->update('quiz',$data,['id'=>$id]);
				$result = ($exec) ? [1,'update success',null] : [0,'something error',null];
			}
		}
		echo json_encode($result);
	}

	public function delete_quiz()
	{
		$id = $this->input->post('id');
		$exec = $this->Common_model->delete('quiz',['id'=>$id]);
		$result = ($exec) ? [1,'delete success',null] : [0,'something error',null];
		echo json_encode($result);
	}


	public function update_lesson()
	{
		$id = trimChar_input('id');
		$title = trimChar_input('title');
		$slug = trimChar_input('slug');
		$content = preg_replace('/&nbsp;/',' ',$this->input->post('content'));
		$length = trimChar_input('length');
		$key1 = !empty($content) ? strtolower(implode(',',getTags($content,'h3'))) : '';
		$key2 = !empty($content) ? getTags($content,'h4') : '';
		if (!empty($key2)) {
			foreach ($key2 as $k => $v) {
				$key3[$k] = strtolower(preg_replace("/\d\.\s/",'', $v));
			}
			$key4 = implode(',',$key3);
		} else {
			$key4 = '';
		}
		$keywords = ($key4 != '') ? $key1.','.$key4.'' : $key1;
		$data = [
		  'les_title'  => ucwords($title),
		  'les_slug'   => $slug,
		  'les_length' => $length,
		  'les_content'=> $content,
		  'les_key'		 => $keywords,
		  'les_update' => time()
		];
		$this->Common_model->update('materi',$data,['les_id'=>$id]);
		$affected = $this->Common_model->select_specific('materi','les_content',['les_id'=>$id]);
		if (!empty($affected)) {
			$h3 = getTags($affected,'h3');
			$h4 = getTags($affected,'h4');
		}
		$result = [1,'update success',null,date('d F, Y H:i',time()),$h3,$h4];
		
		echo json_encode($result);
	}

	public function update_lesson_public($id)
	{
		$check = $this->Common_model->select_specific('materi','les_publish',['les_id' => $id]);
		if($check == 0){
			$this->Common_model->update('materi',['les_publish' => 1],['les_id' => $id]);
			$result = 1;
		} else {
			$this->Common_model->update('materi',['les_publish' => 0],['les_id' => $id]);
			$result = 0;
		}
		echo json_encode($result);
	}

	public function update_lesson_order()
	{
		$post_order = isset($_POST["num_order"]) ? $_POST["num_order"] : [];
		if(count($post_order) > 0){
			for($i = 0; $i < count($post_order); $i++){
				$this->Common_model->update(
					'materi',
					['les_order'=>($i+1)],
					['les_id'=>$post_order[$i]]
				);
			}
			$result = 1;
		} else {
			$result = 0;
		}
		echo json_encode($result);
	}

	public function update_lesson_inline()
	{
		$action = trimChar_input('action');
		$id = trimChar_input('id');
		$input = trimChar_input('input');
		if (!$input) {
			$result = 'this field is required';
		} else {
			if ($action == 'title') {
				$data = ['les_title' => ucwords($input)];
			} else {
				$data = ['les_slug' => $input];
			}
			$exec = $this->Common_model->update('materi',$data,['les_id' => $id]);
			$result = ($exec) ? [1,'success',null] : [0,'something error',null];
		}
		echo json_encode($result);
	}

	








	// public function get_detail_user()
	// {
	// 	$id = $this->input->post('id');
	// 	$res = $this->db->get_where('users',['u_id' => $id])->row_array();
	// 	$result = [
	// 		'uid'   => $res['u_id'],
	// 		'provider'  => $res['u_provider'],
	// 		'role'	=> $res['u_role'],
	// 		'username' => $res['u_username'],
	// 		'name' => ucwords($res['u_name']),
	// 		'email' => $res['u_email'],
	// 		'active' => $res['u_active'],
	// 		'register' => time_elapsed_string('@'.$res['u_register']),
	// 		'gender' => $res['u_gender'],
	// 		'web'	=> $res['u_web'],
	// 		'image' => $res['u_image']
	// 	];
	// 	$this->output->set_content_type('aplication/json')->set_output(json_encode($result));
	// }

	// public function update_role()
	// {
	// 	$action = $this->input->post('action');
	// 	$id   = $this->input->post('id');
	// 	$role = $this->input->post('role');
	// 	if($action == 'change'){
	// 		$change = $this->Update_model->updateUserRole($id,$role);
	// 		$result = ($change) ? 1 : 0;
	// 	} else {
	// 		$delete = $this->Delete_model->deleteUserByAdmin($id);
	// 		$result = ($delete) ? 1 : 0;
	// 	}
	// 	echo json_encode($result);
	// }



	// public function inline_tutorial()
	// {
	// 	$id = $this->input->post('id');
	// 	$desc = preg_replace('/&nbsp;/',' ',$this->input->post('desc'));
	// 	$data = [
	// 	  'snip_code'   => $this->input->post('count_words'),
	// 	  'snip_content'=> $desc,
	// 	  'snip_key'		=> trim(strtolower(implode(',',getTags($desc,'h3')))),
	// 	];
	// 	$this->Common_model->update('tutors',$data,['snip_id' => $id]);
	// 	$affect = $this->Common_model->select_spec('tutors','snip_content',['snip_id' => $id]);
	// 	if (!empty($affect)) {
	// 		echo json_encode($affect);
	// 	} else {
	// 		echo '<script>alert("something wrong")</script>';
	// 	}		
	// }

	// public function delete_tutorial($id)
	// {
	// 	$delete = $this->Delete_model->deleteTutorial($id);
	// }






// END OF FILE
}