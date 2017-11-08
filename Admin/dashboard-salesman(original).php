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
                        //

                        $res1=mysqli_query($db,"SELECT DISTINCT(BDate) from booking order by BDate");

                        while($row=mysqli_fetch_array($res1)){

                        $limit = 11;
                        if (isset($_GET['page']) & !empty($_GET['page'])) {
                           $page  = $_GET['page'];
                        }else {
                          $page=1;
                        }
                        //echo $page;
                        $start = ($page * $limit) - $limit;

                        $N_sql = "SELECT *, SUM(SalesAed), s.SName FROM booking, salesman s LIMIT $start, $limit";
                        $N_res = mysqli_query($db, $N_sql);

                        $total = mysqli_query($db,"SELECT * FROM salesman");
                        $noOfRows = mysqli_num_rows($total);

                        while($rows=mysqli_fetch_array($N_res)){
                          //var_dump($rows);
                          echo "
                            <th scope='row'>".$rows['SName']."</th>
                          ";
                        }
                        ?>
                        <?php

                        // $date = '0';
                        $leena = $antonette = $sameer = $amit = $suraj = $joanna = $mary = $blossom= $anmol = $jo = $anne= 0;
                        $tleena = $tantonette = $tsameer = $tamit = $tsuraj = $tjoanna = $tmary = $tblossom= $tanmol = $tjo = $tanne= 0;
                        // $totalDay=0;
                        // $totalMonth=0;
                        $data="
                        <tr>
                          <?php if(!$leena){?>
                            <td style='color:red'><?php echo $leena; ?></td>
                          <?php }else{ ?>
                            <td><?php echo $leena; ?></td>
                          <?php }
                           if(!$antonette){?>
                            <td style='color:red'><?php echo $antonette; ?></td>
                          <?php }else{ ?>
                            <td><?php echo $antonette; ?></td>
                          <?php }
                           if(!$sameer){?>
                            <td style='color:red'><?php echo $sameer; ?></td>
                          <?php }else{ ?>
                            <td><?php echo $sameer; ?></td>
                          <?php }
                            if(!$amit){?>
                              <td style='color:red'><?php echo $amit; ?></td>
                          <?php }else{ ?>
                              <td><?php echo $amit; ?></td>
                          <?php }
                            if(!$suraj){?>
                              <td style='color:red'><?php echo $suraj; ?></td>
                          <?php }else{ ?>
                                <td><?php echo $suraj; ?></td>
                          <?php }
                            if(!$joanna){?>
                             <td style='color:red'><?php echo $joanna; ?></td>
                           <?php }else{ ?>
                             <td><?php echo $joanna; ?></td>
                           <?php }
                             if(!$mary){?>
                              <td style='color:red'><?php echo $mary; ?></td>
                           <?php }else{ ?>
                              <td><?php echo $mary; ?></td>
                           <?php }
                              if(!$blossom){?>
                               <td style='color:red'><?php echo $blossom; ?></td>
                           <?php }else{ ?>
                               <td><?php echo $blossom; ?></td>
                           <?php }
                             if(!$anmol){?>
                              <td style='color:red'><?php echo $anmol; ?></td>
                           <?php }else{ ?>
                              <td><?php echo $anmol; ?></td>
                           <?php }
                              if(!$jo){?>
                               <td style='color:red'><?php echo $jo; ?></td>
                           <?php }else{ ?>
                               <td><?php echo $jo; ?></td>
                           <?php }
                               if(!$anne){?>
                                <td style='color:red'><?php echo $anne; ?></td>
                           <?php }else{ ?>
                                <td><?php echo $anne; ?></td>
                           <?php } ?>
                        </tr>";
                        //PUT DATA IN THE TABLE

                        $data2= "
                        <tr style='border-top: 1px solid #000'>
                          <td>$tleena</td>
                          <td>$tantonette</td>
                          <td>$tsameer</td>
                          <td>$tamit</td>
                          <td>$tsuraj</td>
                          <td>$tjoanna</td>
                          <td>$tmary</td>
                          <td>$tblossom</td>
                          <td>$tanmol</td>
                          <td>$tjo</td>
                          <td>$tanne</td>
                        </tr>";
                        //PUT data2 after the last row


                            $date = $row['BDate'];
                          //echo $date;
                            // $res2 = mysqli_query($db,"SELECT IFNULL((SELECT SUM(SalesAed) where BDate = '$date' GROUP BY Sid), 0)" );
                            $res2 = mysqli_query($db,"SELECT SUM(SalesAed), Sid from booking where BDate = '$date' GROUP BY Sid");
                            $side = 1000;
                            ?>
                            <!-- //var_dump(mysqli_fetch_array($res2)); -->
                            <tr>
                            <?php while($rows2=mysqli_fetch_array($res2)){
                              echo "
                              <td>";
                                $res3 = mysqli_query($db,"SELECT Sid from salesman");
                                // while($rows3=mysqli_fetch_array($res3)){
                                    // if($rows2['Sid']==$rows3['Sid']){
                                      echo $rows2['SUM(SalesAed)'];
                                    // }else{
                                //     echo ;
                                //   }
                                // }
                                echo "</td>";
                                  }
                              echo "</tr>";
                            }
                            //$totalDay = 0;
                          //  $res3 =mysqli_query($db,"SELECT * from booking where BDate = '$date'");
                          //  while($rows=mysqli_fetch_array($res3)){

                          //   if($rows['Sid']=='1000'){
                          //     $leena = $leena + $rows['SalesAed'];
                          //     $tleena = $tleena + $rows['SalesAed'];
                          //   }
                          //   else if($rows['Sid']=='1001'){
                          //     $antonette = $antonette + $rows['SalesAed'];
                          //     $tantonette = $tantonette +  $rows['SalesAed'];
                          //   }
                          //   else if($rows['Sid']=='1002'){
                          //     $sameer = $sameer + $rows['SalesAed'];
                          //     $tsameer = $tsameer + $rows['SalesAed'];
                          //   }
                          //   else if($rows['Sid']=='1003'){
                          //     $amit = $amit + $rows['SalesAed'];
                          //     $tamit = $tamit + $rows['SalesAed'];
                          //   }
                          //   else if($rows['Sid']=='1004'){
                          //     $suraj = $suraj + $rows['SalesAed'];
                          //     $tsuraj = $tsuraj +  $rows['SalesAed'];
                          //   }
                          //   else if($rows['Sid']=='1005'){
                          //     $joanna = $joanna + $rows['SalesAed'];
                          //     $tjoanna = $tjoanna +  $rows['SalesAed'];
                          //   }
                          //   else if($rows['Sid']=='1006'){
                          //     $mary = $mary + $rows['SalesAed'];
                          //     $tmary = $tmary +  $rows['SalesAed'];
                          //   }
                          //   else if($rows['Sid']=='1007'){
                          //     $blossom = $blossom + $rows['SalesAed'];
                          //     $tblossom = $tblossom +  $rows['SalesAed'];
                          //   }
                          //   else if($rows['Sid']=='1008'){
                          //     $anmol = $anmol + $rows['SalesAed'];
                          //     $tanmol = $tanmol +  $rows['SalesAed'];
                          //   }
                          //   else if($rows['Sid']=='1009'){
                          //     $jo = $jo + $rows['SalesAed'];
                          //     $tjo = $tjo +  $rows['SalesAed'];
                          //   }
                          //   else if($rows['Sid']=='1010'){
                          //     $anne = $anne + $rows['SalesAed'];
                          //     $tanne = $tanne +  $rows['SalesAed'];
                          //   }
                          // }
                          ?>

                      </tbody>

                      <?php
                      $endPage = ceil($noOfRows/$limit);
                      $previousThirdPage = $page-2;
                      $previousPage = $page-1;
                      $startPage = $page-5;
                      $nextPage = $page+1;
                      $thirdPage = $page+2;
                      $end = $page+5;
                      $beginning = 1;
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
