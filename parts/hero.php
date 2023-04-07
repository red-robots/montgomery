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
        $banner_logo_mobile = $b['banner_logo_mobile'];
        $banner_class = ( $banner_logo && $text ) ? ' logo-and-text':'';
        if($img) { ?>
          <div class="swiper-slide banner<?php echo $banner_class ?>" style="background-image:url('<?php echo $img['url'] ?>')">
            <?php if ($banner_logo || $text) { ?>
            <div class="banner-content">
              <div class="banner-inner">
                <?php if ($banner_logo) { ?>
                <div class="banner-logo">
                  <img src="<?php echo $banner_logo['url'] ?>" alt="<?php echo $banner_logo['title'] ?>" class="banner-logo-desktop">
                  <?php if ($banner_logo_mobile) { ?>
                  <img src="<?php echo $banner_logo_mobile['url'] ?>" alt="<?php echo $banner_logo_mobile['title'] ?>" class="banner-logo-mobile">
                  <?php } ?>
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
    $page_title = (isset($obj->name) && $obj->name) ? $obj->name : '';
    $banner_image = '';
    $banner_text = '';
    if( isset($obj->name) && $obj->name=='tribe_events' ) {
      $banner_image = get_field("calendar_banner_image","option");
      $banner_text = get_field("calendar_banner_text","option");
    } 
    else {
      $current_term_id = $obj->term_id;
      //$banner_text = $obj->name;
      $taxonomy = $obj->taxonomy;
      $banner_image = get_field("category_image",$taxonomy.'_'.$current_term_id);
    }

    // echo "<pre>";
    // print_r( $obj );
    // echo "</pre>";

    if(isset($obj->name) && $obj->name=='tribe_events') {
      if( $banner_text ) {
        $page_title = $banner_text;
      } else {
        $page_title = $obj->label;
      }
      $banner_text = '';
    }

    if($banner_image) { ?>
    <div class="static-banner taxonomy-banner no-banner-title">
      <div class="banner-image" style="background-image:url('<?php echo $banner_image['url'] ?>')"></div>
      <?php if ($banner_text) { ?>
      <div class="banner-text">
        <div class="wrapper">
          <div class="title"><span><?php echo $banner_text ?></span></div>
        </div>
      </div>
      <?php } ?>
    </div>
    <?php } ?>
    
    <?php 
    //$show_title = (get_post_type()=='tribe_events') ? false : true;
    if(isset($obj->name) && $obj->name=='tribe_events') {
      if($page_title) { ?>
      <div class="titlediv typical tax-title">
        <div class="wrapper"> 
          <h1 class="page-title"><span><?php echo $page_title; ?></span></h1>
        </div>
      </div>
      <?php } ?>
    <?php } ?>
    
  <?php } else { ?>
    <?php if( $banner = get_field("banner_image") ) { ?>
    <?php 
      $titleOpt = get_field('page_title_visibility');
      //$page_title = (get_field("banner_text")) ? get_field("banner_text") : get_the_title();  
      $page_title = (get_field("banner_text")) ? get_field("banner_text") : '';  
      $titleClass = (get_field("banner_text")) ? ' has-custom-title':' default-page-title';
      $color = get_field('banner_text_color');
      /* if page is using a template */
      // $template = get_page_template_slug( get_the_ID() );
      // if( $template ) {
      //   $page_title = (get_field("banner_text")) ? get_field("banner_text") : get_the_title();  
      // } 

      // if($template=='single-custom-template.php') {
      //   $page_title = '';
      // } 

      // if( get_post_type()=='activities' ) {
      //   $page_title = (get_field("banner_text")) ? get_field("banner_text") : get_the_title();
      // }
    ?>
    <div class="static-banner no-banner-title <?php echo $color ?>">
      <div class="banner-image" style="background-image:url('<?php echo $banner['url'] ?>')"></div>
      <?php if ($page_title) { ?>
      <div class="banner-text">
        <div class="wrapper">
          <div class="title <?php echo $color.$titleClass ?>"><span><?php echo $page_title ?></span></div>
        </div>
      </div>
      <?php } ?>
    </div>
    <?php } ?>
  <?php } ?>

<?php } ?>