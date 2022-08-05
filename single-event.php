<?php get_header();
    $post_meta = get_post_meta(get_the_ID());
    $lp_plugin_settings = get_option('lp-event-modules_options', array(
        'lp-event-modules_field_event_days' => '',
        'lp-event-modules_field_event_rooms' => ''
    ));
    $post_meta['_event_day_id'][0] = explode('
', $lp_plugin_settings['lp-event-modules_field_event_days'])[intval($post_meta['_event_day_id'][0])];
$post_meta['_event_room_id'][0] = explode('
', $lp_plugin_settings['lp-event-modules_field_event_rooms'])[intval($post_meta['_event_room_id'][0])];
?>
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
                        <p>
                            <?php
                            $time = strtotime(trim($post_meta['_event_day_id'][0]) . ' ' . $post_meta['_event_time'][0]);
                            $nice_time = date("l, F jS \a\\t g:i A", $time);
                            $duration = round(doubleval($post_meta['_event_duration'][0]) / 60, 1);
                            $duration .= ($duration > 1) ? ' hours' : ' hour';
                            $room = $post_meta['_event_room_id'][0];
                            ?>
                            <strong>WHEN:</strong> <?php echo $nice_time ?> (for <?php echo $duration ?>)<br>
                            <strong>WHERE:</strong> <?php echo $room ?>
                        </p>
                        <?php the_content(); ?>
                        <div class="entry-links"><?php wp_link_pages(); ?></div>
                    </div>
                    <br>
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