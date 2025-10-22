<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Likedaheim
 */

get_header();
?>



<div class="banner banner-post py-6 py-lg-8 mb-7 mb-md-8 mb-xl-9">
	<div class="container">
		<div class="row">
			<div class="col-12 text-center">
				<h6 class="color-dark-gold text-uppercase">Like Daheim</h6>
				<h1 class="color-white mb-0"><?php the_title(); ?></h1>
			</div>
		</div>
	</div>
</div>

<div class="single-post mb-7 mb-md-8 mb-xl-9">
	<div class="container">
		<div class="inner">
			<div class="row">
				<div class="col-12">
					<div class="thumb">
						<?php the_post_thumbnail('', array('class' => 'img-fluid')); ?>
					</div>
				</div>
				<div class="col-12">
					<div class="p-3 p-lg-5">
						<?php the_content(); // Dynamic Content. 
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



<?php
get_footer();
