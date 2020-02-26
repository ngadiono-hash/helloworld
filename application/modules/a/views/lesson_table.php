<style type="text/css">
.btn-modal {
  position: absolute;
  top: 52px;
  right: 30px;
}
.dataTables_processing {
	position: absolute !important;
	top: 235px !important;
	right: 500px !important;
}

table thead tr th {
	text-transform: capitalize;
	text-align: center;
	color: #808080;
	cursor: pointer;
	background-color: #f1f1f1;
}
.dataTable tbody tr {
	border-bottom: 2px solid #808080;
}
.dataTable {
	border-spacing: 1px;
}
.dataTable thead .sorting,
.dataTable thead .sorting_asc,
.dataTable thead .sorting_desc {
	/*background-image: none !important;*/
}
.dataTable tbody .order {
	cursor: grab;
}
.dataTable tbody tr td {
	text-align: center;
}
.dataTable tbody tr td a {
/*	color: #808080;
	text-shadow: none !important;*/
}
.dataTable tbody tr:hover {
	background-color: #d2d6de !important;
}
.dataTable tbody tr td .btn {
	display: block;
}
.dataTable tbody tr td:hover {
	background: linear-gradient(45deg,#ddd,#fff);
	border-color: transparent;
}
.dataTable tbody tr td .btn.btn-title,
.dataTable tbody tr td .btn.btn-slug {
	text-align: left;
}
.DataTables_sort_icon.css_right.ui-icon {
	/*display: inline;*/
	/*background-image: none;*/
}	
</style>
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
  						<!-- <th><i class="fa fa-edit"></i></th> -->
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




<div class="content-wrapper d-none">
	<section class="content content-tutorials">
	<div class="custom-modal d-none box-sh">
		<div class="">
			<div><button class="btn btn-diss"><i class="fa fa-times"></i></button></div>
			<iframe id="frame-pre" src=""></iframe>
		</div>
	</div>

	</section>
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
<iframe id="frame-full" style="display: none" src=""></iframe>
