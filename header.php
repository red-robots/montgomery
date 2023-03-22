<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Work+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?php bloginfo("template_url") ?>/css/jquery.fancybox.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php bloginfo("template_url") ?>/css/select2.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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
<style>
.titlediv {display: none!important;}
</style>
<?php } ?>
<?php wp_head(); ?>
</head>
<body <?php body_class($extra_class); ?>>
<div id="page" class="site cf">
	<div id="overlay"></div>
	<a class="skip-link sr" href="#content"><?php esc_html_e( 'Skip to content', 'bellaworks' ); ?></a>
	<header id="masthead" class="site-header">
		<div class="wrapper cf">
      <div class="head-inner">
        <a href="#" id="menu-toggle" class="menu-toggle" aria-label="Menu Toggle"><span class="sr">Menu</span><span class="bar"></span></a>
        <nav id="site-navigation" class="main-navigation" role="navigation">
          <span id="closeMenu" class="menu-toggle"><span class="bar"></span></span>
          <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu','link_before'=>'<span>','link_after'=>'</span>','container_class'=>'menu-wrapper') ); ?>
        </nav><!-- #site-navigation -->

  			<?php if( get_custom_logo() ) { ?>
          <span class="site-logo"><?php the_custom_logo(); ?></span>
        <?php } else { ?>
          <h1 class="site-logo"><a hef="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h1>
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
        </div>
      </div>
      <div class="searchbar">
        <div class="inner"><?php get_template_part('searchform') ?></div>
      </div>
		</div>
	</header>

	<?php get_template_part('parts/hero'); ?>

	<div id="content" class="site-content">
