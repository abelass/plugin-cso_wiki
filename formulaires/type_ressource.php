<?php
function formulaires_type_ressource_charger(){

	$valeurs=array('articles'=>$articles,'link_source'=>_request('link_source'),'objet'=>_request('objet'),'id_objet'=>_request('id_objet'),'lang'=>_request('lang'),'lang_dest'=>_request('lang_dest'),'type_lien'=>_request('type_lien'),'edition'=>'new');
	
	return $valeurs;
	}
?>

