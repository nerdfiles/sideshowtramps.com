<?php
/**
 * Template Name: Custom Template - Text Left
 *
 * @package Hybrid
 * @subpackage Template
 */

get_header(); ?>

	<div class="hfeed content">

		<?php hybrid_before_content(); // Before content hook ?>

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<div id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">

				<?php hybrid_before_entry(); // Before entry hook ?>

				<div class="entry-content">

					<?php the_content(); ?>
					
					<?php wp_link_pages( array( 'before' => '<p class="pages">' . __( 'Pages:', 'hybrid' ), 'after' => '</p>' ) ); ?>

				</div><!-- .entry-content -->

				<?php hybrid_after_entry(); // After entry hook ?>

			</div><!-- .hentry -->

			<?php hybrid_after_singular(); // After singular hook ?>

			<?php
			$allowComments = get_post_custom_values('Enable comments?'); 
			if ( $allowComments[0] == "yes" ) : 
			?>
			<?php comments_template( '', true ); ?>
			<?php endif; ?>

			<?php endwhile; ?>

		<?php else: ?>

			<p class="no-data">
				<?php _e( 'Sorry, no page matched your criteria.', 'hybrid' ); ?>
			</p><!-- .no-data -->

		<?php endif; ?>

		<?php hybrid_after_content(); // After content hook ?>

	</div><!-- .content .hfeed -->

<?php get_footer(); ?>