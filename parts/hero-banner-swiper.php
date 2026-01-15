<?php if( is_front_page() ){
	$cClass = '';
} else {
	$cClass = 'static-banner';
} ?>
<div class="banners swiper <?php echo $type ?> <?php echo $cClass; ?>">
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