<?php get_header(); ?>
<main id="content" class="standard blog has-sidebar">
    <header class="header">
        <h1 class="blog-title">Blog</h1>
        <?php the_archive_description('<div class="archive-meta">', '</div>') ?>
        <?php vanhoover_article_horizontal_divider(true); ?>
    </header>
    <div class="entry-wrapper">
        <div class="article-wrapper">
            <?php if (have_posts()) {
                while (have_posts()) {
                    the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <?php get_template_part('entry', 'summary'); ?>
                    </article>
                    <?php if (comments_open() && !post_password_required()) {
                        comments_template('', true);
                    }
                }
                get_template_part('nav', 'below');
            } ?>
        </div>
        <?php get_sidebar(); ?>
    </div>
</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>

