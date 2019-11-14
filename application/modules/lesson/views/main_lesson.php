<aside class="menu out">
<?php _menus($lesson); ?>
</aside>
<a class="btn-desc-left">
	<i class="fa fa-angle-double-right"></i>
</a>
<div class="overlay"></div>
<div id="jkoverlay"></div>

<main>
	<div id="jkcodecontainer">
	<?php _toolEditor(); ?>
	<?php _codeEditor($lesson); ?>
	<!-- $code,$tmLight,$tmDark,$category,$title,$logo,$meta -->
	</div>
	<section class="box-desc hide">
		<a class="open-menu btn btn-def"><i class="fa fa-bars"></i></a>
		<a class="open-col btn btn-def visible-sm visible-xs"><i class="fa fa-angle-double-right"></i></a>
		<a class="btn-desc-right btn btn-def"><i class="fa fa-times"></i></a>
		<h1 class="main-title sh"><?= $lesson['titles']; ?></h1>
		<?php 
			if (startSession('sess_role') && getSession('sess_role') == 1) :
				echo '<a href="' . base_url('a/tutorial/') . strtolower($lesson['category']) . '/' . $lesson['order'] .'" target="_blank" class="btn btn-def btn-edit" ><i class="fa fa-cog"></i></a>';
			endif;
		?>		
	<?php _mainContent($lesson); ?>
	<!-- $id,$order,$title,$titles,$level,$category,$content,$update,$next,$btn -->
	</section>
</main>