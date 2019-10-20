<aside class="menu out">
<?php _menus($menu,$level,$category); ?>
</aside>
<a class="btn-desc-left">
	<i class="fa fa-angle-double-right"></i>
</a>
<div class="overlay"></div>
<div id="jkoverlay"></div>

<main>
	<div id="jkcodecontainer">
	<?php _toolEditor(); ?>
	<?php _codeEditor($code,$tmLight,$tmDark,$category,$title,$logo,$meta); ?>
	</div>
	<section class="box-desc hide">
		<a class="btn-desc-right">
			<i class="fa fa-angle-double-left"></i>
		</a>
	<?php _mainContent($id,$order,$title,$titles,$level,$category,$content,$update,$next,$btn); ?>
	</section>
</main>