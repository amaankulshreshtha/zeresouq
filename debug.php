<?php

  include 'config.php';
  //include 'start.php';

  // session_start();
  //
  // $sql = "SELECT * FROM login";
  //
  // var_dump(mysqli_fetch_array(mysqli_query($db, $sql)));

  // if($_SERVER['REQUEST_METHOD'] == 'POST') {
  //   $username = mysqli_real_escape_string($db, $_POST['uname']);
  //   $password = md5(mysqli_real_escape_string($db, $_POST['passwd']));
  //
  //   $sql = "SELECT Uname FROM login WHERE Uname = '$username' and Password = '$password' limit 1";
  //
  //   $res = mysqli_query($db,$sql);
  //   //$row = mysqli_fetch_array($res,MYSQLI_ASSOC);
  //
  //   //$count = mysqli_num_rows($res);
  //
  //   //console.log($res);
  //   var_dump($res);
  //
  //   if($rows=mysqli_fetch_array($res)){
  //     if($username==$row['Uname'] and $password==['Password']) {
  //       $_SESSION['user'] = $_POST['uname'];
  //
  //       if($rows['Type'] == 'A'){
  //           echo "<script>window.location = 'dashboard-salesSum.php';</script>";
  //       }
  //     }
  //   }else{
  //       echo "<span style='color:red;'>The username or password entered was incorrect. Please try again.</span>";
  //   }
  //
  // }



  $point = 0;

switch (true) {
    case $point >= 80:
        echo 'A';
        break;
    case $point >= 70:
        echo 'B';
        break;
    case $point >= 50:
        return 'C';
        break;
    case $point >= 30:
        echo 'D';
        break;
    case $point >= 0:
        echo 'E';
        break;
    default:
        echo 'F';
        break;
}


 ?>
