<?php get_header(); ?>
<main id="content" class="standard has-sidebar">
    <article id="post-0" class="post not-found">
        <header class="header">
            <h1 class="entry-title"><?php esc_html_e('Not Found', 'vanhoover'); ?></h1>
            <?php vanhoover_article_horizontal_divider(true) ?>
        </header>
        <div class="entry-wrapper">
            <div class="article-wrapper">
                <div class="entry-content">
                    <p class="four-zero-four">404</p>
                    <p><?php esc_html_e('Nothing found for the requested page. Try a search instead?', 'vanhoover'); ?></p>
                </div>
            </div>
            <?php get_sidebar(); ?>
        </div>
    </article>
</main>
<?php get_footer(); ?>
