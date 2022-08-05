<?php
/**
 * Template Name: Livestream
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
            <div class="entry-content">
                <?php /*
twitch_embed_code       Text Area
widgetbot_embed_code    Text Area
*/ ?>
                <?php the_content(); ?>
                <div class="livestream-layout">
                    <div class="livestream-video">
                    <?php the_field('twitch_embed_code'); ?>
                    </div>
                    <div class="livestream-chat">
                    <?php the_field('widgetbot_embed_code'); ?>
                    </div>
                </div>
                <div class="entry-links"><?php wp_link_pages(); ?></div>
            </div>
        </article>
        <?php if (comments_open() && !post_password_required()) {comments_template('', true);} ?>
        <?php }} ?>
    </main>
<?php get_footer(); ?>