<?php

/**
 * The template for displaying the footer
 *
 * @package Likedaheim
 */
?>
<?php if (is_front_page()): ?>
	<!-- Business Inquiry Modal -->
	<div class="modal fade" id="businessInquiryModal" tabindex="-1" aria-labelledby="businessInquiryModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content">
				<div class="modal-header border-0">
					<h5 class="modal-title" id="businessInquiryModalLabel">
						<?php
						$currentlang = get_bloginfo('language');
						echo ($currentlang == "en-US") ? 'Corporate Inquiry' : 'Firmenanfrage';
						?>
					</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<?php
					if ($currentlang == "en-US") {
						echo do_shortcode('[contact-form-7 id="2aa8d2f" title="Business Inquiry - EN"]');
					} else {
						echo do_shortcode('[contact-form-7 id="OVDE_STAVI_DE_ID" title="Business Inquiry - DE"]');
					}
					?>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<footer id="colophon" class="site-footer">
	<div class="footer-main">
		<div class="container">
			<!-- Logo centriran -->
			<div class="footer-brand fade-up delay-100" data-scroll>
				<?php
				if (has_custom_logo()) {
					$custom_logo_id = get_theme_mod('custom_logo');
					$logo = wp_get_attachment_image_src($custom_logo_id, 'full');
				?>
					<a class="navbar-brand d-flex align-items-center justify-content-center" href="<?php echo esc_url(home_url('/')); ?>" rel="home">
						<img height="60" src="<?php echo esc_url($logo[0]); ?>" alt="<?php bloginfo('name'); ?>" class="custom-logo">
					</a>
				<?php } else { ?>
					<a class="navbar-brand d-flex align-items-center" href="<?php echo esc_url(home_url('/')); ?>" rel="home">
						<span><?php bloginfo('name'); ?></span>
					</a>
				<?php } ?>
			</div>

			<!-- Contact items - 2 kolone -->
			<div class="footer-contact">
				<div class="row justify-content-center g-4">
					<div class="col-md-6 col-lg-5 fade-up delay-100" data-scroll>
						<a href="mailto:info@likedaheim.de" class="contact-card-link">
							<div class="contact-card">
								<div class="contact-icon">
									<i class="fas fa-envelope"></i>
								</div>
								<div class="contact-info">
									<span class="contact-label">Email</span>
									<span class="contact-value">info@likedaheim.de</span>
								</div>
							</div>
						</a>
					</div>
					<div class="col-md-6 col-lg-5 fade-up delay-200" data-scroll>
						<a href="https://www.google.com/maps/place/LikeDaheim+Apartments/@50.2938489,8.6957129,15z/data=!4m2!3m1!1s0x0:0xe72c5c5e61308d0a?sa=X&ved=2ahUKEwjhyMX-rdT0AhXWRvEDHWVgDJ0Q_BJ6BAhUEAU" target="_blank" rel="noopener noreferrer" class="contact-card-link">
							<div class="contact-card">
								<div class="contact-icon">
									<i class="fas fa-map-marker-alt"></i>
								</div>
								<div class="contact-info">
									<?php
									$currentlang = get_bloginfo('language');
									echo ($currentlang == "en-US") ? '<span class="contact-label">Address</span>' : '<span class="contact-label">Adresse</span>';
									?>
									<span class="contact-value">Carl-Benz-Str. 3, 61191 Rosbach v. d. Höhe</span>
								</div>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Bottom Bar -->
	<div class="footer-bottom fade-bottom delay-100" data-scroll>
		<div class="container">
			<div class="footer-bottom-inner">
				<div class="footer-links-wrapper">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-2',
							'menu_class'     => 'footer-menu',
							'container'      => false
						)
					);
					?>
				</div>
				<div class="footer-copyright">
					<?php
					$currentlang = get_bloginfo('language');
					if ($currentlang == "en-US"): ?>
						<p>&copy; LikeDaheim <?php echo date('Y'); ?>, developed by <a href="https://www.s7codedesign.com/" target="_blank">S7 Code & Design</a></p>
					<?php else: ?>
						<p>&copy; LikeDaheim <?php echo date('Y'); ?>, entwickelt von <a href="https://www.s7codedesign.com/" target="_blank">S7 Code & Design</a></p>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>

</html>