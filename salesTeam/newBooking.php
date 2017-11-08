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
            <a href="salesSum.php"><li class="side-menu-item prompt active">Sales Summary</li></a>
            <a href="#"><li class="side-menu-item prompt">New Booking</li></a>
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
              <h3>Add a New Booking</h3>
              <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" id="newBooking">
                <div class="form-group"><label>Name: </label><input name="Name" accept-charset="UTF-8"/></div>
                <div class="form-group"><label>FbName: </label><input name="FbName" accept-charset="UTF-8"/></div>
                <div class="form-group"><label>Email: </label><input name="CEmail" accept-charset="UTF-8"/></div>
                <div class="form-group"><label>Mobile: </label><input name="CMobile" accept-charset="UTF-8" type="tel"/></div>
                <div class="form-group">
                  <label>Location: </label>
                  <select name="CLocation">
                    <option disabled selected value>-- select an option -- </option>
                    <option>Abu Dhabi</option>
                    <option>Ajman</option>
                    <option>Bahrain</option>
                    <option>Bangladesh</option>
                    <option>Dubai</option>
                    <option>Europe</option>
                    <option>Fujairah</option>
                    <option>India</option>
                    <option>Kuwait</option>
                    <option>Oman</option>
                    <option>Pakistan</option>
                    <option>Philippines</option>
                    <option>Qatar</option>
                    <option>Ras al-Khaimah</option>
                    <option>Saudi Arabia</option>
                    <option>Sharjah</option>
                    <option>UK</option>
                    <option>Umm al-Quwain</option>
                    <option>USA</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Currency: </label>
                  <select name="Currency">
                    <option disabled selected value>-- select an option -- </option>
                    <option value='AED'>AED</option>
                    <option value='BHD'>BHD</option>
                    <option value='BDT'>BDT</option>
                    <option value='EUR'>EUR</option>
                    <option value='GBP'>GBP</option>
                    <option value='INR'>INR</option>
                    <option value='KWD'>KWD</option>
                    <option value='OMR'>OMR</option>
                    <option value='PKR'>PKR</option>
                    <option value='PHP'>PHP</option>
                    <option value='QAR'>QAR</option>
                    <option value='SAR'>SAR</option>
                    <option value='USD'>USD</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Payment Method: </label>
                  <select name="PaymentMethod">
                    <option disabled selected value>-- select an option -- </option>
                    <option value="COD">COD</option>
                    <option value="Credit Card">Credit Card</option>
                    <option value="Handcash">Handcash</option>
                  </select>
                </div>
                <div class="form-group"><label>Sales Value: </label><input name="SalesValue" accept-charset="UTF-8"/></div>
                <div class="form-group">
                  <!-- <label>Salesman ID: </label><input name="SalesMan" hidden value="<?php //echo $_SESSION['id']; ?>"/>
                  <?php //echo $_SESSION['id']; ?> -->
                </div>
                <button type="submit" name="submit" class="btn submit-btn">Submit</button>
              </form>

              <?php
                  if($_SERVER['REQUEST_METHOD']=='POST'){
                    $Cname = trim($_POST['Name']);
                    $FbName = trim($_POST['FbName']);
                    $CEmail = trim($_POST['CEmail']);
                    if($_POST['CMobile']){
                      $CMobile = trim($_POST['CMobile']);
                    }else {
                      $CMobile = "NULL";
                    }
                    $CLocation = trim($_POST['CLocation']);
                    $Currency = $_POST['Currency'];
                    $PaymentMethod = trim($_POST['PaymentMethod']);
                    $SalesValue = trim($_POST['SalesValue']);
                    $SEmail = trim($_SESSION['user']);
                    // var_dump($Currency);
                    // echo $Currency;

                  $convert = mysqli_query($db, "SELECT * FROM rates WHERE Currency = '$Currency'");
                  $rows=mysqli_fetch_array($convert);
                  if($rows['Rate']==0){
                    $SalesAed = $SalesValue;
                  }else{
                      $SalesAed = $SalesValue/$rows['Rate'];
                  }

                  // echo $SalesAED;


                  $_IdResult = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM salesman WHERE SEmail = '$SEmail'"));

                  // var_dump($_IdResult);
                  $Sid = $_SESSION['id'];

                //https://stackoverflow.com/questions/46931021/amcharts-funnel-chart-how-to-set-fixed-height
                  date_default_timezone_set('Asia/Dubai');
                  $date = date("Y-m-d"); //this format work ?
                  $time = date("h:i:sa");
                  // var_dump($rows);
                  $Crows = mysqli_fetch_array(mysqli_query($db,"SELECT * from customer"));
                  $Brows = mysqli_fetch_array(mysqli_query($db,"SELECT * from booking"));
                    if($CEmail==$Crows['CEmail'] and $date==$Brows['BDate']){
                      echo "User Present!";
                    }else {

                      $_Cinsert = "INSERT INTO customer (Cname,FbName,CEmail,CMobile,CLocation) VALUES ('$Cname','$FbName','$CEmail','$CMobile','$CLocation')";
                      $_Csql = mysqli_query($db, $_Cinsert);
                      $_Cselect = "SELECT * FROM customer ORDER BY Cid DESC limit 1";
                      $_Cresult = mysqli_fetch_array(mysqli_query($db, $_Cselect));

                      //var_dump($_Cresult['Cid']); ek sec baba
                      // if($result === FALSE){
                      //   printf("Error: %s \n" ,mysqli_error($result));
                      // }
                      // $saleResult = mysqli_fetch_array($result);
                      // $custResult = mysqli_fetch_array(mysqli_query($db, $customerInsert));
                      //
                      // var_dump($custResult);
                      // echo $SalesAed;
                      $Cid = $_Cresult['Cid'];
                      $insert = "INSERT INTO booking (BDate, BTime, Sid, Cid, Currency, SalesValue, SalesAed, PaymentMethod )VALUES('$date','$time','$Sid','$Cid','$Currency','$SalesValue','$SalesAed','$PaymentMethod')";
                      mysqli_query($db, $insert);
                    }
                  }
              ?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
