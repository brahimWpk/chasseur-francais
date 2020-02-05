<?php

$plan_tagagge_dfp =  array(
  "hp" => array( 'id' => "Home_Page"  ), 
  "divers" => array( 'id' => "RG-NON_Classe") ,
);

$pages_types_dfp = array(
  'hp' => array('habillage', 'inread_adikteev', 'interstitiel', 'masthead_haut', 'mpu_haut', 'vignette_haut', 'mpu_milieu', 'vignette_bas', 'dhtml', 'interstitiel_mobile', 'mobile_1', 'mobile_2', 'mobile_3', 'mobile_4', 'mobile_5', 'mobile_6', 'mobile_7', 'mobile_8', 'mobile_9', 'mobile_10', 'mobile_11', 'mobile_12'),
  'rg'=> array( 'habillage', 'inread_adikteev', 'interstitiel', 'vignette_haut', 'masthead_haut', 'mpu_haut', 'mpu_milieu', 'mpu_bas', 'vignette_bas', 'masthead_bas', 'dhtml', 'interstitiel_mobile', 'mobile_1', 'mobile_2', 'mobile_3', 'mobile_4', 'mobile_5', 'mobile_6', 'mobile_7', 'mobile_8', 'mobile_9', 'mobile_10', 'mobile_11', 'mobile_12'),
);

if( is_dev('incontent_banner_folder_154477278') ){
	$pages_types_dfp['folder'] = array( 'habillage', 'inread_adikteev', 'interstitiel', 'vignette_haut', 'masthead_haut', 'mpu_haut', 'mpu_milieu', 'mpu_bas', 'vignette_bas', 'masthead_bas', 'dhtml', 'interstitiel_mobile', 'mobile_1', 'mobile_2', 'mobile_3', 'mobile_4', 'mobile_5', 'mobile_6', 'mobile_7', 'mobile_8', 'mobile_9', 'mobile_10', 'mobile_11', 'mobile_12', 'banner_incontent_1');
}

/* TR-5332 MONETISATION | DIAPO ELASTIQUE*/
if(is_dev('monetisation_diapo_elastique_mt_5363')){
	$pages_types_dfp['diapo_monetisation'] = array('habillage', 'inread_adikteev', 'interstitiel', 'masthead_haut', 'mpu_haut', 'mpu_milieu', 'mpu_milieu_2', 'mpu_milieu_3', 'banner_incontent_1', 'banner_incontent_2', 'mpu_bas', 'masthead_bas', 'dhtml', 'interstitiel_mobile', 'mobile_1', 'mobile_2', 'mobile_3', 'mobile_4', 'mobile_5', 'mobile_6', 'mobile_7', 'mobile_8', 'mobile_9', 'mobile_10', 'mobile_11', 'mobile_12');
}

if(is_dev('mt_monetisation_simple_5363')) {
	$incontents = ['banner_incontent_1', 'banner_incontent_2'];
	$pages_types_dfp['rg'] = array_unique(array_merge($pages_types_dfp['rg'], $incontents));
}
 

$formats_lazyloading = false ;
if(rw_is_mobile()){
	$formats_lazyloading = array('mobile_2', 'mobile_3', 'mobile_4', 'mobile_5', 'mobile_6', 'mobile_7', 'mobile_8', 'mobile_9', 'mobile_10', 'mobile_11', 'mobile_12') ;	
}

$inRead_html = "";
$inBoard_html = "";

$inBoard_hp_html='';
$inBoard_rg_html='';


$inBoard_hp_html = $inBoard_rg_html = <<<INBOARD
<script type="text/javascript">
	var script = document.createElement('script');
	script.async = true;
	script.src = "//a.teads.tv/page/61768/tag";
	document.getElementsByTagName('head')[0].appendChild(script);
</script>

INBOARD;

$inRead_html = <<<INREAD
<script type="text/javascript">
	var script = document.createElement('script');
	script.async = true;
	script.src = "//a.teads.tv/page/61767/tag";
	document.getElementsByTagName('head')[0].appendChild(script);
</script>
INREAD;


$site_config['id_pub'] = false ;

$id_pub_mobile = false ;


$id_pub = array(	
	'type'=> 'vast', 
	'url' => 'https://cdn.advideum.com/tag.xml?id=164081-21591&plt=preroll',
);


$id_pub = array(
	'prerollZoneId'=> 9795,
	'midrollZoneId'=> -1,
	'postrollZoneId'=> 9795,
	'midrollInterval'=> -1,
	'midrollDelay'=> -1,
	'preroll_and_postroll' => true,
);

$id_pub_mobile = array(
	'prerollZoneId'=> 9039,
	'midrollZoneId'=> -1,
	'postrollZoneId'=> 9039,
	'midrollInterval'=> -1,
	'midrollDelay'=> -1,
	'preroll_and_postroll' => true,
);


if(is_dev('dissociation_tags_freewheel_155007542')){
	$id_pub['prerollZoneId'] = $id_pub['postrollZoneId']  = 9795;
	$id_pub_mobile['prerollZoneId'] = $id_pub_mobile['postrollZoneId']  = 9795;

	$id_pub_sidebar = array(
		'prerollZoneId'=> 5652482,
		'midrollZoneId'=> -1,
		'postrollZoneId'=> 5652482,
		'midrollInterval'=> -1,
		'midrollDelay'=> -1,
		'preroll_and_postroll' => true,
	);
}

$partners = array (
   	'ligatus' => array( 
   		'desc' => 'Ligatus',
   		'default_activation' => 1 ,
   		'implementation' => 'ligatus.php',
   		'config' => array(
   			'ligatus_v2'=> array(
   					'html'=> '<div id="lig_maison_travaux_smartbox_article"></div>',
					'js'=> '<script language="javascript" src="//a.ligatus.com/?ids=89853&t=js"></script>'
				),
   			),
   		'shortcodes' => array (
   			'add_ligatus_smartbox'=> 'ligatus_smartbox_implementation',
   			'ligatus'=> 'ligatus_implementation',
   			)
   		),


   	'pub_video' => array(
   		'desc' => 'Pub video',
   		'default_activation' => 1 ,
   		'config' => array(
			'id_pub'=> $id_pub,
			'id_pub_mobile'=> $id_pub_mobile,
			'id_pub_sidebar' => $id_pub_sidebar,
   		),
   	),

	'sam_desktop' => array(
		'default_activation' => 1 ,
	),
	'sam_mobile' => array(
		'default_activation' => 1 ,
	),
	'sam_tablet' => array(
		'default_activation' => 1 ,
	),


	'criteo_adblocks' => array(
		'desc' => 'criteo Adblocks',
		'default_activation' => 1,
		'action' => array('wp_head',10, 1),
		'callback' =>  'adblocks_init_script',
		'implementation' => 'criteo-adblocks.php' ,
		'shortcodes' => array (
			'adblocks_mpu_haut' => 'adblocks_mpu_haut_implementation',
			'adblocks_mpu_milieu' => 'adblocks_mpu_milieu_implementation',
			'adblocks_mpu_bas'=>'adblocks_mpu_bas_implementation',
		)
	),
	// 'sirdata' => array (
	// 	'config' => array (
	// 		'sirdata_si' => 4,
	// 	),
	// ),
	'taboola' => array(
		'config' => array(
			'path_loader' => 'reworldmedia-maisontravaux',
		)
	),

	'taboola_organique' => array(
		'config' => array(
			'path_loader' => 'reworldmedia-maisontravaux',
		)
	),

	'ancre_teads' => array(),
	'player_bas_article' => array(),
	'player_sticky' => array(),
	
	'mediametrie' => array(
        'config' => array (
            'https_mediametrie' => is_dev('mediatrie_148481575'),
            'serial'			=> '800000000086',
        ),
    ),

    'seedtag' => array(
        'config' => array(
            'setId'                 => '5766-5688-01',
        ),
    ),

	'notify' => array(),
	'sdk_beopinion' => array(
		'config' => array(
			'account' => '594a5381c9e77c00013bcc9e'
		)
	),

	'dfp_v2' => array (
        'config' => array (
            'dfp_id_account' => '46980923/maison_travaux',
            'pages_types' => $pages_types_dfp,
            "plan_tagagge"=> $plan_tagagge_dfp,
            'formats_lazyloading' => $formats_lazyloading ,
            'couper_formats_mobile_300_600' => is_dev('couper_les_formats_300_600_mobile_tr_4114'),
            
        ),
        'callback' => 'init_dfp_for_desktop' ,
    ),

    'dfp_v2_mobile' => array (
       	'config' => array (
            'dfp_id_account' => '46980923/maison_travaux',
            'pages_types' => $pages_types_dfp,
            "plan_tagagge"=> $plan_tagagge_dfp,
            'formats_lazyloading' => $formats_lazyloading ,
            'custom_dfp_mobile_locations_in_folders' => true,
            'desactivate_dfp_mobile_hp_hr' => is_dev('desactiver_formats_mobile_hp_hr_155771286'),
            'couper_formats_mobile_300_600' => is_dev('couper_les_formats_300_600_mobile_tr_4114'),
        ),
        'callback' => 'init_dfp_for_mobile' ,
    ),

	'keywee' => array(
		'config' => array(
			'script_keywee' => '//dc8xl0ndzn2cb.cloudfront.net/js/maison-travauxfr/v0/keywee.min.js',
		)
	),

	'meta_fb_page' => array(
		'config' => array(
			'content' => array(
				'145745718827574',
    			'260336854001209',
    			'276854639004814',
    			'198980580143753',
    			'218379691520788',
    			'234359946578296',
    			'208431569261507',
    			'144409998968061',
    			'218961071471115',
    			'100210233404066',
    			'222909701067586',
    			'311692585566649',
    			'152511924822471',
    			'100138030115000',
    			'258383170865614',
    			'203900649724603',
    			'240483766039375',
    			'164225413639261',
    			'152684571500882',
    			'128508680558108',
    			'271746716238714',
    			'272828846135504',
    			'315045558536306',
    			'319204128148247',
    			'348873488513702',
    			'355767137775285',
    			'444748345544053',
    			'232611880158445',
    			'217512521682961',
    			'216289148460035',
    			'403701222984952',
    			'231430763672278',
    			'248971885166718',
    			'323057184379529',
    			'285741331471643',
    			'643924048959400',
    			'538398642875603',
    			'245418318860940',
    			'281258261947433',
    			'291382087626367',
    			'509516579122318',
    			'145416875592507',
    			'294754110613627',
    			'246844705405879',
    			'446449278701644',
    			'366326886804172',
    			'415968418504248',
    			'413798278732756',
    			'152865514908338',
    			'334199736714868',
    			'184356141738591',
    			'178505505664089',
    			'619590931399230',
    			'220249824654279',
    			'185786771597069',
    			'292803477401295',
    			'266721946705687',
    			'170451549679584',
    			'1444603569099788',
    			'542998572447651',
    			'220483528012897',
    			'176167075775391',
    			'370040049788689',
    			'564354933627062',
    			'345750458890599',
    			'500527920023523',
    			'581381098584663'
				),
		)
	),
	'Nugg' => array (
		'config' => array (
			"nuggAd_id" => '1378252818' ,
		),
	),
	'Nielsen' => array(
		'config' => array(
			'p' => 915,
			'g' => 7,
			'c' => 1381249
		)
	),
	'krux' => array(
		'config' => array('krux_script' => get_param_global("krux"))
	),
	'analytics' => array(
		'config' => array('google_analytics_id' => get_param_global("google_analytics_id"), 
						'test_google_analytics_id' => get_param_global('test_google_analytics_id'))
	),
	'newsletter_crm' => array(),
	'acpm' => array(
		'config' => array (
			'serial' => '251051218170',
		),
	),

	//'quantcast' => array(),
	'captify' => array (
        'config' => array (
            'captify_id' => '12258',
        ),
    ),
	'index_exchange' => array(
        'config' => array(
            'placeholder' => '186767-5927649177751',
            'placeholder_mobile' => '186767-118077835297785'
        ),
    ),
    'bliink_article_desktop' => array(
		'config' => array (
			'site_id'	=> '96',
			'tag_id'	=> '107',
			'ga' => 'UA-123137148-6',
			'disabled_event'=> true
		),
	),
	'bliink_article_mobile' => array(
		'config' => array (
			'site_id'	=> '96',
			'tag_id'	=> '107',
			'ga' => 'UA-123137148-6',
			'disabled_event'=> true
		),
	),
	'bliink_diapo_desktop' => array(
		'config' => array (
			'site_id'	=> '96',
			'tag_id'	=> '108',
			'ga' => 'UA-123137148-6',
			'disabled_event'=> true
		),
	),
	'bliink_diapo_mobile' => array(
		'config' => array (
			'site_id'	=> '96',
			'tag_id'	=> '108',
			'ga' => 'UA-123137148-6',
			'disabled_event'=> true
		),
	),
	'pinit_img' => array(),
	'amazon' => array(),
    'soundcast' => array (
        'config' => array (
            'soundcast_id' => '5cada57b002ec',
        ),
    ),
    'cloud_media' => array(
    	'config' => array (
    		'cm_id' => 'ffa66cf9-3057-412d-8246-376989575ea2',
    	),
    ),
	'adways' => array(
		'config' => array (
			'type' => 'publisher',
			'id' => 'YrTWvBK',
		),
	),
    'widget_ops' => array (
		'config' => array(
			'univers_slug' =>'univers_deco',
			'univers_name' =>'Univers Déco (M&T, MJMM, JLM)',
			'archive_action' => 'content_archive_deco',
			'univers_Bo' => true,
			'style_path' => STYLESHEET_DIR_URI . '/renovation/assets/stylesheets/widget_ops.css',
		)
	),
  'publica' => array (
    'config' => array(
      'set_src_publica' =>'//nxkwfrob.qlwgkw.com/84fa41cab901c5542e5a8ff8ca68d82b',
    )
  ),

  'pixel_taboola' => array(),
   'cmp_didomi' => array(
   		'config' => array(
   			'style_path' => STYLESHEET_DIR_URI . '/renovation/assets/stylesheets/cmp_didomi_renovation.css',
   		),
   ),
 );

//Fix warning Undefined variable: div_inread
$div_inread = '<div id="dfp_inread" class="DFP-inread"></div>';

if( is_dev('exclude_article_crm_box_162579379') ){
	$partners['crm_box_article']['config']['cats_to_exclude'] =  array('livres-blancs');
}
/*if( is_dev('dissociation_inread_interface_partenaire_151724296') ){
	unset( $partners['inread'] );

	$partners = array_merge(
		array(
			'inread_desktop' => array (
				'config' => array (
					"init_inread_desktop" => $inRead_html ,
					"div_inread" => $div_inread ,
				),
			),
			'inread_tablet' => array (
				'config' => array (
					"init_inread_tablet" => $inRead_html ,
					"div_inread" => $div_inread ,
				),
			),
			'inread_mobile' => array (
				'config' => array (
					"init_inread_mobile" => $inRead_html ,
					"div_inread" => $div_inread ,
				),
			),
		)
		, $partners);
}
*/
if( is_dev('dissociation_tags_desktop_mobile_Seedtag') ){

    unset( $partners['seedtag'] );
    $partners = array_merge(
        array(
            'seedtag_desktop_tablet' => array(
                'config' => array(
                    'setId' => '5766-5688-01',
                ),
            ),
            'seedtag_mobile' => array(
                'config' => array(
                    'setIdMobile' => '7377-2292-01',
                ),
            ),
        )
        , $partners
    );
}

if( is_dev('nouveau_ligatus_https_152643093') ){
    unset( $partners['ligatus'] );

    $partners = array_merge(
        array(
            'ligatus' =>
                array(
                    'desc' => 'Ligatus V3 ( script en HTTPS )',
                    'default_activation' => 0,
                    'implementation' => 'ligatus_v3.php',
                    'action' => array( 'wp_head',10 , 1 ),
                    'callback' => 'ligatus_init',
                    'class_name' => 'Ligatus',
                    'config'            => array(
                        'article'       => array(
                            'smartbox_ti'     => array(
                                'tagContainerId'    => '89853',
                                'targetId'          => 'lig_maison_travaux_smartbox_article',
                            ),
                        ),
                    ),
                    'shortcodes' => array(
                        'add_ligatus_smartbox' => 'ligatus_smartbox_implementation',
                        'ligatus' => 'ligatus_smartbox_ti',
                        'ligatus_block_right' => 'ligatus_smartbox_side',
                    ),
                ),
        ), $partners);
}

add_filter( 'condition_to_display_seedtag', 'get_condition_to_display_seedtag', 10, 1);
/**
 * @return boolean the condition to display the tag
 * */
function get_condition_to_display_seedtag($condition ){
    //Tag is inserted for simple articles and galleries
    return (is_single() && !page_has_video() || page_has_gallery());
}

