
<div id="content">
  <div class="container-fluid">
  	<h1 class="h3 m-2 text-center text-gray-800">Quiz <?=$label?></h1>
  	
  	<div class="wrap-table">
  		<button class="btn btn-outline-primary btn-sm btn-modal">
        <i class="fa fa-fw fa-plus"></i> Add New
      </button>
  		<div class="table-responsive">
  			<table class="display stripe row-border" id="table">
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
          <div>
            <select id="select-for">
              <?php foreach ($quiz as $k => $v) { ?>
                <option value='<?=$v['les_id']?>'><?=$v['les_title']?></option>
              <?php } ?>
            </select>
          </div>
      </div>
      <div class="modal-body">
        <ul class="nav nav-pills nav-fill mb-1" id="pills-tab">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="pill" href="#add-question">Question</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="pill" href="#add-answer">Answer</a>
          </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
          <div class="tab-pane fade show active" id="add-question">
            <textarea id="ckquiz"></textarea>
          </div>
          <div class="tab-pane fade" id="add-answer">
            <div class="form-group row">
              <label class="col-sm-2">Choice 1</label>
              <div class="col-sm-10">
                <input type="text" name="choice[]" id="choice1" class="form-control">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2">Choice 2</label>
              <div class="col-sm-10">
                <input type="text" name="choice[]" id="choice2" class="form-control">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2">Choice 3</label>
              <div class="col-sm-10">
                <input type="text" name="choice[]" id="choice3" class="form-control">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2">Choice 4</label>
              <div class="col-sm-10">
                <input type="text" name="choice[]" id="choice4" class="form-control">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2">Answer</label>
              <div class="col-sm-10">
                <select id="select-answer">
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                </select>
              </div>
            </div>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <input type="hidden" id="id">
        <button class="btn btn-outline-primary" id="btn-action-quiz">Submit</button>
      </div>
    </div>
  </div>
</div>