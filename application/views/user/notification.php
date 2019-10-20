

<div class="content-wrapper">
	<section class="content content-activity">
		<?php temp_profile() ?>
		<div class="box box-sh">
			<div class="box-header">
				<h3 class="box-title fred text-muted">Pemberitahuan</h3>
			</div>
			<div class="box-body">
					
			<?php foreach ($arr as $key => $value): ?>
      <div class="row">
        <div class="col-md-12">
          <ul class="timeline">
            <li class="time-label">
              <span class="bg-red"><?php echo $key ?></span>
            </li>
            
        <?php foreach ($value as $k => $val): ?>
					<?php 
						if ($val['type'] == 1) {
							$icon = 'fa-exclamation-triangle bg-red';
							$header = 'pemberitahuan system';
							$time = time_elapsed_string('@'.$val['created']);
						} elseif ($val['type'] == 2) {
							$icon = 'fa-comment-alt bg-blue';
							$header = '<a href="#">'.$val['commentator'].'</a> mengomentari snippet kamu';
							$time = time_elapsed_string('@'.$val['created']);							
						} else {
							$icon = 'fa-thumbs-up bg-green';
							$header = '<a href="#">'.$val['liker'].'</a> menyukai snippet kamu';
							$time = time_elapsed_string('@'.$val['created']);
						}

					?>
            <!-- timeline item -->
            <li>
              <i class="fa <?=$icon?>"></i>

              <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> <?=$time?></span>

                <h3 class="timeline-header"><?=$header?></h3>

                <div class="timeline-body">
                  Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                  weebly ning heekya handango imeem plugg dopplr jibjab, movity
                  jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                  quora plaxo ideeli hulu weebly balihoo...
                </div>
                <div class="timeline-footer">
                  <a class="btn btn-primary btn-xs">Read more</a>
                  <a class="btn btn-danger btn-xs">Delete</a>
                </div>
              </div>
            </li>
            <!-- END timeline item -->
				<?php endforeach ?>

<?php endforeach ?>

            <li>
              <i class="fa fa-clock-o bg-gray"></i>
            </li>
          </ul>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

			</div>
		</div>
	</section>
</div>