<?php
/**
 * Plugin Wiki Cso-effectiveness
 * (c) 2012 My Chacra
 * Licence GNU/GPL
 */

if (!defined('_ECRIRE_INC_VERSION')) return;
include_spip('inc/cextras_autoriser');

restreindre_extras('article', array('guidance','how_to_analyse_context','how_to_analyse_org_aspects','suggested_objectives','activities','in_practice','voices','other_ressources'), array(2,3));


function is_wiki($id_rubrique,$options=''){
    include_spip('inc/config');
    $rubriques_wiki_config=lire_config('wiki_cso/rubriques_wiki');
    
    $rubriques_wiki=picker_selected($rubriques_wiki_config,'rubrique');

    if($options=='array')return $rubriques_wiki;
    elseif($rubriques_wiki AND $id_rubrique) return sql_getfetsel("id_rubrique",'spip_rubriques','id_rubrique='.$id_rubrique.' AND id_secteur IN ('.implode(',',$rubriques_wiki).')');
    else return false;
    
    }

function name_country($id_pays){
    
    if($id_pays)$name=sql_getfetsel('nom','spip_geo_pays','id_pays='.$id_pays);
    
    return propre($name);
    }

function chaine_traduite($chaine){
    
    
    
    return $trad;
}


?>
