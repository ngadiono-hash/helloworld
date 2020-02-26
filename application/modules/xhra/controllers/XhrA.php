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
			'les_id,les_level,les_order,les_title,les_slug,les_content,les_meta,les_length,les_key,les_publish,les_update',
			'materi',
			['les_level' => $param]
		);
	}

	public function update_lesson()
	{
		$id = validate_input('id');
		$title = validate_input('title');
		$slug = validate_input('slug');
		$content = preg_replace('/&nbsp;/',' ',$this->input->post('content'));
		$length = validate_input('length');

		$data = [
		  'les_title'  => ucwords($title),
		  'les_slug'   => $slug,
		  'les_length' => $length,
		  'les_content'=> $content,
		  'les_meta'   => create_slug($slug),
		  'les_key'		 => strtolower(implode(',',getTags($content,'h3'))),
		  'les_update' => time()
		];
		$this->Common_model->update('materi',$data,['les_id'=>$id]);
		$affect = $this->Common_model->select_specific('materi','les_content',['les_id'=>$id]);
		if (!empty($affect)) {
			$affect = getTags($affect,'h3');
		}
		$result = [
			'status' => 1,
			'message' => 'update success',
			'last' => date('d F, Y H:i',time()),
			'affect' => $affect
		];
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

	public function create_lesson()
	{
		$title = validate_input('title');
		$slug  = validate_input('slug');
		$label = validate_input('label');
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
					  'les_meta'     => create_slug($slug),
					  'les_upload'   => time(),
					  'les_update'   => time()
					];
					$exec = $this->Common_model->insert_record('materi',$data);
					$result = ($exec) ? 'success' : 'something error';
				}
			}
		}
		echo json_encode($result);
	}

	public function update_lesson_inline()
	{
		$action = validate_input('action');
		$id = validate_input('id');
		$input = validate_input('input');
		if (!$input) {
			$result = 'this field is required';
		} else {
			if ($action == 'title') {
				$data = ['les_title'=>ucwords($input)];
			} else {
				$meta = str_replace(',','',$input);
				$meta = create_slug($meta);
				$data = [
				  'les_slug' => $input,
				  'les_meta' => $meta
				];
			}
			$exec = $this->Common_model->update('materi',$data,['les_id' => $id]);
			$result = ($exec) ? 'success' : 'something error';
		}
		echo json_encode($result);
	}










	// public function dt_deleted_tutorial()
	// {
	// 	echo $this->Read_model->Ignited_dt(['snip_bin' => '0']);
	// }
	// public function dt_users_list()//
	// {
	// 	echo $this->Read_model->Ignited_dt(
	// 		'id,u_id,u_provider,u_role,u_username,u_email,u_active,u_register',
	// 		'users',
	// 		['u_role !=' => 1],
	// 		''
	// 	);
	// }
	// public function dt_cdn_list()//
	// {
	// 	echo $this->Read_model->Ignited_dt(
	// 		'id,cdn_author,cdn_name,cdn_version,cdn_link,cdn_status',
	// 		'cdn',
	// 		[],
	// 		''
	// 	);
	// }
	// public function getTutorial()
	// {
	// 	$id = $this->input->post('id');
	// 	$edit = $this->Common_model->select_spec('tutors','snip_content',['snip_id' => $id]);
	// 	// echo (htmlentities($edit));
	// 	// echo ($edit);
	// 	$result = [
	// 		'left' => htmlentities($edit),
	// 		'right' => $edit
	// 	];
	// 	echo json_encode($result);
	// }












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



	public function inline_tutorial()
	{
		$id = $this->input->post('id');
		$desc = preg_replace('/&nbsp;/',' ',$this->input->post('desc'));
		$data = [
		  'snip_code'   => $this->input->post('count_words'),
		  'snip_content'=> $desc,
		  'snip_key'		=> trim(strtolower(implode(',',getTags($desc,'h3')))),
		];
		$this->Common_model->update('tutors',$data,['snip_id' => $id]);
		$affect = $this->Common_model->select_spec('tutors','snip_content',['snip_id' => $id]);
		if (!empty($affect)) {
			echo json_encode($affect);
		} else {
			echo '<script>alert("something wrong")</script>';
		}		
	}













	public function delete_tutorial($id)
	{
		$delete = $this->Delete_model->deleteTutorial($id);
	}






// END OF FILE
}