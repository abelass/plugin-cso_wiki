<?php
/**
 * Plugin Wiki Cso-effectiveness
 * (c) 2012 My Chacra
 * Licence GNU/GPL
 */

if (!defined('_ECRIRE_INC_VERSION')) return;




function wiki_cso_recuperer_fond($flux){

	$fond=$flux['args']['fond'] ;


	//Intervention dans le formulaire edition_article
    if ($fond == 'formulaires/editer_article' AND !_request('exec')){
        
        $texte=$flux['data']['texte'];
    	$contexte=$flux['args']['contexte'];
        $id_article=$contexte['id_article']	;
		
		$id_parent=$contexte['id_parent'];


		$patterns = array(
		  "#\<li class=\"editer editer_parent\"\>(.+?)\<\/li\>#s",
		  "#\<li class=\"editer editer_soustitre\"\>(.+?)\<\/li\>#s",
          );
		$form_id_parent='<li class="invisible"><input type="hidden" name="id_parent" value="'.$id_parent.'"/></li>';
        if(!intval($id_article))$forms_extras=recuperer_fond('formulaires/forms_extras',$contexte);
	    
		$replacements = array($form_id_parent, $forms_extras);						
		$flux['data']['texte'] = preg_replace($patterns,$replacements,$texte,1);
		

    }	
	

 return $flux;   
}


function wiki_cso_formulaire_charger($flux){
    $form = $flux['args']['form'];

    if ($form =='editer_article' AND !_request('exec')){
        include_spip('inc/config');
         $lang_dest=_request('lang_dest')?_request('lang_dest'):_request('lang');
    
        if(!in_array($lang ,array('en','fr','es'))) $lang='en';
  
		$link_source=_request('link_source');

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

      
    
        $flux['data']['articles']=$articles;
		$flux['data']['lang_dest']= $lang_dest;
		$flux['data']['link_source']=$link_source;
 		$flux['data']['type_lien']=_request('type_lien');
        $flux['data']['_hidden'].='<input type="hidden" name="lang_dest" value="'. $lang_dest.'"/>';              
		}

	return $flux ;
}

function wiki_cso_formulaire_verifier($flux){
    $form = $flux['args']['form'];

    
    //charger la valeur custom dans editer rubrique
    if ($form =='editer_article'  AND !_request('exec')){
       $obligatoires=array('link_source','type_lien');
         
         foreach($obligatoires AS $champ){
               if(!_request($champ))$flux['data'][$champ]=_T("info_obligatoire");
              }

    }
    
    return $flux ;
}


function wiki_cso_formulaire_traiter($flux){
    $form = $flux['args']['form'];

    
    //charger la valeur custom dans editer rubrique
    if ($form =='editer_article'  AND !_request('exec')){
		$id_article=$flux['data']['id_article'];
        

		
		if($id_article_origine=_request('lier_trad')){
			$lang=_request('lang_dest');
			$id_trad_or=sql_getfetsel('id_trad','spip_articles','id_article='.$id_article_origine);
			if($id_trad_or > 0)sql_updateq('spip_articles',array('lang'=>$lang,'langue_choisie'=>'oui','id_trad'=>$id_trad_or),'id_article='.$id_article);
			else{
				sql_updateq('spip_articles',array('id_trad'=>$id_article_origine),'id_article='.$id_article_origine);
				sql_updateq('spip_articles',array('lang'=>$lang,'langue_choisie'=>'oui','id_trad'=>$id_article_origine),'id_article='.$id_article);
				}
			}
		elseif($type_lien=_request('type_lien') AND $link_source=_request('link_source')){
		    
			$sql=sql_fetsel('rang','spip_articles_lies','id_article='.$link_source.' AND type_liaison='.sql_quote($type_lien),'','rang DESC');
			$rang=$sql['rang']+1;
			sql_insertq('spip_articles_lies',array('id_article'=>$link_source,'id_article_lie'=>$id_article,'rang'=>$rang,'type_liaison'=>$type_lien));
            
           if(_request('link_source')){
               include_spip('inc/config');
               $rubriques_wiki=picker_selected(lire_config('rubriques_ressources_wiki'),'rubrique');
                $id_rub=sql_getfetsel('id_rubrique','spip_articles','id_article='._request('link_source'))  ;

              $id_rubrique=sql_getfetsel('id_rubrique','spip_rubriques','id_parent='.$id_rub)  ;
                 sql_updateq('spip_articles',array('id_rubrique'=>$id_rubrique),'id_article='.$id_article);   
        }
		}
	}
	
	return $flux ;
}



?>