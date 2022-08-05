<?php get_header(); ?>
    <main id="content" class="standard has-sidebar">
        <?php
        if (have_posts()){
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
                                <?php wc_get_template_part( 'content', 'single-product' ); ?>
                            </div>
                            <?php if (comments_open() && !post_password_required()) {
                                comments_template( '', true );
                            } ?>
                        </div>
                        <?php get_sidebar('product'); ?>
                    </div>
                </article>
            <?php }
        } ?>
    </main>
<?php get_footer(); ?>