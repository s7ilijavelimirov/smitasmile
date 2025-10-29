<?php

/**
 * Template Name: Success Stories
 * Template Post Type: page
 * 
 * @package smitasmile
 */

get_header();
?>

<!-- Intro Section -->
<?php get_template_part('template-parts/intro-section'); ?>

<!-- Success Stories Content -->
<section class="success-stories-content mt-7 mt-md-8 mt-xl-9">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="success-stories-placeholder">
                    <?php echo do_shortcode('[trustindex no-registration=google]'); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>