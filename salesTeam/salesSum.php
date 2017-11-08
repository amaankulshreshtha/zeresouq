<?php

  include '../config.php';

  session_start();

  include '../start.php';
  include '../header.php';

?>


<div class="container-fluid" id="dashboard" style="height:100%">
  <div class="row" style="height:100%">
    <div class="col-lg-1">
      <div id="options-wrapper">
        <div id="side-menu-container">
          <ul id="side-menu">
            <li class="side-menu-item prompt active"><a href="#"><i class="fa fa-th-list" aria-hidden="true"></i></a></li>
            <li class="side-menu-item prompt"><a href="newBooking.php"><i class="fa fa-user-plus" aria-hidden="true"></i></a></li>
            <!-- <a><li class="side-menu-item prompt">lorem ipsum</li></a> -->
          </ul>
        </div>
      </div>
    </div>
    <div class="col-lg-11">
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
                    $limit = 20;
                    if (isset($_GET['page']) && !empty($_GET['page'])) {
                       $page  = $_GET['page'];
                    }else {
                      $page=1;
                    }
                    //echo $page;
                    $start = ($page * $limit) - $limit;
                    // echo $page.' ';
                    // echo $limit.' ';
                    // echo $start.' ';
                    // echo $_Sid;
                    $Sid_res = mysqli_fetch_array(mysqli_query($db,"SELECT Sid FROM salesman WHERE '$_Sname'=SEmail"));
                    $_Sid=$Sid_res['Sid'];
                    // var_dump($_Sid_res);
                    // var_dump($_Sid);
                    $sql = "SELECT * FROM booking b, customer c WHERE b.Cid = c.Cid && b.Sid = '$_Sid' ORDER BY b.Bid DESC LIMIT $start, $limit";
                    $totalrows = mysqli_num_rows(mysqli_query($db,"SELECT * FROM booking b, customer c WHERE b.Cid = c.Cid && b.Sid = '$_Sid'"));
                    $res= mysqli_query($db, $sql);
                    // var_dump(mysqli_fetch_array($res));
                    // echo $_Sid;
                      while($rows=mysqli_fetch_array($res)){
                        // var_dump($rows);
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
              <?php
                $endPage = ceil($totalrows/$limit);
                $previousThirdPage = $page-2;
                $previousPage = $page-1;
                $startPage = $page-5;
                $nextPage = $page+1;
                $thirdPage = $page+2;
                $end = $page+5;
                $beginning = 1;
                // var_dump($page);
                // var_dump($startPage);
                // var_dump($end);
              ?>
              <ul class="pagination">
                <?php if($page >= $beginning+5): ?>
                  <li class="page-item">
                    <a class="page-link" href="?page=<?php echo $startPage ?>" tabindex="-1" aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                      <span class="sr-only">First</span>
                    </a>
                  </li>
                <?php endif; ?>
                <?php if($page > 2){ ?>
                  <li class="page-item"><a class="page-link" href="?page=<?php echo $previousThirdPage ?>"><?php echo $previousThirdPage ?></a></li>
                <?php } ?>
                <?php if($page > 1){ ?>
                  <li class="page-item"><a class="page-link" href="?page=<?php echo $previousPage ?>"><?php echo $previousPage ?></a></li>
                <?php } ?>
                <li class="page-item active"><a class="page-link" href="?page=<?php echo $page ?>"><?php echo $page ?></a></li>
                <?php if($page != $end){ ?>
                  <li class="page-item"><a class="page-link" href="?page=<?php echo $nextPage ?>"><?php echo $nextPage ?></a></li>
              <?php } ?>
              <?php if($page != $end){ ?>
                <li class="page-item"><a class="page-link" href="?page=<?php echo $thirdPage ?>"><?php echo $thirdPage ?></a></li>
              <?php } ?>
                <?php if($page != $end){ ?>
                  <li class="page-item">
                    <a class="page-link" href="?page=<?php echo $end ?>" aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                      <span class="sr-only">Last</span>
                    </a>
                  </li>
                <?php } ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php

  include '../end.php';

  ?>
