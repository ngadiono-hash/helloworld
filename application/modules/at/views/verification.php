<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Hello World - <?=$title?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<?php bootstrap() ?>
<?php myGlobal() ?>
	<style>
		.div {
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background-color: rgba(0, 0, 0, 0.3);
		}
		.div img {
			position: absolute;
			left: 50%;
			top: 50%;
			transform: translate(-50%, -50%);	
		}
	</style>
</head>
<body>
	<div class="div"></div>
	<script>
		$(document).ready(function() {
			$('.div').html('<img src="'+ host +'assets/img/feed/bars.svg" height="250">');
			setTimeout(function(){$('.div').empty('img'),<?=$message[0]?>},3000);
		});
	</script>
</body>
</html>