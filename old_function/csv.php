<?php 
// connexion à la base des données :  
include("connect_base.inc.php"); 
 
// on indique au navigateur qu'on va exporter un CSV 
header('Content-Type: text/csv'); 
header('Content-Disposition: attachment;filename='.$_GET['nom_table'].'.csv'); 
 
// selection de la table à exporter 
$select_table = mysql_query('select * from '.$_GET['nom_table']); 
$rows = mysql_fetch_assoc($select_table)
query($sql);
$rows = $select_table->fetch_assoc();
if($rows) {
makecsv(array_keys($rows));
}
while($rows) {
makecsv($rows);
$rows = $select_table->fetch_assoc();
}
// la fonction magique
function makecsv($num_field_names) {
$separate =  »;
// on formate les données pour remplacer les séparateurs par des traits d’union
foreach ($num_field_names as $field_name) {
$field_name = str_replace( array( »,  », « \n », « \r », « ; »), array( ‘-‘, ‘-‘, ‘-‘, ‘-‘, ‘,’), $field_name);
echo $separate . $field_name;
// on insère un séparateur de champ reconnu par Excel (si ça ne marche pas, essayez avec une virgule)
$separate = ‘;’;
}
// nouvelle rangée, nouvelle ligne
echo « \r\n »;
}
?>




<?

$maRequete = mysql_query("SELECT * FROM table"); //Requête à définir



header("Content-Type: application/csv-tab-delimited-table");

header("Content-disposition: filename=table.csv");   // indiquer le nom du fichier généré



if (mysql_num_rows($maRequete) != 0) {

 // titre des colonnes

 $fields = mysql_num_fields($maRequete);

 $i = 0;

 while ($i < $fields) {

   echo mysql_field_name($maRequete, $i).";";    // le ";" est le séparateur

   $i++;

 }

 echo "n";



 // données de la table

 while ($arrSelect = mysql_fetch_array($maRequete, MYSQL_ASSOC)) {

  foreach($arrSelect as $elem) {

   echo "$elem;";          // idem, le ";" est le séparateur

  }

  echo "n";

 }

}

?>