<?php 

$devs = isset($devs)? $devs : array() ;

define('NEWRW', true);

$devs  = array_merge($devs, array(
 	'fiches_pratiques_115871923' => '[115871923] Afficher block fiches pratiques',
	'ops_les_experts_grdf_118003671' => '[118003671] OPS LES EXPERTS GRDF Espace dédié',
    'desactiver_formats_mobile_hp_hr_155771286' => array( 'desc' => '[155771286] **MONETISATION** | **DFP mobile** | Désactivation Formats mobile sur HP et HR', 'no_css' => true ),
    'adaptation_habillage_1000px_155809078' => array( 'desc' => '[155809078] **MONETISATION** | **M&T** | Passage du site en 1000px - Adaptation habillage', 'no_css' => false ),
    'change_template_by_resolution_156188083' => array( 'desc' => '[156188083] **MONETISATION**  | **MAISON &TRAVAUX** | Différenciation template selon la résolution', 'no_css' => false ),
    'dissociation_tags_desktop_mobile_Seedtag' => array('desc' => '[156276093] **MONETISATION** | M&T| Dissociation tags Desktop & mobile Seedtag', 'no_css' => true ),
    'pixel_td_reve_de_combles_156495199' => array('desc' => '[156495199] PRIO 1 | **MT** | **OPS** Rêve de Combles  | Integration pixel tradedoubler', 'no_css' => true ),
	'retirer_etiquettes_159621503' => array('desc' => '[159621503] **ETIQUETTES** l **MF MT MJMM JLM**l Retirer les étiquettes has_diapo et has_video', 'no_css' => false),
	'modifs_article_diapo_160919454' => array('desc' => '[160919454] **Optimisation** | **MT & MJMM** | Modification légendes et chapô diapo ', 'no_css' => false ),
	'one_page_template_161057750' => array('desc' => '[161057750] Déploiement One page template | M&T', 'no_css' => true ),
	'barre_de_nav_sur_petite_resolution_ecran_161443657' => '161443657 : **Bug** l **MT** l Barre de nav sur petite résolution écran',
	'mt_gestion_de_campagne_iframe_desactivation_de_l_auto_refresh_2770' => '2770 : M&T | Interface gestion de campagne iframe | Désactivation de l auto refresh',
	'retirer_inred_nl_widget_MPR_161890417' => array('desc' => '[161890417] **Inread NL** l **MT** l retirer le bloc dans les pages avec widget MPR', 'no_css' => true ),
	'intégration_encarts_serviciels_162603628' => array('desc' => '[162603628] **CRM** | PRIO | Template NL M&T | Intégration encarts serviciels', 'no_css' => true ),
	'exclude_article_crm_box_162579379' => array('desc' => '[162579379] **CRM** | Catégorie LB | Exclu box article ', 'no_css' => true ),
	'mt_forum_meta_dissociation_161447059' => array('desc' => '[161447059] **MT MJMM** l Forum', 'no_css' => true ),
	'retirer_inred_nl_widget_LB_3723' => array('desc' => '[tr - 3723] CRM l M&T l Retrait inread NL dans les articles LB', 'no_css' => true ),
	'remonte_articles_he_in_diapo_mt_3702' => array('desc' => '[tr - 3702] HE | Remontée des articles HE dans le Carrousel de la HP M&T', 'no_css' => true ),
	'proxi_energies_163590416' => array('desc' => '[pvt - 163590416] OPS|Proxi Energies|Rubrique dédiée', 'no_css' => true ),
	'remove_maillage_inter_site_163906693' => array('desc' => '[pvt 163906693] OPS|Suppression bloc déco MF bas d articles', 'no_css' => true ),
    'couper_les_formats_300_600_mobile_tr_4114' => array('desc' => "Monetisation | DFP | couper les formats 300x600 sur mobile (4114)  ", 'no_css' => true ),
    'ajout_dimension_personnalisee_4180' => array('desc' => "[tr - 4180] CRM | M&T | PROJET COLLECTE | V2 - Ajout dimension personnalisée", 'no_css' => true ),
    'svg_logo_4522' => array('desc' => "[tr - 4522] M&T | Changement logo site", 'no_css' => true ),
	'positionnement_chapo_article_4434' => array('desc' => "[tr - 4434] MT MJMM l Positionnement chapô article", 'no_css' => true ),
	'retirer_bloc_videos_travaux_4581' => array('desc' => "[tr - 4581] MT - Retirer le bloc Vidéos Travaux et agencement en HP", 'no_css' => true ),
	'supprimer_dates_tags_4683' => array('desc' => "[tr - 4683] MT MJMM AM l supprimer date", 'no_css' => false ),
	'monetisation_diapo_elastique_mt_5363' => array('desc' => "[tr - 5363] MONETISATION | DIAPO ELASTIQUE | MT", 'no_css' => true ),
	'mt_monetisation_simple_5363' => array('desc' => "[tr - 5363] MONETISATION | DIAPO ELASTIQUE | Ajout des incontents 1 et 2 sur les articles simples | MT", 'no_css' => true ),
	'bug_marges_format_habillage_5897' => array('desc' => "[tr - 5897] BUG MARGES FORMAT HABILLAGE", 'no_css' => false ),
	
) );


/*Maison et Travaux*/
include ('include/functions/meta-boxes.php');

/**
* include newsletters.php
*/
include('include/functions/newsletters.php');


$stylesheet_directory = get_bloginfo('stylesheet_directory') ;


/**
 * include site config file
 */
require(locate_template('include/functions/site-config.php')); 

add_filter('main-logo-navbar', function($r,$title){
	return '<img src="'.$title.'" class="main-logo img-responsive" alt="'. __('Maison & travaux : conseils rénovation et agencement', REWORLDMEDIA_TERMS).'" />';
},10,2);

add_action('wp_head','init_isolation_les_experts', 1);
function init_isolation_les_experts(){
	global $wp_query, $post ;
	$category = 0 ;
	if(is_single()){
		$category = get_post_category_from_url(); 
	}elseif(is_category()){
		$category = get_term($wp_query->query_vars['cat'], 'category');
	}	
		if(($category AND $category->slug == 'isolation-les-experts') OR (is_page() AND $post->post_name == 'les-experts-mt' )){ 
			add_filter('inread_filter','__return_false');
			add_filter('fullscreen_filter','__return_false');
			add_filter('inPicture_filter','__return_false');
			add_filter('inBoard_filter','__return_false');
			add_filter('customize_mediabong','__return_false');	
	}
}

/**
*Ticket #109242984 MT - Publication dossier Homepage
* AUTHOR : gounane@webpick.info
**/
add_filter('diaporama_accueil_articles_args', 'filter_diaporama_accueil_');

function filter_diaporama_accueil_($args_diapo){
	$args_diapo['post_type'] = array('post', 'folder');
	return $args_diapo;
}

/**
*End ticket #109242984
**/

add_shortcode('nos_coups_de_coeur','nos_coups_de_coeur_shortcode');
function nos_coups_de_coeur_shortcode($atts){
	global $post;

	 $atts_ = shortcode_atts( array(
        'n' => 5,
        'cat' => 'nos-coups-de-coeur',
        'include' => '',
    ), $atts );
	extract($atts_);
	ob_start();
	$nbr_posts = $n;
	$include_posts = explode(",", $include);
	$specified_posts = array();
	$posts_exclude = [];
	if(count($include_posts)){
		$specified_posts = get_posts(array('posts_per_page' => $nbr_posts, 'post__in' => $include_posts));
		$nbr_posts -= count($specified_posts);
		foreach ($specified_posts as $specified_post) {
			$posts_exclude = RW_Utils::add_value_to_array($specified_post->ID, $posts_exclude);
		}
	}
	$most_popular = get_posts(array( 'category_name' => $cat  , 'posts_per_page' => $nbr_posts, 'post__not_in' => $posts_exclude));

	if(count($specified_posts)){
		$most_popular = array_merge($specified_posts, $most_popular);
	}
	include (get_template_directory() . "/include/templates/post_most_popular.php");
	$s = ob_get_contents();
	ob_end_clean();
	return $s;
}


if((defined('MOBILE_MODE') && MOBILE_MODE) ){	
	add_action('after_item_2_hp','widget_after_item_3_hp_mobile');
	add_action('wp', function(){
		remove_action('after_item_3_hp','widget_after_item_3_hp_mobile');
	});
}


add_action('wp_head',function(){
	global $site_config;
	if(is_home()){
		$site_config['balise_title_list_item']='div class="title-item-home"';
	}
});

if(defined('MOBILE_MODE') && MOBILE_MODE ){
	add_filter('partner_filter_outbrain', '__return_false');
}

add_action('wp_head', function() {
	if(function_exists('is_dedicated_area')){
		$return_cat = is_dedicated_area() ;
		if(isset($return_cat['category']['category']) && $return_cat['category']['category'] == 'trilatte-3d'){
			remove_action('before_comment_block','widget_before_comment_block');
		}
	}
});

add_filter('additionnal_logo_header',function(){
	return  get_stylesheet_directory_uri() . '/assets/images-v3/logomtlapeyre.png';

},10,1);

add_action('after_main_logo_nav_bar','additionnal_logo_to_nav_menu');
function additionnal_logo_to_nav_menu(){
	$additionnal_logo = apply_filters('additionnal_logo_header',get_stylesheet_directory_uri()."/assets/image-v2/main-logo.png?v=10");
	if( is_category('bien-penser-sa-maison')){ 
		echo sprintf('<span class="avec-additionnal-logo">Avec</span><img src="%s" class="additionnal-logo-header" alt="%s" />',$additionnal_logo,apply_filters('alt_logo_header' , get_bloginfo('name') ));
	}
}

if ( is_admin() ) {
	require(RW_THEME_DIR."/include/custom-posts.php");
}

function renovation_main_js(){
	wp_enqueue_script('renovation-js', get_stylesheet_directory_uri().'/assets/javascripts/v3/main.js', array(), CACHE_VERSION_CDN, true );
}

add_action('wp_enqueue_scripts', 'renovation_main_js' );

function change_breadcrumb_questions_page_title($s){
	$s = 'Forum bricolage et travaux';
	return $s;
}
add_filter('breadcrumb_questions_page_title', 'change_breadcrumb_questions_page_title');

function hide_home_articles_video_bloc($hidden, $bloc){
	if( $bloc->cat_name == 'Videos Renovation') $hidden = true;
	return $hidden;
}
function change_home_articles_video_temp($bloc){
	if( $bloc->cat_name == 'Videos'){
		include(locate_template('include/templates/tv.php'));
	}
}
if( is_dev('retirer_bloc_videos_travaux_4581') ){
	add_filter('force_hide_bloc_push', 'hide_home_articles_video_bloc', 2, 10);
	add_action('before_homeMoreArticle_bloc','change_home_articles_video_temp');
	add_action('after_home_block','block_dossiers', 20);
	add_action( 'init', function() {
		remove_action('after_block_tv','block_dossiers');
	});
}

if(is_dev('monetisation_diapo_elastique_mt_5363')){
	add_action('wp', 'template_diapo_monetisation');
}
/**
 * Add diapo template options
 *
 * @return Void   
 */

/* TR-5332 MONETISATION | DIAPO ELASTIQUE*/
function template_diapo_monetisation(){
	global $post, $site_config;
	if(is_single() && has_diapo_monetisation() && page_has_gallery()){
		add_filter( 'forcer_affichage_top_img_single', '__return_false');
		require(locate_template('include/functions/functions_monetisation.php'));
		wp_enqueue_style( 'diapo_monetisation_css',get_stylesheet_directory_uri().'/assets/stylesheets/diapo_monetisation.css', array(), CACHE_VERSION_CDN  );
	}
}

if( is_dev('mt_monetisation_simple_5363') ){
	add_action('wp', 'template_monetisation_simple');
}

function template_monetisation_simple(){
	if(is_single() && !page_has_video() && RW_Post::is_simple_monetisation()) {
		require(locate_template('include/functions/monetisation_simple.php'));
	}
}

function add_custom_style_to_deco($stylesheet_uri, $stylesheet_dir_uri){
	$stylesheet_uri =  $stylesheet_dir_uri."/assets/stylesheets/colors-v3.css";
	return $stylesheet_uri ;
}

add_filter('stylesheet_uri','add_custom_style_to_deco', 20, 2);