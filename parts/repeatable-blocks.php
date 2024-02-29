<?php if( have_rows('repeatable_blocks') ) { ?>
      <div class="repeatable-blocks">
        <?php $n=1; while( have_rows('repeatable_blocks') ): the_row(); ?>
          <?php if( get_row_layout() == 'fullwidth_content' ) { 
            $title = get_sub_field('title');
            $content = get_sub_field('content');
            $button = get_sub_field('button'); 
            $btn_target = (isset($button['target']) && $button['target']) ? $button['target'] : '_self';
            $btn_title = (isset($button['title']) && $button['title']) ? $button['title'] : '';
            $btn_url = (isset($button['url']) && $button['url']) ? $button['url'] : '';
            $button_center = get_sub_field('button_center');

            if($title || $content) { ?>
            <div class="repeatable fullwidth <?php echo ($title) ? 'has-subtitle':'no-subtitle' ?>">
              <div class="wrapper">
              <?php if ($title) { ?><h2 class="h2"><?php echo $title ?></h2><?php } ?>
              <?php if ($content) { ?><div class="text font16"><?php echo anti_email_spam($content) ?></div><?php } ?>
              <?php if ($btn_title && $btn_url) { ?>
              <div class="buttondiv <?php echo ($button_center) ? 'center':'left' ?>">
                <a href="<?php echo $btn_url ?>" target="<?php echo $btn_target ?>" class="button"><?php echo $btn_title ?></a>
              </div>  
              <?php } ?>
              </div>
            </div>
            <?php } ?> 
          <?php } else if ( get_row_layout() == 'image_and_text' ) { 
            $title = get_sub_field('title');
            $content = get_sub_field('content');
            $image = get_sub_field('image'); 
            $imageSize = get_sub_field('image_size'); 
            $text_alignment = get_sub_field('text_alignment'); 
            $rocket_rez_button = get_sub_field('rocket_rez_button'); 

            $col = ( ($title || $content) && $image ) ? 'half':'full';
            $col .= ($n % 2==0) ? ' even':' odd';
            $col .= ($imageSize) ? ' orig-size':' crop-size';
            $col .= ($text_alignment) ? ' text-'.$text_alignment:' text-left';

            $button = get_sub_field('button'); 
            $btn_target = (isset($button['target']) && $button['target']) ? $button['target'] : '_self';
            $btn_title = (isset($button['title']) && $button['title']) ? $button['title'] : '';
            $btn_url = (isset($button['url']) && $button['url']) ? $button['url'] : '';
            ?>
            <div class="repeatable text-image <?php echo $col ?>">
              <div class="wrapper">
                <div class="flexwrap">
                  <?php if ($title || $content) { ?>
                  <div class="textcol">
                    <?php if ($title) { ?><h2 class="h2"><?php echo $title ?></h2><?php } ?>
                    <?php if ($content) { ?><div class="text font16"><?php echo anti_email_spam($content) ?></div><?php } ?>

                    <?php if ($btn_title && $btn_url) { ?>
                    <div class="buttondiv">
                      <a href="<?php echo $btn_url ?>" target="<?php echo $btn_target ?>" class="button"><?php echo $btn_title ?></a>
                    </div>  
                    <?php } ?>
                    <?php if( $rocket_rez_button ) { ?>
                      <br>
                      <?php echo $rocket_rez_button; ?>
                    <?php } ?>
                  </div>  
                  <?php } ?>

                  <?php if ($image) { ?>
                  <div class="imagecol">
                    <figure style="background-image:url(<?php echo $image['url'] ?>)">
                      <img src="<?php echo get_stylesheet_directory_uri() ?>/images/rectangle.png" alt="" class="helper">
                      <img src="<?php echo $image['url'] ?>" alt="<?php echo $image['title'] ?>" class="actual">
                    </figure>
                  </div>  
                  <?php } ?>
                </div>
              </div>
            </div>
          <?php $n++; } else if ( get_row_layout() == 'grid_layout' ) {  
            $blocks = get_sub_field('blocks'); ?> 
            <div class="repeatable grid-layout">
              <div class="wrapper">
                <div class="flexwrap blocks">
                  <?php foreach ($blocks as $b) { 
                    $title = $b['title'];
                    $text = $b['text'];
                    $btn = $b['button'];
                    $btnTitle = (isset($btn['title']) && $btn['title']) ? $btn['title'] : '';
                    $btnLink = (isset($btn['url']) && $btn['url']) ? $btn['url'] : '';
                    $btnTarget = (isset($btn['target']) && $btn['target']) ? $btn['target'] : '_self';
                    $image = $b['image'];
                    ?>
                    <div class="block">
                      <div class="inside <?php echo ($image) ? 'has-image':'no-image' ?>">
                        <?php if ($image) { ?>
                        <div class="bImage">
                          <figure style="background-image:url('<?php echo $image['url'] ?>')">
                            <img src="<?php echo get_stylesheet_directory_uri() ?>/images/rectangle-lg.png" alt="">
                          </figure>
                        </div>
                        <?php } ?>
                        <div class="desc">
                          <?php if ($title) { ?>
                          <div class="bTitle"><?php echo $title ?></div>
                          <?php } ?>
                          <?php if ($text) { ?>
                          <div class="bText"><?php echo $text ?></div>
                          <?php } ?>
                          <?php if ($btnTitle && $btnLink) { ?>
                          <div class="buttondiv">
                            <a href="<?php echo $btnLink ?>" target="<?php echo $btnTarget ?>" class="button"><?php echo $btnTitle ?></a>
                          </div>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                  <?php } ?>
                </div>
              </div>
            </div>
          <?php } else if ( get_row_layout() == 'single_image_block' ) { ?>

            <?php if ( $image = get_sub_field('image') ) { 
              $lightbox = get_sub_field('lightbox'); ?>
              <figure class="repeatable-single-image">
                <?php if($lightbox) { ?>
                  <a href="<?php echo $image['url'] ?>" data-fancybox="gallery"><img src="<?php echo $image['url'] ?>" alt="<?php echo $image['title'] ?>" /></a>
                <?php } else { ?>
                  <img src="<?php echo $image['url'] ?>" alt="<?php echo $image['title'] ?>" />
                <?php } ?>
              </figure>
            <?php } ?>

          <?php } else if ( get_row_layout() == 'slider' ) {  
            $gallery = get_sub_field('gallery_slider'); ?>
            <div class="caro-wrap">
            <div class="owl-carousel">
              <?php foreach( $gallery as $img ) { ?>
                <div>
                  <img src="<?php echo $img['url']; ?>" alt="<?php echo $img['alt']; ?>">
                </div>
              <?php } ?>
            </div>
            </div>

          <?php } else if ( get_row_layout() == 'faqs' ) { ?>
              <?php if ($additional_information = get_sub_field('faq_toggles')) { 
                $sTitle = get_sub_field('section_title');
                // $bgStyle = ($infoBg) ? ' style="background-image:url('.$infoBg['url'].')"':'';
              ?>
              <div class="section-additional-information"<?php echo $bgStyle ?>>
                <div class="wrapper">
                  <?php if( $sTitle ){ ?>
                    <h2 class="stitle"><?php echo $sTitle; ?></h2>
                  <?php } ?>
                  <div class="accordions">
                  <?php $i=1; foreach ($additional_information as $a) { ?>
                    <?php if ($a['question'] && $a['answer']) { ?>
                    <div class="acc-item<?php echo ($i==1) ? ' active first':'' ?>">
                      <div class="title"><a href="javascript:void(0)"><?php echo $a['question'] ?></a></div>
                      <div class="text"><?php echo $a['answer'] ?></div>
                    </div> 
                    <?php $i++; } ?>
                  <?php } ?>
                  </div>
                </div>
              </div>
              <?php } ?>
          <?php } ?>

        <?php endwhile; ?>
      </div>
<?php } ?>
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