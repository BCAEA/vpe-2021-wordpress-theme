<?php
/**
 * Template Name: Registration
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
                <?php the_content(); ?>
<?php /*
reg_button_text	Text
reg_button_url	Url
reg_tiers		Repeater
	group		Select
	title		Text
	icon		Image
	color		Color Picker
	price		Number
	disc_price	Number
	description	Wysiwyg Editor
*/ ?>
                <p class="align-center"><?php vanhoover_button(get_field('reg_button_url'), get_field('reg_button_text')); ?></p>
                <hr>
                <?php if(have_rows('reg_tiers')){ ?>
                    <?php
                    $groups = array();
                    $i = 0; while(have_rows('reg_tiers')){
                        the_row();
                        $group = get_sub_field('group');
                        if (!isset($groups[$group])){
                            $groups[$group] = array();
                        }
                        $new = array(
                            'title' => get_sub_field('title'),
                            'icon' => get_sub_field('icon'),
                            'color' => get_sub_field('color'),
                            'price' => get_sub_field('price'),
                            'description' => get_sub_field('description'),
                        );
                        if(!empty(get_sub_field('disc_price'))) {
                            $new['disc_price'] = get_sub_field('disc_price');
                        }
                        $groups[$group][] = $new;
                    }
                    foreach ($groups as $index => $group) { ?>
                        <h2 class="align-center"><?php echo $index ?></h2>
                        <div class="reg-tiers">
                            <?php foreach ($group as $tier) { ?>
                            <div class="reg-tier">
                                <div class="tier-header" style="background-color: <?php echo $tier['color'] ?>;">
                                <?php echo wp_get_attachment_image($tier['icon'], 'medium', false, array('class' => 'tier-image')); ?>
                                <h3><?php echo $tier['title'] ?></h3>
                                <div class="tier-price">
                                <?php if(isset($tier['disc_price'])) { ?>
                                    <strike>$<?php echo $tier['price'] ?></strike> $<?php echo $tier['disc_price'] ?>
                                <?php } else { ?>
                                    $<?php echo $tier['price'] ?>
                                <?php } ?>
                                </div>
                                </div>
                                <div class="tier-content">
                                    <?php echo $tier['description'] ?>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <hr>
                    <?php } ?>
                <?php } ?>
<?php /*
reg_button_text	Text
reg_button_url	Url
reg_info		Repeater
	title		Text
	content	Wysiwyg Editor
*/ ?>
                <?php if(have_rows('reg_info')){
                    while(have_rows('reg_info')){
                        the_row(); ?>
                <h2 class="subsection-header"><?php the_sub_field('title'); ?></h2>
                <?php the_sub_field('content'); ?>
                <hr>
                    <?php }
                } ?>
                <p class="align-center"><?php vanhoover_button(get_field('reg_button_url'), get_field('reg_button_text')); ?></p>
                <div class="entry-links"><?php wp_link_pages(); ?></div>
            </div>
        </article>
        <?php if (comments_open() && !post_password_required()) {comments_template('', true);} ?>
        <?php }} ?>
    </main>
<?php get_footer(); ?>