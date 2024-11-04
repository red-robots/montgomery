<?php
/**
 * The template for displaying all pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package bellaworks
 */

$placeholder = THEMEURI . 'images/rectangle.png';
$banner = get_field("banner_image");
$has_banner = ($banner) ? 'hasbanner':'nobanner';
global $post;
get_header(); ?>

<div id="primary" class="content-area-full repeatable-layout <?php echo $has_banner ?>">
	<main id="main" class="site-main " role="main">

		<?php while ( have_posts() ) : the_post(); ?>

		<div class="wrapper">
		<?php if( get_page_template_slug( get_the_ID() ) ) { ?>
        <div class="titlediv">
          <h1 class="page-title"><?php the_title(); ?></h1>
        </div>
      <?php } else { ?>

        <div class="titlediv typical nomb">
          <h1 class="page-title"><span><?php the_title(); ?></span></h1>
        </div>

      <?php } ?>

      <?php if ( get_the_content() ) { ?>
			<div class="entry-content " style="padding-top: 15px;">
				<?php the_content(); ?>
			</div>
      <?php } ?>
      </div>

      <?php include(locate_template( 'parts/repeatable-blocks.php' )); ?>



		<?php endwhile; ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
