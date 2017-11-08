<?php

  include 'config.php';

  session_start();

  include 'start.php';

  // if($_SERVER['REQUEST_METHOD'] == 'POST') {
  if(isset($_POST['username'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM login WHERE Uname = '$username' and Password = '$password' limit 1";
    $sq = "SELECT * FROM salesman WHERE SEmail = '$username' limit 1";

    $res = mysqli_query($db, $sql);
    $re = mysqli_query($db, $sq);
    //$row = mysqli_fetch_array($res, MYSQLI_ASSOC);

    //$count = mysqli_num_rows($res);

    //console.log($res);
    if($row=mysqli_fetch_array($re)){
      $_SESSION['id'] = $row['Sid'];
    }
    $rows=mysqli_fetch_array($res);
    if($rows){

      $_SESSION['user'] = $rows['Uname'];
      //You'll need this for log out and stuff.

      if($rows['Type'] == 'A'){
          echo "<script>window.location = 'Admin/dashboard-salesSum.php';</script>";
      }else {
        echo "<script>window.location = 'salesTeam/salesSum.php';</script>";
      }
      // var_dump($rows['Uname']);
      // var_dump($_SESSION['user']);
    }else{
      // echo "Didn't enter if\n";
      // var_dump($rows['Uname']);
      echo "<span style='color:red;'>The username or password entered was incorrect. Please try again.</span>";
    }

  }

 ?>

<link rel="stylesheet" href="styles.css"/>
<link href="hover-min.css" rel="stylesheet" media="all">

<div class="container-fluid login-container">
  <div class="left-side">

  </div>
  <div class="right-side">
    <div class="login-wrapper">
      <div class="card">
        <div class="card-body">
          <h4>Login</h4>
          <small>Log in to ZQ Account</small>
          <form method="POST" action='index.php'>
            <div class="form-group">
              <input class="form-control" id="uname" name="username" autofocus/>
              <label for="uname">Username</label>
            </div>
            <div class="form-group">
              <input class="form-control" id="passwd" name="password" type="password"/>
              <label for="passwd">Password</label>
            </div>
            <a href="#"><span>Forgot your password?</span></a>
            <button class="btn submit-btn" name="submit" type="submit">Next</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'end.php'; ?>
