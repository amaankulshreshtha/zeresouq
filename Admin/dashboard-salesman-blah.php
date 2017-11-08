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
                <li class="side-menu-item prompt active"><a href="#"><i class="fa fa-users" aria-hidden="true"></i></a></li>
                <li class="side-menu-item prompt"><a href="settings.php"><i class="fa fa-cogs" aria-hidden="true"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-lg-11">
          <div class="dashboard-container" id="salesman-wrapper">
            <div class="cards-wrapper">
              <div class="cards-container">
                <div class="card">
                  <div class="card-body">
                    <table class="summary-table table" id="transaction-sum">
                      <thead>
                        <tr>
                          <th>Date</th>
                          <th>No. of Transactions</th>
                          <th>Value(in AED)</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php

                        $sql ="SELECT IFNULL(BDate,'Total') as Date, BDate, COUNT(*) as Transaction, SUM(SalesAed) FROM booking GROUP BY BDate ASC WITH ROLLUP";
                        $res = mysqli_query($db, $sql);
                        //var_dump($rows);
                        $max = mysqli_fetch_array(mysqli_query($db, "SELECT SUM(SalesAed) FROM booking GROUP BY BDate ORDER BY SUM(SalesAed) DESC LIMIT 1"));
                        //var_dump(($max));
                        while($rows = mysqli_fetch_array($res)) { ?>

                            <tr>
                              <?php if($rows['SUM(SalesAed)']==$max['SUM(SalesAed)']){ ?>
                                <td class="max"><?php echo $rows['Date']; ?></td>
                                <td class="max"><?php echo $rows['Transaction']; ?></td>
                                <td class="max"><?php echo $rows['SUM(SalesAed)']; ?></td>
                              <?php }else{ ?>
                              <td><?php echo $rows['Date']; ?></td>
                              <td><?php echo $rows['Transaction']; ?></td>
                              <td><?php echo $rows['SUM(SalesAed)']; ?></td>
                            </tr>

                        <?php }

                      }?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="card">
                  <div class="card-body">
                    <table class="summary-table table" id="salesman-sum">
                      <tbody>
                        <?php

                        $res1=mysqli_query($db,"SELECT DISTINCT(BDate) from booking order by BDate");

                        while($row=mysqli_fetch_array($res1)){

                          $date = $row['BDate'];

                          $N_sql = "SELECT *, SUM(SalesAed) FROM booking where BDate = '$date' GROUP BY Sid";
                          $N_res = mysqli_query($db, $N_sql);

                          while($rows=mysqli_fetch_array($N_res)){
                            echo "
                            <tr>
                              <th scope='row'>".$rows['Sid']."</th>
                              <td>".$rows['SUM(SalesAed)']."</td>
                            </tr>
                            ";
                            }
                          }
                          ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-12">
                  <div id="sorted-sum-wrapper">
                    <div class="card">
                      <div class="card-body">
                        <table class="table summary-table" id="salesman-wise">
                          <thead>
                            <tr>
                              <th>Sales Person</th>
                              <th>No. of Transactions</th>
                              <th>Value(in AED)</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php

                            $_salesId = "SELECT Sid from salesman";
                            $_salesIdQuery = mysqli_query($db, $_salesId);
                            while($row=mysqli_fetch_array($_salesIdQuery)){

                              $Sid = $row['Sid'];
                              $_salesSql = "SELECT s.SName, b.Sid, count(*), sum(SalesAed) from booking b, salesman s where b.Sid='$Sid' and s.Sid='$Sid'";
                              $_salesQuery = mysqli_query($db, $_salesSql);

                              while($rows=mysqli_fetch_array($_salesQuery)){
                                //var_dump($rows);
                                echo "
                                  <tr>
                                    <td>".$rows['SName']."</td>
                                    <td>".$rows['count(*)']."</td>";
                                    if($rows['count(*)']==0){
                                      $rows['sum(SalesAed)']=0;
                                    }
                                    echo "<td>".$rows['sum(SalesAed)']."</td>
                                  </tr>
                                ";
                              }
                            }
                            ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="card">
                      <div class="card-body">
                        <table class="table summary-table" id="team-wise">
                          <thead>
                            <tr>
                              <th>Team</th>
                              <th>No. of Transactions</th>
                              <th>Value(in AED)</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php

                              $T_query = mysqli_query($db,"SELECT COUNT(b.SalesAed), Station, SUM(b.SalesAed) FROM booking b, salesman s WHERE b.Sid=s.Sid GROUP BY Station");

                              while($rows=mysqli_fetch_array($T_query)){
                                //var_dump($rows);   scwoll to the 1010
                                echo "
                                  <tr>
                                    <td>".$rows['Station']."</td>
                                    <td>".$rows['COUNT(b.SalesAed)']."</td>
                                    <td>".$rows['SUM(b.SalesAed)']."</td>
                                  </tr>
                                ";
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
        </div>
      </div>
    </div>

<?php include '../end.php' ?>
