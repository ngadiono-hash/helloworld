<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title><?=$code['code_title']?></title>
<?php
foreach ($extract as $k) {
	echo $k;
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