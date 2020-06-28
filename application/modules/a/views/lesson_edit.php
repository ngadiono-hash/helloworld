<style>
.content-edit {
  position: fixed;
  z-index: 9;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
}
.content-editor {
  display: flex;
  flex-direction: row;
  overflow: hidden;
  height: 100%;
  min-height: 92vh;
  box-shadow: 0px 2px 5px rgba(0,0,0,0.5);
}
.content-editor .splitter {
  flex: 0 0 auto;
  width: 18px;
  min-height: 200px;
  cursor: col-resize;
  transition: all .3s ease-in-out;
}
.content-editor .splitter:hover {
  background-color: #ccc;
}
.content-editor .content-left {
  flex: 0 0 auto;
  width: 50vw;
  min-width: 5%;
  max-width: 98%;
  background-color: #ccc;
}
.content-editor .body-source {
  height: 93vh;
  padding: 0;
}
.content-editor .ctrl {
  display: flex;
}
.content-editor .content-right {
  flex: 1 1 auto;
  width: 100%;
  background: #fff;
}
.content-editor .frame {
  width: 100%;
  height: 100%;
  border: none;
}
.stamp {
	position: absolute;
  bottom: 0;
  right: 10px;
  padding: 0 10px;
  background: #000000e6;
}

.wrapper-editor {
	z-index: 99999;
}
#open-editor {
  position: fixed;
  z-index: 999999;
}

</style>
<button id="open-editor" class="btn btn-outline-dark"><i class="fa fa-lg fa-fw fa-code"></i></button>
<div class="content-edit" id="edited-lesson">
  <div class="content-editor">
    <div class="content-left">
      <nav class="ctrl" style="margin-left: 55px;">
      	<input type="hidden" id="input-id" value="<?=$id?>">
        <button class="btn btn-outline-dark" data-toggle="modal" data-target="#modal-info"><i class="fa fa-lg fa-fw fa-info"></i></button>
        <button class="btn btn-outline-dark" id="btn-update"><i class="fa fa-lg fa-fw fa-save"></i></button>
      	<button class="btn btn-outline-dark"><a href="<?=base_url('a/less/'.$label)?>"><i class="fas fa-lg fa-fw fa-reply"></i></a></button>
        <button class="btn btn-outline-dark"><a href="<?=$linkPrev?>"><i class="fa fa-lg fa-fw fa-arrow-left"></i></a></button>
        <button class="btn btn-outline-dark"><a href="<?=$linkNext?>"><i class="fa fa-lg fa-fw fa-arrow-right"></i></a></button>
        <button class="btn btn-outline-dark"><a href="<?=$link?>" target="_blank"><i class="fas fa-lg fa-fw fa-location-arrow"></i></a></button>
        <input type="text" id="input-title" class="form-control" value="<?=$titles?>">
        <input type="text" id="input-slug" class="form-control" value="<?=$slug?>">
      </nav>
      <textarea id="ckedit"><?=htmlentities($content)?></textarea>
    </div>
    <div class="splitter"></div>
    <div class="content-right">
    	<iframe id="frame-preview" class="frame"></iframe>
    	<div style="position: absolute; bottom: 0" class="stamp">
    		<span id="input-update"><?=date('d F, Y H:i',$update)?></span> | 
    		<span><?=date('d F, Y',$upload)?></span>
    	</div>
    </div>
  </div>  
</div>
<div class="modal fade" id="modal-info">
  <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-body">
				<div class="accordion" id="accord">
				  <div class="card">
				    <div class="card-header p-2">
			        <button class="btn btn-block btn-outline-dark" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false">Sub Key H3</button>
				    </div>
				    <div id="collapseTwo" class="collapse show" data-parent="#accord">
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
