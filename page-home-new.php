<?php
/**
 * Template Name: New Homepage
 */

get_header(); 
$postId = get_the_ID();
?>
<div id="primary" class="content-area-full repeatable-layout ">
	<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>
			
      <?php if( have_rows('home_flexible_content') ) { ?>
        <div class="home-repeatable-blocks">
          <?php $n=1; while( have_rows('home_flexible_content') ): the_row(); ?>
            <?php if( get_row_layout() == 'hero' ) { 
                $hero_type = get_sub_field('hero_type');
                if($hero_type=='image') { 
                  $image = get_sub_field('image');
                  $img_overlay = get_sub_field('img_overlay');
                  $txt_overlay = get_sub_field('text_overlay');
                  $has_overlay = ($img_overlay || $txt_overlay) ? ' has-overlay':'';
                  ?>
                  <div class="hero<?php echo $has_overlay ?>">
                    <figure>
                        <img src="<?php echo $image['url'] ?>" alt="<?php echo $image['title'] ?>" class="hero-image">
                        <?php if ($img_overlay || $txt_overlay) { ?>
                        <div class="overlay">
                          <?php if ($img_overlay) { ?>
                            <div class="img-overlay" style="background-image:url('<?php echo $img_overlay['url'] ?>')"></div> 
                          <?php } ?>
                          <?php if ($txt_overlay) { ?>
                            <div class="text-overlay"><?php echo $txt_overlay ?></div>
                          <?php } ?>
                        </div>
                        <?php } ?>
                    </figure>
                  </div>
                <?php } ?>
            <?php } ?>
          <?php endwhile; ?>
        </div>
      <?php } ?>

		<?php endwhile; ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
