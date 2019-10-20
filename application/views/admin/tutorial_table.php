
<div class="content-wrapper">
	<section class="content content-tutorials">
	<div class="custom-modal hide box-sh">
		<div class="">
			<div><button class="btn btn-diss"><i class="fa fa-times"></i></button></div>
			<iframe id="frame-pre" src=""></iframe>
		</div>
	</div>
		<div class="wrap-table">
			<a class="btn btn-sm btn-ok btn-modal" data-toggle="modal" data-target="#modal-tutorial"><i class="fa fa-fw fa-plus"></i> Add New</a>
			<div class="table-responsive">
				<table class="display" id="tutorials">
					<thead>
						<tr>
							<th>No.</th>
							<th><i class="fa fa-sort-numeric-down"></i></th>
							<th style="min-width: 79px;">Action</th>
							<th>Title</th>
							<th>Slug</th>
							<th><i class="fa fa-edit"></i></th>
							<th><i class="fa fa-info-circle"></i></th>
							<th><i class="fa fa-globe-asia"></i></th>
							<th><i class="fa fa-thumbs-up"></i></th>
							<th><i class="fa fa-eye"></i></th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	</section>
</div>
<div class="modal fade" id="modal-tutorial">
	<div class="modal-dialog">
		<div class="modal-content">
		<div class="modal-header" style="padding: 5px"> 
			<h2>ADD NEW LESOON</h2>
		</div>
			<form id="create-tutorial-form" method="post">
				<div class="row" style="margin: 10px 20px">
					<input type="text" id="ttl-snip" class="input-adjust" name="title" placeholder="Enter Title Here...">
					<hr>
					<input type="text" id="slug-snip" class="input-adjust" name="slug" placeholder="Enter Slug Here...">
					<hr>
					<div class="col-sm-6">
						<select id="cat-snip" class="selectpicker" name="category">
							<option value="blank"> Select Category </option>
							<?php 
							foreach($cat_name as $n){
								echo '<option value="'.$n['category_id'].'">'.$n['category_name'].'</option>';
							}
							?>
						</select>
					</div>        
					<div class="col-sm-6">
						<select id="lvl-snip" class="selectpicker" name="level">
							<option value="blank"> Select Level </option>
							<?php 
							foreach($lev_name as $num){
								echo '<option value="'.$num['level_id'].'" data-chained="'.$num['category_id'].'">'.$num['level_name'].'</option>';
							}
							?>
						</select>
					</div>
				</div>
				<div class="modal-footer center">
					<button type="submit" class="btn button btn-ok" style="width: 50%;">SUBMIT</button>
				</div>
			</form>
		</div>
	</div>
</div>
<script>
	$("#lvl-snip").chained("#cat-snip");
	$("#lvl-snip").change(function(){
	  $('.selectpicker').selectpicker('refresh');
	});
</script>
<script src="<?=base_url('assets/js/dt_tutorial.js')?>"></script>