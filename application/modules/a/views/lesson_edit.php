<style>
  .wrapper-editor {
  	z-index: 99999;
  }
  .open-editor {
  	position: fixed;
    z-index: 999999;
    bottom: 20px;
    right: 30px;
  }
</style>

<div id="content" class="p-1">
	<button class="btn btn-dark open-editor"><i class="fa fa-code"></i></button>
  <div class="container-fluid" id="edited-lesson">
		<div class="row">
			<div class="col-md-9">
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
			<div class="col-md-3 p-4">
				<div class="btn-group btn-block mb-1">
				  <a class="btn btn-outline-primary" href="<?=base_url('a/less/'.$label)?>">Back</a>
				  <a class="btn btn-outline-primary" href="<?=$link?>" target="_blank">Go</a>
				</div>
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
				<div class="btn-group btn-block">
				  <button class="btn <?=$btn?>" data-id="<?=$id?>" id="btn-public"><?=$icon?></button>
				  
				  <button class="btn btn-danger" id=""><i class="fa fa-trash-alt"></i></button>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12 mt-1" id="sub">
			<?php
			if ($content != '') {
				$keys = getTags($content,'h3');
				foreach ($keys as $k) { ?>
					<button class="btn btn-sm btn-outline-primary"><?=$k?></button>
				<?php	}	?>
			<?php	}	?>
			</div>
		</div>
  </div>
</div>
<?php playEditor() ?>