<?php
/**
 * Template Name: VIPs
 */
get_header(); ?>
    <main id="content" class="standard">
        <?php if (have_posts()){
            while (have_posts()){
                the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="header">
                        <h1 class="entry-title"><?php the_title(); ?> <?php edit_post_link(); ?></h1>
                        <?php vanhoover_article_horizontal_divider() ?>
                    </header>
                    <div class="entry-wrapper">
                        <div class="article-wrapper">
                            <div class="entry-content">
                                <?php if ( has_post_thumbnail() ){ ?>
                                    <div class="entry-column-wrapper">
                                        <div class="entry-image">
                                            <?php the_post_thumbnail(); ?>
                                        </div>
                                        <div class="entry-content-column">
                                            <?php the_content(); ?>
                                        </div>
                                    </div>
                                <?php } else {
                                    the_content();
                                } ?>
                                <h2 class="align-center">Our Guests</h2>
                                <?php $vips = new WP_Query(array(
                                    'post_type' => 'vips',
                                    'post_status' => 'publish',
                                    'posts_per_page' => -1,
                                    'order' => 'ASC'
                                ));

                                while ($vips->have_posts()) {
                                    $vips->the_post(); ?>
                                    <div class="post-image-and-excerpt">
                                        <?php if(has_post_thumbnail()) {
                                            the_post_thumbnail(array(300, 300));
                                        } ?>
                                        <div class="post-except-content">
                                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                            <?php $pods = pods('vips', get_the_ID());
                                            echo '<h4>' . $pods->field('role') . '</h4>';
                                            the_excerpt(); ?>
                                        </div>
                                    </div>
                                    <?php
                                } ?>
                                <div class="entry-links"><?php wp_link_pages(); ?></div>
                            </div>
                            <?php if (comments_open() && !post_password_required()) {
                                comments_template( '', true );
                            } ?>
                        </div>
                    </div>
                </article>
            <?php }
        } ?>
    </main>
<?php get_footer(); ?>