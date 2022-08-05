<?php
/**
 * Template Name: Vendors
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
                                <div class="vendor-grid">
                                <?php $musicians = new WP_Query(array(
                                    'post_type' => 'vendor',
                                    'post_status' => 'publish',
                                    'posts_per_page' => -1,
                                    'order' => 'ASC',
                                    'orderby' => 'title'
                                ));

                                while ($musicians->have_posts()) {
                                    $musicians->the_post(); ?>
                                    <div class="vendor">
                                        <?php if(has_post_thumbnail()) {
                                            echo '<a href="' . get_the_permalink() . '">';
                                            the_post_thumbnail();
                                            echo '</a>';
                                        } ?>
                                        <div class="vendor-content">
                                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                            <?php echo vanhoover_first_paragraph() /*the_excerpt();*/ ?>
                                        </div>
                                    </div>
                                    <?php
                                } ?>
                                </div>
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