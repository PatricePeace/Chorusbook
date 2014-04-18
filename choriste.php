<?php

include("config.php");	// Configuration base de données
include("layout.php");	// Fichier de mise en page

// Afficher l'entete
entete("Stats");

// Afficher le menu
menu("choriste");

# Traitement spécifique de la page #
if (isset($_SESSION['login']))
	$stats = $db->getStats();

else $stats = $db->getAllChoristes();

####################################

// Ecrire le contenu de la page

$colspan = 3;
$style   = '';
$contenu = '
  <table id ="tableau" border=1> 
     <tbody>
     <tr align=centers>
        <th> NOM </th>
        <th> PRENOM </th>
        <th> RESPONSABILITE </th>';
		if (isset($_SESSION['login']))
        {
        	$contenu .='
        <th> COORDONNEES </th>
        <th> PRESENCE REPETITION </th>
        <th> REPETITIONS MANQUEES </th>
       <th> %  </th>';
                $colspan = 6;
                $style  = ' style="border-right:none" ';
        }
        
$contenu .= '</tr>' ;

$i = 1 ; 

$presence_alto    = 0;
$presence_tenor   = 0;
$presence_basse   = 0;
$presence_soprano = 0;
$nb_ch_alto    = 0;
$nb_ch_tenor   = 0;
$nb_ch_basse   = 0;
$nb_ch_soprano = 0;

$text_alto = '';
$text_tenor = '';
$text_basse = '';
$text_soprano = '';

foreach($stats as $stat){
	
   //libéllés voix 
   if($stat['idvoix'] == 1){
      if (isset($_SESSION['login']))
      {
         $presence_alto += $stat['nb_presence'];
         $text_alto = '[TAUX_ALTO]';
      }   
      $nb_ch_alto++;
      if($i == 1)
      {
         $contenu.='<tr align=center><th colspan='.$colspan.' '.$style.' class="sep_tableau"> ALTO </th>'.$text_alto.'</tr>' ;
         $i++ ;
      }
   }

   if($stat['idvoix'] == 2 && $i == 2){
      if (isset($_SESSION['login']))
      {
         $presence_tenor += $stat['nb_presence'];
         $text_tenor = '[TAUX_TENOR]';
      }   
      $nb_ch_tenor++;
      if($i == 2)
      {
         $contenu.='<tr align=center><th colspan='.$colspan.' '.$style.' class="sep_tableau"> TENOR  </th>'.$text_tenor.'</tr>' ;
         $i++ ;
      }
   }

   if($stat['idvoix'] == 3){
      if (isset($_SESSION['login']))
      {
         $presence_basse += $stat['nb_presence'];
         $text_basse = '[TAUX_BASSE]';
      }   
      $nb_ch_basse++;
      if($i == 3)
      { 
         $contenu.='<tr align=center><th colspan='.$colspan.' '.$style.' class="sep_tableau"> BASSE </th>'.$text_basse.'</tr>' ;
         $i++ ;
      }
   }

   if($stat['idvoix'] == 4){
      if (isset($_SESSION['login']))
      {
         $presence_soprano += $stat['nb_presence'];
         $text_soprano = '[TAUX_SOPRANO]';
      }   
      $nb_ch_soprano++;
      if($i == 4)
      {
         $contenu.='<tr align=center><th colspan='.$colspan.' '.$style.' class="sep_tableau">  SOPRANO  </th>'.$text_soprano.'</tr>' ;
         $i++ ;
      }
   }

   if(isset($_SESSION['login']))
   {
      $nb_repete_abs = $stat['nb_repete'] - $stat['nb_presence']  ;
      $taux_presence = number_format($stat['nb_presence']/$stat['nb_repete'],2)*100 ;
      $nb_repete = $stat['nb_repete'];
   }


   $contenu .= '<tr align=center> 
                     <td>'.$stat['nom'].'</td>
                     <td>'.$stat['prenom'].'</td>';
   $contenu .= '<td>'.str_replace('{','', str_replace('}','',str_replace('NULL','',str_replace(',', ', ',$stat['responsabilite'])))).'</td>';

   if (isset($_SESSION['login']))
   {
      $contenu .='<td>'.$stat['ville'].' - '
                  .$stat['telephone'].'</td>
                  <td>'.$stat['nb_presence'].'</td>
                  <td>'.$nb_repete_abs.'</td>
                  <td>'.$taux_presence.'%</td>';
   }  
   $contenu .= '</tr>' ;
}

$contenu.= '</tbody> </table>' ;

if(isset($_SESSION['login']))
{
   $taux_alto = number_format(($presence_alto)/($nb_repete*$nb_ch_alto)*100,2);
   $taux_tenor = number_format(($presence_tenor)/($nb_repete*$nb_ch_tenor)*100,2);
   $taux_basse = number_format(($presence_basse)/($nb_repete*$nb_ch_basse)*100,2);
   $taux_soprano = number_format(($presence_soprano)/($nb_repete*$nb_ch_soprano)*100,2);

   $contenu = str_replace($text_alto,'<th class="sep_tableau" style="border-left:none">'.$taux_alto.'%</th>',$contenu);
   $contenu = str_replace($text_tenor,'<th class="sep_tableau" style="border-left:none">'.$taux_tenor.'%</th>',$contenu);
   $contenu = str_replace($text_basse,'<th class="sep_tableau" style="border-left:none">'.$taux_basse.'%</th>',$contenu);
   $contenu = str_replace($text_soprano,'<th class="sep_tableau" style="border-left:none">'.$taux_soprano.'%</th>',$contenu);
}
// Afficher le contenu de la page
page($contenu);

// Afficher le pied de page
pied();

?>
