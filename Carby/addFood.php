<?php
// Only process the form if $_POST isn't empty
if ( ! empty( $_POST ) ) {
  
  // Connect to MySQL
  $mysqli = new mysqli( 'localhost', 'elizeweb_softwar', 'CS3398', 'elizeweb_Carby' );
  
  // Check connection
  if ( $mysqli->connect_error ) {
    die( 'Connect Error: ' . $mysqli->connect_errno . ': ' . $mysqli->connect_error );
  }
  
  // Insert data
  $sql = "INSERT INTO foodTest (FoodName,Grams,Oz,Carbs) VALUES ( '{$mysqli->real_escape_string($_POST['FoodName'])}', '{$mysqli->real_escape_string($_POST['Grams'])}', '{$mysqli->real_escape_string($_POST['Oz'])}','{$mysqli->real_escape_string($_POST['Carbs'])}' )";
  $insert = $mysqli->query($sql);
  
  // Print response
  if ( $insert ) {
    echo "Success! Row ID: {$mysqli->insert_id}";
  } else {
    die("Error: {$mysqli->errno} : {$mysqli->error}");
  }
  
  // Close connection
  $mysqli->close();
}
?>
