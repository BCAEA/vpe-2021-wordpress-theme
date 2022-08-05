<?php
/**
 * Template Name: Charity
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
                            </div>
                        </div>
                        <?php
                        /* charity_item wp_post_id */

                        // NOTE: This whole section *should* work but doesn't since woocommerce doesn't record sales
                        // total of individual variations. We need that for our calculation.


//                        $charity_item = wc_get_product(get_field('charity_item'));
//                        if($charity_item->is_type('variable')) {
//                            /* @var $charity_item WC_Product_Variable */
//                            $variations = $charity_item->get_available_variations();
//                            $total_raised = 0;
//                            foreach ($variations as $i => $variation) {
//                                $variation_prod = wc_get_product($variation['variation_id']);
//                                $total_raised += $variation_prod->get_total_sales() * doubleval($variation_prod->get_price());
//                            }
//                        } else {
//                            $total_raised = $charity_item->get_total_sales() * doubleval($charity_item->get_price());
//                        }
//                        echo $total_raised;
                        ?>
                        <div class="entry-links"><?php wp_link_pages(); ?></div>
                    </div>
                </article>
        <?php if (comments_open() && !post_password_required()) {comments_template('', true);} ?>
        <?php }} ?>
    </main>
<?php get_footer(); ?>