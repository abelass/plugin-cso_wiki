<?php
if (!defined("_ECRIRE_INC_VERSION")) return;

function wiki_cso_declarer_champs_extras($champs = array()) {
    

  
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
  
  $c= array('extra_1','extra_2','extra_3','extra_4','extra_5','extra_6','extra_7','extra_8','extra_9','extra_10','extra_11');
  foreach($c AS $champ)  {
    $titre='';
    if(_request('id_article'))$titre=sql_getfetsel('titre','spip_articles','id_article='._request('id_article'));
    $champs['spip_articles'][$champ] = array(
      'saisie' => 'textarea',//Type du champ (voir plugin Saisies)
      'options' => array(
            'nom' => $champ, 
            'label' => _T('wiki_cso:'.$champ,array('titre'=>$titre)), 
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

 
   return $champs;	
}
?>
