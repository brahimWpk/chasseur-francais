<?php
global $post;
if(empty($bloc['category'])){
	global $wp_query;
	$queried_object = $wp_query->queried_object;
	$bloc['category'] = $queried_object->term_id;
	$current_cat_name = $queried_object->name;
}else{
	$current_cat_name = get_cat_name($bloc['category']);
}
if( !empty($bloc['category']) ){	
	include(locate_template('include/templates/categories_liste.php'));
}
?>

<div class="row">
	<div class="post col-xs-12 col-sm-6">
		<?php
		global $posts_exclude ;
		$post = $bloc["post_push"];
		setup_postdata($post);
		$size = "rw_medium";
		include(locate_template('include/templates/block_post.php'));
		wp_reset_postdata();
		?>
	</div>

	<?php
	$bloc['posts'] = apply_filters('articles_block', $bloc['posts'], $bloc['category']) ;

	foreach ($bloc['posts'] as $post) {
		setup_postdata($post);
		?>
		<div class="post col-xs-12 col-sm-6">
			<?php
			$size = "rw_medium";
			include(locate_template('include/templates/block_post.php'));
			?>
		</div>
		<?php 
		do_action('after_item_hp_bloc_rubrique');
	}
	wp_reset_postdata();
	?>
</div>