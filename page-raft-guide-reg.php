<?php
/**
 * Template Name: Raft Guide Registration
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package bellaworks
 */
$post_type = get_post_type();
$show_title = ($post_type=='tribe_events') ? false : true;
get_header(); 

$eid = get_field('eid');
$id = get_field('id');
$button_name = get_field('button_name');
?>

<div id="primary" class="content-area-full generic-layout">
	<main id="main" class="site-main" role="main">

    <div class="wrapper">
		<?php while ( have_posts() ) : the_post(); ?>

        <?php if ($show_title) { ?>
        <div class="titlediv typical">
          <h1 class="page-title"><span><?php the_title(); ?></span></h1>
        </div>
        <?php } ?>
			
      <div class="entry-content">
        <?php the_content(); ?>
        <!-- Raft Guide School -->
		<div eid="2f3055300179d1b8" id="FlatlandWebEngine"></div>
       </div>
    </div>  

		<?php endwhile; ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
