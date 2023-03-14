<?php if( have_rows('accordions') ) { ?>
<div class="accordions-section">
  <?php while( have_rows('accordions') ): the_row(); 
    if( get_row_layout() == 'accordion' ) { 
      $heading = get_sub_field('heading');
      $questions = get_sub_field('questions');
      ?>
      <div class="accordion">
        <?php if ($heading) { ?>
        <h2 class="acc-title"><?php echo $heading ?></h2>  
        <?php } ?>

        <?php if ($questions) { ?>
        <div class="questions">
          <?php foreach ($questions as $q) { ?>
            <?php if ($q['question'] && $q['answer']) { ?>
              <div class="q-item">
                <h3 class="q-title"><a href="javascript:void(0)"><?php echo $q['question'] ?><span class="icon"></span></a></h3>
                <div class="q-text"><?php echo $q['answer'] ?></div>
              </div>  
            <?php } ?>
          <?php } ?>
        </div>
        <?php } ?>
      </div>
    <?php } ?>

  <?php endwhile; ?>
</div>
<?php } ?>