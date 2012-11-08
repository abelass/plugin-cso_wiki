<?php
/**
 * Plugin Wiki Cso-effectiveness
 * (c) 2012 My Chacra
 * Licence GNU/GPL
 */

include_spip('inc/cextras');
include_spip('base/wiki_cso');
	
function wiki_cso_upgrade($nom_meta_base_version,$version_cible) {

  $maj = array();
  cextras_api_upgrade(wiki_cso_declarer_champs_extras(), $maj['create']);	
  cextras_api_upgrade(wiki_cso_declarer_champs_extras(), $maj['1.2.0']);
  cextras_api_upgrade(wiki_cso_declarer_champs_extras(), $maj['1.2.1']);
  cextras_api_upgrade(wiki_cso_declarer_champs_extras(), $maj['1.2.2']);  
  cextras_api_upgrade(wiki_cso_declarer_champs_extras(), $maj['1.2.4']);  
  cextras_api_upgrade(wiki_cso_declarer_champs_extras(), $maj['1.3.1']);        
  include_spip('base/upgrade');
  maj_plugin($nom_meta_base_version, $version_cible, $maj);
  


}

function wiki_cso_vider_tables($nom_meta_base_version) {
  cextras_api_vider_tables(wiki_cso_declarer_champs_extras());
  effacer_meta($nom_meta_base_version);
}

?>
