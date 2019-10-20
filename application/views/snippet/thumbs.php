<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title><?=$code['code_title']?></title>
<?php
foreach ($arrJquery as $key) {
	$res = $this->db->get_where('cdn',['id' => $key])->result_array();
	foreach ($res as $b) {
echo popu($b['cdn_js'])."\n";
	}
}
foreach ($arrFramework as $key) {
	$rest = $this->db->get_where('cdn',['id' => $key])->result_array();
	foreach ($rest as $k) {
echo popu($k['cdn_css'])."\n".popu($k['cdn_js'])."\n";
	}
}
?>	
<style id="user-style">
<?=html_entity_decode($code["code_css"])?>
</style>
</head>
<body id="user-body">
<?=html_entity_decode($code["code_html"])."\n"?>
<script id="user-script">
<?=html_entity_decode($code["code_js"])?>	
</script>
</body>
</html>