<?php
/**
 * Template Name: Custom Layout
 */
get_header(); ?>

<div id="primary" class="content-area-full custom-layout">
	<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php if ( !$banner ) { ?>
			<div class="titlediv wrapper">
				<h1 class="page-title"><?php the_title(); ?></h1>
			</div>
			<?php } ?>
			
      <?php if ( get_the_content() ) { ?>
      <div class="entry-content">
        <?php the_content(); ?>
      </div> 
      <?php } ?>

		<?php endwhile; ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
