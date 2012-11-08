<?php
if (!defined("_ECRIRE_INC_VERSION")) return;

// Les champs extras via le plugin cextras

function wiki_cso_declarer_champs_extras($champs = array()) {
    

  // Table spip_articles
  $champs['spip_articles']['pays'] = array(
      'saisie' => 'pays',//Type du champ (voir plugin Saisies)
      'options' => array(
            'nom' => 'pays', 
            'label' => _T('wiki_cso:pays'), 
            'sql' => "varchar(30) NOT NULL DEFAULT ''",
            'versionner' => true,
            'restrictions'=>array(
				'voir' => array('auteur' => ''),//Tout le monde peut voir
				'modifier' => array('auteur' => ''),
                        ),//Seuls les webmestres peuvent modifier
				)
  );
 
  // Traitement spéciale suivant les rubriques -> pas très propre mais ça marche
   $titre='';
    if(_request('id_article')){
        $id_article=_request('id_article');
        $sql=sql_fetsel('titre,id_rubrique','spip_articles','id_article='.$id_article);
        $titre=$sql['titre'];
        $id_rubrique=$sql['id_rubrique'];
        }
    if($id_rubrique==2) $c= array('extra_1','extra_2','extra_3','extra_4','extra_5','extra_6','extra_7','extra_8','extra_9','extra_10');
    if($id_rubrique==3) $c= array('extra_1','extra_2','extra_3','extra_4','extra_5','extra_6','extra_7','extra_8','extra_9','extra_10','extra_11');    
    if(in_array($id_rubrique,array(2,3))){
  

  foreach($c AS $champ)  {

    $champs['spip_articles'][$champ] = array(
      'saisie' => 'textarea',//Type du champ (voir plugin Saisies)
      'options' => array(
            'nom' => $champ, 
            'label' => _T('wiki_cso:'.$champ.'_'.$id_rubrique,array('titre'=>$titre)), 
            'sql' => "text NOT NULL DEFAULT ''",
            'versionner' => true,
            'traitements' => '_TRAITEMENT_TYPO',
            'recherche' => true,                                   
            'restrictions'=>array(
                'rubrique' => '2:3', 
                'voir' => array('auteur' => ''),//Tout le monde peut voir
                'modifier' => array('auteur' => ''),
                        ),//Seuls les webmestres peuvent modifier
                )
        );  
       
  }
  }

  // Table spip_documents
  
   $champs['spip_documents']['related_info'] = array(
      'saisie' => 'oui_non',//Type du champ (voir plugin Saisies)
      'options' => array(
            'nom' => 'related_info', 
            'label' => _T('docs_rel'), 
            'sql' => "varchar(10) NOT NULL DEFAULT ''",
            'versionner' => false,
            'restrictions'=>array(
                'voir' => array('auteur' => ''),//Tout le monde peut voir
                'modifier' => array('auteur' => ''),
                        ),//Seuls les webmestres peuvent modifier
                )
  );
 
 
   return $champs;	
}
?>
