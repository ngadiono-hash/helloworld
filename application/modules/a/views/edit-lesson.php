
<button class="btn btn-outline-primary open-editor" data-toggle="modal" data-target="#modal-info"><?=$titles?></button>
<div class="content-edit" id="edited-lesson">
  <div class="content-editor">
    <div class="content-left">
      <nav class="ctrl">
        <button class="btn btn-outline-success px-4" id="btn-update"><i class="fa fa-lg fa-fw fa-save"></i></button>
        <button class="btn btn-outline-info" onclick="editorAdm()"><i class="fa fa-lg fa-fw fa-hourglass-half fa-spin"></i></button>
        <a class="btn btn-primary" href="<?=base_url('a/less/'.$label)?>"><i class="fas fa-lg fa-fw fa-reply"></i></a>
        <a class="btn btn-primary" title="<?=$slugPrev?>" href="<?=$linkPrev?>"><i class="fa fa-lg fa-fw fa-arrow-left"></i></a>
        <a class="btn btn-primary" title="<?=$slugNext?>" href="<?=$linkNext?>"><i class="fa fa-lg fa-fw fa-arrow-right"></i></a>
        <a class="btn btn-outline-dark" target="_blank" href="<?=$link?>"><i class="fas fa-lg fa-fw fa-location-arrow"></i></a>
        
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
  <div class="modal-dialog modal-lg">
    <div class="modal-content bg-light">
      <div class="modal-body">
        <div class="d-flex">
          <input type="text" id="input-id" value="<?=$id?>" disabled>
          <input type="text" id="input-title" class="form-control" value="<?=$titles?>">
          <input type="text" id="input-slug" class="form-control" value="<?=$slug?>">
        </div>
        <hr>
        <div class="accordion" id="main-accord">
          <div class="card">
            <div class="card-header p-2">
              <div class="btn-group btn-block">
                <button class="btn btn-outline-dark" data-toggle="collapse" data-target="#main-accord-snippet" aria-expanded="true">Snippet</button>
                <button class="btn btn-outline-dark" id="snip-length"><?=$snips?></button>
                <button class="btn btn-outline-dark" data-toggle="collapse" data-target="#main-accord-add">ADD Snippet</button>
              </div>
            </div>
            <div id="main-accord-add" class="collapse p-2" data-parent="#main-accord">
              <form class="border bg-light p-2">
                <ul class="nav nav-tabs nav-fill">
                  <button type="button" class="btn btn-outline-success mx-1"><i class="fa fa-fw fa-plus"></i></button>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#add-h">HTM</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab-c">CSS</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#tab-j">JSC</a>
                  </li>
                  <li class="nav-item">
                    <input type="hidden" name="rel" value="<?=$id?>">
                    <input type="text" name="title" placeholder="title" class="form-control">
                  </li>
                </ul>

                <div class="tab-content">
                  <div class="tab-pane p-2 active" id="add-h">
                    <textarea name="htm" rows="8"></textarea>
                  </div>
                  <div class="tab-pane p-2 fade" id="tab-c">
                    <textarea name="css" rows="8"></textarea>
                  </div>
                  <div class="tab-pane p-2 fade" id="tab-j">
                    <textarea name="jsc" rows="8"></textarea>
                  </div>
                </div>
              </form>
            </div>
            <div id="main-accord-snippet" class="collapse p-2 show" data-parent="#main-accord">

              <div class="accordion" id="sub-accord">
              <?php foreach ($snippet as $k => $v) { ?>
              <?php $href = base_url('tryit/file/').create_slug($v['title']); ?>
                <form>
                  <button type="button" class="btn btn-block btn-default my-2" data-toggle="collapse" data-target="#acc-<?=$v['id']?>" aria-expanded="false"><?=$v['title']?></button>
                  <div id="acc-<?=$v['id']?>" data-id="<?=$v['id']?>" class="collapse p-2" data-parent="#sub-accord">
                    <ul class="nav nav-tabs nav-fill">
                      <input type="hidden"  name="rels" value="<?=$id?>">
                      <button type="button" class="btn btn-outline-success mr-1"><i class="fa fa-fw fa-save"></i></button>
                      <button type="button" data-href="<?=$href?>" class="btn btn-outline-dark mr-1"><i class="fa fa-fw fa-link"></i></button>
                      <a href="<?=$href?>" target="_blank" class="btn btn-outline-info mr-1"><i class="fa fa-fw fa-location-arrow"></i></a>
                      <button type="button" class="btn btn-outline-danger mx-1"><i class="fa fa-fw fa-trash-alt"></i></button>
                      <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tab-h-<?=$v['id']?>">HTM</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tab-c-<?=$v['id']?>">CSS</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#tab-j-<?=$v['id']?>">JSC</a>
                      </li>
                      <li class="nav-item">
                        <input type="hidden" name="id" value="<?=$v['id']?>">
                        <input type="text" name="title" class="form-control" value="<?=$v['title']?>">
                      </li>
                    </ul>

                    <div class="tab-content">
                      <div class="tab-pane p-2 fade" id="tab-h-<?=$v['id']?>">
                        <textarea name="htm" rows="8"><?=$v['htm']?></textarea>
                      </div>
                      <div class="tab-pane p-2 fade" id="tab-c-<?=$v['id']?>">
                        <textarea name="css" rows="8"><?=$v['css']?></textarea>
                      </div>
                      <div class="tab-pane p-2 active" id="tab-j-<?=$v['id']?>">
                        <textarea name="jsc" rows="8"><?=$v['jsc']?></textarea>
                      </div>
                    </div>
                  </div>
                </form>
              <?php } ?>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header p-2">
              <button class="btn btn-block btn-outline-dark" data-toggle="collapse" data-target="#main-accord-subkeys" aria-expanded="false">Sub Keys</button>
            </div>
            <div id="main-accord-subkeys" class="collapse p-2" data-parent="#main-accord">
              <div class="card-deck">
                <div class="card card-body">
                  <ol class="" id="sub-h3">
                  <?php
                  if ($content != '') {
                    $k3 = getTags($content,'h3');
                    foreach ($k3 as $k) { ?>
                    <li><?=$k?></li>
                    <?php } ?>
                  <?php } ?>
                  </ol>
                </div>
                <div class="card card-body">
                  <ol class="" id="sub-h4">
                  <?php
                  if ($content != '') {
                    $k4 = getTags($content,'h4');
                    if (!empty($k4)) :
                      foreach ($k4 as $k) : ?>
                      <li><?=$k?></li>
                      <?php endforeach;
                    endif;
                    } ?>
                  </ol>
                </div>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header p-2">
              <div class="btn-group btn-block">
                <button class="btn btn-outline-dark" data-toggle="collapse" data-target="#quiz-accord" aria-expanded="false">Quiz</button>
                <button class="btn btn-outline-dark">1</button>
                <button class="btn btn-outline-dark" data-toggle="collapse" data-target="#quiz-accord-add">ADD Quiz</button>
              </div>
            </div>
            <div id="quiz-accord-add" class="collapse p-2" data-parent="#main-accord">

            </div>
            <div id="quiz-accord" class="collapse p-2" data-parent="#main-accord">

            </div>
          </div>


        </div>
      </div>
    </div>
  </div>
</div>

