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
                  <div class="hero<?php echo $has_overlay ?>">
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
                  <div class="hero hero-video<?php echo $has_overlay ?>">
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
                <div class="icons-repeatable icons-count-<?php echo $count ?>">
                  <?php $ctr=1; foreach ($icons as $ic) { 
                    $link = $ic['link'];
                    $icon = $ic['icon'];
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
                    <div class="icon-block icon-block-<?php echo $ctr ?>">
                      <div class="inner">
                        <a href="<?php echo $url ?>" target="<?php echo $target ?>">
                          <span class="link-title">
                          <?php echo $icon ?>
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
              $btnTitle = (isset($button['title']) && $button['title']) ? $button['title'] : '';
              $btnUrl = (isset($button['url']) && $button['url']) ? $button['url'] : '';
              $btnTarget = (isset($button['target']) && $button['target']) ? $button['target'] : '_self';
              if($image) { ?>
              <div class="fullscreen-text-image-repeatable">
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
                  </div>
                  <?php } ?>
                </figure>
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
