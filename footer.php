</main><!-- #primary -->

<!-- Footer -->
<footer id="colophon" class="site-footer">
	<div class="footer-wrapper">
		<!-- Footer Content - 4 Columns -->
		<div class="footer-content">
			<div class="container-fluid footer-container">
				<div class="row g-4">
					<!-- Column 1: Logo & Social Media -->
					<div class="col-12 col-md-6 col-lg-3 footer-col footer-col-1">
						<div class="footer-logo-section">
							<?php
							if (has_custom_logo()) {
								$custom_logo_id = get_theme_mod('custom_logo');
								$logo = wp_get_attachment_image_src($custom_logo_id, 'full');
							?>
								<a href="<?php echo esc_url(home_url('/')); ?>" class="footer-logo" rel="home">
									<img
										src="<?php echo esc_url($logo[0]); ?>"
										alt="<?php bloginfo('name'); ?>"
										width="auto"
										height="60"
										loading="lazy"
										decoding="async">
								</a>
							<?php } else { ?>
								<a href="<?php echo esc_url(home_url('/')); ?>" class="footer-logo-text" rel="home">
									<?php bloginfo('name'); ?>
								</a>
							<?php } ?>

							<!-- Social Media -->
							<div class="footer-social mt-4">
								<a href="https://instagram.com" target="_blank" rel="noopener" class="social-link" aria-label="Instagram">
									<span class="visually-hidden">Instagram</span>
									<svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
										<path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.266.07 1.646.07 4.85s-.012 3.584-.07 4.85c-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zM5.838 12a6.162 6.162 0 1 1 12.324 0 6.162 6.162 0 0 1-12.324 0zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm4.965-10.322a1.44 1.44 0 1 1 2.881.001 1.44 1.44 0 0 1-2.881-.001z" />
									</svg>
								</a>
								<a href="https://facebook.com" target="_blank" rel="noopener" class="social-link" aria-label="Facebook">
									<span class="visually-hidden">Facebook</span>
									<svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
										<path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
									</svg>
								</a>
								<a href="https://wa.me/34622165781" target="_blank" rel="noopener" class="social-link" aria-label="WhatsApp">
									<span class="visually-hidden">WhatsApp</span>
									<svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
										<path d="M17.472 14.382c-.297-.15-1.739-.861-2.008-.96-.27-.108-.459-.162-.655.162-.196.324-.759.954-.929 1.149-.168.193-.337.217-.634.05-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.52.149-.174.198-.298.297-.497.099-.198.05-.371-.025-.52-.075-.149-.655-1.573-.899-2.159-.237-.582-.474-.503-.655-.512-.169-.009-.364-.01-.556-.01-.192 0-.505.073-.769.359-.264.287-1.014.99-1.014 2.414 0 1.424 1.039 2.797 1.184 2.996.145.199 2.048 3.132 4.963 4.368 2.915 1.237 2.915.82 3.438.77.523-.05 1.694-.692 1.934-1.36.24-.668.24-1.24.168-1.36-.072-.12-.264-.192-.556-.341z" />
										<path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm0 22.25C6.063 22.25 1.75 17.938 1.75 12S6.063 1.75 12 1.75 22.25 6.063 22.25 12 17.938 22.25 12 22.25z" />
									</svg>
								</a>
							</div>
						</div>
					</div>

					<!-- Column 2: Contact Info -->
					<div class="col-12 col-md-6 col-lg-3 footer-col footer-col-2">
						<div class="footer-widget">
							<h4 class="footer-title">Contact</h4>
							<ul class="footer-contact-list">
								<li>
									<a href="mailto:info@smitasmile.com">
										info@smitasmile.com
									</a>
								</li>
								<li>
									<a href="tel:+34622165781">
										+(34) 622 16 57 81
									</a>
								</li>
							</ul>
						</div>
					</div>

					<!-- Column 3: Address -->
					<div class="col-12 col-md-6 col-lg-3 footer-col footer-col-3">
						<div class="footer-widget">
							<h4 class="footer-title">Address</h4>
							<address class="footer-address">
								Carrer de Ca l'Alegre de Dalt, 69 bajos<br>
								08024 Barcelona, Spain
							</address>
						</div>
					</div>

					<!-- Column 4: Widget Area (optional) -->
					<div class="col-12 col-md-6 col-lg-3 footer-col footer-col-4">
						<?php
						if (is_active_sidebar('footer-3')) {
							dynamic_sidebar('footer-3');
						} else {
							echo '<div class="footer-widget"><h4 class="footer-title">Quick Links</h4><ul><li><a href="#">Home</a></li><li><a href="#">About</a></li><li><a href="#">Services</a></li><li><a href="#">Contact</a></li></ul></div>';
						}
						?>
					</div>
				</div>
			</div>
		</div>

		<!-- Footer Bottom -->
		<div class="footer-bottom">
			<div class="container-fluid footer-container">
				<div class="row align-items-center">
					<div class="col-md-6">
						<p class="footer-copyright">
							&copy; <?php echo esc_html(date_i18n('Y')); ?>
							<a href="<?php echo esc_url(home_url('/')); ?>">
								<?php bloginfo('name'); ?>
							</a>.
							<?php esc_html_e('All rights reserved.', 'mytheme'); ?>
						</p>
					</div>
					<div class="col-md-6 text-md-end">
						<?php
						wp_nav_menu(array(
							'theme_location' => 'footer',
							'depth' => 1,
							'container' => false,
							'menu_class' => 'footer-menu',
							'fallback_cb' => false,
						));
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>

</html>