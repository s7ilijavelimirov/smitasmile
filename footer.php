<?php

/**
 * Footer template
 * 
 * @package smitasmile
 */
?>

</main><!-- #primary -->

<!-- Footer -->
<footer id="colophon" class="site-footer">
	<div class="footer-wrapper">
		<!-- Footer Content - 4 Columns Grid -->
		<div class="footer-container">

			<!-- Column 1: Logo & Social (Widget Area) -->
			<div class="footer-col footer-col-1">
				<div class="footer-logo-section">
					<?php
					if (has_custom_logo()) {
						$custom_logo_id = get_theme_mod('custom_logo');
						$logo = wp_get_attachment_image_src($custom_logo_id, 'full');
						if ($logo) :
					?>
							<a href="<?php echo esc_url(home_url('/')); ?>" class="footer-logo" rel="home">
								<img
									src="<?php echo esc_url($logo[0]); ?>"
									alt="<?php bloginfo('name'); ?>"
									width="auto"
									height="65"
									loading="lazy"
									decoding="async">
							</a>
						<?php
						endif;
					} else {
						?>
						<a href="<?php echo esc_url(home_url('/')); ?>" class="footer-logo-text" rel="home">
							<?php bloginfo('name'); ?>
						</a>
					<?php
					}
					?>
				</div>
				<?php
				if (is_active_sidebar('footer-logo-social')):
					dynamic_sidebar('footer-logo-social');
				endif;

				?>
			</div>

			<!-- Column 2: Contact Info Widget -->
			<div class="footer-col footer-col-2">
				<?php
				if (is_active_sidebar('footer-contact')) {
					dynamic_sidebar('footer-contact');
				}
				?>
			</div>

			<!-- Column 3: Address Widget -->
			<div class="footer-col footer-col-3">
				<?php
				if (is_active_sidebar('footer-address')) {
					dynamic_sidebar('footer-address');
				}
				?>
			</div>

			<!-- Column 4: Google Maps Widget -->
			<div class="footer-col footer-col-4">
				<?php
				// if ( is_active_sidebar( 'footer-maps' ) ) {
				// 	dynamic_sidebar( 'footer-maps' );
				// }
				?>
			</div>

		</div><!-- .footer-container -->
	</div><!-- .footer-wrapper -->
</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>