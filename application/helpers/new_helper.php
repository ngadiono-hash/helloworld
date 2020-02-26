<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	function deb($param)
	{
		var_dump($param);
		die();
	}

	function change_host($content)
	{
		// $find = ["/http:\/\/localhost\/helloworld\//"]
		// $replace 		= ["".base_url().""];
		// $find = '';
		// $replace = '';
		if(isset($find) && isset($replace)){
			return preg_replace($find,$replace,$content);
		} else {
			return $content;
		}		
	}

	function crypto_rand_secure($min, $max)
	{
		$range = $max - $min;
		if ($range < 1) return $min;
		$log = ceil(log($range, 2));
		$bytes = (int) ($log / 8) + 1;
		$bits = (int) $log + 1;
		$filter = (int) (1 << $bits) - 1;
		do {
				$rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
				$rnd = $rnd & $filter;
		} while ($rnd > $range);
		return $min + $rnd;
	}
	function getRandStr($length)
	{
		$str = "";
		$codeAlphabet = "";
		$codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
		$codeAlphabet.= "0123456789";
		$max = strlen($codeAlphabet);
		for ($i=0; $i < $length; $i++) {
			$str .= $codeAlphabet[crypto_rand_secure(0, $max-1)];
		}
		return $str;
	}

	function create_rand($label)
	{
		$rand = getRandStr(6);
		if($label == 'beginner'){
			$id = 'B'.$rand;
		} elseif ($label == 'intermediate') {
			$id = 'I'.$rand;
		} else {
			$id = 'A'.$rand;
		}
		return $id;
	}

	function validate_input($posted)
	{
		$CI = get_instance();
		$str = $CI->input->post($posted);
	  $str = trim($str);
	  $str = htmlspecialchars($str);
	  return $str;
	}

	function create_slug($str)
	{
		return trim(strtolower(str_replace(' ', '-', $str)));
	}










	function getIp() 
	{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
	}

	function buildSession($name,$value=null)
	{
		return (empty($_SESSION[$name])) ? $_SESSION[$name] = $value : false;	
	}
	function startSession($name)
	{
		return (!empty($_SESSION[$name])) ? true : false;
	}
	function getSession($name)
	{
		return $_SESSION[$name];
	}
	function startCookie($name)
	{
		return (!empty($_COOKIE[$name])) ? true : false;
	}
	function getCookie($name)
	{
		return $_COOKIE[$name];
	}
	function not_found()
	{
		$status = [
			'title' => '404',
			'image' => '404.gif',
			'message' => 'halaman yang kamu cari tidak tersedia'
		];
		blank_page($status);
		die();
	}
	// function checkSession($result){
	// 	if(!startSession('sess_id')) {
	// 		$result['message'] = "<script>alertDanger('ok','server mendeteksi bahwa tidak ada sesi login, <br> silahkan login terlebih dahulu')</script>";
	// 		echo json_encode($result);
	// 	}
	// }	
	function is_login()
	{
		$status = [
			'title' => '403',
			'image' => 'blocked.png',
			'message' => 'kamu harus <a href="'.base_url("at/sign").'">login</a> dulu untuk lanjut ke halaman ini'
		];
		if (startSession('sess_id')) {
			return TRUE;
		} else {
			$_SESSION['reff_page'] = current_url();
			blank_page($status);
			die();
		} 
	}

	function is_admin()
	{
		$status = [
			'title' => '403',
			'image' => 'blocked.png',
			'message' => 'kamu tidak punya hak akses ke halaman ini'
		];		
		if ( startSession('sess_role') && getSession('sess_role') == 1 ) {
			return true;
		} else {
			blank_page($status);
			die();
		}
	}

	function is_send_ajax(){
		(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') ? true : not_found();
	}

	function reload_session(){
		$CI = get_instance();			
		if ((startSession('sess_id') == false) && (startCookie('c_user') == true)){
			$token = getCookie('c_user');
			$now   = time();
			$ip    = getIp();
			$agent = $_SERVER['HTTP_USER_AGENT'];
			$check = $CI->db->from('user_cookie')->where(['token' => $token, 'expired >' => $now])->get();
			
			if ( $check->num_rows() > 0 ){
					$check = $check->row_array();
				if ( $check['ip'] ==  $ip || $check['agent'] == $agent){
					$getData = $CI->db->get_where('users', ['u_email' => $check['email']])->row_array();
					$data = [
						'sess_id'   => $getData['u_id'],
						'sess_role' => $getData['u_role'],
						'sess_user' => $getData['u_username'],
						'sess_reg'   => $getData['u_register'],
						'sess_image' => base_url('assets/img/profile/').$getData['u_image']
					];
					$CI->session->set_userdata($data);
					return true;
				}
			} else {
				$CI->db->delete('user_cookie',['token' => $token]);
			}
		}
	}


	function whats_page($uri,$page){
		$CI = get_instance();
		$url 	 = $CI->uri->segment($uri);
		return ( in_array($url, $page) ) ? true : false;
	}

	function fetch_data(){
		$CI = get_instance();
		if ( startSession('sess_id') )
		{
			$id    = getSession('sess_id');
			$fetch = $CI->db->get_where('users',['u_id' => $id])->row_array();
			return $fetch;
		}
	}

	function _temp_admin($data=null,$title,$page){
		$CI = get_instance();
		$fet = fetch_data();		
		$data['inUser'] = [
			'register' =>  $fet['u_register'],
			'email'	=>  $fet['u_email']
		];
		$data['title']    = $title;

		$CI->load->view('templates/adminHeader',$data);
		$CI->load->view($page,$data);
		$CI->load->view('templates/adminFooter',$data);
	}

// TIMING
	function time_elapsed_string($datetime,$full=false,$lang='id') {
		$now = new DateTime;
		$ago = new DateTime($datetime);
		$diff = $now->diff($ago);
		$diff->w = floor($diff->d / 7);
		$diff->d -= $diff->w * 7;

		if ($lang == 'id') {
			$str = array(
					'y' => 'tahun',
					'm' => 'bulan',
					'w' => 'minggu',
					'd' => 'hari',
					'h' => 'jam',
					'i' => 'menit',
					's' => 'detik',
			);
		} else {
			$str = array(
					'y' => 'years',
					'm' => 'months',
					'w' => 'weeks',
					'd' => 'day',
					'h' => 'hours',
					'i' => 'minutes',
					's' => 'seconds',
			);
		}
		foreach ($str as $k => &$v) {
				if ($diff->$k) {
						$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
				} else {
						unset($str[$k]);
				}
		}

		if (!$full) $str = array_slice($str, 0, 1);
		if ($lang == 'id') {
			return $str ? implode(', ', $str) . ' yang lalu' : 'baru saja';
		} else {
			return $str ? implode(', ', $str) . ' ago' : 'just now';
		}
}

// META CONTENT 
function getTags($str, $tagname){
  if (!empty($str)) {
	  $d = new DOMDocument();
	  $d->loadHTML($str);
	  $return = array();
	  foreach($d->getElementsByTagName($tagname) as $item){
	      $return[] = $item->textContent;
	  }
	  return $return;
  }
}
function read_more($str,$length){
	$delTags = strip_tags($str);
	$replaceTab = preg_replace('/\s\s+/',' ', $delTags);
	$cut = substr($replaceTab, 0,$length);
	$pieces = explode(' ', $cut);
	array_pop($pieces);
	$result = implode(' ', $pieces);
	return $result;	
}


