<?php get_header(); ?>
    <main id="content" class="standard has-sidebar">
        <?php if (have_posts()){
            while (have_posts()){
                the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="header">
                <h1 class="entry-title"><?php the_title(); ?> <?php edit_post_link(); ?></h1>
                <?php $role = pods()->field('role');
                if(isset($role) && !empty($role)){ ?>
                <h2 class="entry-subtitle"><?php echo $role ?></h2>
                <?php } ?>
                <?php vanhoover_article_horizontal_divider() ?>
            </header>
            <div class="entry-wrapper">
                <div class="article-wrapper">
                    <div class="entry-content">
                        <div class="vip-images">
                        <?php $images = pods()->field('images'); foreach ($images as $image) {
                            echo pods_image($image['ID'], 'large');
                        } ?>
                        </div>
                        <?php the_content(); ?>
                        <div class="social-links"><?php
                            foreach (array('social_1', 'social_2') as $key => $value) {
                                vanhoover_social_button(pods()->field($value . '_url'), null, pods()->field($value));
                                echo ' ';
                            }
                        ?></div>
                        <div class="entry-links"><?php wp_link_pages(); ?></div>
                    </div>
                    <footer><?php get_template_part( 'nav', 'below-single' ); ?></footer>
                </div>
                <?php get_sidebar(); ?>
            </div>
        </article>
                <?php if (comments_open() && !post_password_required()) {
                    comments_template( '', true );
                }
            }
        } ?>
    </main>
<?php get_footer(); ?>