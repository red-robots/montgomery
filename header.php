<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="stylesheet" href="<?php bloginfo("template_url") ?>/css/jquery.fancybox.min.css?v=1.1">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php bloginfo("template_url") ?>/css/select2.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css2?family=Anton&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Libre+Caslon+Text:ital,wght@0,400;0,700;1,400&family=Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap">



<?php if ( is_singular(array('post')) ) { 
global $post;
$post_id = $post->ID;
$thumbId = get_post_thumbnail_id($post_id); 
$featImg = wp_get_attachment_image_src($thumbId,'full'); ?>
<!-- SOCIAL MEDIA META TAGS -->
<meta property="og:site_name" content="<?php bloginfo('name'); ?>"/>
<meta property="og:url"		content="<?php echo get_permalink(); ?>" />
<meta property="og:type"	content="article" />
<meta property="og:title"	content="<?php echo get_the_title(); ?>" />
<meta property="og:description"	content="<?php echo (get_the_excerpt()) ? strip_tags(get_the_excerpt()):''; ?>" />
<?php if ($featImg) { ?>
<meta property="og:image"	content="<?php echo $featImg[0] ?>" />
<?php } ?>
<!-- end of SOCIAL MEDIA META TAGS -->
<?php } ?>
<script>
var siteURL = '<?php echo get_site_url();?>';
var currentURL = '<?php echo get_permalink();?>';
var params={};location.search.replace(/[?&]+([^=&]+)=([^&]*)/gi,function(s,k,v){params[k]=v});
</script>
<?php
global $obj;
$obj = ( is_archive() ) ? get_queried_object() : '';
$extra_class = ( get_field("banner_image") ) ? 'has-banner':'no-banner';
if( get_field("banner_image")  ) { ?>
<style>.titlediv:not(.typical) {display: none!important;}</style>
<?php } ?>

<?php if ( isset($obj->name) && $obj->name=='tribe_events' ) { 
$extra_class = ( get_field("calendar_banner_image","option") ) ? 'has-banner':'no-banner';  
} ?>

<?php 
$titleOpt = get_field('page_title_visibility');
if ( $titleOpt=='hide' ) { ?>
<style>.titlediv,h1.page-title,.default-page-title {display: none!important;}</style>
<?php } ?>

<?php 
wp_head(); 

$rr_btn_menu = get_field('rr_btn_menu', 'option');
$activities_link = get_field('activities_link', 'option');
$a_link = get_bloginfo('url') . '/event/hours-of-operation-' . date("m-d-y") . '/';

$trail_status = get_field('trail_status', 'option');
if( $trail_status == 'open' ) {
  $trailText = 'Trails Open';
  $trailSquare = 'green';
} else {
  $trailText = 'Trails Closed';
  $trailSquare = 'red';
}
?>
</head>
<body <?php body_class($extra_class); ?>>
<div id="page" class="site cf">
	<div id="overlay"></div>
	<a class="skip-link sr" href="#content"><?php esc_html_e( 'Skip to content', 'bellaworks' ); ?></a>
	<header id="masthead" class="site-header">
    <div class="trail-bar">
      <div class="trail-wrapper">
        <div class="trails">
          <div class="trail-text"><?php echo $trailText; ?></div><div class="trailsquare <?php echo $trailSquare; ?>">&nbsp;</div>
        </div>
      </div>
    </div>
		<div class="wrapper cf">
      <div class="head-inner">
        <a href="#" id="menu-toggle" class="menu-toggle" aria-label="Menu Toggle"><span class="sr">Menu</span><span class="bar"></span></a>

        <?php  
        $new_navigation = get_field('enable_new_navigation','option');
        if($new_navigation=='on') { ?>
          <?php include( locate_template('parts/navigation-new.php') );  ?>
        <?php } else { ?>

          <nav id="site-navigation" class="main-navigation" role="navigation">
            <span id="closeMenu" class="menu-toggle"><span class="bar"></span></span>
            <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu','link_before'=>'<span>','link_after'=>'</span>','container_class'=>'menu-wrapper') ); ?>
            <?php if( $rr_btn_menu ){  ?>
              <div class="menu-cta-btn"><?php echo $rr_btn_menu; ?></div>
            <?php } ?>
            <?php if( $activities_link ){ ?>
              <div class="menu-cta-btn mobile"><a href="<?php echo $a_link; ?>"><?php echo $activities_link; ?></a></div>
            <?php } ?>
          </nav><!-- #site-navigation -->

        <?php } ?>

        <?php $mobileLogo = get_field('logo_mobile','option'); ?>
        <?php if ($mobileLogo) { ?>
        <span class="site-logo mobile">
          <a href="<?php bloginfo('url'); ?>" class="custom-logo-link" rel="home"><img src="<?php echo $mobileLogo['url'] ?>" alt="<?php echo $mobileLogo['title'] ?>"></a>
        </span>
        <?php } ?>
  			<?php if( get_custom_logo() ) { ?>
          <span class="site-logo desktop"><?php the_custom_logo(); ?></span>
        <?php } else { ?>
          <h1 class="site-logo desktop"><a hef="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
        <?php } ?>

        <div class="headtopright">
            
          <?php if(function_exists('wp_forecast')) { ?>
            <span class="weatherInfo">
              <span class="live-forecast"><?php wp_forecast('A'); ?></span>
              <span class="weather-icon"></span>
              <span class="fahrenheit"></span>
            </span>
          <?php } ?>


          <a href="#" id="topsearchBtn" class="search-button"><i class="search-icon">Search</i></a>
          <?php 
          $header_button = get_field('header_cta_button','option'); 
          $btn_target = (isset($header_button['target']) && $header_button['target']) ? $header_button['target'] : '_self';
          $btn_text = (isset($header_button['title']) && $header_button['title']) ? $header_button['title'] : '';
          $btn_link = (isset($header_button['url']) && $header_button['url']) ? $header_button['url'] : '';
          if ($btn_text && $btn_link) { ?>
          <a href="<?php echo $btn_link ?>" target="<?php echo $btn_target ?>" class="head-button"><?php echo $btn_text ?></a>
          <?php } ?>

          <?php if($new_navigation=='on') { ?>
            <?php $buttonLabel = get_field('book_button_label','option'); ?>
            <?php if ($buttonLabel) { ?>
            <div class="header-link">
              <!-- <button type="button" class="rocketrez-web-engine-button button" eid="b51df41873cb0f76" id="rafting"><?php echo $buttonLabel ?></button> -->
              <div class=""><a href="<?php bloginfo('url'); ?>/buy/" class="button">Book an Activity</a></div>
            </div>
            <?php } ?>
          <?php } else { ?>
            <?php if( $activities_link ){ ?>
              <div class="header-link">
                <a href="<?php echo $a_link; ?>"><?php echo $activities_link; ?></a>
              </div>
            <?php } ?>
          <?php } ?>

        </div>

      </div>
      <div class="searchbar">
        <div class="inner"><?php get_template_part('searchform') ?></div>
      </div>
      
		</div>
	</header>

	<?php get_template_part('parts/hero'); ?>

	<div id="content" class="site-content">
