<?php
/**
 * Template Name: Contact Us
 */
get_header(); ?>

<div id="primary" class="content-area-full generic-layout contact-page">
	<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>
			<?php
        $intro_content = get_field('intro_content'); 
        $from_content = get_field('from_content');
        $form_shortcode = get_field('form_shortcode');
        $form_div = ($from_content && $form_shortcode) ? 'twocol':'onecol';
      ?>

      <div class="titlediv typical nomb">
        <div class="wrapper">
          <h1 class="page-title"><span><?php the_title(); ?></span></h1>
        </div>
      </div>

      <?php if ($intro_content) { ?>
      <div class="intro-content font16">
        <div class="wrapper"><div class="text"><?php echo $intro_content ?></div></div>
      </div>
      <?php } ?>

      <?php if ($from_content || $form_shortcode) { 
      $bgImg = get_field('from_content_bgimage');
      $bgStyle = ($bgImg) ? ' style="background-image:url('.$bgImg['url'].')"':''; ?>
      <div class="contact-form-section <?php echo $form_div ?>">
        <div class="flexwrap">
          <?php if ($from_content) { ?>
          <div class="fxcol text"<?php echo $bgStyle ?>><div class="inside"><?php echo $from_content ?></div></div>  
          <?php } ?>

          <?php if ($form_shortcode && do_shortcode($form_shortcode) ) { ?>
          <div class="fxcol form"><?php echo do_shortcode($form_shortcode) ?></div>  
          <?php } ?>
        </div>
      </div>
      <?php } ?>


      <?php if( $links = get_field('contact_links') ) { ?>
      <div class="contact-links-section">
        <div class="wrapper">
          <div class="flexwrap">
            <?php foreach ($links as $e) { 
              $icon = $e['icon'];
              $link = $e['link'];
              $url = ( isset($link['url']) && $link['url'] ) ? $link['url'] : 'javascript:void(0)';
              $utitle = ( isset($link['title']) && $link['title'] ) ? $link['title'] : '';
              $utarget = ( isset($link['target']) && $link['target'] ) ? $link['target'] : '_self';
              if($url && $utitle) { ?>
                <div class="link-icon">
                  <a href="<?php echo $url ?>" target="<?php echo $utarget ?>">
                    <?php if ($icon) { ?>
                    <span class="icon"><i style="background-image:url('<?php echo $icon['url'] ?>')"></i></span>
                    <?php } ?>
                    <span class="title"><?php echo $utitle ?></span>
                  </a>
                </div>
              <?php } ?>
            <?php } ?>
          </div>
        </div>
      </div>
      <?php } ?>

		<?php endwhile; ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
