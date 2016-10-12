<?php
class DbConnection {
  
  private $db_connection  = null;
  private $db_host     = 'localhost';
  private $db_user     = 'junior';
  private $db_password = 'junior';
  private $db_name     = 'UELibertador';
  private $errors      = array();
  
//  include_once("conexion.php");

  
  public function __construct()
  {
    /* $this->db_host     = $db_host;
    $this->db_user     = $db_user;
    $this->db_password = $db_password;
    $this->db_name     = $db_name; */
  }
  
  public function connect()
  {
   // $datos_bd="host='$this->host' dbname='$this->bd' user='$this->usuario' password='$this->password'"
    //$link=pg_connect($datos_bd);
    if ( !$this->db_connection = pg_connect('127.0.0.1', 'UELibertador', 'junior', 'junior') ) {
      throw new RunTimeException("Couldn't connect to the database server");
    }
    //if ( !@mysql_select_db($this->db_name, $this->db_connection) ) {
    //   throw new RunTimeException("Couldn't connect to the given database");
    // }
    //$this->executeQuery("SET CHARACTER SET 'utf8'");
  }
  
  public function disconnect(){
	  //pg_close($this->link)
	if(pg_close($this->db_connection)){
		return true;
	}
	return false;
  }
  
  public function getAllRows($sql)
  {
	  //pg_query($link,$sql)
    if ( !$results = pg_query($this->db_connection,$sql) ) {
      throw new RunTimeException("Couldn't execute query: " ); //. mysql_error($this->db_connection)
    }
    
    $count = 0;
    $rows  = array();
    //pg_fetch_array($dataobject)
    while ( $row = pg_fetch_array($results) ) { //fetch asoc
      $rows[] = $row;
      $count++;
    }
    return ($count)?$rows:false;
  }
  
  public function getOneColumn($sql)
  {
    if ( !$results = pg_query($this->db_connection,$sql) ) {
      throw new RunTimeException("Couldn't execute query: "); //. mysql_error($this->db_connection) 
    }
    
    $count = 0;
    $rows  = array();
    while ( $row = pg_fetch_array($results) ) {
      $rows[] = $row[0];
      $count++;
    }
    return ($count)?$rows:false;
  }
  
  public function getArrayPair($sql)
  {
    if ( !$results =pg_query($this->db_connection,$sql) ) {
      throw new RunTimeException("Couldn't execute query: " ); //. mysql_error($this->db_connection)
    }
    
    $count = 0;
    $rows  = array();
    while ( $row =  pg_fetch_array($results)  ) {
      $rows[$row[0]] = $row[1];
      $count++;
    }
    return ($count)?$rows:false;
  }
  
  public function getOneRow($sql)
  {
    if ( !$results = pg_query($this->db_connection,$sql)  ) {
      throw new RunTimeException("Couldn't execute query: ". mysql_error($this->db_connection) );
    }
    
    if ( $row =  pg_fetch_array($results) ) { //fetch asoc
      return $row;
    }
    return false;
  }
  
  public function getOneValue($sql)
  {
    if ( !$results = pg_query($this->db_connection,$sql)  ) {
      throw new RunTimeException("Couldn't execute query: " ); //. mysql_error($this->db_connection)
    }
    
    if ( $row = pg_fetch_array($results)) {
      return $row[0];
    }
    return false;
  }
  
  public function executeQuery($sql)
  {
    if ( !pg_query($this->db_connection,$sql) ) {
      $this->errors[] = "error en db";//mysql_error($this->db_connection);
      return false;
    }
    return true;
  }
  
  public function getErrors()
  {
    return $this->errors;
  }
  
  public function getLastId()
  {
    return "no se que hace";//mysql_insert_id($this->db_connection);
  }
  
  public function countRows($table)
  {
    if (!is_string($table)) {
      throw new InvalidArgumentException("table_name isn't an string");
    }
	//  pg_query($this->db_connection,$sql)
	if ( !$results = pg_query($this->db_connection,"SELECT COUNT(*) as total FROM $table") ) {
      throw new RunTimeException("Couldn't execute query: " ); //. mysql_error($this->db_connection)
    }
	// pg_fetch_array($results)
    $count =  pg_fetch_array($results); //mysql_fetch_array($results);
	$count = $count['total'];
    return ($count)?$count:0;
  }
}

?>
