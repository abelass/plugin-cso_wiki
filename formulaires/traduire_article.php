<?php
function formulaires_traduire_article_charger($id_article){
	$valeurs=array('lang_dest'=>_request('lang_dest'),'id_article'=>$id_article,'lier_trad'=>_request('lier_trad'),'objet'=>_request('objet'));
		
	$valeurs['id_parent']=sql_getfetsel('id_rubrique','spip_articles','id_article='.$id_article);
	return $valeurs;
	}
?>

