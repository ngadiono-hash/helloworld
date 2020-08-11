<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Xhra extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_send_ajax();
		$this->load->model('Common');
	}
	public function my()
	{
		$a = trimChar_input('code');
		$b = trimChar_input('replace');

		if (!empty($b)) {
			$exec = $this->Common->update('snippet',['relation'=>$b],['relation'=>$a]);
			if ($exec) {
				$e = $this->Common->select_where('snippet','title,relation',['relation'=>$a]);
				// var_dump($e);
				echo json_encode('sukses');
				// var_dump($edit);
			} else {
				echo json_encode('gagal');
			}
		} else {
			// $ed = $this->Common->select_where('snippet','title,relation',['relation'=>$a]);
			// echo json_encode($ed);
			echo json_encode('kosong');
			// echo json_encode($ed);
		}
	}
// ============== QUIZ
	public function read_quiz($param)
	{
		$content = $this->Common->Ignited_join(
			'quiz',
			'les_id,les_title,quiz.id,q_title,q_level,q_question,q_answer,q_correct',
			'materi','quiz.q_rel = materi.les_id',null,
			['quiz.q_level' => $param]
		);
		echo $content;
	}

	public function fetch_quiz()
	{
		$id = trimChar_input('id');
		$get = $this->Common->select_where('quiz','*',['id' => $id],true,true);
		$get['q_answer'] = html_entity_decode(htmlspecialchars_decode($get['q_answer']));
		echo json_encode($get);
	}

	public function create_quiz()
	{
		$id = $this->input->post('id');
		$rel = trimChar_input('rel');
		$title = trimChar_input('title');
		$label = trimChar_input('label');
		$question = preg_replace('/&nbsp;/',' ',$this->input->post('question'));
		$answer = htmlentities(trimChar_input('answer'));
		$lenghtA = in_array( '',explode(',',$answer) );
		$correct = trimChar_input('correct');
		
		if (strlen($label) === 0 || strlen($rel) === 0 || strlen($question) === 0 || $lenghtA || strlen($correct) === 0) {
			$result = [0,'all of input required',null];
		} else {
			if ($id == '') {
				$data = [
					'q_rel' => $rel,
					'q_level' => $label,
					'q_title' => $title,
					'q_question' => $question,
					'q_answer' => $answer,
					'q_correct' => $correct
				];
				$exec = $this->Common->insert_record('quiz',$data);
				$result = ($exec) ? [1,'add success',null] : [0,'add error',null];
			} else {
				$data = [
					'q_rel' => $rel,
					'q_level' => $label,
					'q_title' => $title,
					'q_question' => $question,
					'q_answer' => $answer,
					'q_correct' => $correct
				];
				$exec = $this->Common->update('quiz',$data,['id'=>$id]);
				$result = ($exec) ? [1,'update success',null] : [0,'update error',null];
			}
		}
		echo json_encode($result);
	}

	public function delete_quiz()
	{
		$id = $this->input->post('id');
		$exec = $this->Common->delete('quiz',['id'=>$id]);
		$result = ($exec) ? [1,'delete success',null] : [0,'something error',null];
		echo json_encode($result);
	}

// ============== LESSON
	public function read_lesson($param)
	{
		echo $this->Common->Ignited_dt(
			'les_id,les_level,les_order,les_title,les_slug,les_content,les_length,les_snippet,les_key,les_publish,les_update',
			'materi',
			['les_level' => $param]
		);
	}

	public function create_lesson()
	{
		$title = trimChar_input('title');
		$slug  = trimChar_input('slug');
		$label = trimChar_input('label');
		if (!$title) {
			$result = [0,'title field is required',null];
		} else {
			if(!$slug) {
				$result = [0,'slug field is required',null];
			} else {
				$id = getRandStr(10);
				$check = $this->Common->check_exist('materi',['les_id'=>$id]);
				if ($check) {
					$id = getRandStr(10);
				} else {
					$order = $this->Common->counting('materi',['les_level'=>$label]);
					$data = [
						'les_id'			 => $id,
					  'les_order'    => $order + 1,
					  'les_title'    => ucwords($title),
					  'les_slug'     => $slug,
					  'les_level'    => $label,
					  'les_upload'   => time(),
					  'les_update'   => time()
					];
					$exec = $this->Common->insert_record('materi',$data);
					$result = ($exec) ? [1,'add success',null] : [0,'unknow error',null];
				}
			}
		}
		echo json_encode($result);
	}

	public function update_lesson()
	{
		$id = trimChar_input('id');
		$title = trimChar_input('title');
		$slug = trimChar_input('slug');
		$oriCon = $this->input->post('content');
		$content = correcting($oriCon);
		$length = trimChar_input('length');
		$snippet = trimChar_input('snippet');
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
		  'les_snippet'=> $snippet,
		  'les_content'=> $content,
		  'les_key'		 => $keywords,
		  'les_update' => time()
		];
		$this->Common->update('materi',$data,['les_id'=>$id]);
		$affected = $this->Common->select_specific('materi','les_content',['les_id'=>$id]);
		if (!empty($affected)) {
			$h3 = getTags($affected,'h3');
			$h4 = getTags($affected,'h4');
		}
		$result = [1,'update lesson success',null,date('d F, Y H:i',time()),$h3,$h4];
		
		echo json_encode($result);
	}

	public function update_lesson_level()
	{
		$id = trimChar_input('id');
		$level = trimChar_input('level');	
		$exec = $this->Common->update('materi',['les_level'=>$level],['les_id'=>$id]);
		$result = ($exec) ? [1,'update level success',null] : [0,'unknow error',null];
		echo json_encode($result);
	}

	public function update_lesson_public()
	{
		$id = $this->input->post('id');
		$check = $this->Common->select_specific('materi','les_publish',['les_id' => $id]);
		if($check == 0){
			$this->Common->update('materi',['les_publish' => 1],['les_id' => $id]);
			$result = 1;
		} else {
			$this->Common->update('materi',['les_publish' => 0],['les_id' => $id]);
			$result = 0;
		}
		echo json_encode($result);
	}

	public function update_lesson_order()
	{
		$post_order = isset($_POST["num_order"]) ? $_POST["num_order"] : [];
		if(count($post_order) > 0){
			for($i = 0; $i < count($post_order); $i++){
				$this->Common->update(
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
			$exec = $this->Common->update('materi',$data,['les_id' => $id]);
			$result = ($exec) ? [1,'success',null] : [0,'something error',null];
		}
		echo json_encode($result);
	}

	public function create_snippet()
	{
		$result = [];
		$rel = $this->input->post('rel');
		$title = trimChar_input('title');
		if (!empty($title) && !empty($rel) ) {
			$where = " LOWER(title)='".$title."' ";
			$check = $this->Common->check_segment('snippet',$where);
			if (!$check) {
				$data = [
					'relation' => $rel,
				  'title' => $title,
				  'htm' => $this->input->post('htm'),
				  'css' => $this->input->post('css'),
				  'jsc' => $this->input->post('jsc')
				];
				$exec = $this->Common->insert_record('snippet',$data);
				$insert = $this->Common->select_where('snippet','*',['id'=>$exec],true,true);
				$result = $exec ? [1,'add snippet success',null,$insert] : [0,'errors db',null];
			} else {
				$result = [0,'there are duplicate title',null];	
			}
		} else {
			$result = [0,'check your title',null];
		}
		echo json_encode($result);
	}

	public function update_snippet()
	{
		$result = [];
		$id = $this->input->post('id');
		$title = trimChar_input('title');
		$rels = trimChar_input('rels');
		if (!empty($title)) {
			$data = [
			  'title' => $title,
			  'htm' => $this->input->post('htm'),
			  'css' => $this->input->post('css'),
			  'jsc' => $this->input->post('jsc')
			];
			$this->Common->update('snippet',$data,['id'=>$id]);
			$fetch = $this->Common->select_where('snippet','*',['id'=>$id],true,true);
			$result = $fetch ? [1,'update snippet success',null,$fetch] : [0,'errors',null];
		} else {
			$result = [0,'failed to update snippet',null];
		}
		echo json_encode($result);
	}

	public function delete_snippet()
	{
		$result = [];
		$id = $this->input->post('id');
		$level = $this->input->post('rels');
		$exec = $this->Common->delete('snippet',['id'=>$id]);
		$this->Common->update('materi',['les_snippet'=>0],['les_id'=>$level]);
		$result = $exec ? [1,'delete snippet success',null] : [0,'errors',null];
		echo json_encode($result);
	}

	public function fetch_snippet()
	{
		$id = trimChar_input('id');
		$t = $this->Common->select_where('snippet','*',['relation'=>$id],true,false,['id','ASC']);
		echo json_encode($t);
	}

// ============== CONFIG PAGE
	public function pages()
	{
		$key = trimChar_input('key');
		$val = trimChar_input('val');
		$aff = $this->Common->update('level',['content'=>$val],['name'=>$key]);
		$aff = [1,'update success',null];
		echo json_encode($aff);
	}






// END OF FILE
}