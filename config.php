<?php
  define('DB_SERVER', 'localhost');
  define('DB_USERNAME', 'root');
  define('DB_PASSWORD', '');
  define('DB_DATABASE', 'zqdb');

  $db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

  mysqli_query($db, "SET NAMES utf8");

  if($db->connect_error) {
    die("Connection failed:". $db->connect_error);
  }
  // else {}
  //   echo "Tadpole :3";
  // }
?>
