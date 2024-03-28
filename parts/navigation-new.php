<div id="site-navigation" class="main-navigation" role="navigation">
<span id="closeMenu" class="menu-toggle"><span class="bar"></span></span>
<?php if( have_rows('navigation_items', 'option') ) { ?>
  <ul id="primary-menu" class="menu menu-custom">
  <?php $n=1; while( have_rows('navigation_items', 'option') ): the_row(); ?>
  <?php if( get_row_layout() == 'navlink' ) {  ?>
      <?php 
      $link_type = get_sub_field('link_type');
      if($link_type=='link') { 
        $link = get_sub_field('link'); 
        $btnTitle = (isset($link['title']) && $link['title']) ? $link['title'] : '';
        $btnUrl = (isset($link['url']) && $link['url']) ? $link['url'] : '';
        $btnTarget = (isset($link['target']) && $link['target']) ? $link['target'] : '_self';
        ?>
        <li>
          <a href="<?php echo $btnUrl ?>" target="<?php echo $btnTarget ?>"><?php echo $btnTitle ?></a>
        </li>
      <?php } 
        else if($link_type=='dropdown') { 
          $dropdown_title = get_sub_field('dropdown_title'); 
          $dropdowns = get_sub_field('dropdown'); 
          if($dropdown_title) { ?>
          <li class="has-sub-items">
            <a href="javascript:void(0)" data-link="#submenu-items-<?php echo $n ?>"><?php echo $dropdown_title ?> <i class="fa-solid fa-plus"></i></a>
            <?php if ($dropdowns) { ?>
            <div id="submenu-items-<?php echo $n ?>" class="submenu-items">
              <button class="goBackToNav" aria-label="Go Back to Main Navigation"><i class="fa-solid fa-arrow-left-long"></i></button>
              <?php foreach ($dropdowns as $d) { 
                $heading = $d['heading'];
                $hLink = $d['headingLink'];

                $headingLink = (isset($hLink['url']) && $hLink['url']) ? $hLink['url'] : '';
                $headingLinkTarget = (isset($hLink['target']) && $hLink['target']) ? '_blank' : '_self';

                $menulinks = $d['dropdown'];
                $sublink_type = $d['sublink_type'];
                $link2 = $d['page_link'];
                if($sublink_type=='list') { ?>
                  <div class="items">
                    <?php if ($heading) { ?>
                      <div class="menu-heading">
                        <?php if ($headingLink) { ?>
                          <a href="<?php echo $headingLink ?>" target="<?php echo $headingLinkTarget ?>" class="headingLink"><?php echo $heading ?></a>
                        <?php } else { ?>
                          <?php echo $heading ?>
                        <?php } ?>
                      </div>
                    <?php } ?>
                    <?php if ($menulinks) { ?>
                      <ul class="menulink">
                        <?php foreach ($menulinks as $m) { 
                          $mlink = $m['link'];
                          $mTitle = (isset($mlink['title']) && $mlink['title']) ? $mlink['title'] : '';
                          $mUrl = (isset($mlink['url']) && $mlink['url']) ? $mlink['url'] : '';
                          $mTarget = (isset($mlink['target']) && $mlink['target']) ? $mlink['target'] : '_self';
                          if($mTitle && $mUrl) { ?>
                          <li>
                            <a href="<?php echo $mUrl ?>" target="<?php echo $mTarget ?>"><?php echo $mTitle ?></a>
                          </li> 
                          <?php } ?>
                        <?php } ?>
                      </ul>
                    <?php } ?>
                  </div>
                <?php } else { 
                    $sbBtnTitle = (isset($link2['title']) && $link2['title']) ? $link2['title'] : '';
                    $sbBtnUrl = (isset($link2['url']) && $link2['url']) ? $link2['url'] : '';
                    $sbBtnTarget = (isset($link2['target']) && $link2['target']) ? $link2['target'] : '_self';
                    if($sbBtnTitle && $sbBtnUrl) { ?>
                      <div class="items page_link">
                        <div class="menu-heading"><a href="<?php echo $sbBtnUrl ?>" target="<?php echo $sbBtnTarget ?>"><?php echo $sbBtnTitle ?></a></div>
                      </div>
                    <?php } ?>
                <?php } ?>
              <?php } ?>
            </div>
            <?php } ?>
          </li>
        <?php } ?>
      <?php } ?>
    <?php } ?>
  <?php $n++; endwhile; ?>
  </ul>
<?php } ?>


<?php if( $rr_btn_menu ){  ?>
  <div class="menu-cta-btn"><?php echo $rr_btn_menu; ?></div>
<?php } ?>
<?php if( $activities_link ){ ?>
  <div class="menu-cta-btn mobile"><a href="<?php echo $a_link; ?>"><?php echo $activities_link; ?></a></div>
<?php } ?>
</div><!-- #site-navigation -->
<div id="subMenuContainer"></div>
<div id="navOverlay"></div>