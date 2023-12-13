<?php if( $banner = get_field("banner_image") ) { ?>
	<?php 
		$titleOpt = get_field('page_title_visibility');
		//$page_title = (get_field("banner_text")) ? get_field("banner_text") : get_the_title();  
		$page_title = (get_field("banner_text")) ? get_field("banner_text") : '';  
		$titleClass = (get_field("banner_text")) ? ' has-custom-title':' default-page-title';
		$color = get_field('banner_text_color');
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