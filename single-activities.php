<?php
/**
 * The template for displaying all pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package bellaworks
 */
get_header(); ?>

<div id="primary" class="content-area-full generic-layout single-content">
  <main id="main" class="site-main" role="main">

    <?php while ( have_posts() ) : the_post(); ?>
      <div class="wrapper">
        <div class="titlediv typical nomb"><h1 class="page-title"><span><?php the_title(); ?></span></h1></div>
        <?php if ( $intro = get_field('intro') ) { ?>
        <div class="entry-content" style="padding-top: 15px;">
          <?php echo anti_email_spam($intro); ?>
        </div>
        <?php } ?>
      </div>

      <?php  
      $trip_options = get_field('trip_options');
      $pass_options = get_field('pass_options');
      $note_title = get_field('pass_note_title');
      $note_content = get_field('pass_note_content');
      $section_class = ($trip_options && ($pass_options || $note_content )) ? 'half':'full';
      ?>
      <div class="section-trip-options <?php echo $section_class ?>">
        <div class="wrapper">
          <div class="flexwrap f-options">
            
            <?php if ($trip_options) { ?>
            <div class="fxcol fleft">

              <div class="table-data">
                <div class="thead flexwrap">
                  <div class="tbcol c1">OPTIONS</div>
                  <div class="tbcol c2">DIFFICULTY</div>
                  <div class="tbcol c3">QUALIFIER</div>
                </div>
                <div class="tbody">
                <?php foreach ($trip_options as $e) { 
                  $t_title = $e['title'];
                  $t_difficulty = $e['difficulty'];
                  $t_qualifier = $e['qualifier'];
                  $t_description = $e['description'];
                  $t_size = $e['size']; ?>
                  <div class="trow">
                    <div class="flexwrap">
                      <div class="tbcol c1"><?php echo $t_title ?></div>
                      <div class="tbcol c2"><?php echo $t_difficulty ?></div>
                      <div class="tbcol c3"><?php echo $t_qualifier ?></div>
                    </div>
                    <?php if ($t_description || $t_size) { ?>
                    <div class="info">
                       <?php if ($t_description) { ?>
                      <div class="f-desc"><?php echo $t_description ?></div> 
                      <?php } ?>
                      <?php if ($t_size) { ?>
                      <div class="f-size"><?php echo $t_size ?></div> 
                      <?php } ?>
                    </div>
                    <?php } ?>
                  </div>
                <?php } ?>
                </div>
              </div>
            </div>
            <?php } ?>


            <?php if ($pass_options || $note_content) { 
              $passBtn = get_field('pass_button');
              $btnText = (isset($passBtn['title']) && $passBtn['title']) ? $passBtn['title'] : '';
              $btnUrl = (isset($passBtn['url']) && $passBtn['url']) ? $passBtn['url'] : '';
              $btnTarget = (isset($passBtn['target']) && $passBtn['target']) ? $passBtn['target'] : '_self';

              $pass_note_button = get_field('pass_note_button');
              $nBtnLink = ( isset($pass_note_button['url']) && $pass_note_button['url'] ) ? $pass_note_button['url'] : '';
              $nBtnTitle = ( isset($pass_note_button['title']) && $pass_note_button['title'] ) ? $pass_note_button['title'] : '';
              $nBtnTarget = ( isset($pass_note_button['target']) && $pass_note_button['target'] ) ? $pass_note_button['target'] : '_self';
            ?>
            <div class="fxcol fright">
              <?php if ($pass_options) { ?>
              <div class="graybox pass_options">
                <div class="box-title">Pass Options</div> 
                <div class="box-text">
                  <?php foreach ($pass_options as $p) { ?>
                  <div class="p-info">
                    <div class="p-title"><?php echo $p['title'] ?></div>
                    <div class="p-price"><?php echo $p['price'] ?></div>
                  </div>
                  <?php } ?>
                  <?php if ($btnText && $btnUrl) { ?>
                  <div class="buttondiv">
                    <a href="<?php echo $btnUrl ?>" target="<?php echo $btnTarget ?>" class="button-outline"><?php echo $btnText ?></a>
                  </div> 
                  <?php } ?>
                </div>
              </div> 
              <?php } ?>

              <?php if ($note_content) { ?>
              <div class="graybox notes">
                <?php if ($note_title) { ?>
                <div class="box-title"><?php echo $note_title ?></div> 
                <?php } ?>
                <div class="box-text">
                  <div class="text"><?php echo anti_email_spam($note_content); ?></div>
                  <?php if ($nBtnLink && $nBtnTitle) { ?>
                  <div class="buttondiv mt-25">
                    <a href="<?php echo $nBtnLink ?>" target="<?php echo $nBtnTarget ?>" class="button-outline"><?php echo $nBtnTitle ?></a>
                  </div> 
                  <?php } ?>
                </div>
              </div> 
              <?php } ?>
            </div>
            <?php } ?>

          </div>
        </div>
      </div> 


      <?php if ($additional_information = get_field('additional_information')) { 
        $infoBg = get_field('additional_information_bg');
        $bgStyle = ($infoBg) ? ' style="background-image:url('.$infoBg['url'].')"':'';
      ?>
      <div class="section-additional-information"<?php echo $bgStyle ?>>
        <div class="wrapper">
          <h2 class="stitle">ADDITIONAL INFORMATION</h2>
          <div class="accordions">
          <?php $i=1; foreach ($additional_information as $a) { ?>
            <?php if ($a['title'] && $a['text']) { ?>
            <div class="acc-item<?php echo ($i==1) ? ' active first':'' ?>">
              <div class="title"><a href="javascript:void(0)"><?php echo $a['title'] ?></a></div>
              <div class="text"><?php echo $a['text'] ?></div>
            </div> 
            <?php $i++; } ?>
          <?php } ?>
          </div>
        </div>
      </div>
      <?php } ?>

    <?php endwhile; ?>

  </main><!-- #main -->
</div><!-- #primary -->

<script>
jQuery(document).ready(function($){

});

var handles = document.querySelectorAll('.acc-item .title');
for (var i = 0; i < handles.length; i++) {
  handles[i].addEventListener('click', function(e) {
    var textPanel = e.target.parentNode.nextElementSibling;
    var wrap = e.target.parentNode.parentNode;
    wrap.classList.toggle("active");
  });
}
</script>
<?php
get_footer();
