<?php
/**
 * Template Name: Hotel
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
hotel_info	                Wysiwyg Editor
hotel_buttons	            Repeater
	button_text	            Text
	button_url	            Url
map_iframe_url	            Url
column_left	                Wysiwyg Editor
column_right	            Wysiwyg Editor
*/ ?>
                <div class="con-location">
                    <?php the_content(); ?>
                    <div class="location-content-column">
                        <div class="info">
                            <?php the_field('hotel_info'); ?>
                            <?php if(have_rows('hotel_buttons')){ ?>
                                <p class="location-buttons">
                                    <?php while(have_rows('hotel_buttons')){
                                        the_row(); ?>
                                <span>
                                <?php vanhoover_button(get_sub_field('button_url'), get_sub_field('button_text')); ?>
                                </span>
                                    <?php } ?>
                                </p>
                            <?php } ?>
                        </div>
                        <?php
                        $map_url = get_field('map_iframe_url');
                        if($map_url){
                            ?>
                            <iframe class="map" src="<?php echo $map_url ?>"></iframe>
                        <?php } ?>
                    </div>
                    <hr>
                    <div class="hotel-info-columns misc-listings">
                        <div class="misc-listing"><?php the_field('column_left'); ?></div>
                        <div class="misc-listing"><?php the_field('column_right'); ?></div>
                    </div>
                </div>
                <hr>
                <?php /*
hotel_rooms_title           Text
hotel_rooms_info            Wysiwyg Editor
hotel_rooms_rate            Repeater
    name                    Text
    photo                   Image
    price                   Number
    description             Wysiwyg Editor
hotel_book_button_text      Text
hotel_book_button_url       URL
*/ ?>
                <h2 class="subsection-header"><?php the_field('hotel_rooms_title'); ?></h2>
                <?php if(have_rows('hotel_rooms_rate')) { ?>
                <div class="hotel-slider">
                    <?php while (have_rows('hotel_rooms_rate')) {
                        the_row(); ?>
                    <div class="hotel-slider-item">
                        <div class="img-container">
                            <?php echo wp_get_attachment_image(get_sub_field('photo'), 'medium', false, array('class' => 'room-photo')); ?>
                            <h3 class="img-header"><?php the_sub_field('name'); ?></h3>
                            <span class="img-price">$<?php the_sub_field('price'); ?> / Night</span>
                        </div>
                        <div class="description"><?php the_sub_field('description'); ?></div>
                    </div>
                    <?php } ?>
                </div>
                <?php }
                the_field('hotel_rooms_info'); ?>
                <p class="align-center"><?php vanhoover_button(get_field('hotel_book_button_url'), get_field('hotel_book_button_text')); ?></p>
                <hr>
                <?php/*
extra_blocks                Repeater
    title                   Text
    content                 Wysiwyg Editor
    button_text             Text
    button_url              URL
*/ ?>
                <?php if(have_rows('extra_blocks')) { ?>
                    <?php while (have_rows('extra_blocks')) {
                        the_row(); ?>
                        <h2 class="subsection-header"><?php the_sub_field('title'); ?></h2>
                        <?php the_sub_field('content'); ?>
                        <p class="align-center"><?php vanhoover_button(get_sub_field('button_url'), get_sub_field('button_text')); ?></p>
                        <hr>
                    <?php } ?>
                <?php } ?>
                <div class="entry-links"><?php wp_link_pages(); ?></div>
            </div>
        </article>
        <?php if (comments_open() && !post_password_required()) {comments_template('', true);} ?>
        <?php }} ?>
    </main>
<?php get_footer(); ?>