
<div id="content">
  <div class="container-fluid">
  	<h1 class="h3 m-2 text-center text-gray-800">Quiz <?=$label?></h1>
  	
  	<div class="wrap-table">
  		<button class="btn btn-outline-primary btn-sm add-modal">
        <i class="fa fa-fw fa-plus"></i> Add New
      </button>
  		<div class="table-responsive">
  			<table class="display stripe row-border" id="table-quiz">
  				<thead>
  					<tr>
  						<th>No.</th>
              <th>Title</th>
              <th><i class="fa fa-sort-numeric-down"></i></th>
              <th>Question</th>
              <th>Answer</th>
              <th>Correct</th>
  					</tr>
  				</thead>
  				<tbody></tbody>
  			</table>
  		</div>
  	</div>

  </div>
</div>

<div class="modal fade" id="modal-quiz">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="text-center"></h3> 
      </div>
      <div class="modal-body">
        <ul class="nav nav-tabs nav-fill mb-1" id="pills-tab">
          <input type="hidden" id="id-quiz">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="pill" href="#add-question">Question</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="pill" href="#add-answer">Answer</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="pill" href="#add-qlue">Qlue</a>
          </li>
          <li class="nav-item">
            <button class="btn btn-default" id="btn-action-quiz">Submit</button>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane fade show active" id="add-question">
            <textarea id="ckquiz"></textarea>
          </div>
          <div class="tab-pane fade" id="add-answer">
            <div class="card card-body">
              <div class="form-group row">
                <label class="col-sm-2">Choice A</label>
                <div class="col-sm-10">
                  <input type="text" name="choice[]" id="choice1" class="form-control">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2">Choice B</label>
                <div class="col-sm-10">
                  <input type="text" name="choice[]" id="choice2" class="form-control">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2">Choice C</label>
                <div class="col-sm-10">
                  <input type="text" name="choice[]" id="choice3" class="form-control">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2">Choice D</label>
                <div class="col-sm-10">
                  <input type="text" name="choice[]" id="choice4" class="form-control">
                </div>
              </div>
            </div>
            <div class="card card-body">
              <div class="form-group row">
                <label class="col-sm-2">Answer</label>
                <div class="col-sm-10">
                  <select id="select-answer">
                    <option value="1">A</option>
                    <option value="2">B</option>
                    <option value="3">C</option>
                    <option value="4">D</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="add-qlue">
            <div class="row">
              <div class="col-sm-4">
                <select id="select-level">
                  <option value="a">beginner</option>
                  <option value="b">medium</option>
                  <option value="c">advance</option>
                </select>
              </div>
              <div class="col-sm-4">
                <select id="select-materi">
                <?php foreach ($option as $k => $v) { ?>
                  <option value='<?=$v['les_id']?>'><?=$v['les_title']?></option>
                <?php } ?>
                </select>
              </div>
              <div class="col-sm-4">
                <input type="text" name="" class="form-control" id="qlue" value="">
              </div>
            </div>

          </div>
        </div>

      </div>
    </div>
  </div>
</div>