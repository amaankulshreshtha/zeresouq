<?php
  include '../config.php';
  session_start();
  include '../start.php';
  include '../header.php';

  $month = date('m');
  $year = date('Y');

if(isset($_GET['month'])){
  $month = $_GET['month'];
}

if(isset($_GET['year'])){
  $year = $_GET['year'];
}
$term = $year."-".$month."-%";
?>

    <div class="container-fluid" id="dashboard">
      <div class="row">
        <div class="col-lg-1">
          <div id="options-wrapper">
            <div id="side-menu-container">
              <ul id="side-menu">
                <li class="side-menu-item prompt"><a href="dashboard-salesSum.php"><i class="fa fa-database" aria-hidden="true"></i></a></li>
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
                <div class="card" style="grid-column:1/3" id="calender-filter-wrapper">
                  <div class="card-body" id="calender-filter">
                    <h5>Search for records</h5>
                    <hr />
                    <br />
                    <form action='dashboard-salesman.php' method='GET' style="display:flex; justify-content: space-between">
                      <select name='year'>
                        <option selected disabled value>-- select a year --</option>
                        <option value='%'> All </option>
                        <?php
                         $ny = date('Y');
                         $ny = $ny + 2;
                         for($y=2014; $y<$ny; $y=$y+1){
                           echo "<option value='$y'>$y</option>";
                         }
                        ?>
                      </select>
                      <select name='month' style="text-align:center">
                        <option selected disabled value>-- select a month --</option>
                        <option value='%'> All </option>
                        <option value='01'> January </option>
                        <option value='02'> February </option>
                        <option value='03'> March </option>
                        <option value='04'> April </option>
                        <option value='05'> May </option>
                        <option value='06'> June </option>
                        <option value='07'> July </option>
                        <option value='08'> August </option>
                        <option value='09'> September </option>
                        <option value='10'> October </option>
                        <option value='11'> November </option>
                        <option value='12'> December </option>
                      </select>
                    <button class="btn btn-primary" type="submit" name="submit">Search</button>
                  </form>
                  </div>
                </div>
                <div class="card">
                  <div class="card-body">

                    <h4>ZQ Daily Sales Summary</h4>
                    <hr class="header-hr"/>

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

                        $sql ="SELECT IFNULL(BDate,'Total') as Date, BDate, COUNT(*) as Transaction, SUM(SalesAed) FROM booking where BDate LIKE '$term' GROUP BY BDate ASC WITH ROLLUP";
                        $res = mysqli_query($db, $sql);
                        $max = mysqli_fetch_array(mysqli_query($db, "SELECT SUM(SalesAed) FROM booking GROUP BY BDate ORDER BY SUM(SalesAed) DESC LIMIT 1"));
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
                  <div class="card-body" style='overflow-x: scroll;'>
                    <h4>Sales Value</h4>
                    <hr class="header-hr"/>
                    <table class="summary-table table" id="salesman-sum">
                      <tbody>
                        <?php
                        //   $month = date('m');
                        //   $year = date('Y');
                        //
                        // if(isset($_GET['month'])){
                        //   $month = $_GET['month'];
                        // }
                        //
                        // if(isset($_GET['year'])){
                        //   $year = $_GET['year'];
                        // }?>
                        <thead>
                          <tr>
                            <?php
                            $salesman=mysqli_query($db,"SELECT * FROM salesman");
                            while($rows=mysqli_fetch_array($salesman)){
                              echo "<th>".$rows['SName']."</th>";
                            }
                            ?>
                          </tr>
                        </thead>
                        <?php
                        $date = '0';
                        // $term = $year."-".$month."-%";
                        //echo "<br/>".$term;
                        $res1=mysqli_query($db, "SELECT DISTINCT(BDate) from booking where BDate LIKE '$term' order by BDate");



                        while($row1=mysqli_fetch_array($res1)){
                          $date = $row1['BDate'];
                          echo "<tr>";

                          $res2=mysqli_query($db,"SELECT DISTINCT(Sid) from salesman");
                          while($row2=mysqli_fetch_array($res2)){
                            $sid = $row2['Sid'];

                            $res3=mysqli_query($db,"SELECT SUM(SalesAed) from booking where BDate = '$date' && Sid='$sid'");
                            while($row3=mysqli_fetch_array($res3)){
                              $number = $row3['SUM(SalesAed)'];
                              if($number > 0)
                              echo "<td>$number</td>";
                              else if($number == NULL)
                              echo "<td>0</td>";
                            }
                          }
                          echo "</tr>";
                        }

                        echo "<tr>";
                        $res2=mysqli_query($db,"SELECT DISTINCT(Sid) from salesman");
                        while($row2=mysqli_fetch_array($res2)){
                          $sid = $row2['Sid'];

                            $totalMonth = mysqli_query($db, "SELECT Sid, SUM(SalesAed) from booking where BDate LIKE '$term' && Sid = '$sid'");
                              while($rows=mysqli_fetch_array($totalMonth)){
                                $number = $rows['SUM(SalesAed)'];
                                if($number > 0)
                                echo "<td>$number</td>";
                                else if($number == NULL)
                                echo "<td>0</td>";
                              }
                          }
                        echo "</tr>";
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
                        <h4>ZQ Sales Summary: Salesman-wise</h4>
                        <hr class="header-hr"/>
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
                              $_salesSql = "SELECT s.SName, b.Sid, count(*), sum(SalesAed) from booking b, salesman s where b.Sid='$Sid' and s.Sid='$Sid' and b.BDate LIKE '$term'";
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
                        <h4>ZQ Sales Summary: Team-wise</h4>
                        <hr class="header-hr"/>
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

                            // $T_query = mysqli_query($db,"SELECT COUNT(*), COUNT(b.SalesAed), Station, SUM(b.SalesAed) FROM booking b, salesman s WHERE b.Sid=s.Sid AND BDate LIKE '$term' GROUP BY Station");
                              $T_query = mysqli_query($db,"SELECT * FROM booking b, salesman s WHERE b.Sid=s.Sid AND BDate LIKE '$term'");

                              $Istation = $Icount = $Isum = $Ustation = $Ucount = $Usum = 0;
                              while($rows=mysqli_fetch_array($T_query)){

                                if($rows['Station']=='IND'){
                                  $Istation = $rows['Station'];
                                  $Icount = $Icount + 1;
                                  $Isum = $Isum + $rows['SalesAed'];}
                                if($rows['Station']=='UAE'){
                                  $Ustation = $rows['Station'];
                                  $Ucount = $Ucount + 1;
                                  $Usum = $Usum + $rows['SalesAed'];}

                                }

                                echo "<tr>
                                        <td>IND</td>
                                        <td>$Icount</td>
                                        <td>$Isum</td>
                                      </tr>
                                      <tr>
                                          <td>UAE</td>
                                          <td>$Ucount</td>
                                          <td>$Usum</td>
                                        </tr>"




                                // echo "
                                //   <tr>
                                //     <td>".$rows['Station']."</td>";
                                //     if($rows['COUNT(*)']==0){
                                //       $rows['COUNT(b.SalesAed)']=0;
                                //       $rows['SUM(b.SalesAed)']=0;
                                //     }
                                //     echo "
                                //     <td>".$rows['COUNT(b.SalesAed)']."</td>
                                //     <td>".$rows['SUM(b.SalesAed)']."</td>
                                //   </tr>
                                // ";

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
