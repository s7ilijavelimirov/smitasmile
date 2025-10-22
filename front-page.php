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

<!-- Smile Makeovers Section -->
<?php get_template_part('template-parts/homepage/smile-makeovers'); ?>
<!-- <div class="container">
    <iframe src="https://www.theasys.io/viewer/88wSAFPya9fyuaQGmfB2ZTLdwWqJf3/"
        width="100%" height="800" frameborder="0" allow="fullscreen">
    </iframe>
</div> -->
<!-- Treatments / FAQ Section -->
<?php get_template_part('template-parts/homepage/treatments'); ?>

<!-- Our Partners Section -->
<?php get_template_part('template-parts/homepage/partners'); ?>

<!-- Meet The Team Section -->
<?php get_template_part('template-parts/homepage/team'); ?>

<!-- CTA Section -->
<?php get_template_part('template-parts/homepage/cta'); ?>

<?php
get_footer();
