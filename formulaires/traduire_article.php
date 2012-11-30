<?php
function formulaires_traduire_article_charger($id_article){
	$valeurs=array('lang_dest'=>_request('lang_dest'),'id_article'=>$id_article,'lier_trad'=>_request('lier_trad'),'objet'=>_request('objet'));
    
    $art_lie=sql_fetsel('type_liaison,id_article','spip_articles_lies','id_article_lie='.$id_article);
    
    $valeurs['type_lien']=$art_lie['type_liaison'];
    $valeurs['link_source']=$art_lie['id_article'];    
		
	$valeurs['id_parent']=sql_getfetsel('id_rubrique','spip_articles','id_article='.$id_article);
    
	return $valeurs;
	}
?>

