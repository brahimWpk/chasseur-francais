<?php
if( get_param_global('truncate_text') ){
	$title = $post->post_title;
	$title = apply_filters( 'block_post_title' , $title);
}
else{
	$title = strip_tags(mini_title_for_lines(26 , 2));
}
$cat_link = get_menu_cat_link($post, "link_cat", false, false, true);
$link = get_permalink();
?>

<div class="post_img">
	<a href="javascript:void(0);" title="<?php echo $post->post_title ;?>" data-href="<?php echo $link; ?>">
		<?php 
		if ( has_post_thumbnail(get_the_ID()) ){
			$yoast_wpseo_title = get_post_meta( get_the_ID(), "_yoast_wpseo_title", true );
			if( $yoast_wpseo_title != "" ){
				$img_attr = array( 'alt' => $yoast_wpseo_title );
			}else{
				$img_attr = array();
			}
			echo get_the_post_thumbnail( get_the_ID(), $size, $img_attr );
		}
		?>
	</a>
</div>
<div class="post_caption <?php echo $have_excerpt; ?>">
	<?php echo apply_filters('block_post_categorie',$cat_link); ?>
	<div class="post_date"><?php echo get_the_date(); ?></div>
	<div class="post_title">	
		<a title="<?php echo $titre;?>" href="<?php echo $link; ?>" >
			<?php echo $title; ?>
		</a>
	</div>
</div>