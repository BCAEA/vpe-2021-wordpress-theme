<?php

define('VPE_THEME_VER', '1.4.5');

add_action('after_setup_theme', 'vanhoover_setup');
function vanhoover_setup() {
    load_theme_textdomain('vanhoover', get_template_directory() . '/languages');
    add_theme_support('title-tag');
    add_theme_support('automatic-feed-links');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form'));
    add_theme_support('woocommerce');
    global $content_width;
    if (!isset($content_width)) {
        $content_width = 1920;
    }
    register_nav_menus(array('main-menu' => esc_html__('Main Menu', 'vanhoover')));
    register_nav_menus(array('footer-menu' => esc_html__('Footer Menu', 'vanhoover')));
}

add_action('wp_enqueue_scripts', 'vanhoover_load_scripts');
function vanhoover_load_scripts() {
    add_filter('style_loader_tag', 'vanhoover_add_script_sri', 10, 2);
    add_filter('script_loader_tag', 'vanhoover_add_style_sri', 10, 2);

    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Arvo:400,400i,700,700i|Cabin:400,400i,700,700i&display=swap', [], null);
    wp_enqueue_style('slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css', [], null);
    wp_enqueue_style('vanhoover-style', get_stylesheet_uri(), [], VPE_THEME_VER);

    wp_deregister_script('jquery');
    wp_register_script('jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js', [], null);
    wp_enqueue_script('jquery');

    wp_register_script('slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js', ['jquery'], null);
    wp_enqueue_script('slick');

    wp_register_script('fontawesome', 'https://kit.fontawesome.com/e38d08c644.js', ['jquery']);
    wp_enqueue_script('fontawesome');

    wp_register_script('vanhoover-scripts', get_template_directory_uri() . '/js/global.js', ['jquery'], VPE_THEME_VER);
    wp_enqueue_script('vanhoover-scripts');
}

function vanhoover_add_script_sri($html, $handle) {
    switch ($handle){
        case 'slick':
            $html = str_replace('></script>', ' integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous"></script>', $html);
            break;
    }
    return $html;
}

function vanhoover_add_style_sri($html, $handle) {
    switch ($handle){
        case 'jquery':
            $html = str_replace(' />', ' integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous" />', $html);
            break;
        case 'slick':
            $html = str_replace(' />', ' integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" />', $html);
            break;
    }
    return $html;
}

add_action('wp_footer', 'vanhoover_footer_scripts');
function vanhoover_footer_scripts() {
    ?>
    <script>
        jQuery(document).ready(function ($) {
            let deviceAgent = navigator.userAgent.toLowerCase();
            if (deviceAgent.match(/(iphone|ipod|ipad)/)) {
                $("html").addClass(["ios", "mobile"]);
            }
            if (navigator.userAgent.search("MSIE") >= 0) {
                $("html").addClass("ie");
            } else if (navigator.userAgent.search("Chrome") >= 0) {
                $("html").addClass("chrome");
            } else if (navigator.userAgent.search("Firefox") >= 0) {
                $("html").addClass("firefox");
            } else if (navigator.userAgent.search("Safari") >= 0 && navigator.userAgent.search("Chrome") < 0) {
                $("html").addClass("safari");
            } else if (navigator.userAgent.search("Opera") >= 0) {
                $("html").addClass("opera");
            }
        });
    </script>
    <?php

}

add_filter('document_title_separator', 'vanhoover_document_title_separator');
function vanhoover_document_title_separator($sep) {
    $sep = '|';
    return $sep;
}

add_filter('the_title', 'vanhoover_title');
function vanhoover_title($title) {
    if ($title == '') {
        return '...';
    } else {
        return $title;
    }
}

add_filter('the_content_more_link', 'vanhoover_read_more_link');
function vanhoover_read_more_link() {
    if (!is_admin()) {
        global $post;
        if($post->post_type != 'event') {
            return '&hellip; <a href="' . esc_url(get_permalink()) . '" class="more-link">Read More <span class="far fa-chevron-right" aria-hidden="true"></span></a>';
        } else {
            return '&hellip;';
        }
    }
}

add_filter('excerpt_more', 'vanhoover_excerpt_read_more_link');
function vanhoover_excerpt_read_more_link($more) {
    if (!is_admin()) {
        global $post;
        if($post->post_type != 'event') {
            return '&hellip; <a href="' . esc_url(get_permalink($post->ID)) . '" class="more-link">Read More <span class="far fa-chevron-right" aria-hidden="true"></span></a>';
        } else {
            return '&hellip;';
        }
    }
}

add_filter('intermediate_image_sizes_advanced', 'vanhoover_image_insert_override');
function vanhoover_image_insert_override($sizes) {
    unset($sizes['medium_large']);
    return $sizes;
}

add_action('widgets_init', 'vanhoover_widgets_init');
function vanhoover_widgets_init() {
    register_sidebar(array(
        'name' => esc_html__('Sidebar Widget Area', 'vanhoover'),
        'id' => 'primary-widget-area',
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Product Sidebar', 'vanhoover'),
        'id' => 'product-widget-area',
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}

add_action('wp_head', 'vanhoover_pingback_header');
function vanhoover_pingback_header() {
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s" />' . "\n", esc_url(get_bloginfo('pingback_url')));
    }
}

add_action('comment_form_before', 'vanhoover_enqueue_comment_reply_script');
function vanhoover_enqueue_comment_reply_script() {
    if (get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

function vanhoover_custom_pings($comment) {
    ?><li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li><?php
}

add_filter('get_comments_number', 'vanhoover_comment_count', 0);
function vanhoover_comment_count($count) {
    if (!is_admin()) {
        global $id;
        $get_comments = get_comments('status=approve&post_id=' . $id);
        $comments_by_type = separate_comments($get_comments);
        return count($comments_by_type['comment']);
    } else {
        return $count;
    }
}

add_filter('edit_post_link', 'vanhoover_edit_post_link', 10, 3);
function vanhoover_edit_post_link($link, $post_id, $text) {
    if (strlen($link) <= 0) return $link;
    return
        '<a target="_blank" href="' . get_edit_post_link($post_id) . '">
            <span class="screen-reader-text">(Edit this post)</span>
            <span class="fa-stack" aria-hidden="true">
                <span class="fas fa-circle fa-stack-2x"></span>
                <span class="fas fa-pencil fa-stack-1x fa-inverse"></span>
            </span>
        </a>';
}

function vanhoover_article_horizontal_divider($swap_updated_for_current_time = false) {
    ?>
    <hr>
    <div class="entry-sub-header">
        <span class="entry-location">Vanhoover, BC</span>
        <?php if ($swap_updated_for_current_time) { ?>
            <span class="entry-updated hide-on-sm">Date: <?php

                try {
                    echo (
                    new DateTime("now", new DateTimeZone('America/Vancouver'))
                    )->format('l, F jS, Y');
                } catch (Exception $e) {
                } ?></span>
        <?php } else { ?>
            <span class="entry-updated">Updated: <?php the_modified_date('l, F jS, Y') ?></span>
        <?php } ?>
        <span class="entry-price">Price: 1 Bit</span>
    </div>
    <?php if ($swap_updated_for_current_time) { ?>
        <hr class="hide-on-sm">
    <?php } else { ?>
        <hr>
    <?php }
}

add_filter('comments_open', 'vanhoover_filter_media_comment_status', 10, 2);
function vanhoover_filter_media_comment_status($open, $post_id) {
    $post = get_post($post_id);
    if ($post->post_type == 'attachment') {
        return false;
    }
    return $open;
}

function vanhoover_button($button_url = '', $button_text = 'button', $button_class = 'primary') {
    echo vanhoover_get_button($button_url, $button_text, $button_class);
}

function vanhoover_get_button($button_url = '', $button_text = 'button', $button_class = 'primary'){
    if (empty($button_text)) return '';
    $button_attr = (!empty($button_url))? 'class="button ' . $button_class . '" href="' . $button_url . '"' : 'class="button disabled"';
    return '<a ' . $button_attr . ((strpos($button_url, 'http') !== false)? ' target="_blank" rel="noopener noreferrer"' : '') . '>' . $button_text . '</a>';
}

function vanhoover_social_button($button_url = '', $button_text = 'button', $button_type = 'none') {
    echo vanhoover_get_social_button($button_url, $button_text, $button_type);
}

function vanhoover_get_social_button($button_url = '', $button_text = 'button', $button_type = 'none'){
    switch($button_type) {
        case 'twitter':
            if ($button_text == null) $button_text = "Twitter";
            $button_text = '<span class="fab fa-twitter" aria-hidden="true"></span> ' . $button_text;
            break;
        case 'facebook':
            if ($button_text == null) $button_text = "Facebook";
            $button_text = '<span class="fab fa-facebook-square" aria-hidden="true"></span> ' . $button_text;
            break;
        case 'discord':
            if ($button_text == null) $button_text = "Discord";
            $button_text = '<span class="fab fa-discord" aria-hidden="true"></span> ' . $button_text;
            break;
        case 'telegram':
            if ($button_text == null) $button_text = "Telegram";
            $button_text = '<span class="fab fa-telegram" aria-hidden="true"></span> ' . $button_text;
            break;
        case 'youtube':
            if ($button_text == null) $button_text = "YouTube";
            $button_text = '<span class="fab fa-youtube" aria-hidden="true"></span> ' . $button_text;
            break;
        case 'soundcloud':
            if ($button_text == null) $button_text = "Soundcloud";
            $button_text = '<span class="fab fa-soundcloud" aria-hidden="true"></span> ' . $button_text;
            break;
        case 'mixcloud':
            if ($button_text == null) $button_text = "Mixcloud";
            $button_text = '<span class="fab fa-mixcloud" aria-hidden="true"></span> ' . $button_text;
            break;
        case 'bandcamp':
            if ($button_text == null) $button_text = "Bandcamp";
            $button_text = '<span class="fab fa-bandcamp" aria-hidden="true"></span> ' . $button_text;
            break;
        case 'website':
            if ($button_text == null) $button_text = "Website";
            $button_text = '<span class="far fa-globe" aria-hidden="true"></span> ' . $button_text;
            break;
    }
    return vanhoover_get_button($button_url, $button_text, $button_type);
}

function vanhoover_first_paragraph() {
    $first_paragraph_str = wpautop(get_the_content());
    $first_paragraph_str = substr($first_paragraph_str, 0, strpos($first_paragraph_str, '<!-- /wp:paragraph -->') + 4);
    $first_paragraph_str = strip_tags($first_paragraph_str, '<i><b><strong><em>');
    return '<p>' . $first_paragraph_str . '</p>';
}

function woocommerce_template_loop_product_thumbnail() {
    echo '<div class="product-loop-image-wrapper">' . woocommerce_get_product_thumbnail() . '</div>';
}

// Remove company name from checkout
add_filter('woocommerce_checkout_fields', 'vanhoover_remove_company_name');
function vanhoover_remove_company_name($fields) {
    unset($fields['billing']['billing_company']);
    return $fields;
}

add_filter('embed_oembed_html', 'wrap_embed_with_div', 10, 3);
function wrap_embed_with_div($html, $url, $attr) {
    return '<div class="video-container">' . $html . '</div>';
}

add_action('woocommerce_before_customer_login_form', 'vanhoover_login_message');
function vanhoover_login_message() {
    if (get_option('woocommerce_enable_myaccount_registration') == 'yes') {
        ?>
        <div class="woocommerce-info">
            <span><?php _e('NOTE: This account is NOT linked to the registration system. You will need to create a new account. You cannot login to your reg account from here. '); ?></span>
        </div>
        <?php
    }
}

// set billing phone optional
//add_filter('woocommerce_billing_fields', 'vanhoover_remove_billing_phone_field', 20, 1);
//function vanhoover_remove_billing_phone_field($fields) {
//    $fields ['billing_phone']['required'] = false;
//
////    $fields['billing_email']['class'] = array('form-row-wide');
////    unset($fields ['billing_phone']);
//    return $fields;
//}

// Set shipping phone optional
//add_filter('woocommerce_shipping_fields', 'vanhoover_remove_shipping_phone_field', 20, 1);
//function vanhoover_remove_shipping_phone_field($fields) {
//    $fields ['shipping_phone']['required'] = false;
//
////    unset($fields ['shipping_phone']);
//    return $fields;
//}

// Check if WooCommerce is activated
if (!function_exists('is_woocommerce_activated')) {
    function is_woocommerce_activated() {
        return class_exists('woocommerce');
    }
}

// Show shipping info
//add_action('woocommerce_admin_order_data_after_order_details', 'vanhoover_editable_order_meta_general');
function vanhoover_editable_order_meta_general($order) {
//    ini_set('display_startup_errors', 1);
//    ini_set('display_errors', 1);
//    error_reporting(-1);
    $html = '<br><hr><h2>Shipment Info</h2>';
    try {
        /** @var WC_Order $order */
        $shipping_methods = $order->get_shipping_methods();
	if(count($shipping_methods) <= 0) return;
        $shipping_metas = array_values($shipping_methods)[0]->get_meta_data();
        /** @var WC_Meta_Data $shipping_meta */
        $html .= '<ul>';
        foreach ($shipping_metas as $shipping_meta) {
            $data = $shipping_meta->get_data();
            $html .= "<li>" . $data['key'] . ': ';
            if (gettype($data['value']) == "array") {
                $html .= '<pre>' . print_r($data['value'], true) . '</pre>';
            } else {
                $html .=  $data['value'];
            }
            $html .=  "</li>";
        }
        $html .=  '</ul>';
    } catch (Exception $e) {
        $html .= 'An exception occurred. Please report this to LinuxPony.';
    }
    echo $html;
}
require_once 'current-post-type-widget.php';

// Kill redirect
function kill_404_redirect_wpse_92103() {
    if (is_404()) {
        add_action('redirect_canonical','__return_false');
    }
}
add_action('template_redirect','kill_404_redirect_wpse_92103',1);