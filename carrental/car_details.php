<?php 
session_start();
include('includes/config.php');
error_reporting(0);
if(isset($_POST['submit']))
{
  $fromdate=$_POST['fromdate'];
  $todate=$_POST['todate']; 
  $message=$_POST['message'];
  $useremail=$_SESSION['login'];
  $status=0;
  $vhid=$_GET['vhid'];
  $bookingno=mt_rand(100000000, 999999999);
  $ret="SELECT * FROM tblbooking where (:fromdate BETWEEN date(FromDate) and date(ToDate) || :todate BETWEEN date(FromDate) and date(ToDate) || date(FromDate) BETWEEN :fromdate and :todate) and VehicleId=:vhid";
  $query1 = $dbh -> prepare($ret);
  $query1->bindParam(':vhid',$vhid, PDO::PARAM_STR);
  $query1->bindParam(':fromdate',$fromdate,PDO::PARAM_STR);
  $query1->bindParam(':todate',$todate,PDO::PARAM_STR);
  $query1->execute();
  $results1=$query1->fetchAll(PDO::FETCH_OBJ);

  if($query1->rowCount()==0)
  {

    $sql="INSERT INTO  tblbooking(userEmail,VehicleId,FromDate,ToDate,message,Status,BookingNumber) VALUES(:useremail,:vhid,:fromdate,:todate,:message,:status,:bookingno)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':useremail',$useremail,PDO::PARAM_STR);
    $query->bindParam(':vhid',$vhid,PDO::PARAM_STR);
    $query->bindParam(':fromdate',$fromdate,PDO::PARAM_STR);
    $query->bindParam(':todate',$todate,PDO::PARAM_STR);
    $query->bindParam(':message',$message,PDO::PARAM_STR);
    $query->bindParam(':status',$status,PDO::PARAM_STR);
    $query->bindParam(':bookingno',$bookingno,PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if($lastInsertId)
    {
      echo "<script>alert('Booked successfuly.');</script>";
      echo "<script type='text/javascript'> document.location = 'my_booking.php'; </script>";
    }
    else 
    {
      echo "<script>alert('Something went wrong. Please try again');</script>";
      echo "<script type='text/javascript'> document.location = 'car_list.php'; </script>";
    } 
  }  else{
   echo "<script>alert('Car already booked for these days');</script>"; 
   echo "<script type='text/javascript'> document.location = 'car_list.php'; </script>";
 }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>HelloCab|Car Details</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800|Montserrat:300,400,700" rel="stylesheet">
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link href="css/style.css" rel="stylesheet"> 
</head>

<body id="body"> 
 <section id="innerBanner"> 
 <?php include('includes/header.php');?>
  <div class="inner-content">
    <h2>ABOUT CAR</h2>
    <p>We provide high quality and well serviced cars</p>
    <div> 
    </div>
  </div> 
</section>

<main id="main">
      <section id="clients"  class="wow fadeInUp">
        <div class="container">
          <div class="section-header">
            <h2>Car details</h2>
            <p>With every safety feature and every standard in our Community Guidelines, we're committed to helping to create a safe environment for our users.</p>
          </div>
          <?php 
          $vhid=intval($_GET['vhid']);
          $sql = "SELECT tblvehicles.*,tblbrands.BrandName,tblbrands.id as bid  from tblvehicles join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand where tblvehicles.id=:vhid";
          $query = $dbh -> prepare($sql);
          $query->bindParam(':vhid',$vhid, PDO::PARAM_STR);
          $query->execute();
          $results=$query->fetchAll(PDO::FETCH_OBJ);
          $cnt=1;
          if($query->rowCount() > 0)
          {
            foreach($results as $result)
            {  
              $_SESSION['brndid']=$result->bid;  
              ?>  
            </div>
          </section>

          <section class="listing-detail">
            <div class="container">
              <div class="listing_detail_head row" style="margin-top: -40px;">
              <div class="vehicle_img"> <a href="car_details.php?vhid=<?php echo htmlentities($result->vid);?>"><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1);?>" alt="image" width="40%"></a> </div>

                <div class="col-md-9">
                  <h2 style="color: #60a3bc;"><?php echo htmlentities($result->BrandName);?> , <?php echo htmlentities($result->VehiclesTitle);?></h2>
                </div>
                <div class="col-md-3">
                  <div class="price_info">
                    <p>$<?php echo htmlentities($result->PricePerDay);?> </p>Per Day

                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-9">
                  <div class="main_features">
                    <ul>
                      <li> <i class="fa fa-calendar" aria-hidden="true"></i>
                        <h5><?php echo htmlentities($result->ModelYear);?></h5>
                        <p>Reg.Year</p>
                      </li>
                      <li> <i class="fa fa-cogs" aria-hidden="true"></i>
                        <h5><?php echo htmlentities($result->FuelType);?></h5>
                        <p>Fuel Type</p>
                      </li>

                      <li> <i class="fa fa-user-plus" aria-hidden="true"></i>
                        <h5><?php echo htmlentities($result->SeatingCapacity);?></h5>
                        <p>Seats</p>
                      </li>
                    </ul>
                  </div>
                  <div class="listing_more_info">
                    <div class="listing_detail_wrap"> 
                      <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active" style="color: #fff;">
                          <a href="#vehicle-overview " aria-controls="vehicle-overview" role="tab" data-toggle="tab" style="color: #1289A7;">Vehicle Overview </a>
                        </li>
                        <li role="presentation"><a href="#accessories" aria-controls="accessories" role="tab" data-toggle="tab" style="color: #1289A7;">Accessories</a></li>
                      </ul>

                      <div class="tab-content"> 
                        <div role="tabpanel" class="tab-pane active" id="vehicle-overview">

                          <p style="color: #1289A7;"><?php echo htmlentities($result->VehiclesOverview);?></p>
                        </div>


                        <div role="tabpanel" class="tab-pane" id="accessories"> 
                          <table>
                            <thead>
                              <tr>
                                <th colspan="2" style="color: #1289A7;">Accessories</th>
                              </tr>
                            </thead>
                            <tbody style="color: #1289A7;">
                              <tr>
                                <td>Air Conditioner</td>
                                <?php if($result->AirConditioner==1)
                                {
                                  ?>
                                  <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                  <?php 
                                } else { ?> 
                                 <td><i class="fa fa-close" aria-hidden="true"></i></td>
                                 <?php 
                               } ?> </tr>

                              <tr>
                                <td>Power Steering</td>
                                <?php if($result->PowerSteering==1)
                                {
                                  ?>
                                  <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                <?php } else { ?>
                                  <td><i class="fa fa-close" aria-hidden="true"></i></td>
                                <?php } ?>
                              </tr>

                              <tr>
                                <td>CD Player</td>
                                <?php if($result->CDPlayer==1)
                                {
                                  ?>
                                  <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                <?php } else { ?>
                                  <td><i class="fa fa-close" aria-hidden="true"></i></td>
                                <?php } ?>
                              </tr>

                              <tr>
                                <td>Leather Seats</td>
                                <?php if($result->LeatherSeats==1)
                                {
                                  ?>
                                  <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                <?php } else { ?>
                                  <td><i class="fa fa-close" aria-hidden="true"></i></td>
                                <?php } ?>
                              </tr>

                              <tr>
                                <td>Central Locking</td>
                                <?php if($result->CentralLocking==1)
                                {
                                  ?>
                                  <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                <?php } else { ?>
                                  <td><i class="fa fa-close" aria-hidden="true"></i></td>
                                <?php } ?>
                              </tr>

                              <tr>
                                <td>Power Door Locks</td>
                                <?php if($result->PowerDoorLocks==1)
                                {
                                  ?>
                                  <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                <?php } else { ?>
                                  <td><i class="fa fa-close" aria-hidden="true"></i></td>
                                <?php } ?>
                              </tr>
                              <tr>
                                <td>Brake Assist</td>
                                <?php if($result->BrakeAssist==1)
                                {
                                  ?>
                                  <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                <?php  } else { ?>
                                  <td><i class="fa fa-close" aria-hidden="true"></i></td>
                                <?php } ?>
                              </tr>


                            <tr>
                              <td>Crash Sensor</td>
                              <?php if($result->CrashSensor==1)
                              {
                                ?>
                                <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                <?php 
                              } else { ?>
                                <td><i class="fa fa-close" aria-hidden="true"></i></td>
                                <?php
                              } ?>
                            </tr>

                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>

                </div>
                <?php 
              }
            } ?>

          </div>

          <aside class="col-md-3">

            <div class="sidebar_widget">
              <div class="widget_heading" >
                <h5 style="color: #000;"><i class="fa fa-envelope" aria-hidden="true"></i> Book Now</h5>
              </div>
              <form method="post">
                <div class="form-group">
                  <label style="color: #1289A7;font-weight:bold;font-size:18px;">From Date:</label>
                  <input type="date" class="form-control" name="fromdate" placeholder="From Date" required style="background-color: #fff;border:1px solid #ef7392;height:40px;">
                </div>
                <div class="form-group">
                  <label style="color: #1289A7;font-weight:bold;font-size:18px;">To Date:</label>
                  <input type="date" class="form-control" name="todate" placeholder="To Date" required style="background-color: #fff;border:1px solid #ef7392;height:40px;">
                </div>
                <div class="form-group">
                  <textarea rows="4" class="form-control" name="message" placeholder="Message" required style="background-color: #fff;border:1px solid #ef7392;"></textarea>
                </div>
                <?php if($_SESSION['login'])
                {?>
                  <div class="form-group">
                    <input type="submit" class="btn" style="background-color: #ef9273;color:#fff;"  name="submit" value="Book Now">
                  </div>
                  <?php 
                } else { ?>
                  <a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal" data-dismiss="modal" style="background-color: #49a3ff;color:#fff;">Login For Book</a>

                  <?php 
                } ?>
              </form>
            </div>
          </aside>
        </div>

        <div class="space-20"></div>
        <div class="divider"></div>

     </div>
   </section>



    </main>

    <?php include('includes/footer.php');?>

    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

    <?php include('includes/login.php');?>
    <?php include('includes/registration.php');?>

    <!-- JavaScript  -->
    <script src="lib/jquery/jquery.min.js"></script>
    <script src="lib/jquery/jquery-migrate.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/superfish/hoverIntent.js"></script>
    <script src="lib/superfish/superfish.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/sticky/sticky.js"></script> 
    <script src="contact/jqBootstrapValidation.js"></script>
    <script src="contact/contact_me.js"></script>
    <script src="js/main.js"></script>

  </body>
  </html>
