<style>
	.content-index .panel-trigger {
		display: block;
    background: #ccc;
    padding: 10px;
    font-size: 1.5em;
    font-family: 'Fredoka One', cursive;
	}
	.content-index a[aria-expanded="true"] {
		pointer-events: none;
	}
</style>
<div class="content-wrapper">
	<section class="content content-index">
		<div class="box">
			<div class="box-body">
				<div class="box-group" id="accordion">
					<div class="panel box box-primary">
						<a class="panel-trigger" data-toggle="collapse" data-parent="#accordion" href="#one" aria-expanded="false">
							Tutorials Report
						</a>
						<div id="one" class="panel-collapse collapse">
							<div class="box-body">
								<div class="row">
									<div class="col-lg-4 col-xs-6">
										<div class="small-box theme-html">
											<div class="inner">
												<h4>Tutorials HTML</h4>
												<p><span>Total</span> <b class="pull-right"><?= $html['total'] ?></b></p>
												<p><span>Public</span> <b class="pull-right"><?= $html['public'] ?></b></p>
												<p><span>Draft</span> <b class="pull-right"><?= $html['draft'] ?></b></p>
												<hr>
												<div class="progress sm">
													<div id="progress-html"></div>
												</div>
												<?php
												for ($i=0; $i < count($level_html) ; $i++) { 
													echo "<p>".$level_html[$i]['level_name']."<b class='pull-right'>".$level_html[$i]['counter']."</b></p>";
												}
												?>
											</div>
											<div class="icon">
												<i class="ion ion-bag"></i>
											</div>
											<a href="<?= base_url('a/html') ?>" id="html" class="small-box-footer">More <i class="fa fa-arrow-circle-right"></i></a>
										</div>
									</div>
									<div class="col-lg-4 col-xs-6">
										<div class="small-box theme-css">
											<div class="inner">
												<h4>Tutorials CSS</h4>
												<p><span>Total</span> <b class="pull-right"><?= $css['total'] ?></b></p>
												<p><span>Public</span> <b class="pull-right"><?= $css['public'] ?></b></p>
												<p><span>Draft</span> <b class="pull-right"><?= $css['draft'] ?></b></p>
												<hr>
												<div class="progress sm">
													<div id="progress-css"></div>
												</div>												
												<?php
												for ($i=0; $i < count($level_css) ; $i++) { 
													echo "<p>".$level_css[$i]['level_name']."<b class='pull-right'>".$level_css[$i]['counter']."</b></p>";
												}
												?>
											</div>
											<div class="icon">
												<i class="ion ion-stats-bars"></i>
											</div>
											<a href="<?= base_url('a/css') ?>" id="css" class="small-box-footer">More <i class="fa fa-arrow-circle-right"></i></a>
										</div>
									</div>
									<div class="col-lg-4 col-xs-6">
										<div class="small-box theme-js">
											<div class="inner">
												<h4>Tutorials JavaScript</h4>
												<p><span>Total</span> <b class="pull-right"><?= $js['total'] ?></b></p>
												<p><span>Public</span> <b class="pull-right"><?= $js['public'] ?></b></p>
												<p><span>Draft</span> <b class="pull-right"><?= $js['draft'] ?></b></p>
												<hr>
												<div class="progress sm">
													<div id="progress-js"></div>
												</div>
												<?php
												for ($i=0; $i < count($level_js) ; $i++) { 
													echo "<p>".$level_js[$i]['level_name']."<b class='pull-right'>".$level_js[$i]['counter']."</b></p>";
												}
												?>
											</div>
											<div class="icon">
												<i class="ion ion-person-add"></i>
											</div>
											<a href="<?= base_url('a/javascript') ?>" id="js" class="small-box-footer">More <i class="fa fa-arrow-circle-right"></i></a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="panel box box-primary">
						<a class="panel-trigger" data-toggle="collapse" data-parent="#accordion" href="#two">
							Members Report
						</a>
						<div id="two" class="panel-collapse collapse">
							<div class="box-body">
								Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3
								wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
								eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
								assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
								nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
								farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus
								labore sustainable VHS.
							</div>
						</div>
					</div>
					<div class="panel box box-primary">
						<a class="panel-trigger" data-toggle="collapse" data-parent="#accordion" href="#three">
							Snippets Report
						</a>
						<div id="three" class="panel-collapse collapse">
							<div class="box-body">
								Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3
								wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
								eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
								assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
								nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
								farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus
								labore sustainable VHS.
							</div>
						</div>
					</div>
					<div class="panel box box-primary">
						<a class="panel-trigger" data-toggle="collapse" data-parent="#accordion" href="#four">
							Bugs Report
						</a>
						<div id="four" class="panel-collapse collapse">
							<div class="box-body">
								Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3
								wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
								eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
								assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
								nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
								farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus
								labore sustainable VHS.
							</div>
						</div>
					</div>
					<div class="panel box box-primary">
						<a class="panel-trigger" data-toggle="collapse" data-parent="#accordion" href="#five">
							CDN Report
						</a>
						<div id="five" class="panel-collapse collapse">
							<div class="box-body">
								Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3
								wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
								eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
								assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
								nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
								farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus
								labore sustainable VHS.
							</div>
						</div>
					</div>					
				</div>
			</div>
		</div>
	</section>
</div>
<script>
	$(function() {
		$( "#progress-html" ).progressbar({
			classes: { "ui-progressbar-value": "html-pro" },
			value: <?= $html['public'] ?>,
			max: <?= $html['total'] ?>
		});
		$( "#progress-css" ).progressbar({
			classes: { "ui-progressbar-value": "css-pro" },
			value: <?= $css['public'] ?>,
			max: <?= $css['total'] ?>
		});
		$( "#progress-js" ).progressbar({
			classes: { "ui-progressbar-value": "js-pro" },
			value: <?= $js['public'] ?>,
			max: <?= $js['total'] ?>
		});	
	});	
</script>
