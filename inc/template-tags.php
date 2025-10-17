<?php
/**
 * Custom Template Tags
 * @package smitasmile
 */

if ( ! function_exists( 'smitasmile_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function smitasmile_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		printf(
			'<span class="posted-on">%s <a href="%s" rel="bookmark">%s</a></span>',
			esc_html_x( 'Posted on', 'post date', 'smitasmile' ),
			esc_url( get_permalink() ),
			$time_string
		);
	}
endif;

if ( ! function_exists( 'smitasmile_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function smitasmile_posted_by() {
		printf(
			'<span class="byline"> %s <a class="url fn n" href="%s">%s</a></span>',
			esc_html_x( 'by', 'post author', 'smitasmile' ),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		);
	}
endif;

if ( ! function_exists( 'smitasmile_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function smitasmile_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'smitasmile' ) );
			if ( $categories_list ) {
				printf( '<span class="cat-links">%s %s</span>', esc_html__( 'Categories:', 'smitasmile' ), $categories_list );
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'smitasmile' ) );
			if ( $tags_list ) {
				printf( '<span class="tags-links">%s %s</span>', esc_html__( 'Tags:', 'smitasmile' ), $tags_list );
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'smitasmile' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);
			echo '</span>';
		}
	}
endif;

if ( ! function_exists( 'smitasmile_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 */
	function smitasmile_post_thumbnail() {
		if ( post_password_required() || ! has_post_thumbnail() ) {
			return;
		}
		?>
		<div class="post-thumbnail">
			<?php the_post_thumbnail( 'featured' ); ?>
		</div><!-- .post-thumbnail -->
		<?php
	}
endif;
?>