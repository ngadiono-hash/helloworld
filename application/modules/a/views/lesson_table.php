
<div id="content">
  <div class="container-fluid">
  	<h1 class="h3 m-2 text-center text-gray-800">Materi <?=$label?></h1>
  	
  	<div class="wrap-table">
  		<button class="btn btn-outline-primary btn-sm btn-modal" data-toggle="modal" data-target="#modal-lesson"><i class="fa fa-fw fa-plus"></i> Add New</button>
  		<div class="table-responsive">
  			<table class="display stripe row-border" id="lesson-table">
  				<thead>
  					<tr>
  						<th>No.</th>
  						<th><i class="fa fa-sort-numeric-down"></i></th>
  						<th><i class="fa fa-edit"></i></th>
  						<th>Title</th>
  						<th>Slug</th>
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

  </div>
</div>


<div class="modal fade" id="modal-lesson">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-body">
				<h3 class="text-center">Add New Lesson</h3>
				<form id="lesson-form" method="post">
					<div class="row">
						<div class="col-12">
							<div class="form-group">
								<label>Title</label>
								<input type="text" id="lesson-title" class="form-control" placeholder="Enter Title Here...">
							</div>
							<div class="form-group">
								<label>Slug</label>
								<input type="text" id="lesson-slug" class="form-control" placeholder="Enter Slug Here...">
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-block btn-primary">Submit</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
