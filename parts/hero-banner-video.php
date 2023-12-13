<?php if( $banner_video = get_field('banner_video') ) { 
	$type = pathinfo($banner_video);
	$videoFormat = array('mp4','mov','webm');
	$extension = ( isset($type['extension']) && $type['extension'] ) ? strtolower($type['extension']) : '';
	$vidTextType = get_field('banner_video_overlay');
	$vidTextContent = get_field('banner_video_caption_text');
	$vidImageDesktop = get_field('banner_video_caption_image_desktop');
	$vidImageMobile = get_field('banner_video_caption_image_mobile');

	$vidMobile = get_field('banner_video_mobile');

	if( in_array($extension,$videoFormat) ) { ?>
	<div class="banner-video <?php echo ($vidMobile) ? 'has-mobile-video':'no-mobile-video'?>">
	<div class="banner-inner">
	  <video class="video-desktop" width="400" autoplay muted loop>
	    <source src="<?php echo $banner_video ?>" type="video/<?php echo $extension ?>">
	    Your browser does not support HTML video.
	  </video>
	  <?php if ($vidMobile) { ?>
	  <video class="video-mobile" width="400" autoplay muted loop>
	    <source src="<?php echo $banner_video ?>" type="video/<?php echo $extension ?>">
	    Your browser does not support HTML video.
	  </video>
	  <?php } ?>
	  <?php if ($vidTextType=='image') { ?>

	    <?php if ($vidImageDesktop) { ?>
	    <div class="video-caption type-image">
	      <div class="video-inner">
	        <figure>
	          <img src="<?php echo $vidImageDesktop['url'] ?>" alt="<?php echo $vidImageDesktop['title'] ?>" class="img-desktop">

	          <?php if ($vidImageMobile) { ?>
	          <img src="<?php echo $vidImageMobile['url'] ?>" alt="<?php echo $vidImageMobile['title'] ?>" class="img-mobile">
	          <?php } else { ?>
	          <img src="<?php echo $vidImageDesktop['url'] ?>" alt="<?php echo $vidImageDesktop['title'] ?>" class="img-mobile">
	          <?php } ?>
	        </figure>
	      </div>
	    </div>
	    <?php } ?>

	  <?php } else if( $vidTextType=='text' ) { ?>

	    <?php if ($vidTextContent) { ?>
	    <div class="video-caption type-text">
	      <div class="video-inner">
	        <div class="video-text"><?php echo $vidTextContent ?></div>
	      </div>
	    </div>
	    <?php } ?>

	  <?php } ?>
	</div>  
	</div>
	<?php } ?>
<?php } ?>