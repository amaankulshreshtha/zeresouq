
<?php
  include '../config.php';
  session_start();
  include '../start.php';
  // include '../header.php';
  if(isset($_POST['Sid'])){
    $Sid = $_POST['Sid'];
    $res = mysqli_query($db, "DELETE FROM salesman, login WHERE Sid = '$Sid' AND Uname=SName");
    $res = mysqli_query($db, "DELETE FROM salesman WHERE Sid = '$Sid'");
    $res = mysqli_query($db, "ALTER TABLE salesman AUTO_INCREMENT = 1000;");
    // $res2 = mysqli_query($db, "DELETE FROM login ")
    // echo $Sid;
    // mysqli_query("$db", "ALTER table salesman AUTO_INCREMENT = '$Sid'");
    // echo "
    // <div class='alert alert-success alert-dismissible fade show' role='alert'>
    //   <strong>Sucess !</strong> New user added successfully.
    //   <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    //     <span aria-hidden='true'>&times;</span>
    //   </button>
    // </div>
    // ";
    echo "<script>window.location = 'settings.php';</script>";
  }
include '../end.php';
?>
