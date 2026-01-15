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
    <div class="wrapper wraptax">

    	<div class="titlediv typical nomb">
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
                $sub_title = $v['video_sub_title'];
                $placeholder = get_stylesheet_directory_uri() . '/images/video-helper.png';
                $thumbnail = 'https://vumbnail.com/'.$basename.'.jpg';
                ?>
                <div class="video">
                  <figure>
                    <a href="<?php echo $videoLink ?>" class="fancybox fancybox.iframe" data-fancybox="gallery" allow="autoplay; encrypted-media" allowfullscreen="" frameborder="0">
                      <img src="<?php echo $thumbnail ?>" alt="" class="thumbnail">
                      <img src="<?php echo $placeholder ?>" alt="" class="helper" />
                    </a>
                  </figure>
                  <div class="video-title">
                    <a href="<?php echo $videoLink ?>" data-fancybox="gallery" data-type="video"><?php echo $title ?></a>
                  </div>
                  <?php if( $sub_title ) { ?>
                    <p><?php echo $sub_title; ?></p>
                  <?php } ?>
                </div>
              <?php } ?>
            <?php } ?>
          </div>
          <?php } ?>


          <?php 
          $section_title = get_field('section_title'); 
          if( $section_title ) {
          ?>
            <div class="titlediv typical">
              <h1 class="page-title"><span><?php echo $section_title; ?></span></h1>
            </div>
          <?php } ?>

          <?php if( $news_links = get_field('news_links') ) { ?>
          <div class="videoLibrary">
            <?php foreach ($news_links as $nl) { 
              // echo '<pre>';
              // print_r($nl);
              // echo '</pre>';
                $link = $nl['link']['url'];
                $target = $nl['link']['target'];
                $title = $nl['title'];
                $sub_title = $nl['sub_title'];
                $placeholder = get_stylesheet_directory_uri() . '/images/video-helper.png';
                $thumbnail = $nl['thumbnail']['url'];
                $alt = $nl['thumbnail']['alt'];
                ?>
                <div class="video">
                  <figure>
                    <a href="<?php echo $link ?>" target="<?php echo $target; ?>">
                      <img src="<?php echo $thumbnail ?>" alt="<?php echo $alt; ?>" class="thumbnail">
                      <img src="<?php echo $placeholder ?>" alt="" class="helper" />
                    </a>
                  </figure>
                  <div class="video-title">
                    <a href="<?php echo $link ?>" target="<?php echo $target; ?>"><?php echo $title; ?></a>
                  </div>
                  <?php if( $sub_title ) { ?>
                    <p><?php echo $sub_title; ?></p>
                  <?php } ?>
                </div>
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
