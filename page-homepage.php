<?php
/**
 * Template Name: Homepage
 */
get_header(); ?>
<div id="homepage-splash">
    <div id="homepage-content">
        <div class="column-left">
            <picture>
                <source srcset="<?php echo get_template_directory_uri() ?>/img/noir-sunnyshowers-small.webp" type="image/webp">
                <img id="homepage-image" src="<?php echo get_template_directory_uri() ?>/img/noir-sunnyshowers-small.png" alt="Noir Detective Sunny Showers">
            </picture>
        </div>
        <div class="column-right">
            <div id="branding-wrapper">
                <div id="branding">
                    <h1 id="site-title"><?php echo esc_html(get_bloginfo('name')); ?></h1>
                    <h2 id="site-subtitle"><?php bloginfo('description'); ?></h2>
                    <div id="site-description">Online Convention<br>January 7th - 9th, 2022</div>
                </div>
            </div>
        </div>
    </div>
    <div id="homepage-scroll-down-container" aria-hidden="true">
        <span id="homepage-scroll-down" aria-hidden="true">
            <span class="fas fa-chevron-down" aria-hidden="true"></span>
            Scroll Down
            <span class="fas fa-chevron-down" aria-hidden="true"></span>
        </span>
    </div>
</div>
<main id="content" class="standard">
    <?php if(have_posts()){
        while(have_posts()){
            the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="header">
            <h1 class="entry-title"><?php the_title(); ?>  <?php edit_post_link(); ?></h1>
            <?php vanhoover_article_horizontal_divider() ?>
        </header>
        <div class="entry-content">
            <?php the_content(); ?>
            <hr>
            <h2 class="has-text-align-center">Special Thanks!</h2>
            <p class="has-text-align-center">A special thanks to our Patrons and Alicorns who make this event possible with their overwhelming generosity.</p>
            <h3 class="has-text-align-center">Patrons</h3>
            <p class="has-text-align-center" style="color:#71588e;"><?php echo implode(', ', get_option('vpe_patrons'))  ?></p>
            <h3 class="has-text-align-center">Alicorns</h3>
            <p class="has-text-align-center" style="color:#c98000;"><?php echo implode(', ', get_option('vpe_alicorns')); ?></p>
            <hr>
<?php /*
short_repeater	            Repeater
	title	                Text
	content	                Text Area
	button_text	            Text
	button_url	            Url
*/ ?>
            <?php if(have_rows('short_repeater')){ ?>
            <div class="misc-listings">
                <?php $i = 0; while(have_rows('short_repeater')){
                    the_row(); ?>
                <div class="misc-listing">
                    <?php if($i == 1){
                        ?><hr class="hide-on-lg"><?php
                    } else if($i > 1) {
                        ?><hr><?php
                    } $i++;?>
                    <h2 class="subsection-header"><?php the_sub_field('title'); ?></h2>
                    <?php the_sub_field('content'); ?>
                    <p class="misc-listing-buttons">
                        <?php vanhoover_button(get_sub_field('button_url'), get_sub_field('button_text')); ?>
                    </p>
                </div>
                <?php } ?>
            </div>
            <hr>
            <?php } ?>
            <?php /*
hotel_section_title	        Text
hotel_section_description	Wysiwyg Editor
hotel_info	                Wysiwyg Editor
hotel_buttons	            Repeater
	button_text	            Text
	button_url	            Url
map_iframe_url	            Url
*/ ?>
            <div class="con-location">
                <h2 class="subsection-header"><?php the_field('hotel_section_title'); ?></h2>
                <?php the_field('hotel_section_description'); ?>
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
            </div>
            <hr>
<?php /*
long_repeater	            Repeater
	title	                Text
	content                 Text Area
	button_text	            Text
	button_url	            Url
*/ ?>
            <?php if(have_rows('long_repeater')){ ?>
            <div class="misc-listings">
                <?php $i = 0; while(have_rows('long_repeater')){
                    the_row(); ?>
                <div class="misc-listing">
                    <?php if($i == 1){
                        ?><hr class="hide-on-lg"><?php
                    } else if($i > 1) {
                        ?><hr><?php
                    } $i++;?>
                    <h2 class="subsection-header"><?php the_sub_field('title'); ?></h2>
                    <?php the_sub_field('content'); ?>
                    <p class="misc-listing-buttons">
                        <?php vanhoover_button(get_sub_field('button_url'), get_sub_field('button_text')); ?>
                    </p>
                </div>
                <?php } ?>
            </div>
            <hr>
            <?php } ?>
<?php /*
social_title                Text
social_buttons	            Repeater
	button_text	            Text
	button_icon	            Select
	button_url	            Url
*/ ?>
            <?php if(have_rows('social_buttons')){ ?>
            <div class="socials">
                <h2 class="subsection-header"><?php the_field('social_title'); ?></h2>
                <p class="text-center">
                    <?php while(have_rows('social_buttons')){
                        the_row();
                        vanhoover_social_button(get_sub_field('button_url'), get_sub_field('button_text'), get_sub_field('button_icon')); ?>
                    <?php } ?>
                </p>
            </div>
            <?php } ?>
            <div class="entry-links"><?php wp_link_pages(); ?></div>
        </div>
    </article>
    <?php if (comments_open() && !post_password_required()) {
                comments_template( '', true );
            }
        }
    } ?>
</main>
<?php get_footer(); ?>
