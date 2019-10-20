<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class XhrU extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		reload_session();
		is_send_ajax();
		$this->load->model('Create_model');
		$this->load->model('Read_model');
		$this->load->model('Update_model');
		$this->load->model('Delete_model');
	}

	public function create_progress() // OK
	{
		$time    = intval($this->input->post('time'));
		$id_page = $this->input->post('id_page');
		$id_user = $this->input->post('id_user');
		$check 	 = $this->Read_model->checkExist('user_progress',['id_snip' => $id_page, 'id_user' => $id_user]);
		if( $time > (60000) ) {
			if ( $check < 1 ) {
				$data = [
					'id_snip' => $id_page,
					'id_user' => $id_user
				];
				$this->db->insert('user_progress',$data);
			}
		}
	}
	public function create_snip() // OK
	{
		$result = [];
		checkSession($result);
		$codeTitle  = trim($this->input->post('title',true));
		if ( empty($codeTitle) ) {
			$result['message'] = "alertDanger('ok','belum ada judul yang dimasukkan')";
		} else {	
			$this->Create_model->insertSnippet();
			$result['message'] = "alertSuccess('back',['snippet berhasil disimpan','terima kasih '+ userData.username +' atas kontribusinya','']);";
		}
		$this->output->set_content_type('aplication/json')->set_output(json_encode($result));
	}
	public function update_photo() // OK
	{
		$result = [];
		checkSession($result);
		$photo = $_FILES['photo']['name'];
		if($photo){
      $config['upload_path']    = './assets/img/profile/';
      $config['allowed_types']  = 'gif|jpg|png|jpeg';
      $config['max_size']       = 2048;
      $config['max_width']      = 1000;
      $config['max_height']     = 1000;
      $config['encrypt_name'] 	= FALSE;
      $this->load->library('upload', $config);
      if ($this->upload->do_upload('photo')) {
      	$old_photo = $this->Read_model->getOldPhoto(getSession('sess_id'));
      	if($old_photo['u_image'] != 'default.gif') {
      		unlink(FCPATH . 'assets/img/profile/' . $old_photo['u_image']);
      	}
      	$new_photo = $this->upload->data('file_name');
      	$this->Update_model->updatePhotoPassword(['u_image' => $new_photo],getSession('sess_id'));
      	$_SESSION['sess_image'] = base_url('assets/img/profile/') . $new_photo;
      	$locate = base_url('u/profile');
      	$result = [
      		'status' => 1,
      		'message' => "alertSuccess('blank',['sukses','foto profilmu berhasil diubah',' '+imgLoad+' '],'".$locate."')"
      	];
      }	else {
      	$result = [
      		'status' => 0,
      		'message' => $this->upload->display_errors('<p class="text-danger center">', '</p>')
      	];
      }
    } else {
    	$result = [
    		'status' => 0,
    		'message' => '<p class="text-danger center">tidak ada foto untuk diupload</p>'
    	];
    }
    $this->output->set_content_type('aplication/json')->set_output(json_encode($result));
	}
	public function update_profile() // OK
	{
		$result = [];
		checkSession($result);
		$this->form_validation->set_rules('name', 'Nama Lengkap', 'trim|required');
		$this->form_validation->set_rules('bio', 'Biografi', 'max_length[500]');
		$this->form_validation->set_rules('web', 'URL Web', 'trim|prep_url');
		$this->form_validation->set_message('required','{field} harus diisi');
		$this->form_validation->set_message('max_length','{field} terlalu panjang');

		if ($this->form_validation->run() === FALSE) {
			$result = [
				'name' => form_error('name','<p class="text-danger">','</p>'),
				'gender' => form_error('gender','<p class="text-danger">','</p>'),
				'bio' => form_error('bio','<p class="text-danger">','</p>'),
				'web' => form_error('web','<p class="text-danger">','</p>')
			];
		} else {
			$this->Update_model->updateProfile();
			$result = [
				'status' => 1,
				'message' => "flashAlert('sukses','info tentang profilmu berhasil diubah')"
			];
		}
		$this->output->set_content_type('aplication/json')->set_output(json_encode($result));
	}
	public function update_password() // OK
	{
		$result = [];
		checkSession($result);
		$this->form_validation->set_rules('pass_0', 'Password Lama', 'trim|required');
		$this->form_validation->set_rules('pass_1', 'Password', 'trim|required|min_length[6]',
					array('min_length' => '{field} minimal 6 karakter')
				);
		$this->form_validation->set_rules('pass_2', 'Password Konfirmasi', 'trim|required|matches[pass_1]',
					array('matches' => '{field} tidak cocok')
				);
		$this->form_validation->set_message('required','{field} harus diisi');
		if ($this->form_validation->run() == FALSE) {
			$result = [
				'pass_0'    => form_error('pass_0','<p class="text-danger">','</p>'),
				'pass_1'    => form_error('pass_1','<p class="text-danger">','</p>'),
				'pass_2'    => form_error('pass_2','<p class="text-danger">','</p>')
			];
		} else {
			$old = $this->input->post('pass_0');
			$new = $this->input->post('pass_1');
			$fetch = $this->Read_model->getDataUser();
			if (!password_verify($old,$fetch['password'])) {
				$result = [
					'message' => "alertDanger('ok','password aktif saat ini salah')"
				];
			} else {
				if ($old == $new) {
					$result = [
						'message' => "alertDanger('ok','password baru tidak boleh sama dengan<br> password aktif')"
					];
				} else {
			    $hash = password_hash($new, PASSWORD_DEFAULT); 
					$this->Update_model->updatePhotoPassword(['u_password' => $hash],getSession('sess_id'));
					$locate = base_url('at/logout');
					$result = [
						'message' => "alertSuccess('blank',['password berhasil diubah','silahkan coba login kembali',' '+imgLoad+' '],'".$locate."')"
					];
				}
			}			
		}
		$this->output->set_content_type('aplication/json')->set_output(json_encode($result));
	}
	public function update_snip() // OK
	{
		$result = [];
		checkSession($result);
		$codeTitle = trim($this->input->post('title',true));
		if ( empty($codeTitle) ) {
			$result['message'] = "alertDanger('ok','kolom judul tidak boleh dikosongkan')";
		} else {
			$update = $this->Update_model->updateSnippet();
			if ($update) {
				$result['message'] = "flashAlert('sukses','perubahan berhasil disimpan')";
			} else {
				$result['message'] = "alertBug('report','perubahan gagal disimpan')";
			}
		}
		$this->output->set_content_type('aplication/json')->set_output(json_encode($result));
	}

	public function create_comment() // BELUM
	{
		$result = [];
		checkSession($result);
		$id_post = $this->input->post('post');
		$owner_post = $this->input->post('owner');
		$comment_post = trim(htmlspecialchars($this->input->post('comment',true)));
		if (empty($comment_post)) {
			$result = [
				'status' => 0,
				'message' => '<p class="text-danger">kamu belum menulis komentar apapun</p>'
			];
		} elseif (strlen($comment_post) < 10) {
			$result = [
				'status' => 0,
				'message' => '<p class="text-danger">komentar minimal terdiri dari 10 karakter</p>'
			];
		} else {
			$insert_last = $this->Create_model->insertComment($id_post,$comment_post);
			$this->Update_model->updateNotif(['comment' => 1],['user' => $owner_post]);
			$last_comment = $this->Read_model->getCommentSnippet($id_post,1,['t1.id' => $insert_last]);
			$last_comment = append_comment($last_comment);
			$result = [
				'status' => 1,
				'message' => $last_comment
			];
		}
		$this->output->set_content_type('aplication/json')->set_output(json_encode($result));
	}
	public function create_like() // BELUM
	{
		$result = [];
		checkSession($result);
		$id_post = $this->input->post('post');
		$owner_post = $this->input->post('owner');
		$countLike = $this->Read_model->getCountLikePost($id_post);
		$cek = $this->Read_model->checkExist('liked',['id_user' => getSession('sess_id'), 'id_target' => $id_post]);
		if ($cek == 0) {
			$this->Update_model->updateNotif(['liked' => 1],['user' => $owner_post]);
			$this->Create_model->insertLiked($id_post,$countLike);
		}
		// var_dump($countLike);
	}









// END OF FILE
}