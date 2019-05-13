                    <?php 
                      if (get_field('offline') != 1): ?>
                         <div class="the-map">
                            <?php include(locate_template('/template-parts/map/smartakartan-single.php')); ?>
                                    <!-- link-buttons -->

                        </div>
                    <?php endif ?>
                  
