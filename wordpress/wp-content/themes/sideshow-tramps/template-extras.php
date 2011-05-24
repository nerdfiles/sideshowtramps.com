<?php
/**
 * Template Name: Custom Template - Extras Page
 *
 * @package Hybrid
 * @subpackage Template
 */

get_header(); ?>

	<div class="hfeed content">

		<?php hybrid_before_content(); // Before content hook ?>
		
		<div class="extras-block row row-1 clear-hack">
			<div class="column column-1 sideshow-news">
				<div class="cell-content">
					<a href="/extras/sideshow-news/">Sideshow News</a>
				</div>
			</div>
			<div class="column column-2 sideshow-recipes-gallery">
				<div class="cell-content">
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<div id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">
	
							<?php hybrid_before_entry(); // Before entry hook ?>
			
							<div class="entry-content">
								<?php the_content(); ?>
								<?php wp_link_pages( array( 'before' => '<p class="pages">' . __( 'Pages:', 'hybrid' ), 'after' => '</p>' ) ); ?>
							</div><!-- .entry-content -->
			
							<?php hybrid_after_entry(); // After entry hook ?>
			
						</div><!-- .hentry -->
						
					<?php endwhile; endif; ?>
				</div>
			</div>
		</div>
		
		<div class="extras-block row row-2 clear-hack">
			<div class="column column-1 tramps-logic">
				<div class="cell-content">
					<a href="/extras/tramps-logic/">Tramps Logic</a>
				</div>
			</div>
			<div class="column column-2 wallpapers-and-pics">
				<div class="cell-content">
					<a href="/extras/photos/wallpapers/">Wallpapers &amp; Pics</a>
				</div>
			</div>
		</div>
		
		<style>
		body.extras { }
		body.extras .row { clear: both; }
		body.extras .column { float: left; }
		body.extras .cell-content { }
		body.extras .row-1 .column { width: 280px; margin: 0 10px 0 0; height: 410px; }
		body.extras .row-2 .column { }
		body.extras .row-1 .column-1 { }
		body.extras .row-1 .column-1 .cell-content { width: 100%; height: 100%; }
		body.extras .row-1 .column-2 { width: 430px; }
		body.extras .row-1 .column-2 .cell-content { }
		body.extras .row-2 .column-1 { width: 280px; margin: 0 10px 0 0; height: 220px; }
		body.extras .row-2 .column-1 .cell-content { width: 100%; height: 100%; }
		body.extras .row-2 .column-2 { width: 470px; height: 220px; }
		body.extras .row-2 .column-2 .cell-content { width: 100%; height: 100%; }
		body.extras .row-1 { }
		body.extras .row-2 { }
		body.extras .row .column-1 { }
		body.extras .row .column-2 { }
		body.extras .sideshow-news a {
			display: block;
			height: 100%;
			width: 100%;
			text-indent: -9999px;
			*zoom: 1;
			background: url(<?php echo get_stylesheet_directory_uri(); ?>/images/sideshow-news.png) no-repeat; }

		body.extras .sideshow-recipes-gallery {
			background: url(<?php echo get_stylesheet_directory_uri(); ?>/images/recipe-bg.png) -50px 0 no-repeat; }
		
		body.extras .sideshow-recipes-gallery .cell-content { color: #000; padding: 20px 40px 0 40px; }
			
		body.extras .tramps-logic a {
			display: block;
			height: 100%;
			width: 100%;
			text-indent: -9999px;
			*zoom: 1;
			background: url(<?php echo get_stylesheet_directory_uri(); ?>/images/tramps-logic.png) -30px 0 no-repeat; }
			
		body.extras .wallpapers-and-pics a { 
			display: block;
			height: 100%;
			width: 100%;
			text-indent: -9999px;
			*zoom: 1;
			background: url(<?php echo get_stylesheet_directory_uri(); ?>/images/wallpapers-and-pics.png) -20px 0 no-repeat; }
		
		</style>

		<?php hybrid_after_content(); // After content hook ?>

	</div><!-- .content .hfeed -->

<?php get_footer(); ?>