<?php

  include '../config.php';

  session_start();

  include '../start.php';
  include '../header.php';

?>


<div class="container-fluid" id="dashboard">
  <div class="row">
    <div class="col-lg-2">
      <div id="options-wrapper">
        <div id="side-menu-container">
          <ul id="side-menu">
            <a href="#"><li class="side-menu-item prompt active">Sales Summary</li></a>
            <a href="newBooking.php"><li class="side-menu-item prompt">New Booking</li></a>
            <!-- <a><li class="side-menu-item prompt">lorem ipsum</li></a> -->
          </ul>
        </div>
      </div>
    </div>
    <div class="col-lg-10">
      <div class="dashboard-container" id="salesSum-wrapper">
        <div class="cards-wrapper">
          <div class="card">
            <div class="card-body">
              <table class="table summary-table" id="total-sales">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>Booking Time</th>
                    <th>Billing Name</th>
                    <th>FB name</th>
                    <th>Location</th>
                    <th>Payment Method</th>
                    <th>Currency</th>
                    <th>Sales Value</th>
                    <th>Sales(AED)</th>
                    <th>Phone Number</th>
                  </tr>
                </thead>
                <tbody>
                  <?php

                    // $sql = 'SELECT b.BDate, b.BTime, c.CName, c.FbName, c.CLocation, b.PaymentMethod, b.Currency, b.SalesValue, b.SalesAed, c.CMobile
                    // FROM ((booking b
                    // INNER JOIN salesman s ON b.Sid = s.ID)
                    // INNER JOIN customer c ON b.Cid = c.ID)';
                    $_Sname = $_SESSION['user'];
                    // echo $_Sid;
                    $Sid_res = mysqli_fetch_array(mysqli_query($db,"SELECT Sid FROM salesman WHERE '$_Sname'=SEmail"));
                    $_Sid=$Sid_res['Sid'];
                    // var_dump($_Sid_res);
                    // var_dump($_Sid);
                    $sql = "SELECT * FROM booking, customer WHERE booking.Cid = customer.Cid && booking.Sid = '$_Sid'";

                    $res= mysqli_query($db, $sql);
                    // var_dump(mysqli_fetch_array($res));
                    // echo $_Sid;
                    while($rows=mysqli_fetch_array($res)){
                        echo "<tr>
                          <th scope='row'>".$rows['BDate']."</th>
                          <td>".$rows['BTime']."</td>
                          <td>".$rows['Cname']."</td>
                          <td>".$rows['FbName']."</td>
                          <td>".$rows['CLocation']."</td>
                          <td>".$rows['PaymentMethod']."</td>
                          <td>".$rows['Currency']."</td>
                          <td>".$rows['SalesValue']."</td>
                          <td>".$rows['SalesAed']."</td>
                          <td>".$rows['CMobile']."</td>
                        </tr>";
                    }
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
