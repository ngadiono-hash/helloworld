
<div class="content-wrapper">
	<section class="content content-activity">
		<?php temp_profile() ?>
		<div class="box box-sh">
			<div class="box-header">
				<h3 class="box-title fred text-muted"><a href="#">Tandai semua telah dibaca</a></h3>
			</div>
			<div class="box-body">
        <ul class="timeline">
          <?php foreach ($arr as $key => $value): ?>
            <li class="time-label">
              <span class="bg-red"><?php echo $key ?></span>
            </li>

            <?php foreach ($value as $k => $val): ?>
             <?php 
             if ($val['type'] == 1) {
               $icon = 'fa-exclamation-triangle bg-red';
               $header = '<h4>pemberitahuan system</h4>';
               $time = time_elapsed_string('@'.$val['created']);
               $body = '';
               $reff = '';
             } elseif ($val['type'] == 2) {
               $icon = 'fa-comment-alt bg-blue';
               $header = '<a class="base-link" href="#">'.$val['commentator'].'</a> mengomentari snippet kamu';
               $time = time_elapsed_string('@'.$val['created']);
               $body = '<h4 class="fred">'.$val['post'].'</h4>';
               $body .= '<h4>'.readMore($val['message'],100).'...</h4>';
               $reff = base_url('snippet/s/').$val['id'].'#'.$val['created'];
               $reff = '<a class="btn btn-primary btn-xs" href="'.$reff.'">Selengkapnya</a>';
             } else {
               $icon = 'fa-thumbs-up bg-green';
               $header = '<a class="base-link" href="#">'.$val['liker'].'</a> menyukai snippet kamu';
               $time = time_elapsed_string('@'.$val['created']);
               $body = '';
               $reff = base_url('snippet/s/').$val['id'];
               $reff = '<a class="btn btn-primary btn-xs" href="'.$reff.'">Lihat</a>';
             }
             $timing = ($val['status'] == 1) ? '<span class="badge">baru</span> '.$time : $time;

             ?>
             <li>
              <i class="fa <?=$icon?>"></i>
              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> <?=$timing?></span>
                <h3 class="timeline-header fred"><?=$header?></h3>
                <div class="timeline-body"><?=$body?></div>
                <div class="timeline-footer"><?=$reff?></div>
              </div>
            </li>
            <?php endforeach ?>
          <?php endforeach ?>
        </ul>
      </div>
    </div>
  </section>
</div>