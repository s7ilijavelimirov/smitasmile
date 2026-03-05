<?php

/**
 * The template for displaying author archives
 * Same layout as blog page with intro section and author info
 * 
 * @package SmitaSmile
 */

get_header();
?>

<!-- Intro Section with Author Info -->
<section class="intro-section py-4 py-md-5 py-lg-6">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <div class="intro-content">
                    <!-- Author Avatar -->
                    <div class="author-intro-avatar mb-3">
                        <?php
                        echo get_avatar(get_the_author_meta('ID'), 100, '', get_the_author_meta('display_name'), array(
                            'class' => 'rounded-circle',
                            'loading' => 'lazy'
                        ));
                        ?>
                    </div>

                    <!-- H1 - Author Name for SEO -->
                    <h1 class="intro-title" itemprop="headline">
                        <?php echo esc_html( get_the_author_meta('display_name') ); ?>
                    </h1>

                    <!-- Author Bio -->
                    <?php if (get_the_author_meta('description')) : ?>
                        <p class="intro-secondary-text mt-4">
                            <?php echo wp_kses_post(get_the_author_meta('description')); ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Author Posts Grid -->
<div class="author-posts-section py-5 py-md-6 py-lg-7">
    <div class="container">
        <div class="row g-4">
            <?php
            $paged = get_query_var('paged') ? get_query_var('paged') : 1;

            if (have_posts()) {
                while (have_posts()) {
                    the_post();
                    get_template_part('template-parts/content');
                }
            } else {
                echo '<div class="col-12"><p class="text-center">' . esc_html(pll__('No posts available.')) . '</p></div>';
            }

            wp_reset_postdata();
            ?>
        </div>

        <!-- Pagination -->
        <?php
        $max_pages = $wp_query->max_num_pages;
        if ($max_pages > 1) :
        ?>
            <div class="row mt-6">
                <div class="col-12">
                    <nav aria-label="<?php echo esc_attr(pll__('Posts pagination')); ?>">
                        <ul class="pagination justify-content-center">
                            <?php
                            $big = 999999999;
                            $pagination_args = array(
                                'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                                'format'    => '?paged=%#%',
                                'current'   => max(1, $paged),
                                'total'     => $max_pages,
                                'prev_text' => '← ' . esc_html(pll__('Previous')),
                                'next_text' => esc_html(pll__('Next')) . ' →',
                                'type'      => 'array',
                            );

                            $links = paginate_links($pagination_args);
                            if ($links) {
                                foreach ($links as $link) {
                                    $link = str_replace('<span class="page-numbers', '<span class="page-link page-numbers', $link);
                                    $link = str_replace('current"><span', 'current', $link);
                                    $link = str_replace('</span></span>', '', $link);

                                    echo '<li class="page-item">' . wp_kses_post($link) . '</li>';
                                }
                            }
                            ?>
                        </ul>
                    </nav>
                </div>
            </div>
        <?php endif; ?>

    </div>
</div>


<?php
get_footer();
