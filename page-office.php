<?php
/**
* Template Name: Theming - Sunny's Office
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
                            <div class="entry-column-wrapper">
                                <p style="text-align: center;">This image is interactive</p>
                                <div class="office-container">
                                    <img class="office-img" src="<?php echo get_template_directory_uri() ?>/img/office.png" alt="Sunny's Office">
                                    <img class="phone-img" src="<?php echo get_template_directory_uri() ?>/img/phone.png" alt="Sunny's Office" role="button">
                                </div>
                                <div class="audio-container" style="display: none;">
                                    <audio id="sunny-audio" src="<?php echo get_template_directory_uri() ?>/audio/sunny%20takes.mp3" controls></audio>
                                </div>
                                <div>
                                    <h2 style="text-align: center">Element Status</h2>
                                    <div style="text-align: center">
                                    <?php
                                    $codes = array(
                                        'Element of Winter' => 'hkezx5qe',
                                        'Element of Maple Syrup' => 'n25p48en',
                                        'Element of Hockey' => '93cedu98',
                                        'Element of Politeness' => '8gtesrj7',
//                                        'Pickup' => 'pickup',
                                    );

                                    foreach ($codes as $name => $code) {
                                        global $woocommerce;
                                        $coupon = new WC_Coupon($code);
                                        echo "<div>The " . $name . " " .
                                            (((int)$coupon->usage_count > 0) ?
                                                'has been <b style="color:#0A0">found</b>' :
                                                'is <b style="color:#A00">still missing</b>') .
                                            "</div>";
                                    }
                                    ?>
                                        <div>The Element of Nature has been <b style="color:#0A0">found</b></div>
                                    </div>
                                </div>
                                <div class="entry-content-column">
                                    <?php the_content(); ?>
                                </div>
                            </div>
                        <div class="entry-links"><?php wp_link_pages(); ?></div>
                    </div>
                </article>
                <?php if (comments_open() && !post_password_required()) {comments_template('', true);} ?>
            <?php }} ?>
    </main>
    <script>
        $(function (){
            setTimeout(function () {
                $('.phone-img').addClass('shake').on('click', function (){
                    $('.audio-container').show();
                    $(this).removeClass('shake');
                    $('#sunny-audio').trigger('play').focus();
                });
            }, 3000)
        })
    </script>
    <style>
        .office-container {
            position: relative;
        }
        .office-img {
            object-fit: cover !important;
            height: 600px !important;
            width: 100% !important;
            max-width: 842px !important;
        }
        .phone-img {
            width: 100px !important;
            height: 56px !important;
            position: absolute;
            left: calc(50% - 25px);
            bottom: 171px;
        }
        .audio-container {
            align-items: center;
        }
        #sunny-audio {
            display: block;
            margin: 0 auto;
        }
        .blocks-gallery-item__caption a{
            font-size: 1rem;
        }
        .blocks-gallery-item__caption a:link,
        .blocks-gallery-item__caption a:visited {
            color: #fff;
        }
        .blocks-gallery-item__caption a:hover,
        .blocks-gallery-item__caption a:active {
            color: #ccc;
        }
        .shake {
            /* Start the shake animation and make the animation last for 0.5 seconds */
            animation: shake 1s;

            /* When the animation is finished, start again */
            animation-iteration-count: infinite;
            cursor: pointer;
        }

        @keyframes shake {
            0% { transform: translate(1px, 1px) rotate(0deg); }
            5% { transform: translate(-1px, -2px) rotate(-1deg); }
            10% { transform: translate(-3px, 0px) rotate(1deg); }
            15% { transform: translate(3px, 2px) rotate(0deg); }
            20% { transform: translate(1px, -1px) rotate(1deg); }
            25% { transform: translate(-1px, 2px) rotate(-1deg); }
            30% { transform: translate(-3px, 1px) rotate(0deg); }
            35% { transform: translate(3px, 1px) rotate(-1deg); }
            40% { transform: translate(-1px, -1px) rotate(1deg); }
            45% { transform: translate(1px, 2px) rotate(0deg); }
            50% { transform: translate(1px, -2px) rotate(-1deg); }
            55% { transform: translate(0, 0) rotate(0); }
            100% { transform: translate(0, 0) rotate(0); }
        }
    </style>
<?php get_footer(); ?>