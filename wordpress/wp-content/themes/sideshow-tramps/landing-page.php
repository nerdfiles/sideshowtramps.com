<?php
/**
 * Template Name: Landing Page
 *
 * This will list your categories and monthly archives by default.
 * @link http://themehybrid.com/themes/hybrid/page-templates/archives
 *
 * Alternately, you can activate an archives plugin.
 * @link http://justinblanton.com/projects/smartarchives
 * @link http://wordpress.org/extend/plugins/clean-archives-reloaded
 * @link http://www.geekwithlaptop.com/projects/clean-archives
 *
 * @deprecated 0.7 In order to make the theme's template hierarchy more organized, this template
 * will be renamed to page-archives.php in version 0.8.
 *
 * @package Hybrid
 * @subpackage Template
 */

get_header(); ?>

	<div class="hfeed content">

		<?php hybrid_before_content(); // Before content hook ?>
		
		<div class="news-updates-container">
			<div class="underlay"></div>
			<div class="content">
				<h3>Tramp News</h3>
				<dl>
				<?php $my_query = new WP_Query('tag=tramp-news&posts_per_page=10'); ?>
				<?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
					<dt><?php the_date('F d'); ?></dt>
					<dd><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></dd>
				<?php endwhile; ?>
				</dl>
			</div>
		</div>
		
		<div class="tv-overlay">
			<object 
				classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" 
				codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=10,0,0,0" 
				width="207" 
				height="320" 
				id="video" 
				align="middle">
				<param name="allowScriptAccess" value="sameDomain" />
				<param name="allowFullScreen" value="false" />
				<param name="wmode" value="transparent" /> 
				<param name="movie" value="/wordpress/wp-content/themes/sideshow-tramps/flash/video.swf" />
				<param name="quality" value="high" />
				<param name="loop" value="false" />
				<embed 
					src="/wordpress/wp-content/themes/sideshow-tramps/flash/video.swf" 
					quality="high" 
					width="207" 
					height="320" 
					name="video" 
					align="middle" 
					allowScriptAccess="sameDomain" 
					allowFullScreen="false" 
					type="application/x-shockwave-flash" 
					pluginspage="http://www.adobe.com/go/getflashplayer"
					play="true" 
					loop="false" 
					wmode="transparent" />
			</object>

		</div>

		<?php hybrid_after_content(); // After content hook ?>

	</div><!-- .content .hfeed -->

<?php get_footer(); ?>