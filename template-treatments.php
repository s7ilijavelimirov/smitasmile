<?php

/**
 * Template Name: Treatments
 * Template Post Type: page
 * 
 * @package smitasmile
 */

get_header();
?>

<!-- Intro Section -->
<?php get_template_part('template-parts/intro-section'); ?>

<!-- Treatments Section -->
<section class="container-fluid treatments-page mt-7 mt-md-8 mt-xl-9 pb-7 pb-md-8 pb-xl-9">
    <div class="container-xl-custom">
        <?php
        $treatments = get_field('treatments');

        if ($treatments) :
            $counter = 1;

            foreach ($treatments as $treatment) :
                $counter++;

                $treatment_images = $treatment['treatment_images'];
                $title = $treatment['treatment_title'];
                $description = $treatment['treatment_description'];
                $faq_items = $treatment['treatment_faq'];

                $is_text_left = ($counter % 2) !== 0;
                $accordion_id = 'accordion-' . $counter;
        ?>

                <div class="row align-items-start mb-6 mb-md-7 mb-xl-8 content">

                    <!-- Text Content Column -->
                    <div class="col-lg-7 <?php echo ! $is_text_left ? 'order-lg-2' : ''; ?>">
                        <div class="content-text">
                            <h2 class="mb-4">
                                <?php echo esc_html($title); ?>
                            </h2>

                            <?php if ($description) : ?>
                                <div class="mb-5">
                                    <?php echo wp_kses_post($description); ?>
                                </div>
                            <?php endif; ?>

                            <!-- FAQ Accordion -->
                            <?php if ($faq_items) : ?>
                                <div>
                                    <h4 class="mb-3"><?php echo esc_html(__('FAQ', 'smitasmile')); ?></h4>
                                    <div class="accordion" id="<?php echo esc_attr($accordion_id); ?>">

                                        <?php
                                        $faq_count = count($faq_items);

                                        foreach ($faq_items as $faq_index => $faq) :
                                            $question = $faq['faq_question'];
                                            $answer = $faq['faq_answer'];
                                            $faq_id = $accordion_id . '-' . $faq_index;
                                            $is_last = ($faq_index === $faq_count - 1);
                                        ?>
                                            <div class="accordion-item <?php echo ! $is_last ? 'with-divider' : ''; ?>">
                                                <p class="accordion-header">
                                                    <button
                                                        class="accordion-button collapsed"
                                                        type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#<?php echo esc_attr($faq_id); ?>"
                                                        aria-expanded="false"
                                                        aria-controls="<?php echo esc_attr($faq_id); ?>">
                                                        <?php echo esc_html($question); ?>
                                                    </button>
                                                </p>
                                                <div
                                                    id="<?php echo esc_attr($faq_id); ?>"
                                                    class="accordion-collapse collapse"
                                                    data-bs-parent="#<?php echo esc_attr($accordion_id); ?>">
                                                    <div class="accordion-body">
                                                        <?php echo wp_kses_post($answer); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>

                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Images Column -->
                    <div class="col-lg-5 treatments-images <?php echo $is_text_left ? 'order-lg-2' : ''; ?>">
                        <?php if ($treatment_images) : ?>
                            <div>
                                <?php foreach ($treatment_images as $image) :
                                    $img = $image['treatment_single_image'];
                                    if ($img) :
                                ?>
                                        <div class="mb-3">
                                            <img
                                                src="<?php echo esc_url($img['url']); ?>"
                                                alt="<?php echo esc_attr($img['alt'] ?: $title); ?>"
                                                class="img-fluid rounded-4 w-100"
                                                loading="lazy">
                                        </div>
                                <?php
                                    endif;
                                endforeach;
                                ?>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>

        <?php
            endforeach;
        else :
            echo '<div class="alert alert-info text-center">' . esc_html__('No treatments found.', 'smitasmile') . '</div>';
        endif;
        ?>
    </div>
</section>

<?php get_footer(); ?>