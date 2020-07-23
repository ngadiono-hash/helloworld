
<div id="content">
	<div class="container-fluid">
		<h1 class="h3 mb-4 text-center text-gray-800">Welcome Admin</h1>
		<div class="card shadow mb-4">
			<a href="#one" class="d-block card-header py-3" data-toggle="collapse" aria-expanded="true">
				<h6 class="m-0 font-weight-bold text-primary">Materi</h6>
			</a>
			<div class="collapse show" id="one">
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead class="text-center">
								<tr>
									<th>Level</th>
									<th>Count <??></th>
									<th>Publish</th>
									<th>Draft</th>
								</tr>
							</thead>
							<tbody class="text-center">
								<?php 
								foreach ($t as $key => $value) {
									echo "<tr data-id=".$value['nam'].">";
									echo "<td><a class='btn btn-outline-dark btn-block' href='".$value['lin']."'>".$value['nam']."</a></td>";
									echo "<td><button class='btn btn-outline-primary btn-block'>".$value['all']."</button></td>";
									echo "<td><button class='btn btn-outline-primary btn-block'>".$value['pub']."</button></td>";
									echo "<td><button class='btn btn-outline-primary btn-block'>".$value['dra']."</button></td>";
									echo "</tr>";
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<div class="card shadow mb-4">
			<a href="#two" class="d-block card-header py-3" data-toggle="collapse" aria-expanded="false">
				<h6 class="m-0 font-weight-bold text-primary">Quiz</h6>
			</a>
			<div class="collapse" id="two">
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead class="text-center">
								<tr>
									<th>Level</th>
									<th>Count <??></th>
									<th>Publish</th>
									<th>Draft</th>
									<th>Info</th>
								</tr>
							</thead>
							<tbody class="text-center">
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>

<div class="modal fade" id="modal-index">
	<div class="modal-dialog">
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