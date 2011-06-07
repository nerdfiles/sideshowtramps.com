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
		
		<?php hybrid_after_content(); // After content hook ?>

	</div><!-- .content .hfeed -->

<?php get_footer(); ?>