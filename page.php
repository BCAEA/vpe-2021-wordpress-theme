<?php get_header(); ?>
    <main id="content" class="standard has-sidebar">
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
                        <?php } else { ?>
                            <?php the_content(); ?>
                        <?php } ?>
                        <div class="entry-links"><?php wp_link_pages(); ?></div>
                    </div>
                    <?php if (comments_open() && !post_password_required()) {
                        comments_template( '', true );
                    } ?>
                </div>
                <?php get_sidebar(); ?>
            </div>
        </article>
            <?php }
        } ?>
    </main>
<?php get_footer(); ?>