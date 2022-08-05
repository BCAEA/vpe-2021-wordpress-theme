<?php
/**
* Template Name: Theming - Case File Politeness
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
                        <h2>Click a recorder to hear a tape.</h2>
                        <div class="tape-recorder-container">
                            <div>
                                <h3>Office Curds</h3>
                                <img class="tape-recorder-img" src="<?php echo get_template_directory_uri() ?>/img/tape-recorder.png" alt="Tape Recorder" role="button" data-filename="poutine%20takes.mp3" data-show="tape-a">
                                <img id="tape-a" class="tape-recorder-gif" src="<?php echo get_template_directory_uri() ?>/img/tape-recorder.gif" alt="Tape Recorder" style="display: none">
                            </div>
                            <div>
                                <h3>Trail Blazer</h3>
                                <img class="tape-recorder-img" src="<?php echo get_template_directory_uri() ?>/img/tape-recorder.png" alt="Tape Recorder" role="button" data-filename="trail%20takes.mp3" data-show="tape-b">
                                <img id="tape-b" class="tape-recorder-gif" src="<?php echo get_template_directory_uri() ?>/img/tape-recorder.gif" alt="Tape Recorder" style="display: none">
                            </div>
                            <div>
                                <h3>Princess Apricity</h3>
                                <img class="tape-recorder-img" src="<?php echo get_template_directory_uri() ?>/img/tape-recorder.png" alt="Tape Recorder" role="button" data-filename="apricity%20takes.mp3" data-show="tape-c">
                                <img id="tape-c" class="tape-recorder-gif" src="<?php echo get_template_directory_uri() ?>/img/tape-recorder.gif" alt="Tape Recorder" style="display: none">
                            </div>
                        </div>
                        <div class="audio-container" style="display: none;">
                            <audio id="tape-recorder-audio" controls></audio>
                        </div>
                        <?php if ( has_post_thumbnail() ){ ?>
                            <div class="entry-column-wrapper">
                                <div class="entry-image">
                                    <?php the_post_thumbnail(); ?>
                                </div>
                                <div class="entry-content-column">
                                    <?php the_content(); ?>
                                </div>
                            </div>
                        <?php } else { ?>
                            <?php the_content(); ?>
                        <?php } ?>
                        <div class="entry-links"><?php wp_link_pages(); ?></div>
                    </div>
                </article>
                <?php if (comments_open() && !post_password_required()) {comments_template('', true);} ?>
            <?php }} ?>
    </main>
<script>
    $(function (){
        $(".tape-recorder-img").on('click', function (){
            $(".tape-recorder-img").show();
            $(".tape-recorder-gif").hide();
            $(this).hide();
            $('#' + $(this).data('show')).show();
            $(".audio-container").show();
            $("#tape-recorder-audio").attr("src", '<?php echo get_template_directory_uri() ?>/audio/' + $(this).data('filename')).trigger('play').focus();
        })
    });
</script>
<style>
    h1, h2, h3, h4, h5, h6 {
        text-align: center;
    }
    @media (min-width: 1050px) {
        .tape-recorder-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    }
    .tape-recorder-container > * {
        margin: 1rem;
    }
    .tape-recorder-img {
        cursor: pointer;
        display: block;
        margin: 0 auto;
    }
    #tape-recorder-audio {
        display: block;
        margin: 1rem auto;
    }
</style>
<?php get_footer(); ?>