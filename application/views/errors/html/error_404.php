<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>This is 404</title>
<style>
	div {
		margin: 80px auto;
		text-align: center;
		line-height: 15vh;
	}
	img{
    width: 350px;
	}
	h1{
		font-family: Stencil, Fantasy; 
	}
</style>
</head>
<body>
	<div>
		<h1><?php echo $heading; ?></h1>
		<h3><?php echo $message; ?></h3>
		<button onclick="window.history.back()"><h3>Lets go back</h3></button>
	</div>
</body>
</html>