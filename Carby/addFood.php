<?php
global $wpdb;
$wpdb->insert("wp_Food_Test", array(
   "FoodName" => $FoodName,
   "Grams" => $Grams,
   "Oz" => $Oz,
   "Carbs" => $Carbs,
));
?>