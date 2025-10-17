<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Smitasmile
 */

?>

<div class="col-lg-6">
	<article id="post-<?php the_ID(); ?>" class="inner">
		<div class="row">
			<div class="col-12">
				<?php the_post_thumbnail('apartment-rectangle-horizontal', array('class' => 'img-fluid')); ?>
			</div>
			<div class="col-12">
				<div class="p-3 p-lg-5">
					<?php
					if ( is_singular() ) :
						the_title( '<h1 class="entry-title">', '</h1>' );
					else :
						the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' );
					endif;

					if ( 'post' === get_post_type() ) :
						?>
						<div class="entry-meta">
							<?php
							Smitasmile_posted_on();
							?>
						</div><!-- .entry-meta -->
					<?php endif; ?>
					<?php the_excerpt(); // Build your custom callback length in functions.php. ?>
				</div>
			</div>
		</div>
	</article><!-- #post-<?php the_ID(); ?> -->
</div>
