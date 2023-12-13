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