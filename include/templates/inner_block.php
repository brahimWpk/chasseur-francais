<div class="row">
	<div class="he-inner-block">
		<?php
		global $post;
		foreach ($posts as $post) {
			setup_postdata($post);
			$title = get_the_title();
			$link = get_the_permalink();
			$cat = RW_Category::get_permalinked_category(get_the_ID(), true);
			$thumbnail = get_the_post_thumbnail(get_the_ID(), 'rw_medium');
			$cat_link = get_category_link($cat);
			$date = get_the_date();
			?>
				<div class="col-xs-12 col-sm-4 col-md-4 post_item_<?php echo get_the_ID(); ?>">
					<div class="post_item post_simple">
						<div class="post_item_img">
							<a href="<?php echo $link; ?>">
								<?php echo $thumbnail; ?>
							</a>
						</div>
						<div class="post_item_txt">
							<span class="post-date"><?php echo $date; ?></span>
							<a class="post_item_cat" href="<?php echo $cat_link;?>"><?php echo $cat->name; ?></a>
							<a href="<?php echo $link; ?>">
								<h3 class="post_item_title"><?php echo $title; ?></h3>
							</a>
						</div>
					</div>
				</div>
			<?php
		}
		wp_reset_postdata();
		?>
	</div>
</div>