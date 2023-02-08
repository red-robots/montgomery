<?php if ( is_front_page() || is_home() ) { 
  if( $banners = get_field('banner') ) { 
    $type = ( count($banners) > 1 ) ? 'slideshow':'static';
  ?>
  <div class="banners <?php echo $type ?>">
    <?php foreach ($banners as $b) { 
      $img = $b['image'];
      $text = $b['text'];
      if($img) { ?>
        <div class="banner" style="background-image:url('<?php echo $img['url'] ?>')">
          <?php if ($text) { ?>
          <div class="text"><div class="pad"><?php echo $text ?></div></div> 
          <?php } ?>
        </div>
      <?php } ?>
    <?php } ?>
  </div>
  <?php } ?>
<?php } ?>
