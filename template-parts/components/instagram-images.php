<?php $insagram_user_name = get_field('instagram_feed'); ?>

  <?php
    $insta_start  = '@';
    $pos = strpos($insagram_user_name, $insta_start);
      ?>

<?php if ($pos === 0) {
    $insagram_user_name = ltrim($insagram_user_name, '@');
      } ?>

  <?php if(strlen($insagram_user_name)>2): ?>
  <div class="instagram-images">
    <h4>Instagram</h4>
    <div id="instafeed" class="instafeed"></div>

   <script type="text/javascript">
     var instaUser = '<?php echo $insagram_user_name; ?>';
   </script>

  </div>
<?php endif ?>
