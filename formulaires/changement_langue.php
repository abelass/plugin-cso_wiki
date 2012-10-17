<?php
function formulaires_changement_langue_charger(){
	$valeurs=array('lang_dest'=>_request('lang_dest'),'link_source'=>_request('link_source'),'objet'=>_request('objet'),'id_objet'=>_request('id_objet'),'type_lien'=>_request('type_lien'));
	
	
	
	return $valeurs;
	}
?>

