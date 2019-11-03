<style>
	.d { padding: 10px !important; }
	.content-edit .nav-tabs li {
		width: 20%;
	}
	.alert-auto {
		position: fixed;
    top: -1px;
    right: 60px;
    z-index: 9999;
    width: 300px;	
    text-align: center;	
	}
	.alert-auto h4 {
		margin: 0;
	}
	.label-created,.label-updated {
		position: absolute;
		bottom: 38px;
    font-size: 0.9em;
    color: #ccc;
    text-shadow: -1px -1px 0 royalblue, 1px -1px 0 royalblue, -1px 1px 0 royalblue, 1px 1px 0 royalblue;
	}
	.label-created {
		left: 200px;
	}
	.label-updated {
		left: 400px;
	}
</style>
<script>
	CKEDITOR.dtd.$removeEmpty['i'] = false;
</script>
<div class="content-wrapper">
  <section class="content content-edit">
  	<div class="alert alert-success alert-auto hide">
  		<h4><i class="fa fa-check"></i> sucessfully updated</h4>
  	</div>
	<div class="custom-modal hide box-sh">
		<div>
			<button class="btn btn-diss"><i class="fa fa-times"></i></button>
		</div>
		<iframe id="frame-pre" src=""></iframe>
	</div>  	
		<div class="wrap-table <?= $theme ?>" style="margin-right: 46px;">
			<form id="tutorial-form" action="<?=base_url('xhra/update_tutorial')?>">
				<input type="hidden" id="id" name="id" value="<?= $id ?>">
				<input type="hidden" name="category" value="<?= $cat_name ?>">
				<input type="hidden" name="public" value="<?= $public ?>">
				
					<ul class="nav nav-tabs">
						<li class="center">
							<a class="button btn-def" href="<?= $linkPrev ?>">
						  	<i class="fa fa-arrow-left"></i>
						  	<span class="hidden-xs hidden-sm">Prev</span> 
						  </a>
						</li>
				  	<li class="active center">
				  		<a class="button btn-def" data-toggle="tab" href="#desk">
				  			<i class="fa fa-book fa-lg"></i>
				  			<span class="hidden-xs hidden-sm"> Desc</span>
				  		</a>
				  	</li>
				  	<li class="center">
				  		<a class="button btn-def" data-toggle="tab" href="#snip">
				  			<i class="fa fa-code fa-lg"></i>
				  			<span class="hidden-xs hidden-sm"> Snippet</span>
				  		</a>
				  	</li>
				  	<li class="center">
				  		<a class="button btn-def" data-toggle="tab" href="#info">
				  			<i class="fa fa-info-circle fa-lg"></i>
				  			<span class="hidden-xs hidden-sm"> Info</span>
				  		</a>
				  	</li>
				  	<li class="center">
							<a class="button btn-def" href="<?= $linkNext ?>">
						  	<i class="fa fa-arrow-right"></i>
						  	<span class="hidden-xs hidden-sm">Next</span> 
						  </a>
						</li>
					</ul>

					<div class="tab-content">
					  <div id="desk" class="tab-pane fade in active">
							<textarea id="text-editor" name="desc"><?= $content ?></textarea>
							<label class="label-created">Created : <span><?= date('d M, Y H:i',$upload) ?></span></label>
							<label class="label-updated">Last Updated : <span><?= date('d M, Y H:i',$update) ?></span></label>
					  </div>
					  <div id="snip" class="tab-pane fade">
				    	<textarea id="isi" class="text-code" name="code" spellcheck="false"><?= $code; ?></textarea>
					  </div>
					  <div id="info" class="tab-pane fade">
					  	<div class="row">
					  		<div class="col-sm-6">
					  			<label for="title">Title Snippet</label>
					  			<input type="text" class="input-adjust" id="title" spellcheck="false" name="title" value="<?= $titlex; ?>" placeholder="Edit this Title">
					  			<label for="slug">Slug Snippet</label>
					  			<input type="text" class="input-adjust" id="slug" spellcheck="false" name="slug" value="<?= $slug; ?>" placeholder="Edit this Slug">
					  			<label for="level">Level Snippet</label>
					  			<input class="input-adjust" id="level" name="level" value="<?= $cat_name; ?>" disabled>
					  		</div>
					  	</div>
					  </div>
					</div>

				<div class="icon-bar">
				  <a class="a btn btn-prm" id="update">
				  	<span>Update</span> <i class="fa fa-edit"></i> 
				  </a>
				  <a class="b btn btn-def" href="<?=base_url('lesson/'.$cat_name.'/'.$meta)?>" target="_blank">
				  	<span>Open Link</span> <i class="fas fa-link"></i> 
				  </a> 
				  <a class="c btn btn-warn action-preview" data-href="<?=base_url('lesson/'.$cat_name.'/'.$meta) ?>">
				  	<span>Preview</span> <i class="fa fa-eye"></i> 
				  </a>
				  <a class="d btn btn-pub action-public <?=$btn?>" data-href="<?=base_url('xhra/update_tutorial_public/'. $id)?>">
				  	<?= $fa ?>
				  </a> 
				  <a class="e btn btn-no" href="<?=base_url('a/'.$cat_name) ?>">
				  	<span>Back</span> <i class="fa fa-reply"></i> 
				  </a> 
				  <a class="f btn btn-no btn-del" data-id="<?=$id?>" data-href="<?=base_url('xhra/delete_tutorial/'.$id)?>">
				  	<span>Delete</span>
				  	<i class="fa a-fw fa-trash-alt"></i>
				  </a>
				</div>
			</form>
		</div>
	</section>
</div>

<script>
CKEDITOR.on('instanceReady', function(evt) {
  var editor = evt.editor;
  editor.on('focus', function(e) {
  	// console.log('focus');
  	// setInterval(autoUpdateTutor,60 * 5 * 1000);
  });
  editor.on('blur', function(e) {
  	// console.log('blur');
  	// setInterval(autoUpdateTutor,60 * 5 * 1000);
  });
});
CKEDITOR.replace('text-editor');
</script>