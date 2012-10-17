<?php
function formulaires_changement_article_destination_charger($lang){
	include_spip('inc/config');

	$lang_dest=_request('lang_dest')?_request('lang_dest'):$lang;	
	$rubriques_wiki=picker_selected(lire_config('wiki_cso/rubriques_wiki'),'rubrique');
	
	$titre_rubriques=array();
	foreach($rubriques_wiki AS $id_rubrique){
		$titre_rubriques[$id_rubrique]=extraire_multi(sql_getfetsel('titre','spip_rubriques','id_rubrique='.$id_rubrique));
		}

	if(is_array($rubriques_wiki))$sql=sql_select('id_article,id_rubrique,titre,soustitre','spip_articles','id_rubrique IN ('.implode(',',$rubriques_wiki).') AND lang='.sql_quote($lang),'','titre');
	
	$articles=array();
	while($data=sql_fetch($sql)){
		
		$articles[$titre_rubriques[$data['id_rubrique']]][$data['id_article']]=$data['titre'].($data['soustitre']?' - '.$data['soustitre']:'');	
	}	
	
	$valeurs=array('articles'=>$articles,'link_source'=>_request('link_source'),'objet'=>_request('objet'),'id_objet'=>_request('id_objet'),'lang_dest'=>$lang_dest,'type_lien'=>_request('type_lien'),'lang'=>$lang);
	
	return $valeurs;
	}
?>

