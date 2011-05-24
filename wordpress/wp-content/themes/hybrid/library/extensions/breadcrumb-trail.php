<?php
/**
 * A script for showing a breadcrumb trail for any type of page.  It tries to anticipate any
 * type of structure and display the best possible trail that matches your site's permalinks.
 * While not perfect, it attempts to fill in the gaps left by many other breadcrumb scripts.
 *
 * @copyright 2008 - 2010
 * @version 0.3
 * @author Justin Tadlock
 * @link http://justintadlock.com/archives/2009/04/05/breadcrumb-trail-wordpress-plugin
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @package BreadcrumbTrail
 */

/**
 * Shows a breadcrumb for all types of pages.  Themes and plugins can filter $args or 
 * input directly.  Allow filtering of only the $args using get_the_breadcrumb_args.
 *
 * @since 0.1
 * @param array $args Mixed arguments for the menu.
 * @return string Output of the breadcrumb menu.
 */
function breadcrumb_trail( $args = array() ) {
	global $wp_query, $wp_rewrite;

	/* Get the textdomain. */
	$textdomain = hybrid_get_textdomain();

	/* Create an empty array for the trail. */
	$trail = array();

	/* Set up the default arguments for the breadcrumb. */
	$defaults = array(
		'separator' => '/',
		'before' => '<span class="breadcrumb-title">' . __( 'Browse:', $textdomain ) . '</span>',
		'after' => false,
		'front_page' => true,
		'show_home' => __( 'Home', $textdomain ),
		'single_tax' => false, // @deprecated 0.3 Use singular_{$post_type}_taxonomy.
		'echo' => true
	);

	/* Allow singular post views to have a taxonomy's terms prefixing the trail. */
	if ( is_singular() )
		$defaults["singular_{$wp_query->post->post_type}_taxonomy"] = false;

	/* Apply filters to the arguments. */
	$args = apply_filters( 'breadcrumb_trail_args', $args );

	/* Parse the arguments and extract them for easy variable naming. */
	extract( wp_parse_args( $args, $defaults ) );

	/* For backwards compatibility, set $single_tax if it's explicitly given. */
	if ( $single_tax )
		$args['singular_post_taxonomy'] = $single_tax;

	/* Format the separator. */
	if ( $separator )
		$separator = '<span class="sep">' . $separator . '</span>';

	/* If $show_home is set and we're not on the front page of the site, link to the home page. */
	if ( !is_front_page() && $show_home )
		$trail[] = '<a href="' . home_url() . '" title="' . get_bloginfo( 'name' ) . '" rel="home" class="trail-begin">' . $show_home . '</a>';

	/* If viewing the front page of the site. */
	if ( is_front_page() ) {
		if ( !$front_page )
			$trail = false;
		elseif ( $show_home )
			$trail['trail_end'] = "{$show_home}";
	}

	/* If viewing the "home"/posts page. */
	elseif ( is_home() ) {
		$home_page = get_page( $wp_query->get_queried_object_id() );
		$trail = array_merge( $trail, breadcrumb_trail_get_parents( $home_page->post_parent, '' ) );
		$trail['trail_end'] = get_the_title( $home_page->ID );
	}

	/* If viewing a singular post (page, attachment, etc.). */
	elseif ( is_singular() ) {

		/* Get singular post variables needed. */
		$post_id = absint( $wp_query->post->ID );
		$post_type = $wp_query->post->post_type;
		$parent = $wp_query->post->post_parent;

		/* If a custom post type, check if there are any pages in its hierarchy based on the slug. */
		if ( 'page' !== $post_type ) {

			$post_type_object = get_post_type_object( $post_type );

			/* If $front has been set, add it to the $path. */
			if ( 'post' == $post_type || 'attachment' == $post_type || ( $post_type_object->rewrite['with_front'] && $wp_rewrite->front ) )
				$path = trailingslashit( $wp_rewrite->front );

			/* If there's a slug, add it to the $path. */
			if ( !empty( $post_type_object->rewrite['slug'] ) )
				$path .= $post_type_object->rewrite['slug'];

			/* If there's a path, check for parents. */
			if ( !empty( $path ) )
				$trail = array_merge( $trail, breadcrumb_trail_get_parents( '', $path ) );
		}

		/* If the post type is hierarchical or is an attachment, get its parents. */
		if ( is_post_type_hierarchical( $post_type ) || is_attachment() )
			$trail = array_merge( $trail, breadcrumb_trail_get_parents( $parent, '' ) );

		/* Display terms for specific post type taxonomy if requested. */
		if ( $args["singular_{$post_type}_taxonomy"] && $terms = get_the_term_list( $post_id, $args["singular_{$post_type}_taxonomy"], '', ', ', '' ) )
			$trail[] = $terms;

		/* End with the post title. */
		$trail['trail_end'] = get_the_title();
	}

	/* If we're viewing any type of archive. */
	elseif ( is_archive() ) {

		/* If viewing a taxonomy term archive. */
		if ( is_tax() || is_category() || is_tag() ) {

			/* Get some taxonomy and term variables. */
			$term = $wp_query->get_queried_object();
			$taxonomy = get_taxonomy( $term->taxonomy );

			/* Get the path to the term archive. Use this to determine if a page is present with it. */
			if ( is_category() )
				$path = get_option( 'category_base' );
			elseif ( is_tag() )
				$path = get_option( 'tag_base' );
			else {
				if ( $taxonomy->rewrite['with_front'] && $wp_rewrite->front )
					$path = trailingslashit( $wp_rewrite->front );
				$path .= $taxonomy->rewrite['slug'];
			}

			/* Get parent pages by path if they exist. */
			if ( $path )
				$trail = array_merge( $trail, breadcrumb_trail_get_parents( '', $path ) );

			/* If the taxonomy is hierarchical, list its parent terms. */
			if ( is_taxonomy_hierarchical( $term->taxonomy ) && $term->parent )
				$trail = array_merge( $trail, breadcrumb_trail_get_term_parents( $term->parent, $term->taxonomy ) );

			/* Add the term name to the trail end. */
			$trail['trail_end'] = $term->name;
		}

		/* If viewing an author archive. */
		elseif ( is_author() ) {

			/* If $front has been set, add it to $path. */
			if ( !empty( $wp_rewrite->front ) )
				$path .= trailingslashit( $wp_rewrite->front );

			/* If an $author_base exists, add it to $path. */
			if ( !empty( $wp_rewrite->author_base ) )
				$path .= $wp_rewrite->author_base;

			/* If $path exists, check for parent pages. */
			if ( !empty( $path ) )
				$trail = array_merge( $trail, breadcrumb_trail_get_parents( '', $path ) );

			/* Add the author's display name to the trail end. */
			$trail['trail_end'] = get_the_author_meta( 'display_name', get_query_var( 'author' ) );
		}

		/* If viewing a time-based archive. */
		elseif ( is_time() ) {

			if ( get_query_var( 'minute' ) && get_query_var( 'hour' ) )
				$trail['trail_end'] = get_the_time( __( 'g:i a', $textdomain ) );

			elseif ( get_query_var( 'minute' ) )
				$trail['trail_end'] = sprintf( __( 'Minute %1$s', $textdomain ), get_the_time( __( 'i', $textdomain ) ) );

			elseif ( get_query_var( 'hour' ) )
				$trail['trail_end'] = get_the_time( __( 'g a', $textdomain ) );
		}

		/* If viewing a date-based archive. */
		elseif ( is_date() ) {

			/* If $front has been set, check for parent pages. */
			if ( $wp_rewrite->front )
				$trail = array_merge( $trail, breadcrumb_trail_get_parents( '', $wp_rewrite->front ) );

			if ( is_day() ) {
				$trail[] = '<a href="' . get_year_link( get_the_time( __( 'Y', $textdomain ) ) ) . '" title="' . get_the_time( __( 'Y', $textdomain ) ) . '">' . get_the_time( __( 'Y', $textdomain ) ) . '</a>';
				$trail[] = '<a href="' . get_month_link( get_the_time( __( 'Y', $textdomain ) ), get_the_time( __( 'm', $textdomain ) ) ) . '" title="' . get_the_time( __( 'F', $textdomain ) ) . '">' . get_the_time( __( 'F', $textdomain ) ) . '</a>';
				$trail['trail_end'] = get_the_time( __( 'j', $textdomain ) );
			}

			elseif ( get_query_var( 'w' ) ) {
				$trail[] = '<a href="' . get_year_link( get_the_time( __( 'Y', $textdomain ) ) ) . '" title="' . get_the_time( __( 'Y', $textdomain ) ) . '">' . get_the_time( __( 'Y', $textdomain ) ) . '</a>';
				$trail['trail_end'] = sprintf( __( 'Week %1$s', 'hybrid' ), get_the_time( __( 'W', $textdomain ) ) );
			}

			elseif ( is_month() ) {
				$trail[] = '<a href="' . get_year_link( get_the_time( __( 'Y', $textdomain ) ) ) . '" title="' . get_the_time( __( 'Y', $textdomain ) ) . '">' . get_the_time( __( 'Y', $textdomain ) ) . '</a>';
				$trail['trail_end'] = get_the_time( __( 'F', $textdomain ) );
			}

			elseif ( is_year() ) {
				$trail['trail_end'] = get_the_time( __( 'Y', $textdomain ) );
			}
		}
	}

	/* If viewing search results. */
	elseif ( is_search() )
		$trail['trail_end'] = sprintf( __( 'Search results for &quot;%1$s&quot;', $textdomain ), esc_attr( get_search_query() ) );

	/* If viewing a 404 error page. */
	elseif ( is_404() )
		$trail['trail_end'] = __( '404 Not Found', $textdomain );

	/* Connect the breadcrumb trail if there are items in the trail. */
	if ( is_array( $trail ) ) {
		$breadcrumb = '<div class="breadcrumb breadcrumbs"><div class="breadcrumb-trail">';
		$breadcrumb .= " {$before} ";
		$breadcrumb .= join( " {$separator} ", $trail );
		$breadcrumb .= " {$after} ";
		$breadcrumb .= '</div></div>';
	}

	$breadcrumb = apply_filters( 'breadcrumb_trail', $breadcrumb );

	/* Output the breadcrumb. */
	if ( $echo )
		echo $breadcrumb;
	else
		return $breadcrumb;
}

/**
 * Gets parent pages of any post type or taxonomy by the ID or Path.  The goal of this 
 * function is to create a clear path back to home given what would normally be a "ghost"
 * directory.  If any page matches the given path, it'll be added.  But, it's also just a way
 * to check for a hierarchy with hierarchical post types.
 *
 * @since 0.3
 * @param int $post_id ID of the post whose parents we want.
 * @param string $path Path of a potential parent page.
 * @return array $trail Array of parent page links.
 */
function breadcrumb_trail_get_parents( $post_id = '', $path = '' ) {

	$trail = array();

	if ( empty( $post_id ) && empty( $path ) )
		return $trail;

	if ( empty( $post_id ) ) {
		$parent_page = get_page_by_path( $path );
		$post_id = $parent_page->ID;
	}

	if ( $post_id == 0 ) {
		$path = trim( $path, '/' );
		preg_match_all( "/\/.*?\z/", $path, $matches );

		if ( isset( $matches ) ) {
			$matches = array_reverse( $matches );

			foreach ( $matches as $match ) {

				$path = str_replace( $match[0], '', $path );
				$parent_page = get_page_by_path( trim( $path, '/' ) );

				if ( $parent_page->ID > 0 ) {
					$post_id = $parent_page->ID;
					break;
				}
			}
		}
	}

	while ( $post_id ) {
		$page = get_page( $post_id );
		$parents[]  = '<a href="' . get_permalink( $post_id ) . '" title="' . esc_attr( get_the_title( $post_id ) ) . '">' . get_the_title( $post_id ) . '</a>';
		$post_id = $page->post_parent;
	}

	if ( $parents )
		$trail = array_reverse( $parents );

	return $trail;
}

/**
 * Searches for term parents of hierarchical taxonomies.  This function is similar to
 * the WordPress function get_category_parents() but handles any type of taxonomy.
 *
 * @since 0.3
 * @param int $parent_id The ID of the first parent.
 * @param object|string $taxonomy The taxonomy of the term whose parents we want.
 * @return array $trail Array of links to parent terms.
 */
function breadcrumb_trail_get_term_parents( $parent_id = '', $taxonomy = '' ) {
	$trail = array();
	$parents = array();

	if ( empty( $parent_id ) || empty( $taxonomy ) )
		return $trail;

	while ( $parent_id ) {
		$parent = get_term( $parent_id, $taxonomy );
		$parents[] = '<a href="' . get_term_link( $parent, $taxonomy ) . '" title="' . esc_attr( $parent->name ) . '">' . $parent->name . '</a>';
		$parent_id = $parent->parent;
	}

	if ( $parents )
		$trail = array_reverse( $parents );

	return $trail;
}

?>