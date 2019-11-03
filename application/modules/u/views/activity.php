<style>
	.tab-pane a.base-link {
		/*display: block;*/
	}	
	.nav-tabs-custom {
		margin-bottom: 0;
	}
	.nav-tabs-custom > .tab-content {
		height: 71vh;
	}
	.tab-content>.tab-pane {
    height: 69vh;
    overflow-y: auto;
	}	
	.tab-pane h4 { padding-left: 10px; }
</style>

<div class="content-wrapper">
	<section class="content content-activity">
		<?php temp_profile() ?>
		<div class="box box-sh">
			<div class="box-header">
				<h3 class="box-title fred text-muted">Progres belajarmu di Hello World</h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
				</div>
			</div>
			<div class="box-body">
				<div class="row">
					
					<div class="body-progress">
						<div id="modal-progress" class="custom-modal hide box-sh">
							<div class="inner-modal">
								<div><button class="btn btn-diss" id="diss-progress"><i class="fa fa-times"></i></button></div>
								<div class="target-request"></div>
							</div>
						</div>
							<div class="col-lg-4 col-md-6 col-sm-6 col-xs-6">
								<div class="small-box theme-html">
									<div class="inner">
										<h4 class="fred">Materi HTML</h4>
										<h3><?= $html_pro ?> %</h3>
										<div class="progress-group">
											<span class="progress-text">
												<b><?= $html_count ?></b> dari <b><?= $html_all ?></b> tutorial
											</span>

											<div class="progress sm">
												<div id="progress-html"></div>
											</div>
										</div>
									</div>
									<div class="icon">
										<i class="fab fa-html5"></i>
									</div>
									<a id="html-request" data-id='1' data-name="HTML" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
								</div>
							</div>
							<div class="col-lg-4 col-md-6 col-sm-6 col-xs-6">
								<div class="small-box theme-css">
									<div class="inner">
										<h4 class="fred">Materi CSS</h4>
										<h3><?= $css_pro ?> %</h3>
										<div class="progress-group">
											<span class="progress-text">
												<b><?= $css_count ?></b> dari <b><?= $css_all ?></b> tutorial
											</span>

											<div class="progress sm">
												<div id="progress-css"></div>
											</div>
										</div>
									</div>
									<div class="icon">
										<i class="fab fa-css3-alt"></i>
									</div>
									<a id="css-request" data-id='2' data-name="CSS" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
								</div>
							</div>
							<div class="col-lg-4 col-md-6 col-sm-6 col-xs-6">
								<div class="small-box theme-js">
									<div class="inner">
										<h4 class="center fred">Materi JavaScript</h4>
										<h3><?= $js_pro ?> %</h3>
										<div class="progress-group">
											<span class="progress-text">
												<b><?= $js_count ?></b> dari <b><?= $js_all ?></b> tutorial
											</span>

											<div class="progress sm">
												<div id="progress-js"></div>
											</div>
										</div>
									</div>
									<div class="icon">
										<i class="fab fa-js-square"></i>
									</div>
									<a id="js-request" data-id='3' data-name="JavaScript" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
								</div>
							</div>
					</div>
				</div>
			</div>
		</div>

		<div class="box box-sh">
			<div class="box-header">
				<h3 class="box-title fred text-muted">Aktifitasmu di Hello World</h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
					</button>
				</div>
			</div>
			<div class="box-body">
				<ul class="timeline timeline-inverse">
					<li class="time-label">
								<span class="bg-red">
									10 Feb. 2014
								</span>
					</li>
					<li>
						<i class="fa fa-envelope bg-blue"></i>

						<div class="timeline-item">
							<span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

							<h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

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
					<li>
						<i class="fa fa-user bg-aqua"></i>

						<div class="timeline-item">
							<span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>

							<h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request
							</h3>
						</div>
					</li>
					<li>
						<i class="fa fa-comments bg-yellow"></i>

						<div class="timeline-item">
							<span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>

							<h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

							<div class="timeline-body">
								Take me to your leader!
								Switzerland is small and neutral!
								We are more like Germany, ambitious and misunderstood!
							</div>
							<div class="timeline-footer">
								<a class="btn btn-warning btn-flat btn-xs">View comment</a>
							</div>
						</div>
					</li>
					<li class="time-label">
								<span class="bg-green">
									3 Jan. 2014
								</span>
					</li>
					<li>
						<i class="fa fa-camera bg-purple"></i>

						<div class="timeline-item">
							<span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>

							<h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

							<div class="timeline-body">
								<img src="" alt="..." class="margin">
								<img src="" alt="..." class="margin">
								<img src="" alt="..." class="margin">
								<img src="" alt="..." class="margin">
							</div>
						</div>
					</li>
					<li>
						<i class="fa fa-clock-o bg-gray"></i>
					</li>
				</ul>
			</div>
		</div>
	</section>
</div>
<script>
	$(function() {
		$( "#progress-html" ).progressbar({
			classes: { "ui-progressbar-value": "html-pro" },
			value: <?= $html_count ?>,
			max: <?= $html_all ?>
		});
		$( "#progress-css" ).progressbar({
			classes: { "ui-progressbar-value": "css-pro" },
			value: <?= $css_count ?>,
			max: <?= $css_all ?>
		});
		$( "#progress-js" ).progressbar({
			classes: { "ui-progressbar-value": "js-pro" },
			value: <?= $js_count ?>,
			max: <?= $js_all ?>
		});	
	});	
</script>