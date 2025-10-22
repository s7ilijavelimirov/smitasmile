<?php
/**
 * Founder Section Template
 * 
 * Displays founder information with image, description and signature
 * Uses ACF fields for front-page template
 * SEO optimized with fallback alt text
 * 
 * @package smitasmile
 */

$page_id = get_queried_object_id();

$founder_image = get_field( 'founder_image', $page_id );
$founder_title = get_field( 'founder_title', $page_id );
$founder_description = get_field( 'founder_description', $page_id );
$founder_name = get_field( 'founder_name', $page_id );
$founder_signature = get_field( 'founder_signature', $page_id );

if ( ! $founder_image || ! $founder_title ) {
	return;
}

// SEO: Get image alt text from WordPress, fallback to founder title
$image_alt = get_post_meta( $founder_image, '_wp_attachment_image_alt', true );
$image_alt = $image_alt ?: wp_kses_post( $founder_title );

// SEO: Get signature alt text, fallback to founder name
$signature_alt = get_post_meta( $founder_signature, '_wp_attachment_image_alt', true );
$signature_alt = $signature_alt ?: esc_attr( $founder_name . ' signature' );
?>

<section class="founder-section">
	<div class="container">
		<div class="row align-items-center g-5">
			<!-- Image - Left Side -->
			<div class="col-lg-5">
				<div class="founder-image-wrapper">
					<?php echo wp_get_attachment_image( $founder_image, 'large', false, array( 'class' => 'img-fluid', 'alt' => $image_alt ) ); ?>
				</div>
			</div>

			<!-- Content - Right Side -->
			<div class="col-lg-6">
				<div class="founder-content">
					<!-- Title - H2 for SEO -->
					<h2><?php echo wp_kses_post( $founder_title ); ?></h2>

					<!-- Description - WYSIWYG content -->
					<?php if ( $founder_description ) : ?>
						<div class="founder-description">
							<?php echo wp_kses_post( $founder_description ); ?>
						</div>
					<?php endif; ?>

					<!-- Founder Name - Structured data friendly -->
					<?php if ( $founder_name ) : ?>
						<p class="founder-title"><?php echo wp_kses_post( $founder_name ); ?></p>
					<?php endif; ?>

					<!-- Signature -->
					<?php if ( $founder_signature ) : ?>
						<div class="founder-signature">
							<?php echo wp_get_attachment_image( $founder_signature, 'full', false, array( 'class' => 'img-fluid', 'alt' => $signature_alt ) ); ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section><!-- .founder-section -->