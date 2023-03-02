<?php if ( is_front_page() || is_home() ) { 
  if( $banners = get_field('banner') ) { 
    $type = ( count($banners) > 1 ) ? 'slideshow':'static';
  ?>
  <div class="banners swiper <?php echo $type ?>">
    <div class="swiper-wrapper">
      <?php foreach ($banners as $b) { 
        $img = $b['image'];
        $text = $b['text'];
        if($img) { ?>
          <div class="swiper-slide banner" style="background-image:url('<?php echo $img['url'] ?>')">
            <?php if ($text) { ?>
            <div class="text"><div class="pad"><?php echo $text ?></div></div> 
            <?php } ?>
          </div>
        <?php } ?>
      <?php } ?>
    </div>
  </div>
  <?php } ?>
<?php } else { ?>

  <?php if( $banner = get_field("banner_image") ) { ?>
  <?php  $page_title = (get_field("banner_text")) ? get_field("banner_text") : get_the_title();  
    $color = get_field('banner_text_color');
  ?>
  <div class="static-banner <?php echo $color ?>">
    <div class="banner-image" style="background-image:url('<?php echo $banner['url'] ?>')"></div>
    <div class="banner-text">
      <div class="wrapper">
        <div class="title <?php echo $color ?>"><span><?php echo $page_title ?></span></div>
      </div>
    </div>
  </div>
  <?php } ?>

<?php } ?>