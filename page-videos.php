<?php
/**
 * Template Name: Video Library
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package bellaworks
 */
get_header(); ?>

<div id="primary" class="content-area-full generic-layout">
	<main id="main" class="site-main" role="main">
    <div class="wrapper">

    	<div class="titlediv typical">
        <h1 class="page-title"><span><?php the_title(); ?></span></h1>
      </div>
      <div class="entry-content">
        <?php if ($wp_query->have_posts()) : ?>
		      <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>

          <?php if ( get_the_content() ) { ?>
          <?php the_content(); ?>
          <?php } ?>
		    	
          <?php if( $videos = get_field('videoLibrary') ) { ?>
          <div class="videoLibrary">
            <?php foreach ($videos as $v) { 
              $videoLink = $v['video_link'];
              if($videoLink) {
                $basename = basename( $videoLink );
                $title = $v['video_title'];
                $placeholder = get_stylesheet_directory_uri() . '/images/video-helper.png';
                $thumbnail = 'https://vumbnail.com/'.$basename.'.jpg';
                ?>
                <div class="video">
                  <figure>
                    <a href="<?php echo $videoLink ?>" data-fancybox="gallery" data-type="video">
                      <!-- <iframe title="vimeo-player" src="https://player.vimeo.com/video/<?php //echo $basename ?>" frameborder="0" allowfullscreen></iframe> -->
                      <img src="<?php echo $thumbnail ?>" alt="" class="thumbnail">
                      <img src="<?php echo $placeholder ?>" alt="" class="helper" />
                    </a>
                  </figure>
                </div>
              <?php } ?>
            <?php } ?>
          </div>
          <?php } ?>

		    <?php endwhile; endif; ?>
	    </div>
		
    </div>
	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
