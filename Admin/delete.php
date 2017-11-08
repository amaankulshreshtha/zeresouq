
<?php
  include '../config.php';
  session_start();
  include '../start.php';
  include '../header.php';
  if(isset($_POST['Sid'])){
    $Sid = $_POST['Sid'];
    $res = mysqli_query($db, "DELETE FROM salesman WHERE Sid = '$Sid'");
    echo "<script>window.location = 'settings.php';</script>";
  }
include '../end.php';
?>
