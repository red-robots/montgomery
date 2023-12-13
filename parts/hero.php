<?php  if( !is_search() ) {
  
	// check new banner
	$banners = get_field("banner");
	$banner_video = get_field("banner_video");
	$banner_type = get_field('banner_type');
	$banner = get_field("banner_image");

	// echo '<pre>';
	// print_r($banners);
	// echo '</pre>';

	if( $banners || $banner_video ) { 

		if($banner_type=='image') {

			$type = ( count($banners) > 1 ) ? 'slideshow':'static';
			include( locate_template('parts/hero-banner-swiper.php') );

		} else {

			include( locate_template('parts/hero-banner-video.php') );

		}

	?>
	<?php } else {  ?>

		<?php if ( is_archive() ) { 

				include( locate_template('parts/hero-archive.php') );

			} else { 

				include( locate_template('parts/hero-page-old.php') );

			} 
		?>
	
	<?php } ?>

<?php } ?>