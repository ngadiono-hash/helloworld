<div id="content">
	<div class="container-fluid config">
		<h1 class="text-center">Config Menu JavaScript</h1>
		<div class="row">
			<?php foreach ($all as $key => $value) { ?>
			<div class="col-md-4">
				<form class="card card-body mb-3">
					<h4 class="text-center"><?=$value['names']?></h4>
					<hr>
					<input type="text" name="" class="form-control" value="<?=$value['names']?>">
					<input type="text" name="" class="form-control" value="<?=$value['description']?>">
					<!-- <textarea class="form-control" rows="10"><?=$value['content']?></textarea> -->
					<hr>
					<button type="submit" class="btn btn-primary">Submit</button>
				</form>
			</div>	
			<?php } ?>
		</div>
	</div>
</div>