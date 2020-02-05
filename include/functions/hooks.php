<?php
/**
 * Deco MT
 * Ce fichier contient les actions, les filters et leurs implémentations
 * @author : Souhail.m
 */

///////////////////////////////////////////////////////////////////////////
/////////////////////////////// ACTIONS ///////////////////////////////////
///////////////////////////////////////////////////////////////////////////

add_action('init', 'init_func');
add_action('start_footer', 'add_back_to_tp');
add_action('before_last_post','block_reportages');
add_action('custom_block_push','block_push',10,2);
add_action('cat_title', 'category_title');
add_action('wp','change_template_search');
add_action('before_content_dossiers','bloc_filter');

if(is_dev('fiches_pratiques_115871923')){
	add_action('after_home_block','bloc_practices');
}
///////////////////////////////////////////////////////////////////////////
/////////////////////////////// FILTERS ///////////////////////////////////
///////////////////////////////////////////////////////////////////////////

if ( is_dev( 'ops_lapeyre_mt_shopping_box_150674180' ) ) {
	add_filter( 'shopping_box_query_args', 'shopping_box_query_args_', 10, 3 );
	add_filter( 'display_shopping_box', 'display_shopping_box_', 10, 3 );
	add_action( 'init', function() {
		remove_filter( 'price_format', 'change_price_format' );
	} );
}
add_filter('class_container_replace','make_full_width_content');
add_filter('ask_question', 'sabai_change_form_ask_btn', 10, 2);

add_filter('args_popular','last_post_',10,2);
add_filter('widget_display_callback','change_title_widget_',10,3);
add_filter('option_posts_per_page','real_number_posts_archive');
add_filter('number_posts_rubrique','number_posts_archive',20);
add_filter('menu_child_cats_h1', 'add_folder_title', 10, 2);
add_filter('pagination_js',function(){ return true;});
add_filter('comments_title',  'add_comment_title');

if(is_dev('remonte_articles_he_in_diapo_mt_3702')) {
	add_filter('diaporama_accueil_articles_args', 'add_site_section_id_param', 30, 1);
	add_filter('diapo_hp_filter_post_link_attrs', 'add_target_blank_attr', 10, 2);
	add_filter('diapo_hp_filter_post_cat_attrs', 'add_target_blank_attr', 10, 2);
}
add_filter('partner_filter_dossier_france','add_bliink_to_list_partner');
///////////////////////////////////////////////////////////////////////////
////////////////////////////// FUNCTIONS //////////////////////////////////
///////////////////////////////////////////////////////////////////////////
/**
 * [make_full_width_content description]
 * @param  [type] $class [description]
 * @return [type]        [description]
 */
function make_full_width_content ($class){
	if(is_page('homlyyou')){
		$class="container-fluid";
	}
	return $class;
}
add_filter( 'number_posts_rubrique', 'set_nbr_posts_rubrique_academie', 100 );

/**
* Change Sabai plugin Ask question btn text
* @param $s string
* @param $path string
* @return string
**/
function sabai_change_form_ask_btn($s, $path){
	if($path == "ask"){
		return "Publier ma question";
	}
	return $s;
}

function add_back_to_tp(){
	?>
		<div class="back_to_tp"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images-v3/back_to_tp.png" alt="" title=""/></div>
	<?php
}

function bloc_practices(){
	if(is_home()){
		global $wp_query;
		$practices=array(
					array('name'=>'outils', 'img'=>'outils.jpg'),
					array('name'=>'electricite', 'img'=>'electricite.jpg'),
					array('name'=>'plomberie', 'img'=>'plomberie.jpg'),
					array('name'=>'menuiserie', 'img'=>'menuiserie.jpg'),
					array('name'=>'sols', 'img'=>'sols.jpg'),
					array('name'=>'murs', 'img'=>'murs.jpg'),
					array('name'=>'entretien', 'img'=>'entretien.jpg'),
					array('name'=>'reparations', 'img'=>'reparations.jpg'),
				);
		$link_cat=get_term_link('fiches-pratiques','category');
		$link_cat= !is_wp_error( $link_cat ) ? $link_cat : '';

		if($link_cat){
			?>
			<h2 class="default-title">
				<a href="<?php echo $link_cat;?>">
					<span class="txt_wrapper">Fiches pratiques</span>
				</a>
			</h2>
			<ul class="homeMoreArticles pull_list clearfix fiches-pratiques list-unstyled">
				<?php
				foreach ($practices as $p) {
					$category=rw_get_category_by_slug($p['name']);
					if(!empty($category)){
						$category_link=get_category_link($category);
						query_posts(array('category_name'=>$p['name']));
						?>
						<li class="col-xs-6 col-sm-3 item">
							<div class="fiche_caption">
								<a class="fiche_name" href="<?php echo $category_link;?>"><?php echo $category->name;?></a>
								<div class="fiche_nb"><?php echo $wp_query->found_posts.' fiches';?></div>
							</div>
							<img class="fiche_img"src="<?php echo get_stylesheet_directory_uri() .'/assets/images-v3/'.$p['img']; ?>" alt="<?php echo $p['name']; ?>">
						</li>
						<?php 
					}
				}
				wp_reset_query();?>
			</ul>
			<?php
		}
	}
} 


function block_reportages(){
	global $post;
	$args=array('category_name'=>'reportage-maison-travaux',
		'posts_per_page'=>2,
	);
	$posts=get_posts($args); 
	if(count($posts)){
		$category_link = get_term_link('reportage-maison-travaux', 'category');
		$category_link= !is_wp_error( $category_link ) ? $category_link : '';
		if($category_link){
		?>
			<div class="homeMoreArticles pull_list clearfix">
				<div class="default-title">
					<h2><span class="txt_wrapper"><a href="<?php echo $category_link; ?>">Reportages</a></span></h2>
					<a href="javascript:void(0);" data-href="<?php echo $category_link;?>" class="pull-right all_posts">Voir tous les reportages</a>
				</div>
				<div class="row">
				<?php
				foreach ($posts as $post) {
					setup_postdata($post);
					$link=get_permalink();
					$image_block = "";
					if (has_post_thumbnail($post->ID)){
					    $yoast_wpseo_title = get_post_meta($post->ID, "_yoast_wpseo_title", true);
						if($yoast_wpseo_title != ""){
							$img_attr = array('alt' => $yoast_wpseo_title,'class' => "img-responsive");
						}else{
							$img_attr = array('class' => "img-responsive");
						}
						$image_block = get_the_post_thumbnail($post->ID, 'rw_medium', $img_attr);
					} else {
						if( preg_match('/\[gallery.*ids=.(.*).\]/', get_the_content(), $ids) ){							
							$images_id = explode(",", $ids[1]);
							$src=wp_get_attachment_image_src($images_id[0],'rw_medium');	
							if(!empty($src)){
								$image_block = "<img src='".$src[0]."' class='img-responsive'>";
							}
						}
					}
					
					?>
					<div class="col-xs-12 col-sm-6">
						<div class="hp_gallery_block">
							<div class="hero_post">
								<h3 class="title">
									<a href="<?php echo $link;?>"> <?php echo the_title() ;?> </a>
								</h3>
								<a href="javascript:void(0);" data-href="<?php echo $link;?>" class="hero_visu">
									<div class="plus_detail"><span>Voir le diapo</span></div>
									<?php echo $image_block; ?>
								</a>
							</div>
						</div>
					</div>
				<?php
				} 
				wp_reset_postdata(); ?>
				</div>
			</div>
		<?php 
		}
	}
}

function block_push($menu_items,$bloc){
	include(locate_template('include/templates/block_push_v3.php'));
}

function init_func(){ 
	remove_action('after_home_categories' ,'ajout_mise_avant');
	remove_action('single_after_title','single_after_title_action');
 }

function category_title($current_cat){
	if($current_cat->slug == 'videos-'.RELATED_MAIN_SECTION){ ?>
		<h2 class="cat_big_title"><span>Dernières vidéos</span></h2>
		<?php
	}else if($current_cat->slug=='actualites'){?>
		<h2 class="cat_big_title"><span>Dernières <?php echo $current_cat->name; ?></span></h2>
	<?php
	}else{ ?>
		<h2 class="cat_big_title"><span>Dernières actualités <?php  echo apply_filters('the_custom_archive_title_addon',$current_cat->name); ?></span></h2>
		<?php
	}
}

function last_post_($args,$n){
	global $has_gallery;
	if($has_gallery){
		$args=array('post_type'=>'folder','posts_per_page'=>$n);
		return $args;
	}
	return $args;
}

function change_title_widget_($instance, $widget, $args){
	global $post,$has_gallery;
	if(is_single() && !$has_gallery && (strpos($instance['text'],'last_post="true"') !== false)){
       $instance['title'] = __('Top articles' , REWORLDMEDIA_TERMS);
    }elseif ($has_gallery && (strpos($instance['text'],'last_post="true"') !== false)){
       $instance['title'] = __('Nos dossiers' , REWORLDMEDIA_TERMS);
    }
    return $instance;
}

function change_template_search (){
	global $site_config;
	if(is_search()){
		$site_config['list-item-template']='include/templates/list-item-v3.php';
	}
}

/**
 *  Title to show in the menu for child cats (catégories profondes)
 */
function add_folder_title($h1, $post_type){
	return '<h1 class="name"> Dossiers </h1>';
}

function add_comment_title($title){
	$title = '<div class="default-title"><h2> Commentaires </h2></div>';
	return $title;
}

function real_number_posts_archive($n){
	if(is_category()){
		global $wp_query, $real_number_posts_archive;
		$category_slug = $wp_query->query_vars['category_name'];
		$current_cat = rw_get_category_by_slug($category_slug);
		$mt_cat = rw_get_category_by_slug('maison-travaux');
		$salon_mt_cat=rw_get_category_by_slug('salonmaisonettravaux');
		if($current_cat->category_parent == $mt_cat->term_id){
			$n=6;
		}
		elseif($current_cat->term_id== $salon_mt_cat->term_id){
			$n=24;
		}
		else{		
			$n=4;
		}
		$real_number_posts_archive = $n;
	}
	return $n;
}

function number_posts_archive($n){
	global $real_number_posts_archive;
	$n = $real_number_posts_archive? $real_number_posts_archive : $n;
	if(is_category()){
		$n=20;
	}
	return $n;
} 

include(locate_template('include/functions/common_functions.php'));

function popular_questions_forum($attrs){
	$html = '';
	global $wpdb;
	if(is_home()&& !rw_is_mobile()){
		$questions = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'sabai_content_post WHERE post_status="published" and post_entity_bundle_type="questions" ORDER BY post_views DESC Limit 3' );
		if(!empty($questions)){
			$html = '<div class="widget-title"><a href="'.get_home_url().'/questions">Vos questions</a></div>';
			$html .= '<ul class="menu-footer list-inline">';
			foreach ($questions as $question) {
				$html .= '<li><a href="'.get_home_url().'/questions/question/'.$question->post_slug.'" class="three_dots">'.$question->post_title.'</a></li>';
			}
			$html .= '</ul>';
		}
	}
	return $html;
}

add_shortcode('questions_les_plus_vues','popular_questions_forum');

function add_bliink_to_list_partner($partner){

	array_push($partner, 'bliink_article_desktop','bliink_article_mobile','bliink_diapo_desktop','bliink_diapo_mobile');
	
	return $partner;
}

function orderby_modified( $query ) {
    if ( isset($query->query['post_type']) && $query->query['post_type'] == 'folder' && get_param_global('folders_orderby_date_modified') == true && $query->is_main_query()  ) {
        $query->set( 'orderby' , 'modified');
    }
}
add_action( 'pre_get_posts', 'orderby_modified' );


function modify_parent_folder($post_id, $post) {
	remove_action( 'save_post', 'modify_parent_folder' ,100);
	// Update the parent folder
	if (!empty($post->post_parent) && get_post_type( $post->post_parent ) == "folder"){
		$parent_folder = array(
			'ID'           => $post->post_parent
		);
		// Update the parent folder into the database
		wp_update_post( $parent_folder);
	}
}
add_action( 'save_post', 'modify_parent_folder',100,2);


add_action('after_single','get_last_deco_posts');
function get_last_deco_posts(){
	$args = array(
		'posts_per_page'	=> 3,
		'post_status'		=> 'publish',
		'orderby'			=> 'date',
		'order'				=> 'DESC',
		'meta_key'			=> 'section_permalink',
		'meta_value'		=> 'deco',
		'no_force_category'	=> true,
	);
	$content = "";
	$posts = get_posts($args);
	$_block_title = 'La déco sur Le Journal de la Maison';
	if( !empty($posts))
 	{
 		require(locate_template("renovation/include/templates/block_posts_related.php"));
 	}
 	echo $content;
} 

add_action('before_home_actus', 'add_title_recents_posts');

function add_title_recents_posts(){
	?>
	<h2 class="default-title">
		<span>Articles les plus récents</span>
	</h2>
	<?php
}

add_filter('more_category_text', function ( $return, $title = '' ) {
	return 'Tout voir';
}, 10, 2);

function add_logo($atts){
	return get_data_from_cache('footer_logo_img', 'footer', 60*60*24, function(){
		$img_logo = isset($atts['logo']) ? $atts['logo'] : apply_filters('default_logo_site', RW_THEME_DIR_URI . '/assets/images/logo_white.svg');
		$img_alt = isset($atts['alt']) ? $atts['alt'] : apply_filters('alt_logo_footer' , 'Biba magazine');
		$home_url = esc_url(apply_filters('logo_home_url', home_url('/')));
		$html = '<div class="col-xs-12 footer-widget">';;
		$html .= '<a class="footer-logo" href="'. $home_url .'">';
		$html .= '<img src="'. $img_logo .'" class="img-responsive" alt="'. $img_alt .'" />';
		$html .= '</a>';
		$html .= '</div>';
		return $html;
	});
}
add_shortcode('logo', 'add_logo');

function sub_domain_links($atts){
	return get_data_from_cache('sub_domain_links', 'footer', 60*60*24, function(){
		$menu_items = wp_get_nav_menu_items('pages_footer');	
		$html = '<ul class="footer-menu-pages">' ;
		if (is_array($menu_items)){
			foreach ($menu_items as $menu_item){
				if($menu_item->menu_item_parent == 0){
					$html .='<li class="'. (isset($menu_item->classes)? implode(" ", $menu_item->classes):"") .'">
							<a href="'.$menu_item->url.'">'.$menu_item->title.'</a>
						</li>' ;
				}		
			}					
		}
		$html .='</ul>';
		return $html;
	});
}
add_shortcode('sub_domain_links', 'sub_domain_links');

add_action('after_single_article', 'display_read_more_block',20);

function display_read_more_block() {
	global $post;
	if($post->post_type == "post" || $post->post_type == "folder") {
		include(locate_template('include/templates/read_more_block.php'));
	}
}