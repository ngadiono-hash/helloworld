
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
									echo "<tr>";
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

	</div>
</div>