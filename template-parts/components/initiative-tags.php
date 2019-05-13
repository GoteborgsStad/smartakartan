                   <?php $the_tags = get_the_tags(); ?>
                     <?php if ($the_tags): ?>
                          <?php foreach ($the_tags as $key => $value): ?>
                             <a href="<?php echo get_tag_link($value->term_id); ?>" class="button" aria-label="Tag">#<?php echo $value->name; ?> </a>
                          <?php endforeach ?>
                     <?php endif ?>