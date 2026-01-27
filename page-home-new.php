<?php
/**
 * Template Name: New Homepage
 */

get_header(); 
$postId = get_the_ID();
?>
<div id="primary" class="content-area-full repeatable-layout ">
	<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>
			
      <?php if( have_rows('home_flexible_content') ) { ?>
        <div class="home-repeatable-blocks">
          <?php $n=1; while( have_rows('home_flexible_content') ): the_row(); ?>
            <?php if( get_row_layout() == 'hero' ) { 
                $hero_type = get_sub_field('hero_type');
                $img_overlay = get_sub_field('img_overlay');
                $txt_overlay = get_sub_field('text_overlay');
                $has_overlay = ($img_overlay || $txt_overlay) ? ' has-overlay':'';
                if($hero_type=='image') { 
                  $image = get_sub_field('image');
                  ?>
                  <div class="home-repeatable-section hero<?php echo $has_overlay ?>">
                    <figure>
                        <img src="<?php echo $image['url'] ?>" alt="<?php echo $image['title'] ?>" class="hero-image">
                        <?php if ($img_overlay || $txt_overlay) { ?>
                        <div class="overlay">
                          <?php if ($img_overlay) { ?>
                            <div class="img-overlay" style="background-image:url('<?php echo $img_overlay['url'] ?>')"></div> 
                          <?php } ?>
                          <?php if ($txt_overlay) { ?>
                            <div class="text-overlay"><?php echo $txt_overlay ?></div>
                          <?php } ?>
                        </div>
                        <?php } ?>
                    </figure>
                  </div>
                <?php } else if($hero_type=='video') { 
                    $videoLink = get_sub_field('video');
                    $parts = explode("/", $videoLink);
                    $vimeoId = '';
                    $youtubeId = '';
                    if( strpos($videoLink, 'vimeo.com') !== false ) {
                      $vimeoId = end($parts);
                    }
                    if( strpos($videoLink, 'youtube.com') !== false ||  strpos($videoLink, 'youtu.be') !== false ) {
                      if(strpos($videoLink, 'youtube.com') !== false) {
                        $youtubeParts = explode('?v=', $videoLink);
                        $youtubeId = end($youtubeParts);
                      }
                      if(strpos($videoLink, 'youtu.be') !== false) {
                        if( strpos($videoLink, '?') !== false ) {
                          $youtubeParts = explode('?', $videoLink);
                          $first = $youtubeParts[0];
                          $parts = explode('/', $first);
                        } else {
                          $parts = explode('/', $videoLink);
                        }
                        $youtubeId = end($parts);
                      }
                    }
                  ?>

                  <?php if ($vimeoId || $youtubeId) { ?>
                  <div class="home-repeatable-section hero hero-video<?php echo $has_overlay ?>">
                    <div class="video-wrapper">
                    <?php if ($vimeoId) { ?>     
                      <iframe src="https://player.vimeo.com/video/<?php echo $vimeoId ?>?autoplay=1&loop=1&title=0&byline=0&portrait=0&muted=1&controls=0" style="position:absolute;top:0;left:0;width:100%;height:100%;" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe><script src="https://player.vimeo.com/api/player.js"></script>
                    <?php } else { ?>
                      <?php if ($youtubeId) { ?>
                        <iframe src="https://www.youtube.com/embed/<?php echo $youtubeId ?>?autoplay=1&mute=1&playsinline=1&loop=1&controls=0&disablekb=1" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                      <?php } ?>
                    <?php } ?>
                    </div>

                    <?php if ($img_overlay || $txt_overlay) { ?>
                    <div class="overlay-wrap">
                      <div class="overlay">
                        <?php if ($img_overlay) { ?>
                          <div class="img-overlay" style="background-image:url('<?php echo $img_overlay['url'] ?>')"></div> 
                        <?php } ?>
                        <?php if ($txt_overlay) { ?>
                          <div class="text-overlay"><?php echo $txt_overlay ?></div>
                        <?php } ?>
                      </div>
                      <?php } ?>
                    </div>
                  </div>
                  <?php } ?>

                <?php } ?>
            <?php } else if( get_row_layout() == 'icons' ) { 
                $icons = get_sub_field('icons');
                if($icons) { $count = count($icons); ?>
                <div class="home-repeatable-section icons-repeatable icons-count-<?php echo $count ?>">
                  <?php $ctr=1; foreach ($icons as $ic) { 
                    $odd_even = ($ctr % 2==0) ? 'even':'odd';
                    $link = $ic['link'];
                    //$icon = $ic['icon'];
                    $icon = $ic['icon_image'];
                    $textcolor = $ic['textcolor'];
                    $bgcolor = $ic['bgcolor'];
                    $title = (isset($link['title']) && $link['title']) ? $link['title'] : '';
                    $url = (isset($link['url']) && $link['url']) ? $link['url'] : '';
                    $target = (isset($link['target']) && $link['target']) ? $link['target'] : '_self';
                    if($url=='#') {
                      $url='javascript:void(0)';
                    }
                    if($bgcolor || $textcolor) { ?>
                      <style>
                        .icon-block-<?php echo $ctr ?> {
                          <?php if ($bgcolor) { ?>
                          background-color: <?php echo $bgcolor ?>;
                          <?php } ?>
                          <?php if ($textcolor) { ?>
                          color: <?php echo $textcolor ?>;
                          <?php } ?>
                        }
                        <?php if ($textcolor) { ?>
                        .icon-block-<?php echo $ctr ?> a {
                          color: <?php echo $textcolor ?>;
                        }
                        <?php } ?>
                      </style>
                    <?php } ?>
                    <?php
                      $link_title_slug = ($title) ? sanitize_title($title) : '';
                      $current_date_slug = date('m-d-Y');
                      if($link_title_slug=='todays-hours') {
                        $url = get_site_url() . '/event/hours-of-operation-' . $current_date_slug;
                        $target = '_self';
						//$hours_slug =  'hours-of-operation-' . $current_date_slug;
						//$post__slug = getHoursOperationSlug($hours_slug);  
						//$url = get_site_url() . '/event/' . $post__slug;  
                      }
                    ?>
                    <div class="icon-block icon-block-<?php echo $ctr ?> <?php echo $odd_even ?>">
                      <div class="inner">
                        <a href="<?php echo $url ?>" target="<?php echo $target ?>">
                          <span class="link-title">
                            <?php if ($icon) { ?>
                              <div class="icon">
                                <img src="<?php echo $icon['url'] ?>" alt="">
                              </div>
                            <?php } ?>
                            <?php if ($title) { ?>
                             <div class="title"><?php echo $title ?></div> 
                            <?php } ?>
                          </span>
                        </a>
                      </div>
                    </div>
                  <?php $ctr++; } ?>
                </div>
                <?php } ?>
            <?php } else if( get_row_layout() == 'fullscreen_photo_with_text' ) { 
              $maxwidth = get_sub_field('maxwidth');
              $image = get_sub_field('image');
              $text = get_sub_field('text');
              $button = get_sub_field('button');
              $position =  get_sub_field('position');
              $rr_btn = get_sub_field('rocket_rez_button');
              $btnTitle = (isset($button['title']) && $button['title']) ? $button['title'] : '';
              $btnUrl = (isset($button['url']) && $button['url']) ? $button['url'] : '';
              $btnTarget = (isset($button['target']) && $button['target']) ? $button['target'] : '_self';
              $has_text = ($text || ($btnTitle && $btnUrl)) ? 'has-text':'only-image';
              if($image) { ?>
              <div class="home-repeatable-section fullscreen-text-image-repeatable <?php echo $has_text ?>">
                <figure class="<?php echo ($position) ? $position : 'left' ?>">
                  <img src="<?php echo $image['url'] ?>" alt="<?php echo $image['title'] ?>">
                  <?php if ($text) { ?>
                  <div class="textblock"<?php echo ($maxwidth) ? 'style="max-width:'.$maxwidth.';width:100%"':'' ?>>
                    <?php echo $text ?>
                    <?php if ($btnTitle && $btnUrl) { ?>
                    <div class="buttondiv">
                      <a href="<?php echo $btnUrl ?>" class="button" target="<?php echo $btnTarget ?>"><?php echo $btnTitle ?></a>
                    </div>  
                    <?php } ?>
                   
                    <?php if( $rr_btn ){ echo $rr_btn; } ?>
                    
                  </div>
                  <?php } ?>
                </figure>
              </div>
              <?php } ?>
            <?php } else if( get_row_layout() == 'full_width_text' ) {  
                      $text_full_width = get_sub_field('text_full_width');
              ?>
              <section class="home-full-width-text">
                <?php echo $text_full_width; ?>
              </section>
            <?php } else if( get_row_layout() == 'fullwidth_section_columns' ) {  ?>
              <div class="home-repeatable-section fullwidth_section_or_columns">
                <?php if( $content = get_sub_field('content') ) { $countContent = count($content); ?>
                  <div class="columns-content content-<?php echo $countContent ?>">
                    <?php foreach ($content as $c) { 
                      // echo '<pre>';
                      // print_r($c);
                      // echo '</pre>';
                      $image = $c['image'];
                      $clickthrough = $c['clickthrough_image'];
                      $clickthrough_target = $c['clickthrough_target'];
                      $textgroup = $c['textgroup'];
                      $text = ( isset($textgroup['text']) && $textgroup['text'] ) ? $textgroup['text'] : '';
                      $button = ( isset($textgroup['button']) && $textgroup['button'] ) ? $textgroup['button'] : '';
                      $btnTitle = (isset($button['title']) && $button['title']) ? $button['title'] : '';
                      $btnUrl = (isset($button['url']) && $button['url']) ? $button['url'] : '';
                      $btnTarget = (isset($button['target']) && $button['target']) ? $button['target'] : '_self';
                      $is_only_image = false;
                      $rr_btn = $textgroup['rocket_rez_button'];
                      if( empty($text) && empty($btnTitle) &&  empty($btnUrl) ) {
                        $is_only_image = true;
                      }
                      $is_multiple_columns = ($countContent>2) ? ' multiple-columns':'';
                      if ($image || $text ) { ?>
                      <div class="inner<?php echo ($is_only_image) ? ' only-image':'' ?><?php echo $is_multiple_columns ?>">

                        <?php if (($countContent>2)) { ?>
                          <div class="textwrap">
                        <?php } ?>
                        
                        
                          <?php if ($image) { ?>
                            <?php if ($clickthrough) { ?>
                            <figure>
                              <a href="<?php echo $clickthrough ?>" target="<?php echo ($clickthrough_target) ? '_blank':'_self' ?>">
                                <?php if ($countContent>2) { ?>
                                  <span class="img">
                                    <img src="<?php echo $image['url'] ?>" alt="<?php echo $image['title'] ?>" class="photo">
                                    <img src="<?php echo get_stylesheet_directory_uri() ?>/images/portrait.png" alt="" class="resizer">
                                  </span>
                                <?php } else { ?>
                                  <img src="<?php echo $image['url'] ?>" alt="<?php echo $image['title'] ?>" class="photo">
                                <?php } ?>
                              </a>
                            </figure>
                            <?php } else { ?>
                            <figure>
                              <?php if ($countContent>2) { ?>
                                <span class="img">
                                  <img src="<?php echo $image['url'] ?>" alt="<?php echo $image['title'] ?>" class="photo">
                                  <img src="<?php echo get_stylesheet_directory_uri() ?>/images/portrait.png" alt="" class="resizer">
                                </span>
                              <?php } else { ?>
                                <img src="<?php echo $image['url'] ?>" alt="<?php echo $image['title'] ?>" class="photo">
                              <?php } ?>
                            </figure>
                            <?php } ?>
                          <?php } ?>
                          <?php if ($text) { ?>
                          <div class="textblock<?php echo ($btnTitle || $btnUrl) ? ' has-button':'' ?>">
                            <div class="wrap">
                              <div class="text"><?php echo $text ?></div>
                              <?php if ($btnTitle || $btnUrl) { ?>
                                <div class="buttondiv">
                                  <a href="<?php echo $btnUrl ?>" target="<?php echo $btnTarget ?>" class="button"><?php echo $btnTitle ?></a>
                                </div>
                              <?php } ?>
                              <?php if( $rr_btn ){ echo $rr_btn; } ?>
                            </div>
                          </div>
                          <?php } ?>


                        <?php if (($countContent>2)) { ?>
                          </div>
                        <?php } ?>
                      </div>
                      <?php } ?>
                    <?php } ?>
                  </div>
                <?php } ?>
              </div>
            <?php } ?>

          <?php endwhile; ?>
        </div>
      <?php } ?>

		<?php endwhile; ?>


    <?php get_template_part('parts/upcoming-events-new'); ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
