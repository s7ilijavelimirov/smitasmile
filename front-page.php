<?php

/**
 * Front Page Template
 * 
 * Modular approach - loads template parts for each section
 * 
 * @package smitasmile
 */

get_header(); ?>

<!-- Hero Section -->
<?php get_template_part('template-parts/homepage/hero'); ?>

<!-- About Founder Section -->
<?php get_template_part('template-parts/homepage/founder'); ?>

<?php echo do_shortcode('[dentalink_booking]'); ?>

<!-- Smile Makeovers Section -->
<?php get_template_part('template-parts/homepage/smile-makeovers'); ?>

<!-- Treatments / FAQ Section -->
<?php // get_template_part('template-parts/homepage/treatments'); ?>

<!-- Meet The Team Section -->
<?php //get_template_part('template-parts/homepage/team'); ?>

<div class="container container-xxl  pb-lg-8 pb-md-6 px-3 text-center text-white">
    <!-- <h1 class="fs-1 text-center"><?php echo esc_html(pll__('Instagram Feed')); ?></h1> -->
    <?php echo do_shortcode('[instagram-feed feed=1]'); ?>
</div>
<!-- Our Partners Section -->
<?php get_template_part('template-parts/homepage/partners'); ?>
<!-- CTA Section -->
<?php //get_template_part('template-parts/cta-banner'); ?> 

<?php
get_footer();
