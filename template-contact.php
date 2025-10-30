<?php

/**
 * Template Name: Contact
 * Template Post Type: page
 * 
 * @package smitasmile
 */

get_header();

// Enqueue International Telephone Input - samo na ovoj stranici
wp_enqueue_style('intl-tel-input-css', 'https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/css/intlTelInput.css');
wp_enqueue_script('intl-tel-input-js', 'https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/intlTelInput.js', [], null, true);
?>

<!-- Contact Section -->
<section class="contact-section">
    <div class="container-xl-custom p-7">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2992.3460320491786!2d2.1576633760607926!3d41.41000657129704!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12a4a2b9f24a295f%3A0xd9577bc9ae304d6c!2sCarrer%20de%20Ca%20l%27Alegre%20de%20Dalt%2C%2069%2C%20Barcelona!5e0!3m2!1sen!2srs!4v1760955519253!5m2!1sen!2srs"
            width="100%"
            height="300"
            style="border:0; filter: grayscale(100%); border-radius:10px;"
            allowfullscreen=""
            loading="lazy"
            class="mb-7"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
        <div class="row">
            <!-- Left Column - Contact Information -->
            <div class="col-lg-5 contact-info-column">
                <div class="contact-info-wrapper">

                    <!-- Main Title -->
                    <?php
                    $main_title = get_field('contact_main_title');
                    if ($main_title) {
                        echo '<h1 class="contact-title">' . esc_html($main_title) . '</h1>';
                    }
                    ?>

                    <!-- Main Description -->
                    <?php
                    $main_description = get_field('contact_main_description');
                    if ($main_description) {
                        echo '<div class="contact-description">' . wp_kses_post($main_description) . '</div>';
                    }
                    ?>

                    <!-- Contact Items Repeater -->
                    <div class="contact-items">
                        <?php
                        if (have_rows('contact_items')) {
                            while (have_rows('contact_items')) {
                                the_row();

                                $icon = get_sub_field('item_icon');
                                $content_top = get_sub_field('item_content_top');
                                $label = get_sub_field('item_label');

                                // Build icon path
                                $icon_path = $icon ? get_template_directory_uri() . '/dist/img/' . $icon . '.svg' : '';
                        ?>
                                <div class="contact-item">

                                    <!-- Icon -->
                                    <?php if ($icon_path) : ?>
                                        <div class="contact-item-icon">
                                            <img
                                                src="<?php echo esc_url($icon_path); ?>"
                                                alt="<?php echo esc_attr($icon); ?>"
                                                loading="lazy"
                                                decoding="async" />
                                        </div>
                                    <?php endif; ?>

                                    <!-- Content -->
                                    <div class="contact-item-content">

                                        <!-- Top Content (Email, Phone, Address, Hours) -->
                                        <?php if ($content_top) : ?>
                                            <div class="contact-item-top">
                                                <?php echo wp_kses_post($content_top); ?>
                                            </div>
                                        <?php endif; ?>

                                        <!-- Label (EMAIL, PHONE, ADDRESS, BUSINESS HOURS) -->
                                        <?php if ($label) : ?>
                                            <div class="contact-item-label">
                                                <?php echo wp_kses_post($label); ?>
                                            </div>
                                        <?php endif; ?>

                                    </div>
                                </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>

            </div>

            <!-- Right Column - Contact Form -->
            <div class="col-lg-7 contact-form-column">
                <div class="contact-form-wrapper">
                    <?php
                    // Display Contact Form 7
                    echo do_shortcode('[contact-form-7 id="1da79c8" title="Contact form EN"]');
                    ?>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- International Telephone Input Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const phoneInput = document.querySelector('#phone');
        if (phoneInput) {
            const iti = window.intlTelInput(phoneInput, {
                initialCountry: "es",
                preferredCountries: ["es", "de", "gb", "ru", "us"],
                separateDialCode: true,
                countrySearch: true,
            });

            phoneInput.addEventListener('countrychange', function() {
                phoneInput.value = '';
            });
        }
    });
</script>

<?php get_footer(); ?>