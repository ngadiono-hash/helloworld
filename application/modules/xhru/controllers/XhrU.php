<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class XhrU extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		reload_session();
		is_send_ajax();
		$this->load->model('Common_model');
	}



	public function create_cdn()
	{
		$result = [];
		checkSession($result);
		$this->form_validation->set_rules('cdn_name', 'nama CDN', 'trim|required|is_unique[cdn.cdn_name]');
		$this->form_validation->set_rules('cdn_version', 'versi CDN', 'trim|required|callback_validate_numeric['.$this->input->post('cdn_version').']');
		$this->form_validation->set_rules('cdn[0]', 'URL CDN', 'required|callback_validate_url['.$this->input->post('cdn[0]').']');
		$this->form_validation->set_rules('cdn[1]', 'URL CDN', 'callback_validate_url['.$this->input->post('cdn[1]').']');
		$this->form_validation->set_rules('cdn[2]', 'URL CDN', 'callback_validate_url['.$this->input->post('cdn[2]').']');
		if ($this->form_validation->run() == FALSE) {
			$result = [
				'cdn-name' => form_error('cdn_name','<p class="text-danger">','</p>'),
				'cdn-version' => form_error('cdn_version','<p class="text-danger">','</p>'),
				'cdn0' => form_error('cdn[0]','<p class="text-danger">','</p>'),
				'cdn1' => form_error('cdn[1]','<p class="text-danger">','</p>'),
				'cdn2' => form_error('cdn[2]','<p class="text-danger">','</p>'),
			];
		} else {
			$this->Create_model->insertCdn();
			$result['status'] = 1;
			$result['message'] = "alertSuccess('ok',['terima kasih atas kontribusinya','proses validasi sedang dilakukan',''],'')";
		}
		$this->output->set_content_type('aplication/json')->set_output(json_encode($result));
	}
	function validate_url($url) {
		if (strlen($url) > 0){
			if ( (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$url)) ) {
				$this->form_validation->set_message('validate_url','alamat URL tidak valid');
				return FALSE;
			} else {
				return TRUE;
			}
		}
	}
	function validate_numeric($str)
	{
		if (strlen($str) > 0){
			if (!preg_match('/^[0-9 .]+$/i',$str) ) {
				$this->form_validation->set_message('validate_numeric','versi CDN harus berupa angka dan titik');
				return false;
			} else {
				return true;
			}
		}
	}
	public function create_comment()
	{
		$result = [];
		checkSession($result);
		$id_post = $this->input->post('post');
		$owner_post = $this->input->post('owner');
		$comment_post = trim($this->input->post('comment'));
		if (empty($comment_post)) {
			$result = [
				'status' => 0,
				'message' => '<p class="text-danger">kamu belum menulis komentar apapun</p>'
			];
		} elseif (strlen($comment_post) < 5) {
			$result = [
				'status' => 0,
				'message' => '<p class="text-danger">komentar minimal terdiri dari 5 karakter</p>'
			];
		} else {
			$data = [
				'id_user' => getSession('sess_id'),
				'id_target' => $id_post,
				'message' => htmlentities($comment_post),
				'created' => time()
			];
			$insert_last = $this->Common_model->insert_record('user_comment',$data);
			$comment = $this->Common_model->select_fields_where_join(
				'user_comment AS t1',
				'
				t1.id,t1.message AS message,t1.created AS created,
				t2.u_id AS id_comm,t2.u_username AS name_comm,t2.u_image AS img_comm,
				t3.code_author AS author',
				[
					['table' => 'users AS t2', 'condition' => 't1.id_user = t2.u_id', 'type' => ''],
					['table' => 'snip AS t3', 'condition' => 't1.id_target = t3.code_id', 'type' => ''],
				],
				['t1.id' => $insert_last],
				'',false
			);
			$last_comment = append_comment($comment);
			$this->Common_model->update('notification',['comment' => 1],['user' => $owner_post]);
			$result = [
				'status' => 1,
				'message' => $last_comment
			];
		}
		$this->output->set_content_type('aplication/json')->set_output(json_encode($result));
	}
	public function create_like()
	{
		$result = [];
		if (!startSession('sess_id')) {
			$result = [
				'status' => 0,
				'message' => "alertDanger('ok','kamu harus login dulu untuk bisa memberikan jempol')"
			];
		} else {
			$id_post = $this->input->post('post');
			$owner_post = $this->input->post('owner');
			$countLike = $this->Common_model->select_spec('snip','code_like',['code_id' => $id_post]);
			$cek = $this->Common_model->check_exist('user_liked',['id_user' => getSession('sess_id'), 'id_target' => $id_post]);
			if ($cek == false) {
				$data = [
					'id_user' => getSession('sess_id'),
					'id_target' => $id_post,
					'created' => time()
				];
				$this->Common_model->insert_record('user_liked',$data);
				$this->Common_model->update('snip',['code_like' => ($countLike + 1)],['code_id' => $id_post]);
				$result = [
					'status' => 1,
					'message' => "flashAlert('terima kasih','terima kasih '+ userData.username +' atas jempolnya')"
				];
			}
		}
		$this->output->set_content_type('aplication/json')->set_output(json_encode($result));
	}
	public function create_book()
	{
		$result = [];
		if (!startSession('sess_id')) {
			$result = [
				'status' => 0,
				'message' => "alertDanger('ok','kamu harus login dulu untuk bisa menandai snippet ini')"
			];
		} else {
			$id_post = $this->input->post('post');
			$owner_post = $this->input->post('owner');
			$cek = $this->Common_model->check_exist('user_book',['id_user' => getSession('sess_id'), 'id_target' => $id_post]);
			if ($cek == false) {
				$data = [
					'id_user' => getSession('sess_id'),
					'id_target' => $id_post,
					'created' => time()
				];
				$this->Common_model->insert_record('user_book',$data);
				$result = [
					'status' => 1,
					'message' => "flashAlert('berhasil','snippet telah ditandai <br> silahkah lihat di dashboard kamu')"
				];
			}
		}
		$this->output->set_content_type('aplication/json')->set_output(json_encode($result));
	}
	public function create_progress()
	{
		$time    = intval($this->input->post('time'));
		$id_page = $this->input->post('id_page');
		$id_user = $this->input->post('id_user');
		if( $time > (60) ) {
			// if( $time > (60000) ) {
				$check = $this->Common_model->check_exist('user_progress',['id_snip' => $id_page,'id_user' => $id_user]);
				if ($check) {
					$this->Common_model->update(
						'user_progress',
						['timing' => time()],
						['id_snip' => $id_page,'id_user' => $id_user]
					);
					echo "update";					
				} else {
					echo "inserting <br>";
					$data = [
						'id_snip' => $id_page,
						'id_user' => $id_user,
						'timing'    => time()
					];
					$inserting = $this->Common_model->insert_record('user_progress',$data);
					if ($inserting) {
						$count = $this->Common_model->count_record('user_progress','id',['id_user' => $id_user]);
						if ( $count == 6 ) {
							echo "deleting";
							$this->db->query("DELETE FROM user_progress WHERE id_user = $id_user ORDER BY timing ASC LIMIT 1");
						}						
					}
				}
		}
	}
	public function update_photo() // OK
	{
		$result = [];
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
				$old_photo = $this->Common_model->select_spec('users','u_image',['u_id' => getSession('sess_id')]);
				if ($old_photo != 'default.gif') unlink(FCPATH . 'assets/img/profile/' . $old_photo);
				$new_photo = $this->upload->data('file_name');
				$this->Common_model->update('users',['u_image' => $new_photo],['u_id' => getSession('sess_id')]);
				$_SESSION['sess_image'] = base_url('assets/img/profile/') . $new_photo;
				$locate = base_url('u/profile');
				$result = [
					'status' => 1,
					'message' => "alertSuccess('ok',['sukses','foto profilmu berhasil diubah',' '+imgLoad+' '],'".$locate."')"
				];
			}	else {
				$result = [
					'status' => 0,
					'message' => $this->upload->display_errors('<p class="text-danger">', '</p>')
				];
			}
		} else {
			$result = [
				'status' => 0,
				'message' => '<p class="text-danger">tidak ada foto untuk diupload</p>'
			];
		}
		$this->output->set_content_type('aplication/json')->set_output(json_encode($result));
	}
	public function update_profile() // OK
	{
		$result = [];
		checkSession($result);
		$this->form_validation->set_rules('name', 'nama lengkap', 'trim');
		$this->form_validation->set_rules('bio', 'biografi', 'max_length[500]');
		$this->form_validation->set_rules('web', 'URL website', 'callback_validate_url['.$this->input->post('web').']');

		if ($this->form_validation->run() === FALSE) {
			$result = [
				'name' 		=> form_error('name','<p class="text-danger">','</p>'),
				'gender' 	=> form_error('gender','<p class="text-danger">','</p>'),
				'bio' 		=> form_error('bio','<p class="text-danger">','</p>'),
				'web' 		=> form_error('web','<p class="text-danger">','</p>')
			];
		} else {
			$data = [
			  'u_modified'  => time(),
			  'u_name'      => htmlspecialchars($this->input->post('name')),
			  'u_gender'    => $this->input->post('gender'),
			  'u_bio'       => htmlspecialchars($this->input->post('bio')),
			  'u_web'       => $this->input->post('web')
			];
			$this->Common_model->update('users',$data,['u_id' => getSession('sess_id')]);
			$result = [
				'status' => 1,
				'message' => "alertSuccess('ok',['sukses','info profilmu berhasil diupdate',''])"
			];
		}
		$this->output->set_content_type('aplication/json')->set_output(json_encode($result));
	}
	public function update_password()
	{
		$result = [];
		checkSession($result);
		$this->form_validation->set_rules('pass_0', 'password aktif', 'trim|required');
		$this->form_validation->set_rules('pass_1', 'password baru', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('pass_2', 'password konfirmasi', 'trim|required|matches[pass_1]');
		if ($this->form_validation->run() == FALSE) {
			$result = [
				'pass_0'    => form_error('pass_0','<p class="text-danger">','</p>'),
				'pass_1'    => form_error('pass_1','<p class="text-danger">','</p>'),
				'pass_2'    => form_error('pass_2','<p class="text-danger">','</p>')
			];
		} else {
			$old = $this->input->post('pass_0');
			$new = $this->input->post('pass_1');
			$current = $this->Common_model->select_spec('users','u_password',['u_id' => getSession('sess_id')]);
			if (!password_verify($old,$current)) {
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
					$this->Common_model->update('users',['u_password' => $hash],['u_id' => getSession('sess_id')]);
					$locate = base_url('at/logout');
					$result = [
						'message' => "alertSuccess('blank',['password berhasil diubah','silahkan coba login kembali',' '+imgLoad+' '],'".$locate."')"
					];
				}
			}
		}
		$this->output->set_content_type('aplication/json')->set_output(json_encode($result));
	}

// =============== SNIPPET USER
	public function create_snip() // OK
	{
		$result = [];
		checkSession($result);
		$codeTitle = trim(htmlspecialchars($this->input->post('title',true)));
		$codeTag = $this->input->post('tag');
		$codeHtml = $this->input->post('html');
		if ( strlen($codeTitle) == 0 ) {
			$result = [
				'status' => 1,
				'message' => "alertDanger('ok','periksa Judul snippet <br> kolom ini harus diisi')"
			];
		} elseif ( strlen($codeTag) == 0 ) {
			$result = [
				'status' => 1,
				'message' => "alertDanger('ok','periksa Tag snippet <br> pilih maksimal 3 tag')"
			];
		} elseif (empty($codeHtml)) {
			$result = [
				'status' => 2,
				'message' => "alertDanger('ok','snippet minimal harus ada kode HTML')"
			];
		} else {
			$code_id = getRandStr(6);
			$count = $this->Common_model->count_record('snip','id',['code_id' => $code_id]);
			if ($count > 0) {
				$code_id = getRandStr(6);
			}
			$jquery = [$this->input->post('jquery')];
			$framework = [$this->input->post('framework')];
			$cdn = array_merge($jquery,$framework);
			if ($jquery[0] == '') array_shift($cdn);
			if ($framework[0] == '') array_pop($cdn);
			$data_snippets = [
				'code_id'     => $code_id,
				'code_author' => getSession('sess_id'),
				'code_title'  => $codeTitle,
				'code_desc'   => trim(htmlspecialchars($this->input->post('description',true))),
				'code_cdn'    => (!empty($cdn)) ? implode(',', $cdn) : null,
				'code_tag'    => $codeTag,
				'code_html'   => htmlentities($this->input->post('html')),
				'code_css'    => htmlentities($this->input->post('css')),
				'code_js'     => htmlentities($this->input->post('js')),
				'code_upload' => time(),
				'code_update' => time(),
				'code_publish' => $this->input->post('public')
			];
			$data_timeline = [
				'category' => 2,
				'user' 		 => getSession('sess_id'),
				'relation' => $code_id,
				'created'  => time(),
				'publish'  => $this->input->post('public')
			];
			// $this->Common_model->insert_record('snip',$data_snippets);
			// $this->Common_model->insert_record('timeline',$data_timeline);
			$locate = base_url('u/snippet');
			$result['message'] = "alertSuccess('blank',['snippet berhasil disimpan','terima kasih '+ userData.username +' atas kontribusinya',' '+imgLoad+' '],'".$locate."');";
		}
		$this->output->set_content_type('aplication/json')->set_output(json_encode($result));
	}

	public function update_snip() // OK
	{
		$result = [];
		checkSession($result);
		$codeTitle = trim($this->input->post('title'));
		$codeTag = $this->input->post('tag');
		$codeHtml = $this->input->post('html');
		if ( strlen($codeTitle) == 0 ) {
			$result['message'] = "alertDanger('ok','kolom Judul tidak boleh dikosongkan')";
		} elseif (strlen($codeTag) == 0) {
			$result['message'] = "alertDanger('ok','kolom Tag tidak boleh dikosongkan')";
		} elseif (empty($codeHtml)) {
			$result = [
				'status' => 2,
				'message' => "alertDanger('ok','snippet minimal harus ada kode HTML')"
			];
		} else {
			$code_id = $this->input->post('id');
			$jquery = [$this->input->post('jquery')];
			$framework = [$this->input->post('framework')];
			$cdn = array_merge($jquery,$framework);
			if ($jquery[0] == '') {
				array_shift($cdn);
			}
			if ($framework[0] == '') {
				array_pop($cdn);
			}

			$set_snippets = [
			  'code_title'  => trim(htmlspecialchars($this->input->post('title',true))),
			  'code_desc'   => trim(htmlspecialchars($this->input->post('description',true))),
			  'code_cdn'    => (!empty($cdn)) ? implode(',', $cdn) : null,
			  'code_tag'    => $this->input->post('tag'),
			  'code_html'   => htmlentities($this->input->post('html')),
			  'code_css'    => htmlentities($this->input->post('css')),
			  'code_js'     => htmlentities($this->input->post('js')),
			  'code_update' => time(),
			  'code_publish'=> $this->input->post('public')
			];
			$set_timeline = ['publish' => $this->input->post('public')];
			$this->db->update('snip',$set_snippets,['code_id' => $code_id]);
			$this->db->update('timeline',$set_timeline,['relation' => $code_id]);

			$result['message'] = "alertSuccess('ok',['sukses','perubahan berhasil disimpan',''])";
		}
		$this->output->set_content_type('aplication/json')->set_output(json_encode($result));
	}

	public function delete_snippet($serial)
	{
		$result = [];
		checkSession($result);
		$this->Common_model->delete('snip',['code_id' => $serial]);
		$this->Common_model->delete('user_comment',['id_target' => $serial]);
		$this->Common_model->delete('user_liked',['id_target' => $serial]);
		$this->Common_model->delete('timeline',['relation' => $serial]);
		$result['status'] = 1;
		$result['message'] = "flashAlert('sukses','snippet berhasil dihapus')";
		$this->output->set_content_type('aplication/json')->set_output(json_encode($result));
	}

	public function delete_comment($id)
	{
		$result = [];
		checkSession($result);
		$del = $this->Common_model->delete('user_comment',['created' => $id]);
		if ($del) {
			$result['status'] = 1;
			$result['message'] = "flashAlert('sukses','komentar berhasil dihapus')";
		}
		$this->output->set_content_type('aplication/json')->set_output(json_encode($result));
	}










// END OF FILE
}