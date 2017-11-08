<?php
  include '../config.php';
  session_start();
  include '../start.php';
  include '../header.php';
?>

<div class="container-fluid" id="dashboard">
  <div class="row">
    <div class="col-lg-1">
      <div id="options-wrapper">
        <div id="side-menu-container">
          <ul id="side-menu">
            <li class="side-menu-item prompt"><a href="dashboard-salesSum.php"><i class="fa fa-th-list" aria-hidden="true"></i></a></li>
            <li class="side-menu-item prompt"><a href="dashboard-salesman.php"><i class="fa fa-users" aria-hidden="true"></i></a></li>
            <li class="side-menu-item prompt active"><a href="#"><i class="fa fa-cogs" aria-hidden="true"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-lg-11">
      <div class="dashboard-container" id="settings-dashboard">
        <div class="cards-wrapper">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="add-tab" data-toggle="tab" href="#add" role="tab" aria-controls="add" aria-selected="true">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="remove-tab" data-toggle="tab" href="#remove" role="tab" aria-controls="remove" aria-selected="false">Remove</a>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="add" role="tabpanel" aria-labelledby="add-tab">

              <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" id="newUser">
                <div class="form-group">
                  <label>Name: </label><input type="text" name="SName" class="custom-input"/>
                </div>
                <div class="form-group">
                  <label>Email: </label><input type="email" name="SEmail" class="custom-input"/>
                </div>
                <div class="form-group">
                  <label>Mobile: </label><input name="SMobile" class="custom-input"/>
                </div>
                <div class="form-group">
                  <label>Gender: </label>
                  <select name="Gender" class="custom-input">
                    <option disabled selected value>-- select an option --</option>
                    <option value="M">M</option>
                    <option value="F">F</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Station: </label>
                  <select name="Station" class="custom-input">
                    <option disabled selected value>-- select an option --</option>
                    <option value="IND">IND</option>
                    <option value="UAE">UAE</option>
                  </select>
                </div>
                <button name="submit" type="submit" class="btn btn-primary">Submit</button>
              </form>
              <?php

                  if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['SName'])){
                    // previously this statement was being executed also when you deleted something so you had empty records,
                    $SName = trim($_POST['SName']);
                    $SEmail = trim($_POST['SEmail']);
                    $SMobile = trim($_POST['SMobile']);
                    $Gender = trim($_POST['Gender']);
                    $Station = trim($_POST['Station']);
                    $res = mysqli_query($db,"INSERT INTO salesman(SName, SEmail, SMobile, Gender, Station) VALUES ('$SName','$SEmail','$SMobile','$Gender','$Station')");
                  }
              ?>
            </div>
            <div class="tab-pane fade" id="remove" role="tabpanel" aria-labelledby="remove-tab">

              <table class="table summary-table" id="user-delete">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email ID</th>
                    <th>Station</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php

                    $res = mysqli_query($db, "SELECT * FROM salesman");

                    while($rows=mysqli_fetch_array($res)){
                      echo"
                      <tr>
                        <td>".$rows['Sid']."</td>
                        <td>".$rows['SName']."</td>
                        <td>".$rows['SEmail']."</td>
                        <td>".$rows['Station']."</td>
                        <td>
                          <form method='POST' action='delete.php'>
                            <input type='hidden' value='".$rows['Sid']."' name='Sid'/>
                            <button class='btn btn-danger' name='submit' type='submit'>Remove</button>
                          </form>
                        </td>
                      </tr>";

                    }
                    // if($_SERVER['REQUEST_METHOD']=='POST'){
                    //   $Sid = $_POST['Sid'];

                    //   echo $Sid;
                    //  if(isset($_POST['Sid'])){
                    //    $Sid = $_POST['Sid'];
                    //    $res = mysqli_query($db, "DELETE FROM salesman WHERE Sid = '$Sid'");
                    //  }
                    //
                    // }

                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<?php include '../end.php' ?>
