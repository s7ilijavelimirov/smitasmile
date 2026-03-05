<?php

/**
 * Template Name: Book Appointment
 * Template Post Type: page
 *
 * Booking portal - clean, focused booking experience
 * All strings use Polylang for translations
 *
 * @package smitasmile
 */

// Polylang helper function
function booking_pll($string)
{
    return function_exists('pll__') ? pll__($string) : $string;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class('booking-portal'); ?>>
    <?php wp_body_open(); ?>

    <!-- Booking Portal -->
    <div class="booking-portal-wrapper">

        <!-- Left Panel - Branding & Instructions -->
        <aside class="booking-sidebar">
            <div class="booking-sidebar__content">

                <!-- Logo / Back Link -->
                <div class="booking-sidebar__header">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="booking-back-link">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m15 18-6-6 6-6" />
                        </svg>
                        <span><?php echo esc_html(booking_pll('Back to Website')); ?></span>
                    </a>
                </div>

                <!-- Branding -->
                <div class="booking-sidebar__branding">
                    <?php
                    $custom_logo_id = get_theme_mod('custom_logo');
                    if ($custom_logo_id) {
                        echo wp_get_attachment_image($custom_logo_id, 'medium', false, ['class' => 'booking-logo', 'alt' => get_bloginfo('name')]);
                    } else {
                        echo '<h1 class="booking-site-name">' . esc_html( get_bloginfo('name') ) . '</h1>';
                    }
                    ?>
                </div>

                <!-- Title & Subtitle -->
                <div class="booking-sidebar__intro">
                    <h2 class="booking-sidebar__title"><?php echo esc_html(booking_pll('Book Your Appointment')); ?></h2>
                    <p class="booking-sidebar__subtitle"><?php echo esc_html(booking_pll('Schedule your visit in just a few simple steps')); ?></p>
                </div>

                <!-- Steps / Instructions -->
                <div class="booking-steps">
                    <div class="booking-step">
                        <div class="booking-step__number">1</div>
                        <div class="booking-step__content">
                            <h4 class="booking-step__title"><?php echo esc_html(booking_pll('Select Service')); ?></h4>
                            <p class="booking-step__desc"><?php echo esc_html(booking_pll('Choose the treatment you need')); ?></p>
                        </div>
                    </div>
                    <div class="booking-step">
                        <div class="booking-step__number">2</div>
                        <div class="booking-step__content">
                            <h4 class="booking-step__title"><?php echo esc_html(booking_pll('Pick Date & Time')); ?></h4>
                            <p class="booking-step__desc"><?php echo esc_html(booking_pll('Select your preferred slot')); ?></p>
                        </div>
                    </div>
                    <div class="booking-step">
                        <div class="booking-step__number">3</div>
                        <div class="booking-step__content">
                            <h4 class="booking-step__title"><?php echo esc_html(booking_pll('Confirm Booking')); ?></h4>
                            <p class="booking-step__desc"><?php echo esc_html(booking_pll('Enter your details and confirm')); ?></p>
                        </div>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="booking-sidebar__contact">
                    <p class="booking-sidebar__help">
                        <?php echo esc_html(booking_pll('Need help?')); ?>
                    </p>
                    <a href="tel:+34935453232" class="booking-sidebar__phone">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                        </svg>
                        +34 935 453 232
                    </a>
                </div>

            </div>
        </aside>

        <!-- Right Panel - Booking System -->
        <main class="booking-main">
            <div class="booking-main__content">
                <?php echo do_shortcode('[dentalink_booking]'); ?>
            </div>
        </main>

    </div>

    <?php wp_footer(); ?>
</body>

</html>
