<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	function bug($param)
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
		return (isset($_COOKIE[$name])) ? true : false;
	}
	function getCookie($name)
	{
		return $_COOKIE[$name];
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

	function trimChar_input($posted)
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

	function filterSearchKeys($query){
	  $query = trim(preg_replace("/(\s+)+/", " ", $query));
	  $words = array();
	  // expand this list with your words.
	  $list = ["di","itu","sebuah","ini","dari","atau","kami","kita","kalian","dalam","tetapi"];
	  $c = 0;
	  foreach(explode(" ", $query) as $key){
	    if (in_array($key, $list)){
	      continue;
	    }
	    $words[] = $key;
	    if ($c >= count($list)){
	      break;
	    }
	    $c++;
	  }
	  return $words;
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

	function reload_session()
	{
		$CI = get_instance();
			if ( !startSession('sess_log') && isset($_COOKIE['_lang']) && isset($_COOKIE['_no']) ){
				$id = getCookie('_no');
				$token = getCookie('_lang');
				$check = $CI->db->where(['token' => $token, 'expired >' => time()])->get('user_cookie');

				if ( $check->num_rows() > 0 ){
					$user = $check->row_array();
					$getData = $CI->db->select('u_id,u_role,u_email')->where(['u_id' => $id])->get('users')->row_array();
					if ( $token === hash('sha256',$getData['u_email']) ){
						$data = [
							'sess_log' => true,
							'sess_id'   => $getData['u_id'],
							'sess_role' => $getData['u_role']
						];
						$CI->session->set_userdata($data);
						return true;
					}
				} else {
					$CI->db->delete('user_cookie',['token' => $token]);
				}
			}
	}




	function not_found()
	{
		blank_page(404);
		die();
	}

	function is_logged()
	{
		if (startSession('sess_log')) {
			return true;
		} else {
			buildSession('reff',current_url());
			blank_page(403);
			die();
		}
	}

	function is_admin()
	{
		return ( startSession('sess_role') && getSession('sess_role') == 1 ) ? true : false;
	}

	function is_send_ajax(){
		(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') ? true : not_found(404);
	}

	function getTags($str,$tagname){
	  if (!empty($str)) {
		  $return = [];
		  $doc = new DOMDocument();
		  $doc->loadHTML($str);
		  foreach($doc->getElementsByTagName($tagname) as $item){
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
	function elapsed($datetime,$full=false,$lang='id') {
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




