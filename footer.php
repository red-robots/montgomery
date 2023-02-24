	</div><!-- #content -->
	<?php  
	$footer_logo = get_field("footer_logo","option");
  $footer_widget = get_field("footer_widget","option");
  $address = get_field("address","option");
  $w_title = (isset($footer_widget['widget_title']) && $footer_widget['widget_title']) ? $footer_widget['widget_title'] : '';
  $w_text = (isset($footer_widget['widget_text']) && $footer_widget['widget_text']) ? $footer_widget['widget_text'] : '';
  $social_media = get_social_media();
	?>
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="wrapper">
			<div class="flexwrap">
        <div class="fcol left">
          <?php if ($footer_logo) { ?>
           <div class="footlogo">
             <img src="<?php echo $footer_logo['url'] ?>" alt="<?php echo $footer_logo['title'] ?>">
           </div> 
          <?php } ?>

          <?php if ($address) { ?>
          <address class="address">
            <?php echo $address ?>
          </address> 
          <?php } ?>

          <?php if ($social_media) { ?>
          <div class="social-media">
            <?php foreach ($social_media as $icon) { ?>
            <a href="<?php echo $icon['url'] ?>" target="_blank" arial-label="<?php echo ucwords($icon['type']) ?>"><i class="<?php echo $icon['icon'] ?>"></i></a> 
            <?php } ?>
          </div> 
          <?php } ?>
        </div>

        <?php if ($w_title || $w_text) { ?>
        <div class="fcol right">
          <div class="inner">
            <?php if ($w_title) { ?>
            <div class="wdt-title"><?php echo $w_title ?></div>
            <?php } ?>
            <?php if ($w_text) { ?>
            <div class="wdt-text"><?php echo $w_text ?></div>
            <?php } ?>
          </div>
        </div>
        <?php } ?>

      </div>
		</div>
	</footer><!-- #colophon -->
	
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
