<?php

/**
 * Template Name: Smita Team
 * Template Post Type: page
 * 
 * Team members page template
 * 
 * @package smitasmile
 */

get_header();
?>

<section class="team-section">
    <div class="container">

        <!-- Page Header -->
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <div class="team-page-header mb-5">
                    <h1 class="team-page-title">
                        <?php the_title(); ?>
                    </h1>
                    <?php if (has_excerpt()) : ?>
                        <p class="team-page-description">
                            <?php the_excerpt(); ?>
                        </p>
                    <?php endif; ?>
                </div>

                <!-- Page Content (if any) -->
                <?php if (get_the_content()) : ?>
                    <div class="team-page-content mb-5">
                        <?php the_content(); ?>
                    </div>
                <?php endif; ?>
            <?php endwhile; ?>
        <?php endif; ?>

        <!-- Team Members Grid -->
        <?php
        $team_args = array(
            'post_type' => 'smita_team',
            'posts_per_page' => -1,
            'orderby' => 'date',
            'order' => 'DESC'
        );

        $team_query = new WP_Query($team_args);
        ?>

        <?php if ($team_query->have_posts()) : ?>
            <div class="team-grid">
                <?php
                while ($team_query->have_posts()) :
                    $team_query->the_post();

                    $position = get_field('team_position_title');
                    $specialization = get_field('team_specialization');
                    $bio = get_field('team_bio');
                ?>
                    <article class="team-card">
                        <!-- Team Member Image -->
                        <div class="team-card-image">
                            <?php
                            if (has_post_thumbnail()) {
                                the_post_thumbnail('large', array(
                                    'class' => 'team-member-photo',
                                    'alt' => get_the_title(),
                                    'loading' => 'lazy'
                                ));
                            } else {
                                echo '<div class="team-no-image">' . esc_html_e('No Image', 'smitasmile') . '</div>';
                            }
                            ?>
                        </div>

                        <!-- Team Member Info -->
                        <div class="team-card-content">
                            <!-- Name (Title) -->
                            <h2 class="team-member-name">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h2>

                            <!-- Position -->
                            <?php if ($position) : ?>
                                <p class="team-member-position">
                                    <?php echo esc_html($position); ?>
                                </p>
                            <?php endif; ?>

                            <!-- Specialization -->
                            <?php if ($specialization) : ?>
                                <p class="team-member-specialization">
                                    <?php echo esc_html($specialization); ?>
                                </p>
                            <?php endif; ?>

                            <!-- Short Bio -->
                            <?php if ($bio) : ?>
                                <div class="team-member-bio">
                                    <?php
                                    $short_bio = wp_trim_words(strip_tags($bio), 30, '...');
                                    echo wp_kses_post($short_bio);
                                    ?>
                                </div>
                            <?php endif; ?>

                            <!-- Read More Link -->
                            <a href="<?php the_permalink(); ?>" class="team-read-more">
                                <?php esc_html_e('View Profile', 'smitasmile'); ?>
                            </a>
                        </div>
                    </article>
                <?php
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        <?php else : ?>
            <div class="team-no-results">
                <p><?php esc_html_e('No team members found.', 'smitasmile'); ?></p>
            </div>
        <?php endif; ?>

    </div><!-- .container -->
</section><!-- .team-section -->

<?php
get_footer();
