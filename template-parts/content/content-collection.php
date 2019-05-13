<?php
/**
 *
 */
?>

<?php $featured_posts =  get_field('collection_of_posts', $post->ID); ?>
<?php $container = array(); ?>

<?php foreach ($featured_posts as $key => $url):  ?>

	<?php $itemID = url_to_postid($url);  ?>
	<?php  $tagofthecollections = get_the_tags($itemID); ?>

<?php endforeach; ?>

<?php foreach ($tagofthecollections as $key => $value):  ?>

	<?php 	array_push($container, $value->name); ?>

<?php endforeach; ?>

<div class="featured-holder grid-item grid-item--width2" style="background-color: <?php echo get_field('background_for_collection_on_start', $post->ID) ?>">

	<h5><?php echo get_the_title($post->ID); ?></h5>

	<div class="featured scroll-y">

		<article id="post-<?php echo get_the_ID(); ?>" class="featured-main">

			<a href="<?php the_permalink(); ?>"  aria-label="Link to post">

				<div class="card card-shop card-image"  style="background-image: url('<?php echo get_the_post_thumbnail_url($post->ID); ?>')">

				  <div class="card-body">

					<div class="entry-content">

						<h1><?php echo get_field('text_for_startpage_card', $post->ID); ?></h1>

				 		<div class="buttons">

							<?php

								foreach($tagofthecollections as $tags)
								 {
							   echo '<a href=" ' . get_tag_link($tags->term_id) . ' " class="button" aria-label="Tag">' . $tags->name . '</a>';
							  } ?>

						</div>

					</div><!-- .entry-content -->

				  </div><!--  .card-body -->

				</div> <!-- card -->

			</a>

		</article><!-- Featured Main-->

		<?php foreach ($featured_posts as $key => $url) {
			$ID = url_to_postid($url);
			$thepost = get_post( $ID ); ?>

			<article id="post-<?php echo $ID; ?>" class="featured-scroll">

					<a href="<?php the_permalink(); ?>">

						<div class="card card-shop">

							<div class="card-image card-img-top" style="background-image: url('<?php echo get_the_post_thumbnail_url($ID); ?>')">

							</div>

						  <div class="card-body">

						  	<div class="category-name">
			            		<?php $category_detail=get_the_category($ID);
									foreach($category_detail as $cd){
										echo $cd->cat_name;
									} ?>
			       			</div>

						    <h5 class="card-title"><?php echo get_the_title($ID); ?></h5>

							<div class="entry-content">

								<p>Gatuadress Ort om möjligt</p>

								<p><?php the_field('underrubrik', $ID); ?></p>

						 		<div class="buttons">

						 			<?php
										// global $post;
										// foreach($tagsOfCollection as $tags)
										//  {
									 //  echo '<a href=" ' . get_tag_link($tags->term_id) . ' " class="button">' . $tags->name . '</a>';
									 // }
									 ?>

								</div>

							</div><!-- .entry-content -->

						  </div><!--  .card-body -->

						</div> <!-- card -->

					</a>

				</article><!-- #post-## -->

		<?php } ?>

	</div>

</div> <!-- .featured-holder -->
