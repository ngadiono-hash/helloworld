<style>
  .wrapper-editor {
  	z-index: 99999;
  }
  button.temp-editor {
  	position: fixed;
    z-index: 999999;
    top: 0;
    bottom: 0;
    left: 0;
    width: 27px;
    font-size: 20px;
    word-wrap: break-word;
    font-family: monospace;
  }
</style>
<!-- <button class="btn-dark temp-editor" id="open-editor">EDITOR</button> -->
<div id="content" class="p-1">
  <div class="container-fluid" id="edited-lesson">
		<div class="row">
			<div class="col-md-8">
		  	<ul class="nav nav-pills nav-fill mb-1">
		  		<li class="nav-item">
		  			<a class="nav-link btn btn-outline-primary" href="<?=$linkPrev?>"><i class="fa fa-arrow-left"></i></a>
		  		</li>
		  	  <li class="nav-item">
		  	    <a class="nav-link btn active" data-toggle="pill" href="#pills-editor">Editor</a>
		  	  </li>
		  	  <li class="nav-item">
		  	  	<a class="nav-link btn btn-outline-success" id="btn-update"><i class="fa fa-save"></i></a>
		  	  </li>
		  	  <li class="nav-item">
		  	    <a class="nav-link btn" id="btn-preview" data-href="<?=$link?>" data-toggle="pill" href="#pills-preview">Preview</a>
		  	  </li>
				  <li class="nav-item">
				  	<a class="nav-link btn btn-outline-primary" href="<?=$linkNext?>"><i class="fa fa-arrow-right"></i></a>
					</li>
		  	</ul>
		  	<div class="tab-content">
		  	  <div class="tab-pane fade show active" id="pills-editor">
		  	  	<textarea id="ckedit"><?=htmlentities($content)?></textarea>
		  	  </div>
		  	  <div class="tab-pane fade" id="pills-preview">
		  	  	<iframe id="frame-preview"></iframe>
		  	  </div>
		  	</div>
			</div>
			<div class="col-md-4">
				<div class="btn-group btn-block mb-1" data-id="<?=$id?>">
				  <a class="btn btn-outline-primary" href="<?=base_url('a/less/'.$label)?>">Back</a>
				  <a class="btn btn-info" href="<?=$link?>" target="_blank">Go</a>
				  <button class="btn <?=$btn?>" id="btn-public"><?=$icon?></button>
				  <button class="btn btn-danger" id=""><i class="fa fa-trash-alt"></i></button>
				</div>

				<div class="accordion" id="accord">
				  <div class="card">
				    <div class="card-header p-2">
			        <button class="btn btn-block btn-outline-dark" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true">Info Materi</button>
				    </div>

				    <div id="collapseOne" class="collapse show" data-parent="#accord">
				      <div class="card-body">
				        <div class="form-group">
				        	<input type="hidden" id="input-id" value="<?=$id?>">
				        	<label>Title</label>
				        	<input type="text" id="input-title" class="form-control" value="<?=$titles?>">
				        </div>
				        <div class="form-group">
				        	<label>Slug</label>
				        	<input type="text" id="input-slug" class="form-control" value="<?=$slug?>">
				        </div>
				        <div class="form-group">
				        	<label>Created</label>
				        	<input type="text" class="form-control" value="<?=date('d F, Y H:i',$upload)?>" disabled>
				        </div>
				        <div class="form-group mb-4">
				        	<label>Updated</label>
				        	<input type="text" class="form-control" id="input-update" value="<?=date('d F, Y H:i',$update)?>" disabled>
				        </div>
				      </div>
				    </div>
				  </div>
				  <div class="card">
				    <div class="card-header p-2">
			        <button class="btn btn-block btn-outline-dark collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false">Sub Key H3</button>
				    </div>
				    <div id="collapseTwo" class="collapse" data-parent="#accord">
				      <div class="card-body">
				        <div class="form-group">
				        	<ol id="sub-h3">
					        <?php
					        if ($content != '') {
					        	$k3 = getTags($content,'h3');
					        	foreach ($k3 as $k) { ?>
					        	<li><?=$k?></li>
					        	<?php	}	?>
					        <?php	}	?>
				      		</ol>
				        </div>
				      </div>
				    </div>
				  </div>
				  <div class="card">
				    <div class="card-header p-2">
				      <button class="btn btn-block btn-outline-dark collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false">Sub Key H4</button>
				    </div>
				    <div id="collapseThree" class="collapse" data-parent="#accord">
				      <div class="card-body">
                <div class="form-group">
                	<ol id="sub-h4">
        	        <?php
        	        if ($content != '') {
        	        	$k4 = getTags($content,'h4');
        	        	if (!empty($k4)) :
	        	        	foreach ($k4 as $k) : ?>
	        	        	<li><?=$k?></li>
	        	        	<?php	endforeach;
        	        	endif;
        	        	}	?>
              		</ol>
                </div>
				      </div>
				    </div>
				  </div>
				</div>

			</div>
		</div>
  </div>
</div>
<?php playEditor() ?>