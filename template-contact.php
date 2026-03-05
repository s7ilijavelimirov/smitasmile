<?php

/**
 * Template Name: Contact
 * Template Post Type: page
 *
 * Clean contact page with info left, form right
 *
 * @package smitasmile
 */

get_header();

// Enqueue International Telephone Input
wp_enqueue_style('intl-tel-input-css', 'https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/css/intlTelInput.css');
wp_enqueue_script('intl-tel-input-js', 'https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/intlTelInput.js', [], null, true);

// Get ACF fields
$main_title = get_field('contact_main_title');
$main_description = get_field('contact_main_description');
?>

<!-- Contact Section -->
<section class="contact-section container-fluid pb-lg-8 pb-md-6">
    <div class="container-contact">

        <!-- Header Row - Title & Description -->
        <?php if ($main_title || $main_description) : ?>
            <div class="row mb-lg-5 mb-4">
                <div class="col-12">
                    <?php if ($main_title) : ?>
                        <h1 class="contact-title fs-1"><?php echo esc_html($main_title); ?></h1>
                    <?php endif; ?>

                    <?php if ($main_description) : ?>
                        <div class="contact-description"><?php echo wp_kses_post($main_description); ?></div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="row g-lg-5 g-4">
            <!-- Left Column - Contact Information -->
            <div class="col-lg-5 contact-info-column order-2 order-lg-1">
                <div class="contact-info-wrapper">
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
                                        <?php if ($content_top) : ?>
                                            <div class="contact-item-top">
                                                <?php echo wp_kses_post($content_top); ?>
                                            </div>
                                        <?php endif; ?>

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

                    <!-- Google Maps -->
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d40260.196349536265!2d2.1587282439472784!3d41.40976851448112!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12a499a7a35c6c49%3A0xbe23e85c76fb62c4!2sCl%C3%ADnica%20Dental%20SMITA%20%E2%80%A2%20Advanced%20Smile%20Design!5e0!3m2!1sen!2suk!4v1761820274490!5m2!1sen!2suk"
                        width="100%"
                        height="280"
                        style="border:0; filter: grayscale(100%); border-radius:10px;"
                        allowfullscreen=""
                        loading="lazy"
                        class="mt-1"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

            <!-- Right Column - Contact Form -->
            <div class="col-lg-7 contact-form-column order-1 order-lg-2">
                <div class="contact-form-wrapper">
                    <?php
                    // Get current language from Polylang
                    $lang = function_exists('pll_current_language') ? pll_current_language() : 'en';

                    // Display appropriate Contact Form 7 form by language
                    switch ($lang) {
                        case 'de':
                            echo do_shortcode('[contact-form-7 id="2389e1d" title="Contact form DE"]');
                            break;

                        case 'es':
                            echo do_shortcode('[contact-form-7 id="5f1d6b1" title="Contact form ES"]');
                            break;

                        case 'ru':
                            echo do_shortcode('[contact-form-7 id="7a515c4" title="Contact form RU"]');
                            break;

                        default:
                            echo do_shortcode('[contact-form-7 id="1da79c8" title="Contact form EN"]');
                            break;
                    }
                    ?>
                </div>
            </div>

        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const phoneInput = document.querySelector('#phone');
        const form = phoneInput?.closest('form');

        if (phoneInput && form) {
            const iti = window.intlTelInput(phoneInput, {
                initialCountry: "es",
                preferredCountries: ["es", "de", "gb", "ru", "us"],
                separateDialCode: true,
                countrySearch: true,
            });

            form.addEventListener('submit', function(e) {
                if (phoneInput.value) {
                    const dialCode = iti.getSelectedCountryData().dialCode;
                    const number = phoneInput.value.replace(/\D/g, '');
                    phoneInput.value = '+' + dialCode + number;
                }
            });

            phoneInput.addEventListener('countrychange', function() {
                phoneInput.value = '';
            });
        }
    });
</script>

<?php get_footer(); ?>
