<?php

/**
 * Treatments Section Template
 * 
 * Displays treatments as accordion items in 2 columns
 * Single box with horizontal dividers
 * 
 * @package smitasmile
 */

$page_id = get_queried_object_id();

$main_title = get_field('treatments_main_title', $page_id);
$main_description = get_field('treatments_main_description', $page_id);
$treatments = get_field('treatments_items', $page_id);

if (!$treatments || empty($treatments)) {
    return;
}

// Split treatments into 2 columns
$mid_point = ceil(count($treatments) / 2);
$column_1 = array_slice($treatments, 0, $mid_point);
$column_2 = array_slice($treatments, $mid_point);
?>

<section class="treatments-section">
    <div class="container">

        <!-- Section Header -->
        <?php if ($main_title) : ?>
            <div class="treatments-header mb-5">
                <h2 class="treatments-title"><?php echo esc_html($main_title); ?></h2>
                <?php if ($main_description) : ?>
                    <p class="treatments-subtitle"><?php echo wp_kses_post($main_description); ?></p>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <!-- Accordion Grid - 2 Columns -->
        <div class="row g-4 m-0">

            <!-- Column 1 -->
            <div class="col-lg-6 my-0">
                <div class="treatments-box">
                    <div class="accordion treatments-accordion" id="treatmentsAccordionLeft">
                        <?php foreach ($column_1 as $index => $treatment) :
                            $item_id = 'treatment-left-' . $index;
                            $title = $treatment['treatment_item_title'] ?? '';
                            $description = $treatment['treatment_item_description'] ?? '';
                            $button = $treatment['treatment_item_button'] ?? '';
                            $is_last = ($index === count($column_1) - 1);

                            if (!$title) continue;
                        ?>
                            <div class="accordion-item <?php echo $is_last ? '' : 'with-divider'; ?>">
                                <h3 class="accordion-header">
                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#<?php echo esc_attr($item_id); ?>"
                                        aria-expanded="false"
                                        aria-controls="<?php echo esc_attr($item_id); ?>">
                                        <span class="accordion-title-text">
                                            <?php echo esc_html($title); ?>
                                        </span>
                                    </button>
                                </h3>
                                <div
                                    id="<?php echo esc_attr($item_id); ?>"
                                    class="accordion-collapse collapse"
                                    data-bs-parent="#treatmentsAccordionLeft">
                                    <div class="accordion-body">
                                        <?php if ($description) : ?>
                                            <div class="treatment-description">
                                                <?php echo wp_kses_post($description); ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php if ($button) : ?>
                                            <a
                                                href="<?php echo esc_url($button['url']); ?>"
                                                class="treatment-link"
                                                <?php echo $button['target'] ? 'target="' . esc_attr($button['target']) . '"' : ''; ?>
                                                <?php echo $button['target'] === '_blank' ? 'rel="noopener noreferrer"' : ''; ?>>
                                                <?php echo esc_html($button['title']); ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Column 2 -->
            <div class="col-lg-6 my-0">
                <div class="treatments-box">
                    <div class="accordion treatments-accordion" id="treatmentsAccordionRight">
                        <?php foreach ($column_2 as $index => $treatment) :
                            $item_id = 'treatment-right-' . $index;
                            $title = $treatment['treatment_item_title'] ?? '';
                            $description = $treatment['treatment_item_description'] ?? '';
                            $button = $treatment['treatment_item_button'] ?? '';
                            $is_last = ($index === count($column_2) - 1);

                            if (!$title) continue;
                        ?>
                            <div class="accordion-item <?php echo $is_last ? '' : 'with-divider'; ?>">
                                <h3 class="accordion-header">
                                    <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#<?php echo esc_attr($item_id); ?>"
                                        aria-expanded="false"
                                        aria-controls="<?php echo esc_attr($item_id); ?>">
                                        <span class="accordion-title-text">
                                            <?php echo esc_html($title); ?>
                                        </span>
                                    </button>
                                </h3>
                                <div
                                    id="<?php echo esc_attr($item_id); ?>"
                                    class="accordion-collapse collapse"
                                    data-bs-parent="#treatmentsAccordionRight">
                                    <div class="accordion-body">
                                        <?php if ($description) : ?>
                                            <div class="treatment-description">
                                                <?php echo wp_kses_post($description); ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php if ($button) : ?>
                                            <a
                                                href="<?php echo esc_url($button['url']); ?>"
                                                class="treatment-link"
                                                <?php echo $button['target'] ? 'target="' . esc_attr($button['target']) . '"' : ''; ?>
                                                <?php echo $button['target'] === '_blank' ? 'rel="noopener noreferrer"' : ''; ?>>
                                                <?php echo esc_html($button['title']); ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

        </div><!-- .row -->

    </div><!-- .container -->
</section><!-- .treatments-section -->