<?php

/**
 * Homepage Team Section
 * Display 3 selected team members
 * 
 * @package smitasmile
 */

$section_title = get_field('team_section_title');
$section_description = get_field('team_section_description');
$team_members = get_field('homepage_team_members');
$cta_button = get_field('team_cta_button');

if (! $team_members) {
    return;
}
?>

<section class="homepage-team-section py-7">
    <div class="container-xl-custom">
        <!-- Section Header -->
        <?php if ($section_title || $section_description) : ?>
            <div class="row">
                <div class="col-12 text-center">
                    <?php if ($section_title) : ?>
                        <h2 class="mb-7">
                            <?php echo esc_html($section_title); ?>
                        </h2>
                    <?php endif; ?>

                    <?php if ($section_description) : ?>
                        <p class="lead">
                            <?php echo esc_html($section_description); ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- Team Members Grid -->
        <div class="row justify-content-center gap-md-5 gap-0">
            <?php foreach ($team_members as $member_item) :
                $member = $member_item['team_member'];
                $custom_title = $member_item['team_member_custom_title'];
                $button = $member_item['team_member_button'];

                if (! $member) {
                    continue;
                }

                $member_id = $member->ID;
                $member_image = get_the_post_thumbnail_url($member_id, 'large');
                $member_permalink = get_permalink($member_id);
            ?>

                <div class="col-lg-3 col-md-4">
                    <div class="team-card">
                        <!-- Image -->
                        <?php if ($member_image) : ?>
                            <div class="team-card-image mb-3">
                                <img
                                    src="<?php echo esc_url($member_image); ?>"
                                    alt="<?php echo esc_attr($member->post_title); ?>"
                                    class="img-fluid rounded-4 w-100"
                                    loading="lazy">
                            </div>
                        <?php endif; ?>

                        <!-- Content -->
                        <div class="team-card-content">
                            <h3 class="team-card-name mb-2">
                                <?php echo esc_html($member->post_title); ?>
                            </h3>

                            <?php if ($custom_title) : ?>
                                <p class="team-card-title mb-3">
                                    <?php echo nl2br(esc_html($custom_title)); ?>
                                </p>
                            <?php endif; ?>

                            <?php if ($button && ! empty($button['url']) && ! empty($button['title'])) : ?>
                                <a href="<?php echo esc_url($button['url']); ?>"
                                    class="btn btn-sm btn-outline-secondary"
                                    <?php echo ! empty($button['target']) ? 'target="' . esc_attr($button['target']) . '"' : ''; ?>>
                                    <?php echo esc_html($button['title']); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>
        </div>

        <!-- View All Button -->
        <?php if ($cta_button && ! empty($cta_button['url']) && ! empty($cta_button['title'])) : ?>
            <div class="row mt-6 mt-md-7 mt-xl-8">
                <div class="col-12 text-center">
                    <a href="<?php echo esc_url($cta_button['url']); ?>"
                        class="btn btn-outline-light"
                        <?php echo ! empty($cta_button['target']) ? 'target="' . esc_attr($cta_button['target']) . '"' : ''; ?>>
                        <?php echo esc_html($cta_button['title']); ?>
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>