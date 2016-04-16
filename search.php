<?php
//Check if search data was submitted
if ( isset( $_GET['name'] ) ) {
  // Include the search class
  require_once( dirname( __FILE__ ) . '/class-search.php' );
  
  // Instantiate a new instance of the search class
  $search = new search();
  
  // Store search term into a variable
  $search_term = htmlspecialchars($_GET['name'], ENT_QUOTES);
  
  // Send the search term to our search class and store the result
  $search_results = $search->search($search_term);
}
?> 