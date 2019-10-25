<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class XhrA extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		reload_session();
		// is_login();
		// is_admin();
		is_send_ajax();
		$this->load->model('Create_model');
		$this->load->model('Read_model');
		$this->load->model('Update_model');
		$this->load->model('Delete_model');
	}

	public function dt_read_html()
	{
		echo $this->Read_model->Ignited_dt(
			'snip_id,snip_category,snip_level,snip_order,snip_title,snip_slug,snip_content,snip_meta,snip_code,snip_publish,snip_update',
			'tutors',
			['snip_category' => '1', 'snip_bin' => '0'],
			'snip_order'
		);
	}
	public function dt_read_css()
	{
		echo $this->Read_model->Ignited_dt(
			'snip_id,snip_category,snip_level,snip_order,snip_title,snip_slug,snip_content,snip_meta,snip_code,snip_publish,snip_update',
			'tutors',
			['snip_category' => '2', 'snip_bin' => '0'],
			'snip_order'
		);
	}
	public function dt_read_js()
	{
		echo $this->Read_model->Ignited_dt(
			'snip_id,snip_category,snip_level,snip_order,snip_title,snip_slug,snip_content,snip_meta,snip_code,snip_publish,snip_update',
			'tutors',
			['snip_category' => '3', 'snip_bin' => '0'],
			'snip_order'
		);
	}
	// public function dt_deleted_tutorial()
	// {
	// 	echo $this->Read_model->Ignited_dt(['snip_bin' => '0']);
	// }
	public function dt_users_list()//
	{
		echo $this->Read_model->Ignited_dt(
			'id,u_id,u_provider,u_role,u_username,u_email,u_active,u_register', 
			'users',
			['u_role !=' => 1],
			''
		);
	}
	public function dt_cdn_list()//
	{
		echo $this->Read_model->Ignited_dt(
			'id,cdn_type,cdn_name,cdn_version,cdn_link', 
			'cdn'
		);
	}
	public function get_detail_user()//
	{
		$id = $this->input->post('id');
		$res = $this->db->get_where('users',['u_id' => $id])->row_array();
		$result = [
			'uid'   => $res['u_id'],
			'provider'  => $res['u_provider'],
			'role'	=> $res['u_role'],
			'username' => $res['u_username'],
			'name' => ucwords($res['u_name']),
			'email' => $res['u_email'],
			'active' => $res['u_active'],
			'register' => time_elapsed_string('@'.$res['u_register']),
			'gender' => $res['u_gender'],
			'web'	=> $res['u_web'],
			'image' => $res['u_image']
		];
		$this->output->set_content_type('aplication/json')->set_output(json_encode($result));
	}

	public function update_role()
	{
		$action = $this->input->post('action');
		$id   = $this->input->post('id');
		$role = $this->input->post('role');
		if($action == 'change'){
			$change = $this->Update_model->updateUserRole($id,$role);
			$result = ($change) ? 1 : 0;
		} else {
			$delete = $this->Delete_model->deleteUserByAdmin($id);
			$result = ($delete) ? 1 : 0;
		}
		echo json_encode($result);
	}

	public function create_tutorial()
	{
		$this->form_validation->set_rules('title','Title Tutorial','required|trim');
		$this->form_validation->set_rules('slug','Slug Tutorial','required|trim');
		$this->form_validation->set_rules('category','Category Tutorial','required');
		$result = [];
		if($this->form_validation->run() == FALSE) {
			$result = 0;
		} else {
			$this->Create_model->insertTutorial();
			$result = 1;
		}
		echo json_encode($result);
	}

	public function update_tutorial()
	{
		$this->Update_model->updateTutorial();
		$result['status'] = 1;
		$result['last'] = date('d M, Y H:i',time());
		echo json_encode($result);    
	}

	public function update_tutorial_title()
	{
		$this->form_validation->set_rules('title','Title','required|trim');
		if($this->form_validation->run() == FALSE){
			$result = 0;
		}else{
			$this->Update_model->updateTitle();
			$result = 1;
		}
		echo json_encode($result); 
	}

	public function update_tutorial_slug()
	{
		$this->form_validation->set_rules('slug','Slug','required|trim');
		if($this->form_validation->run() == FALSE){
			$result = 0;
		}else{
			$this->Update_model->updateSlug();
			$result = 1;
		}
		echo json_encode($result);
	}

	public function update_tutorial_public($id)
	{
		$cek = $this->Read_model->getStatusPublic($id);
		if($cek == '0'){
			$this->Update_model->updatePublish($id);
			$result = 1;
		} elseif($cek == '1') {
			$this->Update_model->updateDraft($id);
			$result = 0;
		}
		echo json_encode($result);
	}

	public function update_tutorial_order()
	{
		$post_order = isset($_POST["snip_order"]) ? $_POST["snip_order"] : [];
		// var_dump($post_order);
		if(count($post_order) > 0){
			for($no = 0; $no < count($post_order); $no++)
			{
				$this->db->set('snip_order', ($no + 1));
				$this->db->where('snip_id', $post_order[$no]);
				$this->db->update('tutors');
			}
			$result = 1;
		} else {
			$result = 0;
		}
		echo json_encode($result);
	}  

	public function update_cdn()//
	{
		$this->form_validation->set_rules('cdn_name','CDN Name','required|trim');
		$this->form_validation->set_rules('cdn_version','CDN Version','required|trim');
		$this->form_validation->set_rules('cdn_link','CDN Link','required');
		if($this->form_validation->run() === FALSE){
			$result = 0;
		}else{
			$this->Update_model->updateCdn();
			$result = 1;
		}
		echo json_encode($result);					
	}	

	public function delete_tutorial($id)
	{
		$delete = $this->Delete_model->deleteTutorial($id);
	}






// END OF FILE
}