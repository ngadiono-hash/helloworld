
<div id="content">
  <div class="container-fluid">
  	<h1 class="h3 m-2 text-center text-gray-800">Materi JS <?=ucwords($label)?></h1>
  	
  	<div class="wrap-table">
  		<button class="btn btn-outline-primary btn-sm add-modal"><i class="fa fa-fw fa-plus"></i> Add New</button>
  		<div class="table-responsive">
  			<table class="display stripe row-border" id="table-lesson">
  				<thead>
  					<tr>
  						<th>No.</th>
  						<th><i class="fa fa-sort-numeric-down"></i></th>
  						<th><i class="fa fa-edit"></i></th>
  						<th>Title</th>
  						<th>Slug</th>
  						<th><i class="fa fa-info-circle"></i></th>
              <th><i class="fa fa-code"></i></th>
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

<div class="modal fade" id="modal-snippet">
  <div class="modal-dialog modal-lg">
    <div class="modal-content bg-light">
      <div class="modal-body">
        
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-lesson">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-body">
				
			</div>
		</div>
	</div>
</div>
