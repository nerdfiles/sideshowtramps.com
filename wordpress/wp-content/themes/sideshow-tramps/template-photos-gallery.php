<?php
/**
 * Template Name: Custom Template - Photos Gallery
 *
 * @package Hybrid
 * @subpackage Template
 */

get_header(); ?>

	<div class="hfeed content">

		<?php hybrid_before_content(); // Before content hook ?>
		
		<div class="photos-gallery-nav clear-hack">
		
			<ul>
				<li class="medicine-show"><a href="/extras/photos/medicine-show/">Medicine Show</a></li>
				<li class="live-at-antones"><a href="/extras/photos/live-at-antones">Live @ Antone's</a></li>
				<li class="houston-press-awards-09"><a href="/extras/photos/houston-press-awards-09/">Houston Press Awards '09</a></li>
				<li class="the-revelator-project"><a href="/extras/photos/the-revelator-project/">The Revelator Project</a></li>
			</ul>
			<ul>
				<li class="ragtag-mac"><a href="/extras/photos/ragtag-mac/">Ragtag Mac</a></li>
				<li class="the-reverend"><a href="/extras/photos/the-reverend/">The Reverend</a></li>
				<li class="coach-l-c-dupree"><a href="/extras/photos/coach-l-c-dupree/">Coach L.C. Dupree</a></li>
				<li class="uncle-tic"><a href="/extras/photos/uncle-tic/">Uncle Tic</a></li>
				<li class="wallpapers"><a href="/extras/photos/wallpapers/">Wallpapers</a></li>
			</ul>
			
		</div>
		
		<style type="text/css">
		.photos-gallery-nav { 
			width: 792px; 
			margin: 0 auto; 
			position: relative; }
		.photos-gallery-nav ul { 
			width: 396px; 
			float: left; }
		.photos-gallery-nav li { margin: 0 0 10px 0; }
		.photos-gallery-nav li a {
			background: url(/wordpress/wp-content/themes/sideshow-tramps/images/photos-nav-sprite.png) 30px 7px no-repeat;
			text-indent: -9999px;
			display: block;
			height: 50px;
			width: 396px; }
		.photos-gallery-nav li.live-at-antones a { background-position: 30px -50px; }
		.photos-gallery-nav li.houston-press-awards-09 a { background-position: 30px -100px; height: 80px; }
		.photos-gallery-nav li.the-revelator-project a { background-position: 30px -190px; height: 85px; }
		.photos-gallery-nav li.ragtag-mac a { background-position: -540px 7px; height: 53px; }
		.photos-gallery-nav li.the-reverend a { background-position: -500px -50px; }
		.photos-gallery-nav li.coach-l-c-dupree a { background-position: -420px -100px; height: 60px; }
		.photos-gallery-nav li.uncle-tic a { background-position: -585px -150px; }
		.photos-gallery-nav li.wallpapers a { background-position: -520px -200px; }
		</style>

		<?php hybrid_after_content(); // After content hook ?>

	</div><!-- .content .hfeed -->

<?php get_footer(); ?>