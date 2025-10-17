<?php

/**
 * Template Name: Kontakt
 *
 * @package Likedaheim
 */

get_header();
$currentlang = get_bloginfo('language');
?>

<main id="primary" class="site-main">
    <?php
    $banner = get_field('banner');
    if ($banner): ?>
        <section class="page-banner">
            <div class="banner-background" style="background-image:url('<?php echo $banner['pozadinska_slika']; ?>')"></div>
            <div class="banner-overlay"></div>

            <div class="container">
                <div class="banner-content">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 text-center">
                            <span class="banner-subtitle" data-scroll data-delay="100"><?php echo $banner['podnaslov']; ?></span>
                            <h1 class="banner-title" data-scroll data-delay="200"><?php echo $banner['naslov']; ?></h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php
    $intro = get_field('intro');
    if ($intro): ?>
        <section class="contact-section">
            <div class="container">
                <div class="contact-card">
                    <div class="row">
                        <!-- Left Column - Info & Details -->
                        <div class="col-lg-5">
                            <div class="contact-info-side">
                                <div class="contact-header">
                                    <span class="contact-subtitle fade-up delay-100" data-scroll><?php echo $intro['podnaslov']; ?></span>
                                    <h2 class="contact-title fade-up delay-200" data-scroll><?php echo $intro['naslov']; ?></h2>
                                    <div class="contact-text fade-up delay-300" data-scroll>
                                        <?php echo $intro['tekst']; ?>
                                    </div>
                                </div>

                                <!-- Contact Details -->
                                <div class="contact-details">
                                    <div class="contact-detail-item fade-right delay-100" data-scroll>
                                        <div class="detail-icon">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                        <div class="detail-content">
                                            <h4><?php echo ($currentlang == "en-US") ? "Address" : "Adresse"; ?></h4>
                                            <p>Carl-Benz-Str. 3<br>61191 Rosbach v. d. Höhe</p>
                                        </div>
                                    </div>

                                    <div class="contact-detail-item fade-right delay-200" data-scroll>
                                        <div class="detail-icon">
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                        <div class="detail-content">
                                            <h4>Email</h4>
                                            <p><a href="mailto:info@likedaheim.de">info@likedaheim.de</a></p>
                                        </div>
                                    </div>

                                    <a href="https://www.google.com/maps/place/LikeDaheim+Apartments/@50.2938489,8.6957129,15z/data=!4m2!3m1!1s0x0:0xe72c5c5e61308d0a" target="_blank" rel="noopener noreferrer" class="contact-detail-item contact-detail-link fade-right delay-300" data-scroll>
                                        <div class="detail-icon">
                                            <i class="fas fa-directions"></i>
                                        </div>
                                        <div class="detail-content">
                                            <h4><?php echo ($currentlang == "en-US") ? "Get Directions" : "Route planen"; ?></h4>
                                            <p><?php echo ($currentlang == "en-US") ? "Open in Google Maps" : "In Google Maps öffnen"; ?></p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column - Contact Form -->
                        <div class="col-lg-7">
                            <div class="contact-form-side fade-left delay-200" data-scroll>
                                <?php
                                if ($currentlang == "en-US"):
                                    echo do_shortcode("[contact-form-7 id='827dc94' title='Kontakt EN']");
                                else:
                                    echo do_shortcode("[contact-form-7 id='d4cb70f' title='Kontakt DE']");
                                endif;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Map -->
                <div class="contact-map fade-up delay-100" data-scroll>
                    <iframe src='https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2548.8980627462593!2d8.693498315725725!3d50.293830679454075!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47bd011510ac0bcf%3A0xf9205835651a04c4!2sCarl-Benz-Stra%C3%9Fe%203%2C%2061191%20Rosbach%20vor%20der%20H%C3%B6he%2C%20Germany!5e0!3m2!1sen!2sdk!4v1639049654561!5m2!1sen!2sdk' allowfullscreen='' loading='lazy'></iframe>
                </div>
            </div>
        </section>
    <?php endif; ?>
</main>

<?php get_footer(); ?>