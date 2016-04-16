<?php
/**
 * Performs a search
 *
 * This class is used to perform search functions in a MySQL database
 *
 */
class search {
  /**
   * MySQLi connection
   * @access private
   * @var object
   */
  private $mysqli;
  
  /**
   * Constructor
   *
   * This sets up the class
   */
  public function __construct() {
    // Connect to our database and store in $mysqli property
    $this->connect();
  }
  /**
   * Database connection
   * 
   * This connects to our database
   */
  private function connect() {
    $this->mysqli = new mysqli( 'localhost', 'food', 'food', 'food' );
  }
  
  /**
   * Search routine
   * 
   * Performs a search
   * 
   * @param string $search_term The search term
   * 
   * @return array/boolen $search_results Array of search results or false
   */
  public function search($search_term) {
    // Sanitize the search term to prevent injection attacks
    $sanitized = $this->mysqli->real_escape_string($search_term);
    
    // Run the query
    $query = $this->mysqli->query("
      SELECT *
      FROM table 1
      WHERE sdsFoodName LIKE '%{$sanitized}%'
      OR Carbs LIKE '%{$sanitized}%'
    ");
    
    // Check results
    if ( ! $query->num_rows ) {
      return false;
    }
    
    // Loop and fetch objects
    while( $row = $query->fetch_object() ) {
      $rows[] = $row;
    }
    
    // Build our return result
    $search_results = array(
      'count' => $query->num_rows,
      'results' => $rows,
    );
    
    return $search_results;
  }
}