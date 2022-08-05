<?php
/**
 * Template Name: Musicians
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
                                <?php $musicians = new WP_Query(array(
                                    'post_type' => 'musicians',
                                    'post_status' => 'publish',
                                    'posts_per_page' => -1,
                                    'order' => 'ASC'
                                ));

                                while ($musicians->have_posts()) {
                                    $musicians->the_post(); ?>
                                    <div class="post-image-and-excerpt">
                                        <?php if(has_post_thumbnail()) {
                                            the_post_thumbnail(array(300, 300));
                                        } ?>
                                        <div class="post-except-content">
                                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                            <?php the_excerpt(); ?>
                                            <div class="social-links"><?php
                                            foreach (array('social_1', 'social_2') as $key => $value) {
                                                $pods = pods('musicians', get_the_ID());
                                                vanhoover_social_button($pods->field($value . '_url'), null, $pods->field($value));
                                                echo ' ';
                                            }
                                            ?></div>
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