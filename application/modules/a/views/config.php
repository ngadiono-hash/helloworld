<div id="content">
	<div class="container-fluid config">
		<h1>Config Menu JavaScript</h1>
		<div class="row">
			<?php foreach ($all as $key => $value) { ?>
			<div class="col-md-4">
				<form class="card card-body">
					<h3 class="text-center"><?=$value['name']?></h3>
					<h4 class="text-center"><?=$value['description']?></h4>
					<hr>
					<textarea class="form-control" rows="10"><?=$value['content']?></textarea>
					<hr>
					<button type="submit" class="btn btn-primary">Submit</button>
				</form>
			</div>	
			<?php } ?>
		</div>
	</div>
</div>