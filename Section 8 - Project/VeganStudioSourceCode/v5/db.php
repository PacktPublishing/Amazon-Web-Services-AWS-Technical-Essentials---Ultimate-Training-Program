<?php
define('DB_SERVER', 'Enter Your Database Endpoint DNS Name Here');

define('DB_USERNAME', 'Enter Your Database Username');

define('DB_PASSWORD', 'Enter Your Database Password');

define('DB_DATABASE', 'Enter Your Database Name');

/* Connect to MySQL and select the database. */
$connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

if (mysqli_connect_errno()) {
echo json_encode(array('message'=>"Failed to connect to MySQL: " . mysqli_connect_error(),'status'=>'error'));die();
}

$database = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
// $database = mysqli_select_db($connection, DB_DATABASE);


/* Add an Contents to the table. */
function addContest($data) {


  global $database;
   $n = mysqli_real_escape_string($database, $data['name']);
   $e = mysqli_real_escape_string($database, $data['email']);
   $r = mysqli_real_escape_string($database, $data['recipe_name']);
   $i = mysqli_real_escape_string($database, $data['ingredients']); 
   $m = mysqli_real_escape_string($database, $data['method']);
   $re = mysqli_real_escape_string($database, $data['region']);
   $query = "INSERT INTO CONTEST (name, email, recipe_name, ingredients, method, region) VALUES ('$n', '$e', '$r', '$i', '$m', '$re');";
   if(!mysqli_query($database, $query)) {
      echo json_encode(array('message'=>'Error on submit data','status'=>'error', 'sql_error'=>mysqli_error($database))); 
      die();
    }
    else {
      echo json_encode(array('message'=>'Thank you for participation!','status'=>'success'));
      die();
    }
}

/* Check whether the table exists and, if not, create it. */
function verifyContestTable() {
  global $database;
  $table = 'CONTEST';  
  if(!isTableExists($table))
  {
     $query = "CREATE TABLE $table (id int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, name VARCHAR(50), email VARCHAR(50), recipe_name VARCHAR(100), ingredients TEXT, method TEXT,region VARCHAR(50),  created timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP);";
     if(!mysqli_query($database, $query))  { 
         echo json_encode(array('message'=>' Error on create table!','status'=>'error', 'sql_error'=>mysqli_error($database))); 
         die();
      }
  }
}

/* Check for the existence of a table. */
function isTableExists($tableName) {
  global $connection;
  $t = mysqli_real_escape_string($connection, $tableName);
  $d = mysqli_real_escape_string($connection, DB_DATABASE);

  $checktable = mysqli_query($connection,
      "SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_NAME = '$t' AND TABLE_SCHEMA = '$d'");

  if(mysqli_num_rows($checktable) > 0) return true;

  return false;
}

function getContest(){
  global $database;
  $data = array();
  $q = "SELECT * FROM CONTEST ";
  if ($result = mysqli_query($database, $q)) {
    /* fetch associative array */
    while ($row = mysqli_fetch_assoc($result)) {
      $data[] = $row;
    }
    /* free result set */
    mysqli_free_result($result);
  }
  return $data;
}