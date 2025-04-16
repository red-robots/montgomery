<?php
/**
 * Template Name: Repeatable Blocks
 */

get_header(); 
$postId = get_the_ID();
?>
<div id="primary" class="content-area-full repeatable-layout ">
	<main id="main" class="site-main" role="main">

    <?php 
    //EVENTS Page
    if ($postId==39) { 
      get_template_part('parts/upcoming-events'); 
    } ?>


		<?php while ( have_posts() ) : the_post(); ?>


    <?php if( !is_page('events') ) { ?>
      <div class="titlediv typical nomb">
        <div class="wrapper">
          <h1 class="page-title"><span><?php the_title(); ?></span></h1>
        </div>
      </div>
    <?php } ?>
			
      <?php if( have_rows('repeatable_blocks') ) { ?>
      <div class="repeatable-blocks">
        <?php $n=1; while( have_rows('repeatable_blocks') ): the_row(); ?>
          <?php if( get_row_layout() == 'fullwidth_content' ) { 
            $title = get_sub_field('title');
            $content = get_sub_field('content');
            $button = get_sub_field('button'); 
            $rr_btn = get_sub_field('rocket_rez_button_code'); 
            $btn_target = (isset($button['target']) && $button['target']) ? $button['target'] : '_self';
            $btn_title = (isset($button['title']) && $button['title']) ? $button['title'] : '';
            $btn_url = (isset($button['url']) && $button['url']) ? $button['url'] : '';
            if($title || $content) { ?>
            <div class="repeatable fullwidth <?php echo ($title) ? 'has-subtitle':'no-subtitle' ?>">
              <div class="wrapper">
              <?php if ($title) { ?><h2 class="h2"><?php echo $title ?></h2><?php } ?>
              <?php if ($content) { ?><div class="text font16"><?php echo anti_email_spam($content) ?></div><?php } ?>
              <?php if ($btn_title && $btn_url) { ?>
              <div class="buttondiv">
                <a href="<?php echo $btn_url ?>" target="<?php echo $btn_target ?>" class="button"><?php echo $btn_title ?></a>
              </div>  
              <?php } ?>
              <?php if( $rr_btn ){ ?>
                            <div class="btn-center"><?php echo $rr_btn; ?></div>
                          <?php } ?>
              </div>
            </div>
            <?php } ?> 
          <?php } else if ( get_row_layout() == 'image_and_text' ) { 
            $title = get_sub_field('title');
            $content = get_sub_field('content');
            $image = get_sub_field('image'); 
            $imageSize = get_sub_field('image_size'); 
            $background = strtolower(get_sub_field('background'));
            $text_alignment = get_sub_field('text_alignment'); 

            $col = ( ($title || $content) && $image ) ? 'half':'full';
            $col .= ($n % 2==0) ? ' even':' odd';
            $col .= ($imageSize) ? ' orig-size':' crop-size';
            $col .= ($text_alignment) ? ' text-'.$text_alignment:' text-left';

            $rr_btn = get_sub_field('rocket_rez_button_code');
            $button = get_sub_field('button'); 
            $btn_target = (isset($button['target']) && $button['target']) ? $button['target'] : '_self';
            $btn_title = (isset($button['title']) && $button['title']) ? $button['title'] : '';
            $btn_url = (isset($button['url']) && $button['url']) ? $button['url'] : '';
            ?>
            <div class="repeatable text-image <?php echo $col ?>">
              <div class="wrapper">
                <div class="flexwrap <?php echo $background; ?>">
                  <?php if ($title || $content) { ?>
                  <div class="textcol">
                    <?php if ($title) { ?><h2 class="h2"><?php echo $title ?></h2><?php } ?>
                    <?php if ($content) { ?><div class="text font16"><?php echo anti_email_spam($content) ?></div><?php } ?>

                    <?php if ($btn_title && $btn_url) { ?>
                    <div class="buttondiv">
                      <a href="<?php echo $btn_url ?>" target="<?php echo $btn_target ?>" class="button"><?php echo $btn_title ?></a>
                    </div>  
                    <?php } ?>
                    <?php if( $rr_btn ){ ?>
                            <div class="btn-center"><?php echo $rr_btn; ?></div>
                          <?php } ?>
                  </div>  
                  <?php } ?>

                  <?php if ($image) { ?>
                  <div class="imagecol">
                    <figure style="background-image:url(<?php echo $image['url'] ?>)">
                      <img src="<?php echo get_stylesheet_directory_uri() ?>/images/rectangle.png" alt="" class="helper">
                      <img src="<?php echo $image['url'] ?>" alt="<?php echo $image['title'] ?>" class="actual">
                    </figure>
                  </div>  
                  <?php } ?>
                </div>
              </div>
            </div>
          <?php }  else if ( get_row_layout() == 'slider' ) {  
            $gallery = get_sub_field('gallery_slider'); 
              // echo '<pre>';
              // print_r($gallery);
              // echo '</pre>';
            ?>
            <div class="caro-wrap">
            <div class="owl-carousel">
              <?php foreach( $gallery as $img ) { ?>
                <div>
                  <img src="<?php echo $img['url']; ?>" alt="<?php echo $img['alt']; ?>">
                </div>
              <?php } ?>
            </div>
            </div>
          <?php $n++; } else if ( get_row_layout() == 'grid_layout' ) {  
            $blocks = get_sub_field('blocks'); ?> 
            <div class="repeatable grid-layout">
              <div class="wrapper">
                <div class="flexwrap blocks">
                  <?php foreach ($blocks as $b) { 
                    $title = $b['title'];
                    $text = $b['text'];
                    $rr_btn = $b['rocket_rez_button_code'];
                    $btn = $b['button'];
                    $alignment = strtolower($b['title_align']);
                    $background = strtolower($b['background']);
                    $btnTitle = (isset($btn['title']) && $btn['title']) ? $btn['title'] : '';
                    $btnLink = (isset($btn['url']) && $btn['url']) ? $btn['url'] : '';
                    $btnTarget = (isset($btn['target']) && $btn['target']) ? $btn['target'] : '_self';
                    $image = $b['image'];
                    $imageHelper = get_stylesheet_directory_uri() . '/images/rectangle-lg.png';
                    //Events page
                    if($postId==39) {
                      $imageHelper = get_stylesheet_directory_uri() . '/images/square.png';
                    }
                    $current_date = strtotime(date('Y-m-d'));
                    $start_date = ($b['event_start_date']) ? strtotime($b['event_start_date']) : '';
                    $end_date = ($b['event_end_date']) ? strtotime($b['event_end_date']) : '';
                    $is_completed = false;
                    if($end_date) {
                      if($current_date>$end_date) {
                        $is_completed = true;
                      }
                    } else {
                      if($start_date) {
                        if($current_date>$start_date) {
                          $is_completed = true;
                        }
                      }
                    }
                    ?>
                    <div class="block js-blocks">
                      <div class="inside">
                        
                        <?php if ($image) { ?>
                        <div class="bImage">
                          <figure style="background-image:url('<?php echo $image['url'] ?>')">
                            <img src="<?php echo $imageHelper ?>" alt="">
                          </figure>
                        </div>
                        <?php } ?>

                        <?php if ( $title || ($btnTitle && $btnLink) ) { ?>
                          <div class="desc <?php echo $background; ?>">
                            <?php if ($title) { ?>
                            <div class="bTitle" style="text-align: <?php echo $alignment; ?>"><?php echo $title ?></div>
                            <?php } ?>
                            <?php if ($text) { ?>
                            <div class="bText"><?php echo $text ?></div>
                            <?php } ?>
                            <?php if ($btnTitle && $btnLink) { ?>
                            <div class="buttondiv">
                              <a href="<?php echo $btnLink ?>" target="<?php echo $btnTarget ?>" class="button"><?php echo $btnTitle ?></a>
                            </div>
                            <?php } ?>
                            <?php if( $rr_btn ){ ?>
                              <div class="btn-center"><?php echo $rr_btn; ?></div>
                            <?php } ?>
                          </div>
                        <?php } ?>

                        <?php if ($is_completed) { ?>
                        <div class="status">Event Complete</div>  
                        <?php } ?>

                      </div>
                    </div>
                  <?php } ?>
                </div>
              </div>
            </div>
          <?php } else if ( get_row_layout() == 'single_image_block' ) { ?>
            <?php if ( $image = get_sub_field('image') ) { 
              $lightbox = get_sub_field('lightbox'); ?>
              <div class="repeatable-single-image-block">
                <div class="wrapper">
                  <figure class="repeatable-single-image">
                    <?php if($lightbox) { ?>
                      <a href="<?php echo $image['url'] ?>" data-fancybox="gallery"><img src="<?php echo $image['url'] ?>" alt="<?php echo $image['title'] ?>" /></a>
                    <?php } else { ?>
                      <img src="<?php echo $image['url'] ?>" alt="<?php echo $image['title'] ?>" />
                    <?php } ?>
                  </figure>
                </div>
              </div>
            <?php } ?>
          <?php } ?>

        <?php endwhile; ?>
      </div>
      <?php } ?>
		<?php endwhile; ?>


	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
