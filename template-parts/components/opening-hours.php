<a class="opening-hours" data-toggle="collapse" data-target="#collapseHours" href="#collapseHours">

  <div class="opening-header">

    <?php if(get_field('offline') == 1): ?>
      <span class="area-offline">- <?php pll_e( 'Digital Verksamhet');?></span>
    <?php else: ?>

      <i class="fa fa-clock "></i><span><?php pll_e( 'Öppettider');?></span>
        <?php $hour_now = (date("H") + 2); ?>
        <?php $day = date("l"); ?>
        <?php $today = strtolower($day); ?>

        <?php $field_to_check = $today; ?>
        <?php $allways_open = get_field('allways_open'); ?>
        <?php $is_open_today = get_field($field_to_check); ?>

          <?php if($allways_open): ?>
              <span class="is-open">- <?php pll_e( 'Alltid öppet');?></span><br>
              <span><?php pll_e( 'Ring för att bekräfta öppetider');?></span>
          <?php else: ?>
              <?php if (get_field('can_you_define_your_opening_hours') == 0): ?>
                  <span><?php the_field('text_for_opening_hours'); ?></span>
              <?php elseif ($is_open_today != 'closed' AND !empty($is_open_today) ): ?>
                <?php list($from, $to) = explode('-', $is_open_today); ?>
                    <!-- Check if it is open today -->
                <?php if(($from <= $hour_now) && ($hour_now < $to) ): ?>
                  <span class="is-open">- <?php pll_e( 'Förmodligen öppet');?></span><br>
                  <span><?php pll_e( 'Ring för att bekräfta öppetider');?></span>
                <?php elseif(empty($is_open_today)): ?>
                  <span class="is-closed">- no info</span>
                <?php else: ?>
                  <?php if (get_field('can_you_define_your_opening_hours') == 0): ?>
                    <span><?php the_field('text_for_opening_hours'); ?></span>
                  <?php else: ?>
                    <span class="is-closed">- <?php pll_e( 'Förmodligen Stängt');?></span>
                    <span><?php pll_e( 'Ring för att bekräfta öppetider');?></span>
                  <?php endif ?>
                <?php endif ?>
              <?php else: ?>
                <span class="is-closed">- <?php pll_e( 'Förmodligen Stängt');?></span>
                <span><?php pll_e( 'Ring för att bekräfta öppetider');?></span>
              <?php endif; ?> <!-- allways_open -->
              <?php endif ?>

            </div>
          <?php if(!$allways_open || ( !get_field('can_you_define_your_opening_hours'))  ): ?>
        <div class="collapse" id="collapseHours">

          <?php if(get_field('can_you_define_your_opening_hours') == 1): ?>
            <div class="hours">
                    <div class="opening-day">
                        <span class="week-day"><?php pll_e( 'Måndag:');?></span>

                        <span class="opening-info">
                          <?php if( get_field('monday') ): ?>
                              <?php the_field('monday'); ?>
                              <?php else: ?>
                                - no info
                               <?php endif ?>
                           </span>
                    </div>
                    <div class="opening-day">
                        <span class="week-day"><?php pll_e( 'Tisdag:');?></span>
                        <span class="opening-info">
                          <?php if( get_field('tuesday') ): ?>
                            <?php the_field('tuesday'); ?>
                            <?php else: ?>
                              - no info
                             <?php endif ?>
                            </span>
                    </div>
                    <div class="opening-day">
                        <span class="week-day"><?php pll_e( 'Onsdag');?></span>
                        <span class="opening-info">
                          <?php if( get_field('wednesday') ): ?><?php the_field('wednesday'); ?><?php else: ?>- no info <?php endif ?></span>
                    </div>
                    <div class="opening-day">
                       <span class="week-day"><?php pll_e( 'Torsdag');?></span>
                       <span class="opening-info">
                         <?php if( get_field('thursday') ): ?><?php the_field('thursday'); ?><?php else: ?>- no info <?php endif ?></span>
                    </div>
                    <div class="opening-day">
                        <span class="week-day"><?php pll_e( 'Fredag');?></span>
                        <span class="opening-info">
                          <?php if( get_field('friday') ): ?><?php the_field('friday'); ?><?php else: ?>- no info <?php endif ?></span>
                    </div>
                    <div class="opening-day">
                        <span class="week-day"><?php pll_e( 'Lördag');?></span>
                        <span class="opening-info">
                          <?php if( get_field('saturday') ): ?><?php the_field('saturday'); ?><?php else: ?>- no info <?php endif ?></span>
                    </div>
                    <div class="opening-day">
                        <span class="week-day"><?php pll_e( 'Söndag');?></span>
                        <span class="opening-info">
                          <?php if( get_field('sunday') ): ?><?php the_field('sunday'); ?><?php else: ?>- no info <?php endif ?></span>
                    </div>
            </div> <!-- .hours -->
            </div> <!-- collapseHours -->

            <?php endif; ?>

    <?php endif; ?>

  <?php endif; ?>
</a>
