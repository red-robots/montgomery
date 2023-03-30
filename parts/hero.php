<?php 
if ( is_front_page() || is_home() ) { 
  if( $banners = get_field('banner') ) { 
    $type = ( count($banners) > 1 ) ? 'slideshow':'static';
  ?>
  <div class="banners swiper <?php echo $type ?>">
    <div class="swiper-wrapper">
      <?php foreach ($banners as $b) { 
        $img = $b['image'];
        $text = $b['text'];
        $banner_logo = $b['banner_logo'];
        $banner_class = ( $banner_logo && $text ) ? ' logo-and-text':'';
        if($img) { ?>
          <div class="swiper-slide banner<?php echo $banner_class ?>" style="background-image:url('<?php echo $img['url'] ?>')">
            <?php if ($banner_logo || $text) { ?>
            <div class="banner-content">
              <div class="banner-inner">
                <?php if ($banner_logo) { ?>
                <div class="banner-logo">
                  <img src="<?php echo $banner_logo['url'] ?>" alt="<?php echo $banner_logo['title'] ?>">
                </div>
                <?php } ?>
                <?php if ($text) { ?>
                <div class="text"><div class="pad"><?php echo $text ?></div></div> 
                <?php } ?>
              </div>
            </div>
            <?php } ?>
          </div>
        <?php } ?>
      <?php } ?>
    </div>
  </div>
  <?php } ?>
<?php } else { ?>

  <?php if ( is_archive() ) { ?>

    <?php  
    global $obj;
    $banner_image = '';
    $banner_text = '';
    if( isset($obj->name) && $obj->name=='tribe_events' ) {
      $banner_image = get_field("calendar_banner_image","option");
      $banner_text = get_field("calendar_banner_text","option");
    } else {
      $current_term_id = $obj->term_id;
      $banner_text = $obj->name;
      $taxonomy = $obj->taxonomy;
      $banner_image = get_field("category_image",$taxonomy.'_'.$current_term_id);
    }
    if($banner_image) { ?>
    <div class="static-banner taxonomy-banner">
      <div class="banner-image" style="background-image:url('<?php echo $banner_image['url'] ?>')"></div>
      <div class="banner-text">
        <?php if ($banner_text) { ?>
        <div class="wrapper">
          <div class="title"><span><?php echo $banner_text ?></span></div>
        </div>
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
          <div class="title <?php echo $color ?>"><span><?php echo $secondary ?></span></div>
        </div>
      </div>
    </div>
    <?php } ?>
  <?php } ?>

<?php } ?>