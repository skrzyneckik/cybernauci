<?php get_header(); ?>

<div id="aktualnosci">
    <div class="info container-block">
        <div class="container mainblock">
            <img src="<?php bloginfo('template_directory'); ?>/img/sidebanner-left-computer.png"
                 class="sidebanner sidebanner-left" alt=""/>
            <img src="<?php bloginfo('template_directory'); ?>/img/sidebanner-right-planet.png"
                 class="sidebanner sidebanner-right" alt=""/>

            <header class="entry-header">
                <h2 class="entry-title">Najnowsze informacje o programie</h2>
            </header>
        </div>
        <div class="aktualnosci-list">
            <div class="container mainblock">
                <?php
                $args = array(
                    'cat' => '-' . get_category_by_slug("katalog")->cat_ID,
                    'posts_per_page' => 999999
                );
                $wp_posts = query_posts($args);
                if ($wp_posts) {
                    foreach ($wp_posts as $post):
                        setup_postdata($post); ?>
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                <header class="entry-header">
                                    <?php if (is_sticky() && is_home() && !is_paged()) : ?>
                                        <span class="sticky-post"><?php _e('Featured', 'cybernauci'); ?></span>
                                    <?php endif; ?>

                                    <?php $image = get_field('Image');
                                    if (!empty($image)) { ?>
                                        <img class="img-responsive" src="<?php echo $image['url']; ?>" alt=""/>
                                    <?php } ?>
                                    <small><?php echo get_the_date('d.m.Y'); ?></small>
                                    <?php the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>'); ?>
                                </header>

                                <?php cybernauci_excerpt(); ?>

                                <?php cybernauci_post_thumbnail(); ?>

                                <div class="entry-content">
                                    <?php echo wp_trim_words(get_the_content(), 30) ?>
                                </div>

                                <footer class="entry-footer">
                                    <a class="readmore" href="<?php the_permalink() ?>" rel="bookmark"
                                       title="<?php echo sprintf(__('Continue reading %s', 'cybernauci'), get_the_title()) ?>"><? echo __('czytaj więcej', 'cybernauci') ?></a>
                                    <?php
                                    edit_post_link(
                                        sprintf(
                                            __('Edit<span class="screen-reader-text"> "%s"</span>', 'cybernauci'),
                                            get_the_title()
                                        ),
                                        '<span class="edit-link pull-right">',
                                        '</span>'
                                    );
                                    ?>
                                </footer>
                            </article>
                        </div>
                    <? endforeach;
                }

                the_posts_pagination(array(
                    'prev_text' => '&laquo',
                    'next_text' => '&raquo'
                ));
                ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
